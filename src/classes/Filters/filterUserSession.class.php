<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Session  filter designed to handle user sessions
 *
 * @author htonus
 */
final class filterUserSession implements Controller
{
	private $inner = null;
	
	public function __construct(Controller $controller)
	{
		$this->inner = $controller;
	}

	public function handleRequest(HttpRequest $request)
	{
		/* 1. проверить сессию на пользователя
		 * 2. проверить автологин
		 * 3. проверить форму логина
		 * 4. нет пользователя
		 */
		
		
		($user = Session::get('user'))
		|| ($user = $this->doLogin($request))
		|| ($user = $this->doAutoLogin($request));
		
		$request->setAttachedVar('user', $user);
		
		if ($request->hasAttachedVar('redirect')) {
			$mav = ModelAndView::create()->
				setView(
					RedirectView::create($request->getAttachedVar('redirect'))
				);
		} else
			$mav = $this->inner->handleRequest($request);
		
		if (!$mav->viewIsRedirect())
			$mav->getModel()->
				set('user', $request->getAttachedVar('user'));
		
		return $mav;
	}
	
	private function doLogin(HttpRequest $request)
	{
		$form = Form::create()->
			add(
				Primitive::string('email')->
					addImportFilter(Filter::trim())
			)->
			add(
				Primitive::string('password')->
					addImportFilter(Filter::trim())->
					addImportFilter(Filter::hash())
			)->
			import($request->getPost());
		
		$user = null;
		
		if ($hash = $form->getValue('password')) {
			$user = User::dao()->login($form->getValue('email'), $hash);
			
			if ($user) {
				$backUrl = $request->getAttachedVar('query');
				
				if (Session::get('backUrl')) {
					$backUrl = Session::get('backUrl');
					Session::drop('backUrl');
				}
				
				$request->setAttachedVar('redirect', $backUrl);
			} else {
				$request->setAttachedVar('redirect', PATH_WEB.'user/error');
				Session::assign('backUrl', $request->getAttachedVar('query'));
			}
		}
	
		return $user;
	}
	
	private function doAutoLogin(HttpRequest $request)
	{
		$form = Form::create()->
			add(
				Primitive::string('autoLogin')->
					addImportFilter(Filter::trim())
			)->
			import($request->getCookie());
		
		$user = null;
		
		if ($code = $form->getValue('autoLogin'))
			$user = User::dao()->autoLogin($code);
	
		return $user;
	}
}
