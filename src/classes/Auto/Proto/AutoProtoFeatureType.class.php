<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.9 at 2012-08-20 14:08:44                         *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoFeatureType extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'FeatureType', 8, true, true, false, null, null),
				'name' => LightMetaProperty::fill(new LightMetaProperty(), 'name', null, 'string', null, 32, true, true, false, null, null),
				'weight' => LightMetaProperty::fill(new LightMetaProperty(), 'weight', null, 'integer', null, 4, true, true, false, null, null),
				'group' => LightMetaProperty::fill(new LightMetaProperty(), 'group', null, 'integer', null, 4, false, true, false, null, null),
				'unit' => LightMetaProperty::fill(new LightMetaProperty(), 'unit', 'unit_id', 'identifier', 'Unit', 8, false, false, false, 1, 3)
			);
		}
	}
?>