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
class controllerUser extends PrototypedEditor
{
	public function __construct()
	{
		parent::__construct(User::create());
		
		$this->setMethodMapping('activate', 'actionActivate');
		$this->setMethodMapping('success', 'actionSuccess');
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
			&& in_array($model->get("action"), array('add', 'save'))
		) {
			$mav->
				setView(
					RedirectView::create(PATH_WEB.'user/success')
				)->
				setModel(Model::create());
		}
		
		$request->setAttachedVar('layout', 'main');
		
		return $mav;
	}
	
	protected function addObject(HttpRequest $request, Form $form, Identifiable $object)
	{
//		$form->setValue('password', StringHelper::passgen());
		$email = $form->getValue('email');
		
		if (!User::dao()->checkUnique($email)) {
			$form->setValue('code', StringHelper::makeHash($email));
			$object = parent::addObject($request, $form, $object);
			
			if ($object->getId())
				MailHelper::send(
					Model::create()->
						set('user', $object)->
						set('template', 'activate')->
						set('subject', PROJECT_NAME.' User activation')->
						set('object', $object)
				);
		} else {
			$form->markWrong('email');
		}
		
		return $object;
	}
	
	protected function actionActivate(HttpRequest $request)
	{
		
	}
	
	protected function actionSuccess(HttpRequest $request)
	{
		return ModelAndView::create();
	}
}
