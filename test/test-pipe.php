<?php

require __DIR__ . '/../vendor/autoload.php';

use Khalyomede\Piper;
use Khalyomede\PiperPdoConnect as PdoConnect;
use Khalyomede\PiperPdoSelectAll as PdoSelectAll;

$posts = Piper::pipe( PdoConnect::do(['driver' => 'mysql', 'host' => 'localhost', 'user' => 'root', 'database' => 'test']) )
	->pipe( PdoSelectAll::do('SELECT * FROM post') )
	->get();