<?php

	final class StringHelper extends StaticFactory
	{
		public static function lcfirst($string)
		{
			$string[0] = strtolower($string[0]);
			
			return $string;
		}

		public static function dump($object, $echo = true)
		{
			if ($echo) {
				echo '<pre>';
				print_r($object);
				echo '</pre>';
			} else
				return print_r($object, true);
		}
	}
?>