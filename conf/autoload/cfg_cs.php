<?php

/**
 * cfg_other.php — General / structural configuration.
 *
 * Loaded by cfg_all.php and merged into the master CConfig array.
 *
 * global.php / bootstrap.php (which defines DS and DOCROOT) must load
 * before this file.
 *
 * @author chanhong
 */

namespace MvcLite;
/*
// defined in autoload/local.php
  // set the global configuration value here
   $host = $db = $dbuser= $dbpw= $env ="";
  //  CMsg._pdmsg(env, "env");
  // "" for integrated security or sql security
  $dbuser = "acctazure";
  $dbpw = "@Azure#8510";

  // main db
  $host = "coazdbsrv.database.windows.net";
  $db = "coazportal_db";

    $host = ".\sqlexpress";
  $dbuser = "";
  $dbpw = "";
  $csdb => [
     "host"=>$host,
     "db"=>$db,
     "user"=>$dbuser,
     "pw"=>$dbpw,
     "default"=>"dev",
  ],

*/
$r = [

    "_rp" => '_rp_',
    "viewpath" => "apps/views",
    "layoutpath" => "apps/layouts",

    // -----------------------------------------------------------------------
    // MASTER task→group map (populated at boot by CUtil::TaskGroup())
    // -----------------------------------------------------------------------
//    'tg' => [], // set in setting
    'appfdr' => 'apps', // app folder where views are


    // GOOD, KEEP, DON'T CHANGE, clear validation, try to fix eflag left over from previous validation, during jv approval
    /*
    CCore._eflag = new NameValueCollection {
            { "debitcredit",""},
            { "sumamt",""},
    };
    */
    // GOOD, KEEP, DON'T CHANGE, clear validation, try to fix eflag left over from previous validation, during jv approval
// url task action, etc key
    'takey' => 't,a,p1,p2,p3,p4,p5',

    //    'users' => [], // set in CSecs.setUsersInfo()
    'uinfo' => [], // set in CSecs.setUsersInfo()
//    'mnutop' => [], // dynamic top-level menu, need to write to CSetting rather than CCore or CConfig


    // load and convert this into user,group NV
    'defgrpswusers' => [ // mix of winuser and webuser and only get the highest group
        "inq" => "*,inq", // allow all winuser
        "admin" => "cong,chanhong,admin",
        "super" => "super",
        "approver" => "approver",
        "user" => "user",
    ],

    'defuinfo' => [ // md5("111111")
        "admin" => "96e79218965eb72c92a549dd5a330112",
        "super" => "96e79218965eb72c92a549dd5a330112",
        "approver" => "96e79218965eb72c92a549dd5a330112",
        "user" => "96e79218965eb72c92a549dd5a330112",
        "inq" => "96e79218965eb72c92a549dd5a330112",
    ],
    // can't decide stg or cfg??
    'groups' => [
        'guest' => '0',
        'inq' => '20',
        'user' => '30',
        'approver' => '60',
        'super' => '70',
        'admin' => '90',
    ],

    'mnuhome' => [
        ['title' => 'Home', 'path' => '/'],
    ],
    'mnucommon' => [
        // title,"url,target,image"
        ['title' => "Contact", 'mailto' => "email@email.com"],
    ],
    'mnubot' => [
        ['title' => 'Bing', 'href' => 'http://bing.com/'],
    ],

    'mnu_static' => [
        ['Bing' => 'http://bing.com/,_blank,navarrow.gif'],
        ['MSN' => 'https://msn.com,_blank,navarrow.gif'],
        ['Google' => 'https://google.com,_blank,navarrow.gif'],
        ['DuckDuckGo' => 'https://duckduckgo.com/,_blank,navarrow.gif'],
    ],
    'mnu_learn' => [
        ['TEST' => '/test/index'],
    ],
    // define mnu+app for dynamic top menu based on app front or jv
    'mnu_spage' => [], // dynamic
    'mnu_front' => [], // dynamic

    'mnu_jv' => [],

    // use setting instead, remove these later

    // Ajax Web Services
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
        "learn" => ",Lrn",
        "lrnadmin" => "admin,Admin",
        "userq" => "inq, UserQ",
        "jsgrid" => "inq,",
        "ko" => "inq,",
        "jendo" => ",",
        "spage" => ",",
        "pages" => ",",
    ],
    'static' => [], // no group
    'tg' => [],
];

return $r;