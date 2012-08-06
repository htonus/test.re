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
final class controllerAdd extends MethodMappedController
{
	public function __construct()
	{
		
		$this->
			setMethodMappingList(
				array(
					'sell'		=> 'actionSell',
					'lease'		=> 'actionLease',
					'property'	=> 'actionProperty',
					'images'	=> 'actionImages',
				)
			);
	}

	public function handleRequest(HttpRequest $request)
	{
		$mav = parent::handleRequest($request);

		return $mav;
	}

	public function actionSell(HttpRequest $request)
	{
		return ModelAndView::create();
	}
}
