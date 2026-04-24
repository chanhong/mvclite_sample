<?php
defined('DS') 
    || define('DS', DIRECTORY_SEPARATOR);

    // function declare in bootstrap.php 
    // DOCROOT defined in public\index.php
    loadIfExist(DOCROOT . '/vendor/autoload.php');
    loadIfExist(__DIR__ . '/bootstrap.mvclite.php');

