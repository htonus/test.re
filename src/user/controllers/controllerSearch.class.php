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

	public function actionSearch(HttpRequest $request)
	{
		$form = Form::create()->
			add(
				Primitive::integer('priceMin')->
				setMin(0)->
				setMax(10)->
				setDefault(0)
			)->
			add(
				Primitive::integer('priceMax')->
				setMin(0)->
				setMax(10)->
				setDefault(0)
			)->
			add(
				Primitive::choice('offerType')->
				setList(EnumHelper::getNames('OfferType'))
			)->
			add(
				Primitive::choice('propertyType')->
				setList(EnumHelper::getNames('PropertyType'))
			)->
			add(
				Primitive::integer('bedrooms')->
				setMin(0)->
				setMax(10)->
				setDefault(0)
			)->
			add(
				Primitive::choice('bathrooms')->
				setMin(0)->
				setMax(10)->
				setDefault(0)
			)->
			import($request->getPost());
		
		$criteria = Criteria::create(Feature::dao())->
			setProjection(
				Projection::chain()->
					add(
						Projection::count('id')
					)->
					add(
						Projection::group('property')
					)
			);
		
		$logic = Expression::chain();
		
		if ($priceMax = $form->getValue('priceMax')) 
			$logic->expAnd(
				Expression::ltEq('price', $priceMax)
			);
		
		if ($priceMin = $form->getValue('priceMin')) 
			$logic->expAnd(
				Expression::gtEq('price', $priceMin)
			);
		
		if ($offerType = $form->getValue('offerType')) 
			$logic->expAnd(
				Expression::eqId('offerType', $offerType)
			);
		
		if ($propertyType = $form->getValue('propertyType')) 
			$logic->expAnd(
				Expression::eq ('propertyType', $propertyType)
			);
		
		if ($bedrooms = $form->getValue('bedrooms')) 
			$logic->expAnd(
				Expression::eq ('bedrooms', $bedrooms)
			);
		
		if ($bathrooms = $form->getValue('bathrooms')) 
			$logic->expAnd(
				Expression::eq ('bathrooms', $bathrooms)
			);
	}
	
}
