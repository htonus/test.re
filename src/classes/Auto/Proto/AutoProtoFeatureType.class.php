<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.10.99 at 2012-07-28 23:21:21                     *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoFeatureType extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'FeatureType', 8, true, true, false, null, null),
				'name' => LightMetaProperty::fill(new LightMetaProperty(), 'name', null, 'string', null, 32, true, true, false, null, null),
				'priority' => LightMetaProperty::fill(new LightMetaProperty(), 'priority', null, 'integer', null, 4, true, true, false, null, null),
				'required' => LightMetaProperty::fill(new LightMetaProperty(), 'required', null, 'boolean', null, null, true, true, false, null, null),
				'unit' => LightMetaProperty::fill(new LightMetaProperty(), 'unit', 'unit_id', 'integerIdentifier', 'Unit', null, false, false, false, 1, 3)
			);
		}
	}
?>