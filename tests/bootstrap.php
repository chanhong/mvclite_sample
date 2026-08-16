<?php
define('_MVCLite', true);
define('PDOLITE_DB_DSN', 'sqlite::memory:'); // dummy — prevents PdoLite from crashing
define('PDOLITE_DB_USER', '');
define('PDOLITE_DB_PASS', '');
defined('DOCROOT') || define('DOCROOT', realpath(__DIR__ . '/../'));
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../conf/autoload/bootstrap.mvclite.php';
require_once __DIR__ . '/../conf/autoload/global.php';