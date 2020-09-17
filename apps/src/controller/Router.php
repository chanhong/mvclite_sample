<?php
#namespace MvcSample;

/*
use MvcSample\BaseCore;
use MvcSample\BaseController;
*/
class Router extends BaseController {

    public function __construct() {
        
        parent::__construct();
    }

    public static function start($args = false) {

        // must get userinfo from SESSION, when redirect or new route, only session will retain the value
        if (!empty($_SESSION['cache']['userinfo'])) {
            MvcCore::$_userInfo = $_SESSION['cache']['userinfo'];
        }

//        permDbg(MvcCore::$_cfg['routes'], "routes");    
        self::doRouter(MvcCore::$_cfg['routes'], self::class);
    }
}
