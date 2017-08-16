<?php

use MvcLite\Util;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$routecfg = [
    'page404' => "notfound",
    'routes' => [
        'default_controller' => 'front',
        'alias' => [
            'mya' => ['contacts', 'usefullinks'], 
            'users' => ["login", "logout", "register", "weblogin", "winlogin"],
        ]
    ],
    'auth' => [
        'admin' => [
            '/users/index',
        ],
        'user' => [
            '/logout',
        ],
    ],
    'menu' => [
        'main' => [
            ['title'=>'Home','path'=>'/'],
            ['title' => 'Front', 'path' => '/front/index'],
            ['title' => 'Login', 'path' => '/login'],
            ['title' => 'Logout', 'path' => '/logout'],
            ['title' => 'Register', 'path' => '/register'],
        ],
        'cmenu' => [
            'front' => [
                ['title'=>'Front','path'=>'/front/index'],
                ['title'=>'About','path'=>'/front/about'],
            ],
            'daskboard' => [
                ['title'=>'Home','path'=>'/'],
                ['title' => 'Dashboard', 'path' => '/dashboard/index'],
            ],        
            
        ],
        'submenu' => [
            'front' => [
                ['title'=>'Books List','path'=>'/books/index'],
                ['title'=>'Authors List','path'=>'/authors/index'],
                ['title'=> 'Users', 'path'=>'/users/index'],
                ['title' => 'Pages', 'path' => '/pages/index'],
                ['title' => 'Mya', 'path' => '/mya/index'],
                ['title' => 'Plain', 'path' => '/plain/index'],
            ],
            'user' => [
                ['title'=>'List','path'=>'/users/index'],
                ['title'=>'Create new user','path'=>'/users/create'],
            ],
            'mya' => [
                ['title'=>'Contacts','path'=>'/mya/contacts'],
                ['title'=>'Userful Links','path'=>'/mya/usefullinks'],
            ],
            'page' => [
                ['title' => 'Pages 1','path' => '/pages/page1'],
                ['title' => 'Pages 2','path' => '/pages/page2'],
            ],
            'daskboard' => [
                ['title'=>'Home','path'=>'/'],
                ['title' => 'Dashboard', 'path' => '/dashboard/index'],
            ],        
        ]
    ]
];

// if not set then default to view as the title
$controllerViewCfg = [
    'controller' => [
        'router' => [
            'notfound'=>'Not Found Page',
        ],        
        'mya' => [
            'index'=>'UWMC Accounting',
            'usefullinks'=>'Useful Links',
        ],        
        'dashboard' => [
            'index'=>'Dashboard List',
        ],
        'authors' => [
            'index'=>'Authors List',
        ],
        'books' => [
            'index'=>'Books List',
        ],
        'users' => [
            'index'=>'Users List',
        ],
        'front' => [
            'index'=>'Front Page',
            'about'=>'About Page',
        ],
        'pages' => [
            'index'=>'Pages',
            'page1'=>'Page 1',
            'page2'=>'Page 2',
        ],
    ]
];

if (file_exists(__DIR__  . '/local.php')) {
   $localcfg = require_once(__DIR__  . '/local.php');
} elseif (file_exists(__DIR__  . '/local.php.dist')){
   $localcfg = require_once(__DIR__  . '/local.php.dist');
}
BaseCore::$_cfg = array_merge($routecfg, $controllerViewCfg, $localcfg);

function pCStat($className) {
    $msg = "<>loaded";
    if (class_exists($className)) {
        $msg = "loaded";
    } 
    permDbg($className, "$msg");    
}

function dbgt() {
    return print MvcLite\Util::dTrace();
}

function dbg($iVar, $iStr = "", $iFormat = "") {
    return MvcLite\Util::debug($iVar, $iStr, $iFormat);
}

function permDbg($iVar, $iStr = "", $iFormat = "") {
    return MvcLite\Util::debug($iVar, $iStr, $iFormat);
}

function pdbg($iVar, $iStr = "", $iFormat = "") {
    print dbg($iVar, $iStr, $iFormat);
}

function pbr($iVar, $iStr = "", $iFormat = "") {
    pdbg($iVar, $iStr, $iFormat) . "<br />";
}

function pbrx($iVar, $iStr = "", $iFormat = "") {
    pbr($iVar, $iStr, $iFormat);
    exit;
}

// Redirects user to $url
function redirect($url = null) {
    if (is_null($url))
        $url = $_SERVER['PHP_SELF'];
    header("Location: $url");
    exit();
}
/*
function notFound($inVar) {
    redirect("?t=$inVar");
}
*/


