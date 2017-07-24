<?php

// Determine our absolute document root
// DOC_ROOT for SPF library
session_start();
define('DOCROOT', realpath(dirname(__FILE__) . '/../'));
require_once DOCROOT . '/conf/bootstrap.php';  

//pCStat('MvcLite\MvcCore');

// MVC entry point
Router::start();
?>