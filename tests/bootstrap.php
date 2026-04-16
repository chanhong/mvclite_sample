<?php
define('_MVCLite', true);
define('PDOLITE_DB_DSN', 'sqlite::memory:'); // dummy — prevents PdoLite from crashing
require_once __DIR__ . '/../vendor/autoload.php';