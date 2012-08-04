<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.9 at 2012-07-01 16:43:04                         *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	final class OfferType extends Enumeration
	{
		const BUY	= 1;
		const SELL	= 2;
		const RENT	= 3;
		const LEASE	= 4;

		protected $names = array(
			self::BUY	=> 'buy',
			self::SELL	=> 'sell',
			self::RENT	=> 'rent',
			self::LEASE	=> 'lease',
		);
		
		public static function buy()
		{
			return new self(self::BUY);
		}
		
		public static function rent()
		{
			return new self(self::RENT);
		}
	}
?>