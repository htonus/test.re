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
final class controllerMain extends MethodMappedController
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
		$model = Model::create();

		$this->attachCollections($model);

		$mav = ModelAndView::create()->
			setModel($model);

		return $mav;
	}

	private function attachCollections(Model $model)
	{
		$model->set('propertyTypeList', EnumHelper::getPlainList('PropertyType'));
		return $this;
	}
}
