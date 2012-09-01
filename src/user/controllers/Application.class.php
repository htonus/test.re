<?php
/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */

/**
 * Description of Application
 *
 * @author htonus
 */
final class Application
{
	private $allowedAreas = array(
		'main',
		'search',
		'get',
		'property',
		'user',
		'buy',
		'rent'
	);
	
	public static function create()
	{
		return new self;
	}
	
	public function run()
	{
		if (!Session::isStarted())
			Session::start();
		
		$request = HttpRequest::create()->
			setGet($_GET)->
			setPost($_POST)->
			setCookie($_COOKIE)->
			setFiles($_FILES)->
			setServer($_SERVER)->
			setSession($_SESSION);
		
		$urlMapper = UrlMapper::create(PATH_WEB);
		$logger = Logger::create(Logger::DEBUG);
		
		// for SEO links while browsing properties
		if ($urlMapper->resolveRequest($request)) {
			return $this->render($urlMapper->getRedirectMav($request), $request);
		}
		
		$request->setAttachedVar('urlMapper', $urlMapper);
		$request->setAttachedVar('logger', $logger);
		
		$area = $this->getArea($request);
		$controller = 'controller'.ucfirst($area);
		$chain = null;
		
		switch ($area) {
//			case 'get':
//				if (!$this->isAjax()) {
//					throw new SecurityException('error:404');
//				}
//				break;
			default:
				$chain = 
					new filterUserSession(
						new $controller
					);
				break;
		}
		
		$this->attachResolver($request);

		$mav = $chain->handleRequest($request);
		
		return $this->render($mav, $request);
	}
	
	private function getArea(HttpRequest $request)
	{
		$area = Form::create()->
			add(
				Primitive::string('area')->
				addImportFilter(Filter::trim())->
				setDefault(DEFAULT_AREA)
			)->
			import($request->getGet())->
			importMore($request->getPost())->
			getActualValue('area');
		
		if (!in_array($area, $this->allowedAreas))
			throw new SecurityException('Area not allowed: '.$area);
		
		$request->setAttachedVar('area', $area);
		
		return $area;
	}
	
	private function render(ModelAndView $mav, HttpRequest $request)
	{
		$model = $mav->getModel();
		$view = $mav->getView();
		
		if ($view instanceof RedirectView) {
			return $view->render($model);
		}
		
		$layout = $request->hasAttachedVar('layout')
			? $request->getAttachedVar('layout')
			: $request->getAttachedVar('area');
		
		$model->set('layout', $layout);

		if (empty($view)) {
			$view = $layout;
		}

		if (is_string($view)) {
			$view = $request->getAttachedVar('resolver')->
				resolveViewName($view);
		}
		
		if ($view instanceof View) {
			$model->set('area', $request->getAttachedVar('area'));
			$model->set('urlMapper', $request->getAttachedVar('urlMapper'));
			
//			$model->set('action', $request->getAttachedVar('action'));
		} else {
			$view = RedirectView::create(PATH_WEB.'error/404');
		}
		
		$view->render($model);
		
		return $this;
	}
	
	private function attachResolver(HttpRequest $request)
	{
		$resolver = MultiPrefixPhpViewResolver::create()->
			setViewClassName('SimplePhpView')->
			setPostfix(EXT_TPL)->
			addPrefix(PATH_TEMPLATES);
		
		$request->setAttachedVar('resolver', $resolver);
		
		return $this;
	}
	
	private function isAjax()
	{
		return
			true;
			isset($_SERVER['HTTP_X_REQUESTED_WITH'])
			&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])
				=== 'xmlhttprequest';
	}
}
