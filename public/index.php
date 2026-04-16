<?php

use MvcLite\Router;
// Determine our absolute document root
// DOC_ROOT for SPF library
session_start();
define('DOCROOT', realpath(dirname(__FILE__) . '/../'));
require_once DOCROOT . '/conf/bootstrap.php';  

//pCStat('MvcLite\Ccore');
// DI Dependency Injection entry code
$container = new \MvcLite\CContainer();

$container->singleton('db',     fn() => new \PdoLite\PdoLite());
$container->singleton('util',   fn() => new \MvcLite\CUtil());
$container->singleton('helper', fn() => new \MvcLite\CHelper());
$container->singleton('auth',   fn() => \MvcLite\CAuth::getAuth('MvcLiteSALT'));
$container->singleton('error',  fn() => \MvcLite\CError::getError());

\MvcLite\CCore::setContainer($container);
// DI Dependency Injection entry code


// MVC entry point
Router::start();
