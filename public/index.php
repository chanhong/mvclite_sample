<?php

/**
 * index.php — Application entry point.
 *
 * Responsibilities:
 *   1. Bootstrap the environment (session, constants, autoloader).
 *   2. Build the DI container with all singleton registrations.
 *   3. Sync the legacy CConfig::$_cfg static bridge (remove once migrated).
 *   4. Hand off to the Router.
 *
 * New classes that have only type-hinted constructor parameters do NOT need
 * a manual entry here — CContainer::resolve() will auto-wire them on first
 * use via reflection.  Only register services that need special construction
 * (credentials, factory methods, or primitives that can't be type-hinted).
 */

use MvcLite\Router;

session_start();

define('DOCROOT', realpath(dirname(__FILE__) . '/../'));
require_once DOCROOT . '/conf/bootstrap.php';  

// ---------------------------------------------------------------------------
// 1. Load raw configuration array from cfg.php
// ---------------------------------------------------------------------------

$cfgArray = require DOCROOT . '/conf/autoload/cfg.php';

// ---------------------------------------------------------------------------
// 2. Legacy bridge — lets any code still using CConfig::$_cfg keep working.
//    Delete this block once all call-sites use $cfg->get('key') instead.
// ---------------------------------------------------------------------------

\MvcLite\CConfig::$_cfg = $cfgArray;

// ---------------------------------------------------------------------------
// 3. Build the DI container
//
//    Rule of thumb:
//      • Register here when construction needs something the container
//        cannot infer from type hints alone (e.g. a config array, a salt
//        string, or a named factory method).
//      • Everything else is auto-wired by CContainer::resolve() on demand.
// ---------------------------------------------------------------------------

$container = new \MvcLite\CContainer();

// must be here
$container->singleton('cfg',   fn() => new \MvcLite\CConfig($cfgArray));
// --- Auth / error (use factory methods, not plain new) ---
$container->singleton('auth',  fn() => \MvcLite\CAuth::getAuth('MvcLiteSALT'));
$container->singleton('error', fn() => \MvcLite\CError::getError());

// optional due to CCore::resolve auto wired DI but could end up with muliple instances
// --- Infrastructure / external ---
$container->singleton('db',    fn() => new \PdoLite\PdoLite());

// --- Config & settings (need constructor arguments) ---
$container->singleton('stg',   fn() => new \MvcLite\CSetting());

// --- Utilities (auto-wireable, but registered explicitly for clarity) ---
$container->singleton('util',   fn() => new \MvcLite\CUtil());
$container->singleton('helper', fn() => new \MvcLite\CHelper());
// optional due to CCore::resolve auto wired DI but could end up with muliple instances

// ---------------------------------------------------------------------------
// 4. Make the container globally available to CCore, then start routing
// ---------------------------------------------------------------------------

\MvcLite\CCore::setContainer($container);

Router::start();
