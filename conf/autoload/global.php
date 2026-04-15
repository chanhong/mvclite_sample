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
// move config into cfg.php, so it can be used in controller and view as CCore::$_cfg['db'] or CCore::$_cfg['db']['host']

/*
defined('_MVCLOGIN') 
|| define('_MVCLOGIN', '/login'); 
defined('_MVCLOGOUT') 
|| define('_MVCLOGOUT', '/logout'); 
defined('_MVCREGISTER') 
|| define('_MVCREGISTER', '/register'); 

// DEBUG FLAG - Set to true to enable debug logging, false to disable, remove this later
defined('_DEBUG_ENABLED') 
|| define('_DEBUG_ENABLED', true);

$localcfg = [];
//permDbg(__DIR__, "__dir__");   

if (file_exists(__DIR__  . '/local.php')) {
   $localcfg = require_once(__DIR__  . '/local.php');
} elseif (file_exists(__DIR__  . '/local.php.dist')){
   $localcfg = require_once(__DIR__  . '/local.php.dist');
}


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
            'debug' => ['index', 'logfile', 'clear'],
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
            'debug' => [
                ['title'=>'Home','path'=>'/'],
                ['title' => 'Debug', 'path' => '/debug/index'],
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
            'debug' => [
                ['title' => 'Debug Log Files','path' => '/debug/logfile'],
                ['title' => 'Clear Debug','path' => '/debug/clear'],
            ],
            'daskboard' => [
                ['title'=>'Home','path'=>'/'],
                ['title' => 'Dashboard', 'path' => '/dashboard/index'],
                ['title'=>'Books List','path'=>'/books/index'],
                ['title'=>'Authors List','path'=>'/authors/index'],
                ['title'=> 'Users', 'path'=>'/users/index'],
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
            'index'=>'My App',
            'usefullinks'=>'Useful Links',
        ],        
        'dashboard' => [
            'index'=>'Dashboard List',
        ],
        'debug' => [
            'index'=>'Debug Dashboard',
            'logfile'=>'Debug Log Files',
            'clear'=>'Clear Debug',
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



CCore::$_cfg = array_merge($routecfg, $controllerViewCfg, $localcfg, $authCfg, $menucfg);
//permDbg(Ccore::$_cfg, "_cfg");  
*/
