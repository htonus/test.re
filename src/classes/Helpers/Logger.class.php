<?php

	final class Logger
	{
		const DEBUG		= 0;
		const ERROR		= 1;
		const FATAL		= 2;
		const SILENCE	= 3;
		
		const PREFIX	= 're';
		const POSTFIX	= '.log';
		
		private $level = null;
		
		public function __construct($level = self::DEBUG)
		{
			$this->level = $level;
		}
		
		public static function create($level = self::DEBUG)
		{
			return new self($level);
		}
		
		public function debug($msg, $suffix = '')
		{
			if (self::DEBUG < $this->level)
				return $this;
			
			return $this->log($suffix, $msg, 'DEBUG');
		}
		
		public function error($msg, $suffix = '')
		{
			if (self::ERROR < $this->level)
				return $this;
			
			return $this->log($suffix, $msg, 'ERROR');
		}
		
		public function fatal($msg, $suffix = '')
		{
			if (self::FATAL < $this->level)
				return $this;
			
			return $this->log($suffix, $msg, 'FATAL');
		}
		
		public function log($suffix = '', $msg, $level = 'LOG')
		{
			$file = fopen(
				LOGS_PATH
					.self::PREFIX
					.($suffix ? "_{$suffix}_" : '_')
					.date('Y-m-d')
					.self::POSTFIX,
				'a+'
			);
			
			if (!is_string($msg))
				$msg = print_r($msg, true);
			
			fwrite($file, date('H:i:s')." [$level] $msg\n");
			fclose($file);
			
			return $this;
		}
	}
?>