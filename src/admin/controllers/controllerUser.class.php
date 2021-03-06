<?php
/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */


/**
 * User management controller
 *
 * @author htonus
 */
final class controllerUser extends CommonEditor
{
	public function __construct()
	{
		parent::__construct(User::create());

		$this->getForm()->
			get('password')->
			addImportFilter(Filter::hash());
	}

	public function doSave(HttpRequest $request)
	{
		$this->getForm()->drop('password');
		return parent::doSave($request);
	}

	public function doTake(HttpRequest $request)
	{
		$this->getForm()->drop('password');
		return parent::doTake($request);
	}
}
