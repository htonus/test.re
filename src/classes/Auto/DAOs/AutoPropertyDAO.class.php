<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.9 at 2012-08-20 14:06:13                         *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPropertyDAO extends StorableDAO
	{
		public function getTable()
		{
			return 'property';
		}
		
		public function getObjectName()
		{
			return 'Property';
		}
		
		public function getSequence()
		{
			return 'property_id';
		}
	}
?>