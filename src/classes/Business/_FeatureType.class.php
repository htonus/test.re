<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.9 at 2012-07-01 16:43:04                         *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	final class _FeatureType extends Enumeration
	{
		const AREA		= 1;
		const PRICE		= 2;
		const BEDROOMS	= 3;
		const TOYLETS	= 4;
		const BALCONS	= 5;
		const LEVELS		= 6;
		const PARKING	= 7;	// number of parking places
		const COVERED_PARKING	= 8;	// if the parking covered
		const GARDEN	= 9;
		const BARBEQUE	= 10;
		const POOL		= 11;
		const GARAGE	= 12;
		const STORAGE	= 15;
		const LAUNDRY	= 16;
		const FURNITURE	= 17;
		const FIREPLACE	= 18;
		const CELLAR	= 19;
		const ATTIC		= 20;
		const ELEVATOR	= 21;
		const FLOOR		= 22;
		const SEA_VIEW	= 23;
		const MOUNTAIN_VIEW = 24;
		
		protected $names = array(
			FeatureType::AREA		=> 'area',
			FeatureType::PRICE		=> 'price',
			FeatureType::BEDROOMS	=> 'bedrooms',
			FeatureType::TOYLETS	=> 'toylets',
			FeatureType::BALCONS	=> 'balcons',
			FeatureType::LEVELS		=> 'leveles',
			FeatureType::PARKING	=> 'parking',
			FeatureType::GARDEN		=> 'garden',
			FeatureType::BARBEQUE	=> 'barbeque',
			FeatureType::POOL		=> 'pool',
			FeatureType::GARAGE		=> 'garage',
			FeatureType::STORAGE	=> 'storage',
			FeatureType::LAUNDRY	=> 'laundry',
			FeatureType::FURNITURE	=> 'furniture',
			FeatureType::FIREPLACE	=> 'fireplace',
			FeatureType::CELLAR		=> 'cellar',
			FeatureType::ATTIC		=> 'attic',
			FeatureType::ELEVATOR	=> 'elevator',
			FeatureType::FLOOR		=> 'floor',
			FeatureType::SEA_VIEW	=> 'sea_view',
			FeatureType::COVERED_PARKING	=> 'covered_parking',
			FeatureType::MOUNTAIN_VIEW		=> 'mountain_view',
		);

		const BOOLEAN	= 1;
		const INTEGER	= 2;
		const INT_RANGE	= 3;
		
		protected static $casts = array(
			FeatureType::AREA		=> self::INT_RANGE,
			FeatureType::PRICE		=> self::INT_RANGE,
			FeatureType::BEDROOMS	=> self::INTEGER,
			FeatureType::TOYLETS	=> self::INTEGER,
			FeatureType::BALCONS	=> self::INTEGER,
			FeatureType::LEVELS		=> self::INTEGER,
			FeatureType::PARKING	=> self::BOOLEAN,
			FeatureType::GARDEN		=> self::BOOLEAN,
			FeatureType::BARBEQUE	=> self::BOOLEAN,
			FeatureType::POOL		=> self::BOOLEAN,
			FeatureType::GARAGE		=> self::BOOLEAN,
//			FeatureType::KITCHENS	=> ,
			FeatureType::STORAGE	=> self::BOOLEAN,
			FeatureType::LAUNDRY	=> self::BOOLEAN,
			FeatureType::FURNITURE	=> self::BOOLEAN,
			FeatureType::FIREPLACE	=> self::BOOLEAN,
			FeatureType::CELLAR		=> self::BOOLEAN,
			FeatureType::ATTIC		=> self::BOOLEAN,
			FeatureType::ELEVATOR	=> self::BOOLEAN,
			FeatureType::FLOOR		=> self::INTEGER,
			FeatureType::SEA_VIEW	=> self::BOOLEAN,
			FeatureType::COVERED_PARKING	=> self::BOOLEAN,
			FeatureType::MOUNTAIN_VIEW		=> self::BOOLEAN,
		);
		
		public static function getCasts()
		{
			return self::$casts;
		}
	}
?>