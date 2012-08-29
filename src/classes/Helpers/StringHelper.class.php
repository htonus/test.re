<?php

	final class StringHelper extends StaticFactory
	{
		public static function lcfirst($string)
		{
			$string[0] = strtolower($string[0]);
			
			return $string;
		}

		public static function dump($object, $exit = false, $echo = true, $safe = false)
		{
			if ($echo) {
				echo '<pre>';
				$safe ? print_r($object) : var_dump($object);
				echo '</pre>';
			} else
				return $safe ? print_r($object, true) : var_export($object, true);
			
			(!$exit) || exit();
		}
		
		public static function passgen($length = 8, $strength = 0)
		{
			$vowels = 'aeyui';
			$consonants = 'bdghjmnpqrstvzf';
			
			if ($strength & 1)
				$consonants .= 'BDGHJLMNPQRSTVWXZF';
			
			if ($strength & 2)
				$vowels .= "AEYU";
			
			if ($strength & 4)
				$consonants .= '23456789';
			
			if ($strength & 8)
				$consonants .= '@#$%';

			$password = '';
			$alt = time() % 2;
			for ($i = 0; $i < $length; $i++) {
				if ($alt)
					$password .= $consonants[(rand() % strlen($consonants))];
				else
					$password .= $vowels[(rand() % strlen($vowels))];
				
				$alt = !$alt;
			}
			
			return $password;
		}
		
		public static function makeHash($string)
		{
			return strtolower(
				md5(
					$string
					.StringHelper::passgen(8,8)
				)
			);
		}
	}
?>