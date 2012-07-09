<?php
/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */


/**
 * Property management controller
 *
 * @author htonus
 */
final class controllerProperty extends CommonEditor
{
	public function __construct()
	{
		parent::__construct(Property::create());

		$this->getForm()->add(
			Primitive::set('featureList')
		);
	}

	protected function attachCollections(Model $model)
	{
		parent::attachCollections($model);

		$model->set('featureList', $this->createFeatureList());

		return $this;
	}
	
	private function createFeatureList()
	{
		$typeList = FeatureType::dao()->getPlainList();
		
		$featureList = array();

		if ($this->getForm()->getValue('id')) {
			$features = $this->getForm()->getValue('id')->
				getFeatures()->
					getList();
			
			$featureList = array();
			foreach ($features as $feature) {
				$featureList[$feature->getType()->getId()] = $feature;
			}
		}

		$list = array();
		foreach ($typeList as $featureType) {
			if (isset($featureList[$featureType->getId()])) {
				$list[$featureType->getId()] = $featureList[$featureType->getId()];
			} else {
				$list[$featureType->getId()] = Feature::create()->
					setType($featureType);
			}
		}

		return $list;
	}

	protected function addObject(HttpRequest $request, Form $form, Identifiable $object)
	{
		$subject =  parent::addObject($request, $form, $object);
		return $this->storeFeatures($subject);
	}

	protected function saveObject(HttpRequest $request, Form $form, Identifiable $object)
	{
		$subject = parent::saveObject($request, $form, $object);
		return $this->storeFeatures($subject);
	}

	private function storeFeatures(Property $object)
	{
		if (!($list = $this->getForm()->getValue('featureList'))) {
			throw new WrongArgumentException('Do not have featureList to store');
		}

		$featureList = $object->getFeatures()->getList();

		foreach ($list as $row) {

		}
	}
}
