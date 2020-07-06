<?php
#namespace MvcSample;

class Front extends BaseController {

    public function __construct() {
        
        parent::__construct();
        $this->_view_data['profile'] = BaseCore::$_userInfo;            
//        $this->_view_data['cmenu'] = $this->h->getLiMenu(BaseCore::$_cfg['menu']['cmenu']['front']);        
        $this->_view_data['submenu'] = $this->h->getLiMenu(BaseCore::$_cfg['menu']['submenu']['front']);
        
    }

    public function start($args = false) {

        $ret = self::doAction($args, self::class);
    }

}
