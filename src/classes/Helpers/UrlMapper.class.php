<?php

	final class UrlMapper
	{
		private $pathWeb = null;

		/**
		 * @return Unit
		**/
		public static function create($url = PATH_WEB)
		{
			return new self($url);
		}

		public function __construct($url = PATH_WEB)
		{
			$this->pathWeb = $url;
		}
		
		public function getAreaUrl($area)
		{
			return $this->pathWeb
				.(
					defined('NICE_URL')
						? $area
						: '?area='.$area
				);
		}

		public function getObjectUrl(Identifiable $object, $action='edit')
		{
			$area = get_class($object);
			$area[0] = strtolower($area[0]);
			
			return $this->getAreaUrl($area)
				.(defined('NICE_URL') ? '/' : '&action=').$action
				.(defined('NICE_URL') ? '/' : '&id=').$object->getId();
		}
	}
?>