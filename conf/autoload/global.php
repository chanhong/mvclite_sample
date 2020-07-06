<?php


use MvcLite\MvcCore;
use MvcLite\Util;
#use MvcSample\BaseCore;

defined('_MVCLOGIN') 
|| define('_MVCLOGIN', '/login'); 
defined('_MVCLOGOUT') 
|| define('_MVCLOGOUT', '/logout'); 
defined('_MVCREGISTER') 
|| define('_MVCREGISTER', '/register'); 

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$authCfg = [
    'levels' => [
        'guest' => '0',
        'inq' => '10',
        'user' => '20',
        'supper' => '30',
        'admin' => '90',
    ],
    'auth' => [
        'admin' => [
            '/users/index',
            '/users/create',
            '/users/delete/*',
            '/users/edit/*',
            '/authors/delete/*',
            '/authors/edit/*',
            '/books/delete/*',
            '/books/edit/*',
        ],
        'user' => [
            _MVCLOGOUT,
        ],
    ],
]; 
$routecfg = [
    'page404' => "notfound",
    'routes' => [
        'default_controller' => 'front',
        'alias' => [
            'mya' => ['contacts', 'usefullinks'], 
            'users' => ["login", "logout", "register", "weblogin", "winlogin"],
        ]
    ],
];
$menucfg = [
    'menu' => [
        'main' => [
            ['title'=>'Home','path'=>'/'],
            ['title' => 'Front', 'path' => '/front/index'],
            ['title' => 'Register', 'path' => _MVCREGISTER],
            ['title' => 'Login', 'path' => _MVCLOGIN],
            ['title' => 'Logout', 'path' => _MVCLOGOUT],
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
BaseCore::$_cfg = array_merge($routecfg, $controllerViewCfg, $localcfg, $authCfg, $menucfg);
//permDbg(BaseCore::$_cfg, "_cfg");  

function pCStat($className) {
    $msg = "<>loaded";
    if (class_exists($className)) {
        $msg = "loaded";
    } 
//    permDbg($className, "$msg");    
}

function dbgt() {
    return print MvcLite\Util::dTrace();
}

function dbg($iVar, $iStr = "", $iFormat = "") {
    return MvcLite\Util::debug($iVar, $iStr, $iFormat);
}

function permDbg($iVar, $iStr = "", $iFormat = "") {
    return $_SESSION["debug"] .= MvcLite\Util::debug($iVar, $iStr, $iFormat);
}





