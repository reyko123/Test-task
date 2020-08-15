<?php

 class DbConnect
{
	
	private static $db;

	public static function _initDb()
	{
		if (self::$db == null) {
			self::$db = self::get();
		}

		return self::$db;
	}

	private static function get()
	{
		// Инициализация базы данных
		$db = new PDO ('mysql:host=localhost;dbname=testovaya', 'test', 'test');
    	$db->exec("SET NAMES UTF8");
    	return $db;
	}
}
