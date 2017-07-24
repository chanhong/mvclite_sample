<?php

if (file_exists(__DIR__ . '/autoload/bootstrap.before.php')) 
   require_once(__DIR__ . '/autoload/bootstrap.before.php');

if (file_exists(__DIR__ . '/autoload/global.php')) 
   require_once(__DIR__ . '/autoload/global.php');
   /*
if (file_exists(__DIR__  . '/autoload/settings.php')) {
   require_once(__DIR__  . '/autoload/settings.php');
} elseif (file_exists(__DIR__  . '/autoload/settings-dist.php')){
   require_once(__DIR__  . '/autoload/settings-dist.php');
}
*/
