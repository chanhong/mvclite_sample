<?php

function loadIfExist($iFile) {
   if (file_exists($iFile)) {
      return require_once($iFile);
   }
}

loadIfExist(__DIR__ . '/autoload/bootstrap.before.php');
loadIfExist(__DIR__ . '/autoload/global.php');
loadIfExist(__DIR__ . '/autoload/cfg.php');

