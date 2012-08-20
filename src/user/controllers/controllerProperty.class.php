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
			drop('offerType')->
			add(
				Primitive::enumerationByValue('offerType')->
					of('OfferType')->
					setDefault(OfferType::buy())
			)->
			add(
				Primitive::set('type')->
				setDefault(array())
			);
		
//		$this->map->addSource('offerType', RequestType::get());
	}

	public function handleRequest(HttpRequest $request)
	{
		$mav = parent::handleRequest($request);
		$model = $mav->getModel();
		
		if (
			$model->has('editorResult')
			&& $model->has('editorResult') == PrototypedEditor::COMMAND_SUCCEEDED
			&& $model->has("action")
			&& $model->get('action') != 'drop'
		) {
			$this->storeFeatures($model->get('subject'));
			$request->setAttachedVar('layout', 'json');
			
			$mav->setModel(
				Model::create()->set(
					'data',
					array(
						'result'	=> PrototypedEditor::COMMAND_SUCCEEDED,
						'id'		=> $model->get('subject')->getId()
					)
				)
			);
		} else {
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
			set('typeList', FeatureType::dao()->getPlainList())->
			set('cityList', City::dao()->getCityList());
		
		return $this;
	}

	private function storeFeatures(Property $object)
	{
		if (!($list = $this->getForm()->getValue('type'))) {
//			need to drop features
			$object->getFeatures()->dropList()->save();
			return $object;
		}

		$features = $object->getFeatures()->fetch()->getList();
		
		foreach($features as $typeId => $type) {
			if (!isset($list[$typeId]))
				Feature::dao ()->drop($type);
		}
		
		foreach ($list as $typeId => $value) {
			if (isset($features[$typeId])) {
				$feature = $features[$typeId]->setValue($value);
			} else {
				$feature = Feature::create()->
					setPropertyId($object->getId())->
					setTypeId($typeId)->
					setValue($value);
			}
			
			$feature->dao()->take($feature);
		}

		return $object;
	}
}
