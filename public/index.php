<?php

/**
 * index.php — Application entry point.
 *
 * Responsibilities:
 *   1. Bootstrap the environment (session, constants, autoloader).
 *   2. Populate legacy static bridges.
 *   3. Get the DI container from initDI() in global.php.
 *   4. Wire static facades and sync boot-time values.
 *   5. Hand off to the Router.
 *
 * To add a new service: add it to initDI() in global.php only.
 */

use MvcLite\Router;

session_start();

define('DOCROOT', realpath(dirname(__FILE__) . '/../'));
require_once DOCROOT . '/conf/bootstrap.php';

// ---------------------------------------------------------------------------
// STEP 1 — Load raw configuration arrays
// ---------------------------------------------------------------------------

$cfgArray = require DOCROOT . '/conf/autoload/cfg.php';
$stgArray = require DOCROOT . '/conf/autoload/stg.php';

// ---------------------------------------------------------------------------
// STEP 2 — Populate static bridges
//   Legacy code that reads these directly keeps working until fully migrated.
// ---------------------------------------------------------------------------

\MvcLite\CConfig::$_cfg  = $cfgArray;
\MvcLite\CCore::$_cfg    = $cfgArray;
\MvcLite\CCore::$_stg    = $stgArray;
\MvcLite\CSetting::$_stg = $stgArray;

// ---------------------------------------------------------------------------
// STEP 3 — Build task→group master list (set in CUtil::getTopMenu())
// ---------------------------------------------------------------------------

// \MvcLite\CUtil::TaskGroup("_cfgtg");

// ---------------------------------------------------------------------------
// STEP 4 — Set active controller + login URL + top menu from query string
// ---------------------------------------------------------------------------

// \MvcLite\CUtil::setActiveCtrl(\MvcLite\CUtil::qsValue() ?? []); // even empty, set selctrl from default value
\MvcLite\CUtil::setActiveCtrl(); // even empty, set selctrl from default value

// ---------------------------------------------------------------------------
// STEP 5 — Build the DI container (all registrations live in initDI())
// ---------------------------------------------------------------------------

$container = initDI($cfgArray, $stgArray);  // ← one line, all services registered

// ---------------------------------------------------------------------------
// STEP 6 — Make the container globally available to CCore
// ---------------------------------------------------------------------------

\MvcLite\CCore::setContainer($container);

// ---------------------------------------------------------------------------
// STEP 7 — Wire static facades to their DI instances
// ---------------------------------------------------------------------------

\MvcLite\CConfig::setInstance($container->make('cfg'));
\MvcLite\CSetting::setInstance($container->make('stg'));

// STEP 7b — Wire CUtil facade
\MvcLite\CUtil::setInstance($container->make('util'));

// ---------------------------------------------------------------------------
// STEP 8 — Sync boot-time values into DI instances
// ---------------------------------------------------------------------------

// cfg: seed the instance with the full config array
$container->make('cfg')->setAll($cfgArray);

// stg: already seeded at construction via initDI() — no sync needed.
// CSetting::set() keeps $_stg and the instance in sync from here on.

// ---------------------------------------------------------------------------
// STEP 9 — Start routing
// ---------------------------------------------------------------------------

(new Router())->start();