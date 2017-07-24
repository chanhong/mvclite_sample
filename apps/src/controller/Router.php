<?php

class Router extends BaseController {

    public function __construct() {
        
        parent::__construct();
    }

    public static function start($args = false) {

        // must get userinfo from SESSION
        if (!empty($_SESSION['userinfo'])) {
            BaseCore::$_userInfo = $_SESSION['userinfo'];
        }

        self::doRouter($args, BaseCore::$_cfg['routes'], self::class);
    }
}
