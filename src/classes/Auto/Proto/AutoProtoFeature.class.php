<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.9 at 2012-07-15 19:30:00                         *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoFeature extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'Feature', 8, true, true, false, null, null),
				'content' => LightMetaProperty::fill(new LightMetaProperty(), 'content', null, 'string', null, 128, false, true, false, null, null),
				'value' => LightMetaProperty::fill(new LightMetaProperty(), 'value', null, 'integer', null, 4, false, true, false, null, null),
				'type' => LightMetaProperty::fill(new LightMetaProperty(), 'type', 'type_id', 'identifier', 'FeatureType', 8, true, false, false, 1, 3),
				'property' => LightMetaProperty::fill(new LightMetaProperty(), 'property', 'property_id', 'identifier', 'Property', 8, true, false, false, 1, 3)
			);
		}
	}
?>