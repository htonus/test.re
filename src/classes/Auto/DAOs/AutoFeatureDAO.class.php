<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.9 at 2012-08-20 14:06:13                         *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoFeatureDAO extends StorableDAO
	{
		public function getTable()
		{
			return 'feature';
		}
		
		public function getObjectName()
		{
			return 'Feature';
		}
		
		public function getSequence()
		{
			return 'feature_id';
		}
	}
?>