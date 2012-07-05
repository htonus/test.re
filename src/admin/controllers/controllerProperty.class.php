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

	protected function attachCollections(Model $model)
	{
		parent::attachCollections($model);

		$model->set('unitList', Unit::dao()->getPlainList());

		return $this;
	}

}
