<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.9 at 2012-07-16 11:35:08                         *
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
		
		public function uncacheLists()
		{
			Property::dao()->uncacheLists();
			
			return parent::uncacheLists();
		}
	}
?>