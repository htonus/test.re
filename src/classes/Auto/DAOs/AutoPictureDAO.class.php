<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.10.99 at 2012-09-03 19:16:13                     *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPictureDAO extends StorableDAO
	{
		public function getTable()
		{
			return 'picture';
		}
		
		public function getObjectName()
		{
			return 'Picture';
		}
		
		public function getSequence()
		{
			return 'picture_id';
		}
	}
?>