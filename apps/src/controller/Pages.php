<?php

class Pages extends BaseController {

    public function __construct() {
        
        parent::__construct();
//        $this->_view_data['cmenu'] = $this->h->getLiMenu(BaseCore::$_cfg['menu']['cmenu']['front']);        
        $this->_view_data['submenu'] = $this->h->getLiMenu(BaseCore::$_cfg['menu']['submenu']['page']);
    }

    public function start($args = false) {

        $ret = self::doAction($args, self::class);
    }
}
