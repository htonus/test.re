<?php
/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */


/**
 * Property management controller
 *
 * @author htonus
 */
final class controllerProperty extends CommonEditor
{
	public function __construct()
	{
		parent::__construct(Property::create());
	}
}
