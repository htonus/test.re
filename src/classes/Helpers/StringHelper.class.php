<?php

	final class StringHelper extends StaticFactory
	{
		public static function lcfirst($string)
		{
			$string[0] = strtolower($string[0]);
			
			return $string;
		}

		public static function dump($object, $echo = true, $safe = false)
		{
			if ($echo) {
				echo '<pre>';
				$safe ? print_r($object) : var_dump($object);
				echo '</pre>';
			} else
				return $safe ? print_r($object, true) : var_export($object, true);
		}
	}
?>