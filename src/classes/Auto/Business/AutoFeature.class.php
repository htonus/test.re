<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.9 at 2012-09-21 11:00:44                         *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoFeature extends IdentifiableObject
	{
		protected $content = null;
		protected $value = null;
		protected $type = null;
		protected $typeId = null;
		protected $property = null;
		protected $propertyId = null;
		
		public function getContent()
		{
			return $this->content;
		}
		
		/**
		 * @return Feature
		**/
		public function setContent($content)
		{
			$this->content = $content;
			
			return $this;
		}
		
		public function getValue()
		{
			return $this->value;
		}
		
		/**
		 * @return Feature
		**/
		public function setValue($value)
		{
			$this->value = $value;
			
			return $this;
		}
		
		/**
		 * @return FeatureType
		**/
		public function getType()
		{
			if (!$this->type && $this->typeId) {
				$this->type = FeatureType::dao()->getById($this->typeId);
			}
			
			return $this->type;
		}
		
		public function getTypeId()
		{
			return $this->typeId;
		}
		
		/**
		 * @return Feature
		**/
		public function setType(FeatureType $type)
		{
			$this->type = $type;
			$this->typeId = $type->getId();
			
			return $this;
		}
		
		/**
		 * @return Feature
		**/
		public function setTypeId($id)
		{
			$this->type = null;
			$this->typeId = $id;
			
			return $this;
		}
		
		/**
		 * @return Feature
		**/
		public function dropType()
		{
			$this->type = null;
			$this->typeId = null;
			
			return $this;
		}
		
		/**
		 * @return Property
		**/
		public function getProperty()
		{
			if (!$this->property && $this->propertyId) {
				$this->property = Property::dao()->getById($this->propertyId);
			}
			
			return $this->property;
		}
		
		public function getPropertyId()
		{
			return $this->propertyId;
		}
		
		/**
		 * @return Feature
		**/
		public function setProperty(Property $property)
		{
			$this->property = $property;
			$this->propertyId = $property->getId();
			
			return $this;
		}
		
		/**
		 * @return Feature
		**/
		public function setPropertyId($id)
		{
			$this->property = null;
			$this->propertyId = $id;
			
			return $this;
		}
		
		/**
		 * @return Feature
		**/
		public function dropProperty()
		{
			$this->property = null;
			$this->propertyId = null;
			
			return $this;
		}
	}
?>