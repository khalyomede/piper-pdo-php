<?php

namespace Khalyomede;

use Khalyomede\PiperContract;
use PDO;
use PDOException;
use Exception;

if( defined('PIPERPDO') ) {
	throw new Exception('PIPERPDO constant is already defined');
}
else {
	define('PIPERPDO', 'PIPERPDO');
}

class PiperPdoConnect implements PiperContract {
	public static $host = '';
	public static $database = '';
	public static $charset = 'utf8';
	public static $user = '';
	public static $password = '';
	public static $options = [];
	public static $driver = '';

	public static function execute( $input ) {
		$host = self::$host;
		$database = self::$database;
		$user = self::$user;
		$password = self::$password;
		$options = self::$options;
		$charset = self::$charset;
		$driver = self::$driver;
		$pdo = null;

		switch( strtolower($driver) ) {
			case 'mysql': 
				$pdo = new PDO("mysql:host=$host;dbname=$database;charset=$charset", $user, $password, $options);

				if( isset( $GLOBALS[ PIPERPDO ] ) ) {
					throw new Exception("pdo is already stored for this script");
				}

				$GLOBALS[ PIPERPDO ] = $pdo;

				break;

			default: 
				throw new Exception("the driver is not supported or is empty (your driver : $driver)");
				break;
		}

		return $pdo;
	}

	public static function do( $parameter ) {
		self::$driver = isset($parameter['driver']) ? $parameter['driver'] : '';
		self::$host = isset($parameter['host']) ? $parameter['host'] : '';
		self::$database = isset($parameter['database']) ? $parameter['database'] : '';
		self::$user = isset($parameter['user']) ? $parameter['user'] : '';
		self::$password = isset($parameter['password']) ? $parameter['password']:  '';
		self::$options = isset($parameter['options']) ? $parameter['options'] : [];
		self::$charset = isset($parameter['charset']) ? $parameter['charset'] : 'utf8';

		return new self;
	}
}