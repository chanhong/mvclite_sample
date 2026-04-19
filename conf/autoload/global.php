<?php
// use MvcLite
use MvcLite\CCore;
use MvcLite\CUtil;
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
    return CUtil::debug($iVar, $iStr, $iFormat);
}

function pln($iVar, $iStr = "", $iFormat = "")
{
    print CUtil::debug($iVar, $iStr, $iFormat);
}

function gI404($page = "Page")
{

    $i404 = '<div style="height:auto; min-height:100%; "><div style="text-align: center; width:800px; margin-left: -400px; position:absolute; top: 30%; left:50%;">'
        . '<h1 style="margin:0; font-size:150px; line-height:150px; font-weight:bold;">404</h1>'
        . '<h2 style="margin-top:20px;font-size: 30px;">Not Found - [' . $page . ']</h2>'
        . '<p>The resource requested could not be found on this server! or create your custom 404.php</p></div></div>';

    print '<!DOCTYPE html><html style="height:100%"><head></head>'
        . '<title>404 Not Found</title><style>@media (prefers-color-scheme:dark){body{background-color:#000!important}}</style></head>'
        . '<body style="color: #444; margin:0;font: normal 14px/20px Arial, Helvetica, sans-serif; height:100%; background-color: #fff;">'
        . $i404 . '</body></html>';
}
// move config into cfg.php, so it can be used in controller and view as $_cfg['db'] or $_cfg['db']['host']
