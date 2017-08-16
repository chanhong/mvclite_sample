<?php
class Router extends BaseController {

    public function __construct() {
        
        parent::__construct();
    }

    public static function start($args = false) {

        // must get userinfo from SESSION, when redirect or new route, only session will retain the value
        if (!empty($_SESSION['cache']['userinfo'])) {
            BaseCore::$_userInfo = $_SESSION['cache']['userinfo'];
        }


        self::doRouter(BaseCore::$_cfg['routes'], self::class);
    }
}
