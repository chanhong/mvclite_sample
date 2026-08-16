<?php
use MvcLite\CCore;
use MvcLite\CUtil;
use MvcLite\CMsg;
use MvcLite\CConfig;

/**
 * initDI — Builds and returns the DI container.
 *
 * Rule of thumb:
 *   • Register here when construction needs something the container
 *     cannot infer from type hints alone (e.g. a config array, a salt
 *     string, or a named factory method).
 *   • Everything else is auto-wired by CContainer::resolve() on demand.
 *
 * @return \MvcLite\CContainer
 */
function initDI(array $cfgArray, array $stgArray = []): \MvcLite\CContainer
{
    $container = new \MvcLite\CContainer();

    // --- Config (needs constructor argument) ---
    $container->singleton('cfg',    fn() => new \MvcLite\CConfig($cfgArray));

    // --- Runtime settings (seeded with stg.php values so ::get() works immediately) ---
    $container->singleton('stg',    fn() => new \MvcLite\CSetting($stgArray));

    // --- Auth / error (use factory methods, not plain new) ---
    $container->singleton('auth',   fn() => \MvcLite\CAuth::getAuth('MvcLiteSALT'));
    $container->singleton('error',  fn() => \MvcLite\CError::getError());

    // --- Infrastructure / external ---
    $container->singleton('db',     fn() => new \PdoLite\PdoLite());

    // --- Utilities ---
    $container->singleton('file',   fn() => new \MvcLite\CFiles());
    $container->singleton('util',   fn() => new \MvcLite\CUtil());
    $container->singleton('helper', fn() => new \MvcLite\CHelper());

    // ADD NEW SERVICES HERE — index.php never needs to touch registrations

    return $container;  // ← return, don't wire here; index.php does wiring
}

function pCStat($className)
{
    $msg = "<>loaded";
    if (class_exists($className)) {
        $msg = "loaded";
    }
    permDbg($className, "$msg");
}

function dbgt()
{
    return print CUtil::dTrace();
}

function dbg($iVar, $iStr = "", $iFormat = "")
{
    return CUtil::debug($iVar, $iStr, $iFormat);
}

function permDbg($iVar, $iStr = "", $iFormat = "")
{
    return CUtil::_debug($iVar, $iStr, $iFormat);
}

function pmsg($iVar, $iStr = "")
{
    CMsg::_dprt($iVar, $iStr);
}

function pln($iVar, $iStr = "", $iFormat = "")
{
    print CUtil::_debug($iVar, $iStr, $iFormat);
}