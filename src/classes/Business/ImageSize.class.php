<?php

	final class ImageSize 
	{
		const BIG		= 1;
		const PREVIEW	= 2;
		
		private $size	= null;
		
		private $sizeList = array(
			self::BIG		=> array (630,400),
			self::PREVIEW	=> array (150,100),
		);
		
		public function __construct($size)
		{
			$this->setSize($size);
		}

				/**
		 * @return ImageSize
		**/
		public static function ImageSize($size)
		{
			return new self($size);
		}
		
		public function getWidth()
		{
			return $this->sizeList[$this->size][0];
		}
		
		public function getHeight()
		{
			return $this->sizeList[$this->size][1];
		}
		
		public function setSize($size)
		{
			Assert::isIndexExists($this->sizeList, $size);
			
			$this->size = $size;
			
			return $this;
		}
		
		public function getSize()
		{
			return $this->size;
		}
		
		public static function big()
		{
			return new self(self::BIG);
		}
		
		public static function preview()
		{
			return new self(self::PREVIEW);
		}
	}
