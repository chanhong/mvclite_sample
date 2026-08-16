<?php

namespace MvcLite;

use MvcLite\CUtil;

// ---------------------------------------------------------------------------
// Constants  (define once — safe to call multiple times via defined() guard)
// ---------------------------------------------------------------------------

defined('_MVCLOGIN') || define('_MVCLOGIN', '/login');
defined('_MVCLOGOUT') || define('_MVCLOGOUT', '/logout');
defined('_MVCREGISTER') || define('_MVCREGISTER', '/register');

defined('_DEBUG_ENABLED') || define('_DEBUG_ENABLED', true);

// ---------------------------------------------------------------------------
// Local overrides  (db credentials, environment-specific settings)
// ---------------------------------------------------------------------------

$db = $legacy = $cs = $all = array();

if (file_exists(__DIR__ . '/local.php')) {
    $db = require __DIR__ . '/local.php';          // returns array
} elseif (file_exists(__DIR__ . '/local.php.dist')) {
    $db = require __DIR__ . '/local.php.dist';     // returns array
}

if (file_exists(__DIR__ . '/cfg_legacy.php')) {
    $legacy = require __DIR__ . '/cfg_legacy.php';          // returns array
}

if (file_exists(__DIR__ . '/cfg_cs.php')) {
    $cs = require __DIR__ . '/cfg_cs.php';          // returns array
}

// ---------------------------------------------------------------------------
// Build and return the full configuration array info CCore::$_cfg;
// ---------------------------------------------------------------------------

$all = array_merge($db, $legacy, $cs);

//print(print_r($all, true));
//print (print_r($all['app']['list'], true));
//print ("<pre>".print_r($all, true)."</pre>");
return $all;
