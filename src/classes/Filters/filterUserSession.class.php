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
		
		
		if (!($user = Session::get('user'))) {
			$user = $this->doLogin($request);
		}
		
		$request->setAttachedVar('user', $user);
		
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
				Primitive::string('autoLogin')->
					addImportFilter(Filter::trim())
			)->
			add(
				Primitive::string('username')->
					addImportFilter(Filter::trim())
			)->
			add(
				Primitive::string('password')->
					addImportFilter(Filter::trim())->
					addImportFilter(Filter::hash())
			)->
			import($request->getCookie())->
			importMore($request->getPost());
		
		$user = null;
		
		if ($login = $form->getValue('username'))  {
			$user = User::dao()->login($login, $form->getValue('password'));
		} elseif ($login = $form->getValue('autoLogin')) {
			$user = User::dao()->autLogin($login);
		}
		
		return $user;
	}
}
