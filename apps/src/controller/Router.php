<?php
namespace MvcLite;
#namespace MvcSample;

class Router extends BaseController
{

    public function __construct()
    {

        parent::__construct();
    }

    public function start($args = false)
    { // DI: was static
        // must get userinfo from SESSION, when redirect or new route, only session will retain the value
        if (!empty($_SESSION['cache']['uinfo'])) {
            CSetting::$_usrInfo = $_SESSION['cache']['uinfo'];
        }
        // DI: was self::doRouter(CConfig::$_cfg['routes'], self::class)
        $this->doRouter($this->cfg->get('routes'), static::class);
    }

}
