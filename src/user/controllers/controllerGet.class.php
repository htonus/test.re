<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Get controller designed to serve AJAX requests
 *
 * @author htonus
 */
final class controllerGet extends MethodMappedController
{
	public function __construct()
	{
		
		$this->
			setMethodMappingList(
				array(
					'cities'	=> 'actionGetCityList',
				)
			);
	}

	public function handleRequest(HttpRequest $request)
	{
		$mav = parent::handleRequest($request);

		$request->setAttachedVar('layout', 'json');

		return $mav;
	}

	public function actionGetCityList(HttpRequest $request)
	{
		$form = Form::create()->
			add(
				Primitive::identifier('parent')->
					of('City')->
					optional()
			)->
			add(
				Primitive::string('sample')->
					addImportFilter(Filter::trim())->
					addImportFilter(Filter::lowerCase())->
					optional()
			)->
			import($request->getGet())->
			importMore($request->getPost());
		
		$criteria = Criteria::create(City::dao())->
			setProjection(
				Projection::chain()->
					add(
						Projection::property('id')
					)->
					add(
						Projection::property('name')
					)->
					add(
						Projection::property('parent')
					)
			);
		
		if ($parent = $form->getValue('parent')){
			$criteria->add(
				Expression::orBlock(
					Expression::eqId('parent', $parent),
					Expression::eqId('id', $parent)
				)
			);
		} else {
			$criteria->add(
				Expression::isNull('parent')
			);
		}

		if ($sample = $form->getValue('sample')) {
			$criteria->add(
				Expression::ilike('name', $sample.'%')
			);
		}
		
		return ModelAndView::create()->
			setModel(
				Model::create()->set('data', array('list' => $criteria->getCustomList()))
			);
	}
}
