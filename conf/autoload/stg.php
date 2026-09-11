<?php

/**
 * stg.php — Application settings (runtime state).
 *
 * Returns a plain PHP array that index.php passes directly to CSetting:
 *
 *   $container->singleton('stg', fn() =>
 *       new \MvcLite\CSetting(require DOCROOT . '/conf/stg.php')
 *   );
 *
 * All consumers should retrieve the CSetting instance from the DI container:
 *
 *   $stg->get('logintype');
 *   $stg->get('info.defctrl');
 *
 * -------------------------------------------------------------------------
 * LEGACY BRIDGE
 * During migration, index.php syncs the built array back to CSetting::$_stg
 * so any code still using CSetting::$_stg['key'] keeps working unchanged.
 * Remove that sync line once all call-sites are updated.
 * -------------------------------------------------------------------------
 *
 * global.php / bootstrap.php must load before this file.
 *
 * @author chanhong
 */

namespace MvcLite;

use MvcLite\CUtil;

$r2 = loadIfExist(__DIR__ . '/stg_custom.php');
$r =
    [
    'tg' => [], // set in CUtil::getTopMenu()
    // -----------------------------------------------------------------------
    // Navigation menus
    // -----------------------------------------------------------------------
    'menus' => [ // dynamic menus
        'main' => [],
        'app' => [],
        'sub' => [],
    ],    
        //        "apps" => "ajws,front,jv,learn,static,users", // use app.selctrl instead list of all apps ajws,front,jv,learn,static, control dynamic top menu
        "defctrl" => "front",                       // default controller
        "selctrl" => "",                            // set at runtime by setActiveCtrl()
        "defview" => "index",
        "takey" => "t,a,p1,p2,p3,p4,p5",
        "viewext" => ".php",
        "deflayout" => "_default",
        'layout' => 'bootstrap',
        "login" => "_login", // for dynamic excl
        'router' => 'router',

        "defdb" => "dbacct",                      // db, dbejv, dbadq, dbitinvt, dbacct

        "env" => "",   // set via getenv
        "dbenv" => "",   // set via getenv
        "broadcast" => "",
        "welcome" => "",
        "_rp" => "_r_",        // protected render page prefix
        "pdbg" => "yes",       // turn off print debug message
        "fbdmsg" => "",
        "weblogin" => "admin|cong", // web login allowed users
        "logintype" => "web",        // web (override) only for testing, usually off

        "data" => "data",
        "404" => "Error",
        "logoff" => "",           // username to force logoff

//        '404' => "Error",
        'siteroot' => CUtil::rootSite(),
        'urlsite' => CUtil::siteURL(),
        "urllogin" => "/front/_login",  // overwritten at runtime by setActiveCtrl()
        "urllogout" => "/action/logout", // until add action controller
//        "urllogout" => "?logout", // old alias logout

        "imgpath" => "/apps/images",
        "sharedpath" => "/apps",
        "viewpath" => "apps/views",
        "layoutpath" => "apps/layouts",
        // -----------------------------------------------------------------------
        // General site information
        // -----------------------------------------------------------------------
        
        'info' => [
            'emailfrom' => 'email@email.com',
            'ITContact' => 'email@email.com',
            'router' => 'router',
//            'viewext' => '.php',
//            'layout' => 'bootstrap',
//            'defctrl' => 'front',
//            'selctl' => '',       // written at runtime by setActiveCtrl()
//            'login' => '_login', // for dynamic excl
//            'urllogin' => '',       // written at runtime by setActiveCtrl()
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
        // Derived paths set in CController constructor
        // -----------------------------------------------------------------------
        'path' => [
            'view' => '', // 'apps' . DS . 'views',
            'layout' => '', //'apps' . DS . 'layouts',
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
        // here is better or cfg?
        'groups' => [
            'guest' => '0',
            'inq' => '20',
            'user' => '30',
            'approver' => '60',
            'super' => '70',
            'admin' => '90',
        ],
        'tgExemptControllers' => ['action'],        // handle logout, etc
        // -----------------------------------------------------------------------
        // App registry — TOP LEVEL (not inside menu)
        // -----------------------------------------------------------------------
        'apps' => [
            "list" => "ajws,front,jv,learn,static,users", // for taskgroup until later 
            'ajws' => [ // group, title
                "odata" => ",", // open not required authenticate
                "udata" => "inq,", // required authenticate
            ],
            'front' => [ // group, title
                "front" => ",FP",
                "admin" => "admin,",
                "fbsq" => "inq,FbsQ",
                "jv" => ",",
                "learn" => ",",
                "static" => ",",
                "pages" => ",",
                "users" => ",",
                "books" => ",",
                "authors" => ",",
            ],
            'jv' => [ // group, title
                "jv" => ",eJV",
                "jvadm" => "admin,JV Admin",
                "jvapv" => "approver,JV Approver",
                "jvtpl" => "user,JV Templates",
                "jvinq" => "inq,JV Inquery",
            ],
            'learn' => [ // group, title
                "front" => ",FP",
                "learn" => ",Lrn",
                "lrnadmin" => "admin,Admin",
                "userq" => "inq, UserQ",
                "jsgrid" => "inq,",
                "ko" => "inq,",
                "jendo" => ",",
                "spage" => ",",
                "pages" => ",",
            ],
            'users' => [
                "list" => ",User List",
                "create" => "admin,Create new user",
                "register" => ",",
            ],
            'authors' => [
                "login" => ",",
            ],

            'spage' => [],
        ],

        //        'mnutop' => [], // NOTused, dynamic top-level menu, need to write to CSetting rather than CCore or CConfig
    ];
// ---------------------------------------------------------------------------
// Build and return the full settings array
// ---------------------------------------------------------------------------
//print ("<pre>" . print_r($r, true) . "</pre>");
//print ("<pre>" . print_r($r2, true) . "</pre>");
$all = array_merge($r, $r2);
//print ("<pre>SETTING: " . print_r($all, true) . "</pre>");
return $all;