<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.9 at 2012-07-01 16:43:05                         *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	final class PropertyFeaturesDAO extends OneToManyLinked
	{
		public function __construct(Property $property, $lazy = false)
		{
			parent::__construct(
				$property,
				Feature::dao(),
				$lazy
			);
		}
		
		/**
		 * @return PropertyFeaturesDAO
		**/
		public static function create(Property $property, $lazy = false)
		{
			return new self($property, $lazy);
		}
		
		public function getParentIdField()
		{
			return 'property_id';
		}
		
		public function getList()
		{
			return ArrayHelper::toListByGetter(parent::getList(), 'getTypeId');
		}
		
		public function getGroupList($group = null)
		{
			$out = array();
			foreach($this->getList() as $typeId => $feature) {
				if ($feature->getType()->getGroup() == $group)
					$out[$typeId] = $feature;
			}
			
			return $out;
		}
	}
?>