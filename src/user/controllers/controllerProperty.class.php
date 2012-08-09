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

	private function storeFeatures(Property $object)
	{
//		if (!($list = $this->getForm()->getValue('featureList'))) {
//			throw new WrongArgumentException('Do not have featureList to store');
//		}

		$featureList = $object->getFeatures()->getList();
		foreach ($list as $typeId => $row) {
			if (
				empty($row['value'])
				&& empty($row['comment'])
			) {
				if (!empty($row['id']))
					Feature::dao ()->dropById($row['id']);
			} else {
				$feature = Feature::create()->
					setPropertyId($object->getId())->
					setTypeId($typeId)->
					setValue($row['value'])->
					setContent($row['content']);

				if (!empty($row['id']))
					$feature->setId($row['id']);

				$feature->dao()->take($feature);
			}
		}

		return $object;

	}
}
