<?php
namespace MvcLite;
#namespace MvcSample;

use MvcLite\CCore;
//use MvcSample\BaseCore;
//use BaseController;

class Router extends BaseController {

    public function __construct() {
        
        parent::__construct();
    }

    public static function start($args = false) {

        // must get userinfo from SESSION, when redirect or new route, only session will retain the value
        
        if (!empty($_SESSION['cache']['uinfo'])) {
//            CCore::$_usrInfo = $_SESSION['cache']['uinfo'];
            CSetting::$_usrInfo = $_SESSION['cache']['uinfo'];
        }
        

//        permDbg($this->cfg->get('routes'), "routes");     // warning when this is not in object, DI?
        self::doRouter(CConfig::$_cfg['routes'], self::class);
    
        
    }
}
