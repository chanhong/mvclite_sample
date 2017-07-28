<?php
//namespace MvcSample;

class Dashboard extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->layout = "dashboard";
        $this->add2Array4Layout("meta", "utf-8");
        $this->_view_data['menu'] = $this->h->getLiMenu(BaseCore::$_cfg['menu']['daskboard']);        
    }

    public function start($args = false) {

        $ret = self::doAction($args, self::class);
    }


}
