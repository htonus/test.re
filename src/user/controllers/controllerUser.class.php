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
	const EMAIL_UNIQUE	= 1;
	
	public function __construct()
	{
		parent::__construct(User::create());
		
		$this->getForm()->drop('created');
		
		$this->setMethodMapping('activate', 'actionActivate');
		$this->setMethodMapping('success', 'actionSuccess');
		$this->setMethodMapping('error', 'actionError');
	}
	
	public function handleRequest(HttpRequest $request)
	{
//		$request->getAttachedVar('logger')->debug($_REQUEST);
//		$request->getAttachedVar('logger')->debug($_FILES);
		
		$mav = parent::handleRequest($request);
		$model = $mav->getModel();
		
		if (
			$model->has('editorResult')
			&& in_array($model->get("action"), array('add', 'save'))
		) {
			if (
				$model->get('editorResult')
				== PrototypedEditor::COMMAND_SUCCEEDED
			) {
				$mav->
					setView(
						RedirectView::create(PATH_WEB.'user/success')
					)->
					setModel(Model::create());
			} else {
				$mav->getModel()->set('action', 'edit');
			}
		}
		
		return $mav;
	}
	
	protected function addObject(HttpRequest $request, Form $form, Identifiable $object)
	{
//		$form->setValue('password', StringHelper::passgen());
		$email = $form->getValue('email');
		
		if (User::dao()->isUnique($email)) {
			$form->	setValue('code', StringHelper::makeHash($email));
			$object->setCreated(Timestamp::makeNow());
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
			$form->markCustom('email', self::EMAIL_UNIQUE);
		}
		
		return $object;
	}
	
	protected function actionActivate(HttpRequest $request)
	{
		$mav = ModelAndView::create();
		
		$form = Form::create()->
			add(
				Primitive::string('param')->
					addImportFilter(Filter::trim())->
					required()
			)->
			import($request->getGet());
		
		if ($code = $form->getValue('param')) {
			$pass = StringHelper::passgen();
			
			if ($user = User::dao()->activate($code, $pass)) {
				Session::assign('user', $user);
				
				MailHelper::send(
					Model::create()->
						set('user', $user)->
						set('password', $pass)->
						set('subject', 'Your user account is activated')->
						set('template', 'confirm')
				);

				$mav->setView(
					new RedirectView(PATH_WEB.'user/success')
				);
			} else {
				$mav->setView(
					new RedirectView(PATH_WEB.'user/error')
				);
			}
		} else {
			$mav->setView(
				new RedirectView(PATH_WEB)
			);
		}
		
		return $mav;
	}
	
	protected function actionSuccess(HttpRequest $request)
	{
		return ModelAndView::create();
	}
	
	protected function actionError(HttpRequest $request)
	{
		return ModelAndView::create();
	}
}
