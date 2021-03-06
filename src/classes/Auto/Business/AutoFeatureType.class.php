<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.9 at 2012-09-21 11:00:44                         *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoFeatureType extends NamedObject
	{
		protected $weight = 1;
		protected $group = 0;
		protected $cast = null;
		protected $unit = null;
		protected $unitId = null;
		
		public function getWeight()
		{
			return $this->weight;
		}
		
		/**
		 * @return FeatureType
		**/
		public function setWeight($weight)
		{
			$this->weight = $weight;
			
			return $this;
		}
		
		public function getGroup()
		{
			return $this->group;
		}
		
		/**
		 * @return FeatureType
		**/
		public function setGroup($group)
		{
			$this->group = $group;
			
			return $this;
		}
		
		public function getCast()
		{
			return $this->cast;
		}
		
		/**
		 * @return FeatureType
		**/
		public function setCast($cast)
		{
			$this->cast = $cast;
			
			return $this;
		}
		
		/**
		 * @return Unit
		**/
		public function getUnit()
		{
			if (!$this->unit && $this->unitId) {
				$this->unit = Unit::dao()->getById($this->unitId);
			}
			
			return $this->unit;
		}
		
		public function getUnitId()
		{
			return $this->unitId;
		}
		
		/**
		 * @return FeatureType
		**/
		public function setUnit(Unit $unit)
		{
			$this->unit = $unit;
			$this->unitId = $unit->getId();
			
			return $this;
		}
		
		/**
		 * @return FeatureType
		**/
		public function setUnitId($id)
		{
			$this->unit = null;
			$this->unitId = $id;
			
			return $this;
		}
		
		/**
		 * @return FeatureType
		**/
		public function dropUnit()
		{
			$this->unit = null;
			$this->unitId = null;
			
			return $this;
		}
	}
?>