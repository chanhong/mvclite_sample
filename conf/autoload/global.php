<?php
// use MvcLite
use MvcLite\CCore;
use MvcLite\CUtil;
use MvcLite\CConfig;

#use MvcSample\BaseCore;

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

function pln($iVar, $iStr = "", $iFormat = "")
{
    print CUtil::_debug($iVar, $iStr, $iFormat);
}

// move config into cfg.php, so it can be used in controller and view as $_cfg['db'] or $_cfg['db']['host']
