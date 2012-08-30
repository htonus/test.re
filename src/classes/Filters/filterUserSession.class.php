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
		$mav = $this->inner->handleRequest($request);
		
		return $mav;
	}
}
