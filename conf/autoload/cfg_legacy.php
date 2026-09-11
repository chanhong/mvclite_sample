<?php

namespace MvcLite;

use MvcLite\CUtil;
// ---------------------------------------------------------------------------
// Constants  (define once — safe to call multiple times via defined() guard)
// ---------------------------------------------------------------------------

defined('_MVCLOGIN') || define('_MVCLOGIN', '/login');
defined('_MVCLOGOUT') || define('_MVCLOGOUT', '/logout');
defined('_MVCREGISTER') || define('_MVCREGISTER', '/register');

defined('_DEBUG_ENABLED') || define('_DEBUG_ENABLED', true);

$r = [

    // -----------------------------------------------------------------------
    // Defaults / active-dispatch placeholders (overwritten at runtime)
    // -----------------------------------------------------------------------
    'defctrl' => 'front',
    'selctl' => '',            // populated by the router for the running request

    // -----------------------------------------------------------------------
    // General site information
    // -----------------------------------------------------------------------
    'info' => [
        'emailfrom' => 'email@email.com',
        'ITContact' => 'email@email.com',
        'router' => 'router',
        'viewext' => '.php',
        'layout' => 'bootstrap',
        'apps' => 'ajws,front,learn,static',   // comma-separated app list
        'defctrl' => 'front',
        'selctl' => '',
    ],

    // -----------------------------------------------------------------------
    // Directory names  (relative — not full paths)
    // -----------------------------------------------------------------------
    'folder' => [
        'app' => 'apps',
        'view' => 'views',
        'widget' => 'widgets',
        'vendor' => 'vendor',
        'public' => 'public',
        'layout' => 'layouts',
    ],

    // -----------------------------------------------------------------------
    // Derived paths — built after 'folder' is defined above.
    // DS is defined in bootstrap.php (DIRECTORY_SEPARATOR).
    // -----------------------------------------------------------------------
    'path' => [
        'view' => 'apps' . DS . 'views',
        'layout' => 'apps' . DS . 'layouts',
    ],

    // -----------------------------------------------------------------------
    // Access levels
    // -----------------------------------------------------------------------
    'levels' => [
        'guest' => '0',
        'inq' => '10',
        'user' => '20',
        'supper' => '30',
        'admin' => '90',
    ],

    // -----------------------------------------------------------------------
    // Route-based authorisation  (role => allowed URL prefixes)
    // -----------------------------------------------------------------------
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

    // -----------------------------------------------------------------------
    // Router
    // -----------------------------------------------------------------------
    'routes' => [
        'default_controller' => 'front',
        '404' => '404',
        'page404' => '404',
        'alias' => [
            'mya' => ['contacts', 'usefullinks'],
            // aliaslookup() will produce t=users&a=logout // turn off to use router&a=logout
//            'users' => ['login', 'logout', 'register', 'weblogin', 'winlogin'],
            'users' => ['login', 'register', 'weblogin', 'winlogin'],
//            'router' => ['logout'],
        ],
    ],

    // -----------------------------------------------------------------------
    // Navigation menus
    // -----------------------------------------------------------------------
    'menu' => [
        'main' => [
            ['title' => 'Home', 'path' => '/'],
            ['title' => 'Front', 'path' => '/front/index'],
            ['title' => 'Static', 'path' => '/static/index'],
            ['title' => 'Plain', 'path' => '/plain/index'],
            ['title' => 'Pages', 'path' => '/pages/index'],
            ['title' => 'Learn', 'path' => '/learn/index'],
            ['title' => 'User', 'path' => '/users/index'],
            ['title' => 'Register', 'path' => _MVCREGISTER],
            ['title' => 'Login', 'path' => _MVCLOGIN],
            ['title' => 'Logout', 'path' => _MVCLOGOUT],
        ],
        'cmenu' => [
            'front' => [
                ['title' => 'Front', 'path' => '/front/index'],
                ['title' => 'About', 'path' => '/front/about'],
            ],
            'dashboard' => [                            // fixed typo: 'daskboard'
                ['title' => 'Home', 'path' => '/'],
                ['title' => 'Dashboard', 'path' => '/dashboard/index'],
            ],
        ],
        'submenu' => [
            'front' => [
                ['title' => 'Login', 'path' => '/front/_login'],
                ['title' => 'Books List', 'path' => '/books/index'],
                ['title' => 'Authors List', 'path' => '/authors/index'],
                ['title' => 'Users', 'path' => '/users/index'],
                ['title' => 'Pages', 'path' => '/pages/index'],
                ['title' => 'Debug', 'path' => '/debug/index'],
                ['title' => 'Mya', 'path' => '/mya/index'],
                ['title' => 'Plain', 'path' => '/plain/index'],
            ],
            'user' => [
                ['title' => 'Login', 'path' => '/users/_login'],
                ['title' => 'Register', 'path' => '/users/register'],
                ['title' => 'List', 'path' => '/users/index'],
                ['title' => 'Create new user', 'path' => '/users/create'],
            ],
            'mya' => [
                ['title' => 'Contacts', 'path' => '/mya/contacts'],
                ['title' => 'Useful Links', 'path' => '/mya/usefullinks'], // fixed typo: 'Userful'
            ],
            'page' => [
                ['title' => 'Page 1', 'path' => '/pages/page1'],
                ['title' => 'Page 2', 'path' => '/pages/page2'],
            ],
            'debug' => [
                ['title' => 'Debug Log Files', 'path' => '/debug/logfile'],
                ['title' => 'Clear Debug', 'path' => '/debug/clear'],
            ],
            'dashboard' => [                            // fixed typo: 'daskboard'
                ['title' => 'Home', 'path' => '/'],
                ['title' => 'Dashboard', 'path' => '/dashboard/index'],
                ['title' => 'Books List', 'path' => '/books/index'],
                ['title' => 'Authors List', 'path' => '/authors/index'],
                ['title' => 'Users', 'path' => '/users/index'],
            ],
            'learn' => [
                ['title' => 'Home', 'path' => '/'],
            ],
            'static' => [
                ['title' => 'Home', 'path' => '/'],
            ],
        ],
    ],

    // -----------------------------------------------------------------------
    // Controller → action title map
    // If a title is not found here the router falls back to the action name.
    // -----------------------------------------------------------------------
// enhance dorouter/doview do auto switch
    /*
    'controller' => [
        'router' => [
            'notfound' => 'Not Found Page',
            '404'      => 'Not Found Page',
        ],
        'mya' => [
            'index'        => 'My App',
            'usefullinks'  => 'Useful Links',
        ],
        'dashboard' => [
            'index' => 'Dashboard List',
        ],
        'debug' => [
            'index'   => 'Debug Dashboard',
            'logfile' => 'Debug Log Files',
            'clear'   => 'Clear Debug',
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

    ],

    // -----------------------------------------------------------------------
    // Menu link groups built at runtime — CUtil calls must happen after
    // bootstrap so these closures are resolved lazily if needed, or you can
    // populate them in a post-boot hook instead of here.
    // -----------------------------------------------------------------------
    'mnuhome'   => ['Home' => ''],          // populated at runtime: CUtil::selfURL()
    'mnucommon' => [],                      // populated at runtime: mailto link
    'mnubot'    => ['Bing' => 'http://bing.com/,_blank,navarrow.gif'],

    // -----------------------------------------------------------------------
    // Static / per-app top menus
    // -----------------------------------------------------------------------
    'mnu_static' => [
        'MSN'        => 'https://msn.com,_blank,navarrow.gif',
        'Google'     => 'https://google.com,_blank,navarrow.gif',
        'DuckDuckGo' => 'https://duckduckgo.com/,_blank,navarrow.gif',
    ],
    'mnu_front' => [],
    'mnu_jv'    => [],
    'mnu_learn' => [
        'TEST' => '',                       // populated at runtime: CUtil::rootSite().'/test'
    ],

    // -----------------------------------------------------------------------
    // Ajax Web Services — access levels per endpoint group
    // -----------------------------------------------------------------------
    'ajws' => [
        'odata' => '',      // open — no authentication required
        'udata' => 'inq',   // requires authentication
    ],

    // -----------------------------------------------------------------------
    // Per-app task/group maps
    // -----------------------------------------------------------------------
    'front' => [
        'front'  => ',FP',
        'admin'  => 'admin,',
        'fbsq'   => 'inq,FbsQ',
    ],
    'learn' => [
        'learn'    => ',Lrn',
        'lrnadmin' => 'admin,Admin',
        'userq'    => 'inq,UserQ',
        'jsgrid'   => 'inq,',
        'ko'       => 'inq,',
        'jendo'    => ',',
        'static'   => ',',
    ],
    'static' => [],

    'tg' => [],         // MASTER task→group map

    // -----------------------------------------------------------------------
    // Debug / logging
    // -----------------------------------------------------------------------
    'dmsg' => [
        'maxscreen' => 100,
        'maxlines'  => 2,
    ],
*/
];
return $r;
