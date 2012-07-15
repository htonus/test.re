<?php

	final class ArrayHelper extends StaticFactory
	{
		public static function toKeyValueArray(array $array, $key, $value)
		{
			$out = array();
			
			foreach ($array as $row) {
				$out[$row[$key]] = $row[$value];
			}
			
			return $out;
		}
		
		public static function toListByGetter(array $array, $getter)
		{
			$out = array();
			
			foreach ($array as $object) {
				$out[$object->$getter()] = $object;
			}
			
			return $out;
		}
	}
?>