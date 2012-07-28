<?php
/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */


/**
 * City management controller
 *
 * @author htonus
 */
final class controllerCity extends CommonEditor
{
	public function __construct()
	{
		parent::__construct(City::create());
	}
}
