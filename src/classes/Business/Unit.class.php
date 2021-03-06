<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.9 at 2012-07-01 16:43:04                         *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	final class Unit extends AutoUnit implements Prototyped, DAOConnected
	{
		/**
		 * @return Unit
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return UnitDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('UnitDAO');
		}
		
		/**
		 * @return ProtoUnit
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoUnit');
		}
		
		// your brilliant stuff goes here
	}
?>