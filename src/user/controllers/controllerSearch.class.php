<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of main
 *
 * @author htonus
 */
final class controllerSearch extends MethodMappedController
{
	public function __construct()
	{
		
		$this->
			setMethodMappingList(
				array(
					'index'	=> 'actionIndex',
				)
			)->
			setDefaultAction('index');
	}

	public function handleRequest(HttpRequest $request)
	{
		$mav = parent::handleRequest($request);

		$request->setAttachedVar('layout', 'default');

		return $mav;
	}

	public function actionIndex(HttpRequest $request)
	{
		$form = Form::create()->
			add(
				Primitive::set('type')
			)->
			add(
				Primitive::choice('offerType')->
				setList(EnumHelper::getNames('OfferType'))->
				required()
			)->
			add(
				Primitive::choice('propertyType')->
				setList(EnumHelper::getNames('PropertyType'))->
				required()
			)->
			import($request->getPost());
		
		if ($form->getErrors()) {
			// Really weird
		}
		
		$filters = $form->getValue('type');
		$typeCasts = FeatureType::proto()->getCasts();
		
		$orLogic = Expression::orBlock();
		$filterNumber = 0;
		foreach($typeCasts as $typeId => $castId) {
			if (!empty($filters[$typeId])) {
				$andBlock = Expression::andBlock()->
					expAnd(
						Expression::eq('type', $typeId)
					);
				
				switch ($castId) {
					case ProtoFeatureType::BOOLEAN:
						$andBlock->expAnd(
							Expression::eq('value', 1)
						);
						break;
					case ProtoFeatureType::INTEGER:
						$andBlock->expAnd(
							Expression::eq('value', $filters[$typeId])
						);
						break;
					case ProtoFeatureType::INT_RANGE:
						$start = $filters[$typeId];
						
						$andBlock->expAnd(
							Expression::between('value', ($start - 1) * 100000, $start * 100000)
						);
						break;
				}
				
				$orLogic->expOr($andBlock);
				$filterNumber ++;
			}
		}
		
		$criteria = Criteria::create(Feature::dao())->
			setProjection(
				Projection::chain()->
				add(
					Projection::count('id', 'matchCount')
				)->
				add(
					Projection::property('property')
				)->
				add(
					Projection::group('property')
				)->
				add(
					Projection::having(
						Expression::eq(
							SQLFunction::create(
								'count',
								DBField::create('id', Feature::dao()->getTable())
							),
							$filterNumber
						)
					)
				)
			)->
			add(
				Expression::chain()->
				expAnd(
					Expression::eq(
						'property.propertyType', $form->getValue('propertyType')
					)
				)->
				expAnd(
					Expression::eq(
						'property.offerType', $form->getValue('offerType')
					)
				)->
				expAnd($orLogic)
			)->
			addOrder(
				OrderBy::create('matchCount')->desc()
			);
		echo $criteria->toString();
	}
	
}
