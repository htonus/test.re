<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.9 at 2012-09-11 16:13:54                         *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPicture extends NamedObject
	{
		protected $type = null;
		protected $typeId = null;
		protected $main = false;
		protected $width = null;
		protected $height = null;
		protected $comment = null;
		protected $property = null;
		protected $propertyId = null;
		
		/**
		 * @return ImageType
		**/
		public function getType()
		{
			if (!$this->type && $this->typeId) {
				$this->type = new ImageType($this->typeId);
			}
			
			return $this->type;
		}
		
		public function getTypeId()
		{
			return $this->typeId;
		}
		
		/**
		 * @return Picture
		**/
		public function setType(ImageType $type)
		{
			$this->type = $type;
			$this->typeId = $type->getId();
			
			return $this;
		}
		
		/**
		 * @return Picture
		**/
		public function setTypeId($id)
		{
			$this->type = null;
			$this->typeId = $id;
			
			return $this;
		}
		
		/**
		 * @return Picture
		**/
		public function dropType()
		{
			$this->type = null;
			$this->typeId = null;
			
			return $this;
		}
		
		public function getMain()
		{
			return $this->main;
		}
		
		public function isMain()
		{
			return $this->main;
		}
		
		/**
		 * @return Picture
		**/
		public function setMain($main = false)
		{
			$this->main = ($main === true);
			
			return $this;
		}
		
		public function getWidth()
		{
			return $this->width;
		}
		
		/**
		 * @return Picture
		**/
		public function setWidth($width)
		{
			$this->width = $width;
			
			return $this;
		}
		
		public function getHeight()
		{
			return $this->height;
		}
		
		/**
		 * @return Picture
		**/
		public function setHeight($height)
		{
			$this->height = $height;
			
			return $this;
		}
		
		public function getComment()
		{
			return $this->comment;
		}
		
		/**
		 * @return Picture
		**/
		public function setComment($comment)
		{
			$this->comment = $comment;
			
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
		 * @return Picture
		**/
		public function setProperty(Property $property)
		{
			$this->property = $property;
			$this->propertyId = $property->getId();
			
			return $this;
		}
		
		/**
		 * @return Picture
		**/
		public function setPropertyId($id)
		{
			$this->property = null;
			$this->propertyId = $id;
			
			return $this;
		}
		
		/**
		 * @return Picture
		**/
		public function dropProperty()
		{
			$this->property = null;
			$this->propertyId = null;
			
			return $this;
		}
	}
?>