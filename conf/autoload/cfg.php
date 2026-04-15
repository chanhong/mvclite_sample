<?php
// global.php must load first
namespace MvcLite;

use MvcLite\CDebug;
use MvcLite\CCore;
use MvcLite\CHelper;
use MvcLite\CUtil;

defined('_MVCLOGIN')
    || define('_MVCLOGIN', '/login');
defined('_MVCLOGOUT')
    || define('_MVCLOGOUT', '/logout');
defined('_MVCREGISTER')
    || define('_MVCREGISTER', '/register');

    // DEBUG FLAG - Set to true to enable debug logging, false to disable, remove this later
defined('_DEBUG_ENABLED') 
    || define('_DEBUG_ENABLED', true);

// @ autoload folder
$localcfg = [];
if (file_exists(__DIR__  . __DIR__)) {
    $localcfg = require_once(__DIR__  . '/local.php');
} elseif (file_exists(__DIR__  . '/local.php.dist')) {
    $localcfg = require_once(__DIR__  . '/local.php.dist'); // array['db']
}

CCore::$_cfg = array_merge($localcfg); // assign db related array from local.php to _cfg, can be used in controller and view as CCore::$_cfg['db'] or CCore::$_cfg['db']['host']

CCore::$_cfg["info"] =  [
    'emailfrom' => "email@email.com",
    'ITContact' => "email@email.com",
    "router" => "router",
    "viewext" => ".php",
    'layout' => 'bootstrap',
];

CCore::$_cfg["folder"] =  [
    'app' => 'apps',
    'view' => 'views',
    'widget' => 'widgets',
    'vendor' => 'vendor',
    'public' => 'public', 
    'layout' => 'layouts',
];

CCore::$_cfg["path"] =  [
    'view' => CCore::$_cfg['folder']['app'] . DS.CCore::$_cfg['folder']['view'],
    'layout' => CCore::$_cfg['folder']['app'] . DS.CCore::$_cfg['folder']['layout'],
];


CCore::$_cfg["apps"] = "ajws,front,learn,static"; // list of all app

CCore::$_cfg["levels"] =  [          
        'guest' => '0',
        'inq' => '10',
        'user' => '20',
        'supper' => '30',
        'admin' => '90',
    ];

CCore::$_cfg["auth"] =  [            
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
];

CCore::$_cfg["routes"] =  [       
        '404' => "404", // internal 404?
        'page404' => "404", // routes/404.php
        'default_controller' => 'front',
        'alias' => [
            'mya' => ['contacts', 'usefullinks'],
            'users' => ["login", "logout", "register", "weblogin", "winlogin"],
        ]
];

CCore::$_cfg["menu"] =  [           
        'main' => [
            ['title' => 'Home', 'path' => '/'],
            ['title' => 'Front', 'path' => '/front/index'],
            ['title' => 'Register', 'path' => _MVCREGISTER],
            ['title' => 'Login', 'path' => _MVCLOGIN],
            ['title' => 'Logout', 'path' => _MVCLOGOUT],
        ],
        'cmenu' => [
            'front' => [
                ['title' => 'Front', 'path' => '/front/index'],
                ['title' => 'About', 'path' => '/front/about'],
            ],
            'daskboard' => [
                ['title' => 'Home', 'path' => '/'],
                ['title' => 'Dashboard', 'path' => '/dashboard/index'],
            ],

        ],
        'submenu' => [
            'front' => [
                ['title' => 'Books List', 'path' => '/books/index'],
                ['title' => 'Authors List', 'path' => '/authors/index'],
                ['title' => 'Users', 'path' => '/users/index'],
                ['title' => 'Pages', 'path' => '/pages/index'],
                ['title' => 'Debug', 'path' => '/debug/index'],
                ['title' => 'Mya', 'path' => '/mya/index'],
                ['title' => 'Plain', 'path' => '/plain/index'],
            ],
            'user' => [
                ['title' => 'List', 'path' => '/users/index'],
                ['title' => 'Create new user', 'path' => '/users/create'],
            ],
            'mya' => [
                ['title' => 'Contacts', 'path' => '/mya/contacts'],
                ['title' => 'Userful Links', 'path' => '/mya/usefullinks'],
            ],
            'page' => [
                ['title' => 'Page 1','path' => '/pages/page1'],
                ['title' => 'Page 2','path' => '/pages/page2'],
            ],            
            'debug' => [
                ['title' => 'Debug Log Files','path' => '/debug/logfile'],
                ['title' => 'Clear Debug','path' => '/debug/clear'],
            ],            
            'daskboard' => [
                ['title' => 'Home', 'path' => '/'],
                ['title' => 'Dashboard', 'path' => '/dashboard/index'],
                ['title' => 'Books List', 'path' => '/books/index'],
                ['title' => 'Authors List', 'path' => '/authors/index'],
                ['title' => 'Users', 'path' => '/users/index'],
            ],
        ]
];

