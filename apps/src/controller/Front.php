<?php
#namespace MvcSample;

class Front extends BaseController {

    public function __construct() {
        
        parent::__construct();
        $this->layout = "bootstrap";        
        $this->_view_data['profile'] = MvcCore::$_usrInfo;            
        $this->_view_data['cmenu'] = $this->h->getLiMenu(MvcCore::$_cfg['menu']['cmenu']['front']);        
        $this->_view_data['submenu'] = $this->h->getLiMenu(MvcCore::$_cfg['menu']['submenu']['front']);
    }

    public function start($args = false) {
        $ret = self::doAction($args, self::class);
    }

}
