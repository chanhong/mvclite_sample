<?php

use PhpLoaderLite\NsClassLoader;

// small set of functions to bootstrap 

defined('DS') 
    || define('DS', DIRECTORY_SEPARATOR);
defined('_MVCDEBUG') 
    || define('_MVCDEBUG', true); // false when in production
    
define('APPSROOT', 'apps');
defined('LIBROOT') 
    || define('LIBROOT', DOCROOT .DS. 'Lib');
defined('CONTROLLER') 
    || define('CONTROLLER', APPSROOT .DS . "src" .DS. "controller");
defined('MODEL') 
    || define('MODEL', APPSROOT .DS . "src" .DS. "model");

NsClassLoader::addPath(LIBROOT .DS. 'src');
// loaded by compuser
NsClassLoader::addPath(LIBROOT .DS. 'mvclite'. DS . "src");
NsClassLoader::addPath(CONTROLLER);
NsClassLoader::addPath(MODEL);
$autoloader = new NsClassLoader();


