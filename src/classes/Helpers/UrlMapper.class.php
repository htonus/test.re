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
		
		public function getRedirectMav(HttpRequest $request, Property $property = null)
		{
			return ModelAndView::create()->
				setView(
					RedirectView::create(
						$this->getRedirectUrl($request, $property)
					)
				);
		}
		
		public function getRedirectUrl(HttpRequest $request, Property $property = null)
		{
			$form = Form::create()->
				add(
					Primitive::set('city')
				)->
				add(
					Primitive::enumerationByValue('action')->
						of('OfferType')
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
				.$form->getValue('action')->getName()
				.$this->toNamed($types, FeatureType::BEDROOMS)
				.$this->toNamed($types, FeatureType::AREA)
				.'-'.$form->getActualValue('property')->getName()
				.$this->toNamed($types, FeatureType::PRICE, 'for')
				.'-in-cyprus'
				.($property ? '-'.$property->getId() : null);
			
			$model = Model::create();
			
			if ($cityList = $form->getValue('city')) {
				$model->set('city', $cityList);
			}
			
			return $this->getLocationUrl($url, $model);
		}
		
		private function toNamed($types, $typeId, $prefix = '')
		{
			$named = '';
			
			$typeNames = FeatureType::dao()->getNames();
			
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
							: '-'.$typeNames[$typeId]
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
			
			// is POST to GET redirect for SEO links (browsing properties)
			if (preg_match('!^(buy|rent)/?$!', $query, $m[1])) {
				if ($request->hasPostVar('action'))
					return true;
				
				$request->setGetVar('area', 'main');
				$request->setGetVar('action', $m[1]);
				
				return false;
			}
			
			$rega = '!^(buy|rent)(-(\d)-?(\d)?-bedrooms)?(-(\d+)-?(\d+)?-area)?'
				.'-('.implode('|', EnumHelper::getNames('PropertyType')).')'
				.'(-for-(\d+)-?(\d+)?)?(-in-cyprus)$!';
			
			if (preg_match($rega, $query, $m)) {
				$request->setGetVar('area', 'search');
				$request->setGetVar('action', $m[1]);
				$request->setGetVar('property', $m[8]);
				
				$type = array();
				
				$typeId = FeatureType::BEDROOMS;
				if (!empty($m[2])) {
					$type[$typeId]['min'] =  $m[3];
					$type[$typeId]['max'] =  $m[4];
				}
				
				$typeId = FeatureType::AREA;
				if (!empty($m[5])) {
					$type[$typeId]['min'] =  $m[6];
					$type[$typeId]['max'] =  $m[7];
				}
				
				$typeId = FeatureType::PRICE;
				if (!empty($m[9])) {
					$type[$typeId]['min'] =  $m[10];
					$type[$typeId]['max'] =  $m[11];
				}
				
				$request->setGetVar('type', $type);
				return false;
			}
			
//			if (preg_match('!^(get)/([^/]+)!', $query, $m)) {
//				$request->setGetVar('area', $m[1]);
//				$request->setGetVar('action', $m[2]);
//			}
			
			if (preg_match('!^(property)/([^/]+)/?([^/]+)?!', $query, $m)) {
				$request->setGetVar('area', $m[1]);
				$request->setGetVar('action', $m[2]);
				
				if (isset($m[3])) {
					if (is_numeric($m[3])) {
						$request->setGetVar('idr', $m[3]);
					} else {
						$request->setGetVar('offer', $m[3]);
					}
				}
			}
			
			// last chance
			if (preg_match('!^([^/]+)/?([^/]+)?/?([^/]+)?!', $query, $m)) {
				$request->setGetVar('area', $m[1]);
				$request->setGetVar('action', isset($m[2]) ? $m[2] : null);
				$request->setGetVar('param', isset($m[3]) ? $m[3] : null);
			}
			
			return false;
		}
		
		protected function getLocationUrl($url, Model $model = null)
		{
			$postfix = null;
			
			if ($model && $model->getList()) {
				$qs = array();
				
				foreach ($model->getList() as $key => $val) {
					if (
						(null === $val)
						|| is_object($val)
					) {
						continue;
					} elseif (is_array($val)) {
						$qs[] = http_build_query(
							array($key => $val), null, '&'
						);
						
						continue;
						
					} elseif (is_bool($val)) {
						$val = (int) $val;
					}
					
					$qs[] = $key.'='.urlencode($val);
				}
				
				if (strpos($url, '?') === false)
					$first = '?';
				else
					$first = '&';
					
				if ($qs)
					$postfix = $first.implode('&', $qs);
			}
			
			return $url.$postfix;
		}
	}
	