<?php


class Router extends BaseController {

    public function __construct() {
        
        parent::__construct();
    }

    public static function start($args = false) {

        // must get userinfo from SESSION, when redirect or new route, only session will retain the value
       /* 
        if (!empty($_SESSION['cache']['uinfo'])) {
            MvcCore::$_usrInfo = $_SESSION['cache']['uinfo'];
        }
        */

//        permDbg(MvcCore::$_cfg['routes'], "routes");    
        self::doRouter(MvcCore::$_cfg['routes'], self::class);
    }
}
