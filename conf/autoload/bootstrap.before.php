<?php
defined('DS') 
    || define('DS', DIRECTORY_SEPARATOR);

if (file_exists(DOCROOT . '/vendor/autoload.php')) 
    require_once(DOCROOT . '/vendor/autoload.php');

if (file_exists(__DIR__ . '/bootstrap.mvclite.php')) {
   require_once(__DIR__ . '/bootstrap.mvclite.php');
   }