// if not set then default to view as the title
CCore::$_cfg["controller"] =  [       
        'router' => [
            'notfound' => 'Not Found Page',
            '404' => 'Not Found Page',
        ],
        'mya' => [
            'index' => 'My App',
            'usefullinks' => 'Useful Links',
        ],
        'dashboard' => [
            'index' => 'Dashboard List',
        ],
        'debug' => [
            'index'=>'Debug Dashboard',
            'logfile'=>'Debug Log Files',
            'clear'=>'Clear Debug',
        ],        
        'authors' => [
            'index' => 'Authors List',
        ],
        'books' => [
            'index' => 'Books List',
        ],
        'users' => [
            'index' => 'Users List',
        ],
        'front' => [
            'index' => 'Front Page',
            'about' => 'About Page',
        ],
        'pages' => [
            'index' => 'Pages',
            'page1' => 'Page 1',
            'page2' => 'Page 2',
        ],
 //   ]
];



CCore::$_cfg["mnuhome"] =  [
    // title,"url,target,image"
    "Home" => CUtil::selfURL(),
];

CCore::$_cfg["mnucommon"] =  [
    // title,"url,target,image"
    "Email IT" => "mailto:" . CCore::$_cfg["info"]['emailfrom'] . "\" title=\"Email IT\",_blank,navarrow.gif",
];

CCore::$_cfg["mnubot"] =  [
    // title,"url,target,image"
    "Bing" => "http://bing.com/,_blank,navarrow.gif",
];

// define mnu+app for dynamic top menu based on app front or jv
CCore::$_cfg["mnu_static"] = [
    // title,"url,target,image"
    "MSN" => "https://msn.com,_blank,navarrow.gif",
    "Google" => "https://google.com,_blank,navarrow.gif",
    "DuckDuckGo" => "https://duckduckgo.com/,_blank,navarrow.gif",
];

// define mnu+app for dynamic top menu based on app front or jv
CCore::$_cfg["mnu_front"] = [
    // title,"url,target,image"
];

CCore::$_cfg["mnu_jv"] = [
    // title,"url,target,image"
];

CCore::$_cfg["mnu_learn"] =  [
    // title,"url,target,image"
    "TEST" => CUtil::rootSite() . "/test",
];
// define mnu+app for dynamic top menu based on app front or jv

// Ajax Web Services
CCore::$_cfg["ajws"] = [
    "odata" => "", // open not required authenticate
    "udata" => "inq", // required authenticate
];

// menu for front
CCore::$_cfg["front"] = [
    // name, group, title
    "front" => ",FP",
    "admin" => "admin,",
    "fbsq" => "inq,FbsQ",
    //    { "userq","inq,UserQ"},
];

// menu for learn
CCore::$_cfg["learn"] = [
    // name, group, title
    "learn" => ",Lrn",
    "lrnadmin" => "admin,Admin",
    "userq" => "inq,UserQ",
    "jsgrid" => "inq,",
    "ko" => "inq,",
    "jendo" => ",",
    "static" => ",",
];

// menu for static, nothing here, just a holder
CCore::$_cfg["static"] = [];
// name, group, title

CCore::$_cfg["tg"] = []; // MASTER task list: task->group "jvinq"="inq"

CCore::$_cfg["dmsg"] = array(
    'maxscreen' => 100,
    'maxlines' => 2,
);


//print ("_cfg: ".print_r(CCore::$_cfg, true));
