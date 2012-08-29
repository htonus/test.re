<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.9 at 2012-07-01 16:43:04                         *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	final class User extends AutoUser implements Prototyped, DAOConnected
	{
		/**
		 * @return User
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return UserDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('UserDAO');
		}
		
		/**
		 * @return ProtoUser
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoUser');
		}
		
		public function getFullName()
		{
			return "$this->name $this->surname";
		}
	}
?>