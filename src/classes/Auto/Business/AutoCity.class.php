<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.10.99 at 2012-07-28 23:35:44                     *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoCity extends NamedObject
	{
		protected $latitude = null;
		protected $longitude = null;
		protected $parent = null;
		protected $parentId = null;
		
		public function getLatitude()
		{
			return $this->latitude;
		}
		
		/**
		 * @return City
		**/
		public function setLatitude($latitude)
		{
			$this->latitude = $latitude;
			
			return $this;
		}
		
		public function getLongitude()
		{
			return $this->longitude;
		}
		
		/**
		 * @return City
		**/
		public function setLongitude($longitude)
		{
			$this->longitude = $longitude;
			
			return $this;
		}
		
		/**
		 * @return City
		**/
		public function getParent()
		{
			if (!$this->parent && $this->parentId) {
				$this->parent = City::dao()->getById($this->parentId);
			}
			
			return $this->parent;
		}
		
		public function getParentId()
		{
			return $this->parentId;
		}
		
		/**
		 * @return City
		**/
		public function setParent(City $parent)
		{
			$this->parent = $parent;
			$this->parentId = $parent->getId();
			
			return $this;
		}
		
		/**
		 * @return City
		**/
		public function setParentId($id)
		{
			$this->parent = null;
			$this->parentId = $id;
			
			return $this;
		}
		
		/**
		 * @return City
		**/
		public function dropParent()
		{
			$this->parent = null;
			$this->parentId = null;
			
			return $this;
		}
	}
?>