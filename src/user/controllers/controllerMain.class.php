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
class controllerMain extends MethodMappedController
{
	public function __construct()
	{
		parent::setMethodMappingList(
			array(
				'buy'	=> 'actionIndex',
				'rent'	=> 'actionIndex',
			)
		)->
		setDefaultAction('buy');
	}

	public function actionIndex(HttpRequest $request)
	{
		$model = Model::create();
		
		$this->attachCollections($model);

		$mav = ModelAndView::create()->
			setModel($model);
		
		return $mav;
	}
	
	protected function attachCollections(Model $model)
	{
		$model->
			set(
				'propertyTypeList',
				EnumHelper::getAnyObject('PropertyType')->getDisplayNames()
			)->
			set('cityList', City::dao()->getCityList());
		
		return $this;
	}
}
