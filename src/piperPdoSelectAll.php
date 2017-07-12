<?php

namespace Khalyomede;

use Khalyomede\PiperContract;
use Exception;

class PiperPdoSelectAll implements PiperContract {
	public static $parameter = '';

	public static function execute( $input ) {
		if( ! isset( $GLOBALS[ PIPERPDO ] ) ) {
			throw new Exception("PiperPdoConnect must be called before");
		}

		return $GLOBALS[ PIPERPDO ]->query( self::$parameter )->fetchAll();
	}

	public static function do( $parameter ) {
		self::$parameter = $parameter;

		return new self;
	}
}