<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.10.99 at 2012-08-22 20:53:34                     *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoPicture extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'Picture', 8, true, true, false, null, null),
				'name' => LightMetaProperty::fill(new LightMetaProperty(), 'name', null, 'string', null, 128, false, true, false, null, null),
				'type' => LightMetaProperty::fill(new LightMetaProperty(), 'type', 'type_id', 'enumeration', 'ImageType', null, true, false, false, 1, 3),
				'main' => LightMetaProperty::fill(new LightMetaProperty(), 'main', null, 'boolean', null, null, true, true, false, null, null),
				'width' => LightMetaProperty::fill(new LightMetaProperty(), 'width', null, 'integer', null, 4, true, true, false, null, null),
				'height' => LightMetaProperty::fill(new LightMetaProperty(), 'height', null, 'integer', null, 4, true, true, false, null, null),
				'comment' => LightMetaProperty::fill(new LightMetaProperty(), 'comment', null, 'string', null, 64, false, true, false, null, null),
				'property' => LightMetaProperty::fill(new LightMetaProperty(), 'property', 'property_id', 'integerIdentifier', 'Property', null, true, false, false, 1, 3)
			);
		}
	}
?>