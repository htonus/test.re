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
	const PER_PAGE = 10;
	
	public function __construct()
	{
		
		$this->
			setMethodMappingList(
				array(
//					'index'	=> 'actionIndex',
					'buy'	=> 'actionBuy',
					'rent'	=> 'actionRent',
				)
			)->
			setDefaultAction('buy');
	}

	public function handleRequest(HttpRequest $request)
	{
		$mav = parent::handleRequest($request);

		$request->setAttachedVar('layout', 'main');

		return $mav;
	}
	
	protected function actionBuy(HttpRequest $request)
	{
		return $this->getListMav(OfferType::buy(), $request);
	}

	protected function actionRent(HttpRequest $request)
	{
		return $this->getListMav(OfferType::rent(), $request);
	}

	private function getListMav(OfferType $offerType, HttpRequest $request)
	{
		$propertyTypes = array_flip(EnumHelper::getNames('PropertyType'));
		
		$form = Form::create()->
			add(
				Primitive::set('type')->
				optional()
			)->
			add(
				Primitive::enumerationByValue('property')->
				of('PropertyType')->
				setDefault(PropertyType::property())
			)->
			add(
				Primitive::integer('page')->
					setMin(1)->
					setDefault(1)
			)->
			import($request->getGet())->
			importMore($request->getPost());

		$filters = $form->getValue('type');
//		$filters = array(
//			FeatureType::PRICE	=> array(
//				'min'	=> 100000,
////				'max'	=> 150000,
//			),
//			FeatureType::BEDROOMS => 2,
//			FeatureType::TOYLETS => 1,
//		);
		$typeCasts = FeatureType::getCasts();
		
		$orLogic = Expression::orBlock();
		$filterNumber = 0;
		foreach($typeCasts as $typeId => $castId) {
			if (!empty($filters[$typeId])) {
				$andBlock = Expression::andBlock()->
					expAnd(
						Expression::eq('features.type', $typeId)
					);
				
				switch ($castId) {
					case ProtoFeatureType::BOOLEAN:
						$andBlock->expAnd(
							Expression::eq('features.value', 1)
						);
						break;
					case ProtoFeatureType::INTEGER:
						$andBlock->expAnd(
							Expression::eq('features.value', $filters[$typeId])
						);
						break;
					case ProtoFeatureType::INT_RANGE:
						if (!empty($filters[$typeId]['min']))
							$andBlock->expAnd(
								Expression::gtEq ('features.value', $filters[$typeId]['min'])
							);
							
						if (!empty($filters[$typeId]['max']))
							$andBlock->expAnd(
								Expression::ltEq ('features.value', $filters[$typeId]['max'])
							);
						
						break;
				}
				
				$orLogic->expOr($andBlock);
				$filterNumber ++;
			}
		}
		
		$logic = Expression::chain()->
			expAnd(
				Expression::eqId("offerType", $offerType)
			);

		if (
			($property = $form->getValue('property'))
			&& ($property->getId() != PropertyType::PROPERTY)
		) {
			$logic->
				expAnd(
					Expression::eq("propertyType", $property)
				);
		}

		if ($orLogic->getSize()) {
			$logic->expAnd($orLogic);
		}
		
		$criteria = Criteria::create(Property::dao())->
			setProjection(
				Projection::chain()->
					add(
						Projection::count('features.id', 'relevance')
					)->
					add(
						Projection::property('id')
					)->
					add(
						Projection::group('id')
//					)->
//					add(	// Remove me in case of neighbores search
//						Projection::having(
//							Expression::eq(
//								SQLFunction::create(
//									'count',
//									'features.id'
//								),
//								$filterNumber
//							)
//						)
					)
			)->
			add($logic);
//				setLimit(self::PER_PAGE)->
//				addOrder(
//					OrderBy::create('relevance')->desc()
//				)->
//				setOffset(
//					($form->getActualValue('page') - 1) * self::PER_PAGE
//				);

//		StringHelper::dump($criteria->toString());
//		exit;
		$relevance = ArrayHelper::toKeyValueArray(
			$criteria->getCustomList(), 'id', 'relevance'
		);
		
		arsort($relevance);
		
		$logic = Expression::in('id', array_keys($relevance));
		
		// Need pager here
		
		$list = ArrayUtils::convertObjectList(Property::dao()->getListByLogic($logic));
		
		$model = Model::create()->
			set('relevance', $relevance)->
			set('list', $list)->
			set('page', $form->getActualValue('page'));
		
		return ModelAndView::create()->
			setModel($model);
	}
	
}
