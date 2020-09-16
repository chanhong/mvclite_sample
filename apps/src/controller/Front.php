<?php
#namespace MvcSample;

class Front extends BaseController {

    public function __construct() {
        
        parent::__construct();
        $this->layout = "bootstrap";        
        $this->_view_data['profile'] = MvcCore::$_userInfo;            
        $this->_view_data['cmenu'] = $this->h->getLiMenu(BaseCore::$_cfg['menu']['cmenu']['front']);        
        $this->_view_data['submenu'] = $this->h->getLiMenu(BaseCore::$_cfg['menu']['submenu']['front']);
    }

    public function start($args = false) {
//        permDbg($this->layout, 'layout');
        $ret = self::doAction($args, self::class);
    }

}
