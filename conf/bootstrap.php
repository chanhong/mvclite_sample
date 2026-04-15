<?php

function loadIfExist($iFile) {
   if (file_exists($iFile)) {
      return require_once($iFile);
   }
}

loadIfExist(__DIR__ . '/autoload/bootstrap.before.php');
loadIfExist(__DIR__ . '/autoload/global.php');
loadIfExist(__DIR__ . '/autoload/cfg.php');

/*
if (file_exists(__DIR__ . '/autoload/bootstrap.before.php')) 
   require_once(__DIR__ . '/autoload/bootstrap.before.php');

if (file_exists(__DIR__ . '/autoload/global.php')) 
   require_once(__DIR__ . '/autoload/global.php');

if (file_exists(__DIR__ . '/autoload/cfg.php')) 
   require_once(__DIR__ . '/autoload/cfg.php');
*/