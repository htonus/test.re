<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.9 at 2012-07-01 16:43:04                         *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	final class FeatureType extends AutoFeatureType implements Prototyped, DAOConnected
	{
		/**
		 * @return FeatureType
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return FeatureTypeDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('FeatureTypeDAO');
		}
		
		/**
		 * @return ProtoFeatureType
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoFeatureType');
		}
		
		// your brilliant stuff goes here
	}
?>