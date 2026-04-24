<?php

use PhpLoaderLite\NsClassLoader;

// small set of functions to bootstrap 

defined('DS')         || define('DS', DIRECTORY_SEPARATOR);
defined('_MVCDEBUG')   || define('_MVCDEBUG', true); 

defined('APPSROOT')    || define('APPSROOT', 'apps');
defined('LIBROOT')     || define('LIBROOT', APPSROOT . DS . 'Lib');

// Source path helper to keep the loader map clean
$src = APPSROOT . DS . 'src' . DS;

$loader = [
    'base'       => $src . 'base',
    'appscls'    => $src . 'class',
    'controller' => $src . 'controller',
    'model'      => $src . 'model',
    'mvclite'    => LIBROOT . DS . 'mvclite' . DS . 'src',
];

foreach ($loader as $path) {
    if (is_dir($path)) {
        NsClassLoader::addPath($path);
    }
}
$autoloader = new NsClassLoader();
