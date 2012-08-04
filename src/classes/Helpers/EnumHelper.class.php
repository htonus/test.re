<?php

	final class EnumHelper extends StaticFactory
	{
		/**
		 * @return $object Enumeration
		 */
		public static function getAnyObject($enumName)
		{
			return EnumHelper::getObject(
				$enumName,
				call_user_func(array($enumName, 'getAnyId'))
			);
		}
		
		/**
		 * @return $object Enumeration
		 */
		public static function getObject($enumName, $id)
		{
			return new $enumName($id);
		}
		
		/**
		 * @return array
		 */
		public static function getNames($enumName)
		{
			return EnumHelper::getAnyObject($enumName)->getNameList();
		}
		
		/**
		 * @return array
		 */
		public static function getPlainList($enumName)
		{
			return EnumHelper::getAnyObject($enumName)->getObjectList();
		}
		
		public static function getName($enumName, $id)
		{
			return EnumHelper::getObject($enumName, $id)->
				getName();
		}
	}
