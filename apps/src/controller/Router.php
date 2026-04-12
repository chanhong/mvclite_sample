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
        
        if (!empty($_SESSION['cache']['uinfo'])) {
            Ccore::$_usrInfo = $_SESSION['cache']['uinfo'];
        }
        

//        permDbg(Ccore::$_cfg['routes'], "routes");    
        self::doRouter(Ccore::$_cfg['routes'], self::class);
    }
}
