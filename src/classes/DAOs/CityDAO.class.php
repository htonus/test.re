<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.10.99 at 2012-07-28 23:35:44                     *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	final class CityDAO extends AutoCityDAO
	{
		public function getCityList(City $parent = null)
		{
			$criteria = Criteria::create($this);
			
			if ($parent)
				$criteria->add(
					Expression::eqId('parent', $parent)
				);
			
			return $criteria->getList();
		}
	}
?>