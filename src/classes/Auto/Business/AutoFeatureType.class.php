<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.9 at 2012-07-09 17:44:12                         *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoFeatureType extends NamedObject
	{
		protected $required = true;
		protected $unit = null;
		protected $unitId = null;
		
		public function getRequired()
		{
			return $this->required;
		}
		
		public function isRequired()
		{
			return $this->required;
		}
		
		/**
		 * @return FeatureType
		**/
		public function setRequired($required = false)
		{
			$this->required = ($required === true);
			
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