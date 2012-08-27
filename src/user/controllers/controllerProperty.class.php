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
		
		$this->setMethodMapping('image', 'actionAddImage');
		
//		$this->map->addSource('offerType', RequestType::get());
	}

	public function handleRequest(HttpRequest $request)
	{
//		$request->getAttachedVar('logger')->debug($_REQUEST);
//		$request->getAttachedVar('logger')->debug($_FILES);

		$mav = parent::handleRequest($request);
		$model = $mav->getModel();
		
		if (
			$model->has('editorResult')
			&& $model->has('editorResult') == PrototypedEditor::COMMAND_SUCCEEDED
			&& in_array($model->get("action"), array('add', 'save', 'image'))
		) {
			$data = array(
				'result'	=> PrototypedEditor::COMMAND_SUCCEEDED,
				'id'		=> $model->get('subject')->getId()
			);

			if ($model->get("action") != 'image') {
				$this->storeFeatures($model->get('subject'));
				$request->setAttachedVar('layout', 'json');
				$data['url'] = $request->getAttachedVar('urlMapper')->
					getRedirectUrl($request, $mav->getModel()->get('subject'));
			}
			
			$mav->setModel(
				Model::create()->set('data', $data)
			);
		} else {
			$this->attachCollections($mav->getModel());
			$request->setAttachedVar('layout', 'main');
		}
		
		return $mav;
	}
	
	protected function actionAddImage(HttpRequest $request)
	{
		$editorResult = PrototypedEditor::COMMAND_FAILED;
		
		$form = Form::create()->
			add(
				Primitive::identifier('property')->
				of('Property')->
				required()
			)->
			add(
				Primitive::set('file')->
				required()
			)->
			add(
				Primitive::string('comments')->
				required()
			)->
			add(
				Primitive::string('file_main')->
				required()
			)->
			import($request->getPost())->
			importMore($request->getFiles());
		
		if ($form->getErrors()) {
			
		} else {
			$files = $form->getValue('file');
			$comments = (array)json_decode($form->getValue('comments'));
			$main = $form->getValue('file_main');
			$property = $form->getValue('property');
			
			$pictures = array();
			
			if (is_array($files['name'])) {
				foreach($files['name'] as $key => $name) {
					$pictures[] = Picture::create()->
						setProperty($property)->
						setTypeId($files['type'][$key])->
						setComment($comments[$name])->
						setName($name)->
						setMain($main == $name)->
						setUploadName($files['tmp_name'][$key]);
				}
			} else {
				$pictures[] = Picture::create()->
					setProperty($property)->
					setTypeId($files['type'])->
					setComment($comments[$file['name']])->
					setName($files['name'])->
					setMain($main == $files['name'])->
					setUploadName($files['tmp_name'][$key]);
			}
			
			foreach ($pictures as $picture)
				Picture::dao()->add($picture);
		}
		
		$request->setAttachedVar('layout', 'json');
		
		return ModelAndView::create()->
			setModel(
				Model::create()->
					set('editorResult', PrototypedEditor::COMMAND_SUCCEEDED)->
					set('subject', $property)
			);
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
