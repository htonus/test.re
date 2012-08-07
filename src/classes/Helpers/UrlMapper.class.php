<?php

	final class UrlMapper
	{
		private $pathWeb = null;

		/**
		 * @return UrlMapper $object
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
		
		public function getRedirectMav(HttpRequest $request)
		{
			$form = Form::create()->
				add(
					Primitive::set('city')
				)->
				add(
					Primitive::enumeration('status')->of('OfferType')
				)->
				add(
					Primitive::enumeration('property')->
						of('PropertyType')->
						setDefault(PropertyType::property())
				)->
				add(
					Primitive::set('type')
				)->
				import($request->getPost());
			
			$types = $form->getValue('type');
			
			$url = $this->pathWeb
				.$form->getValue('status')->getName()
				.$this->toNamed($types, FeatureType::BEDROOMS)
				.$this->toNamed($types, FeatureType::AREA)
				.'-'.$form->getActualValue('property')->getName()
				.$this->toNamed($types, FeatureType::PRICE, 'for')
				.'-in-cyprus';
			
			$model = Model::create();
			
			if ($cityList = $form->getValue('city')) {
				$model->set('city', $cityList);
			}
			
			return ModelAndView::create()->
				setView(
					RedirectView::create($url)->
						setBuildArrays(true)
				)->
				setModel($model);
		}
		
		private function toNamed($types, $typeId, $prefix = '')
		{
			$named = '';
			
			if (isset($types[$typeId])) {
				$named =
					($prefix ? "-$prefix" : null)
					.(
						isset($types[$typeId]['min'])
							? '-'.$types[$typeId]['min']
							: '-1'
					)
					.(
						isset($types[$typeId]['max'])
							? '-'.$types[$typeId]['max']
							: null
					)
					.(
						$prefix
							? null
							: '-'.EnumHelper::getObject('FeatureType', $typeId)->getName()
					);
			}
			
			return $named;
		}
		
		/**
		 * 
		 * @param HttpRequest $request
		 * @return boolean $isRedirect
		 */
		public function resolveRequest(HttpRequest $request)
		{
			$query = null;
			
			if ($request->hasGetVar('query'))
				$query = trim($request->getGetVar('query'));
			
			// dont need to parse URL, because this is POST to GET redirect
			if (
				count($request->getPost())
				&& !$query
			)
				return true;
			
			$rega = '!^(buy|rent)(-(\d)-?(\d)?-bedrooms)?(-(\d+)-?(\d+)?-area)?'
				.'-('.implode('|', EnumHelper::getNames('PropertyType')).')'
				.'(-for-(\d+)-?(\d+)?)?(-in-cyprus)$!';
			
			if (preg_match($rega, $query, $m)) {
				$request->setGetVar('area', 'search');
				$request->setGetVar('action', $m[1]);
				$request->setGetVar('property', $m[8]);
				
				$typeId = FeatureType::BEDROOMS;
				if (!empty($m[2])) {
					$request->setGetVar("type[$typeId][min]", $m[3]);
					$request->setGetVar("type[$typeId][max]", $m[4]);
				}
				
				$typeId = FeatureType::AREA;
				if (!empty($m[5])) {
					$request->setGetVar("type[$typeId][min]", $m[6]);
					$request->setGetVar("type[$typeId][max]", $m[7]);
				}
				
				$typeId = FeatureType::PRICE;
				if (!empty($m[9])) {
					$request->setGetVar("type[$typeId][min]", $m[10]);
					$request->setGetVar("type[$typeId][max]", $m[11]);
				}
			}
			
			if (preg_match('!^(get)/([^/]+)!', $query, $m)) {
				$request->setGetVar('area', $m[1]);
				$request->setGetVar('action', $m[2]);
			}
			
			if (preg_match('!^(property)/([^\/]+)/([^\/]+)!', $query, $m)) {
				$request->setGetVar('area', $m[1]);
				$request->setGetVar('action', $m[2]);
				$request->setGetVar('offer', $m[3]);
			}

			return false;
		}
	}
?>