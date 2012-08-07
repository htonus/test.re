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
final class controllerProperty extends PrototypedEditor
{
	public function __construct()
	{
		parent::__construct(Property::create());

		$this->getForm()->
			add(
				Primitive::enumerationByValue('offer')->
					of('OfferType')->
					setDefault(OfferType::buy())
			);

		$this->map->addSource('offer', RequestType::get());
	}

	public function handleRequest(HttpRequest $request)
	{
		$mav = parent::handleRequest($request);

		if (!$mav->viewIsRedirect()) {
			$this->attachCollections($mav->getModel());
			$request->setAttachedVar('layout', 'main');
		}

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
