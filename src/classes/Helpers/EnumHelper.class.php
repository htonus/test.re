<?php

	final class EnumHelper extends StaticFactory
	{
		/**
		 * @return \OfferType 
		 */
		public static function getAnyObject($enumName)
		{
			
			return new $enumName(call_user_func(array($enumName, 'getAnyId')));
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
	}
?>