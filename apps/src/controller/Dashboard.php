<?php
//namespace MvcSample;
namespace MvcLite;
class Dashboard extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->layout = "dashboard";
        $this->_view_data['cmenu'] = $this->h->getLiMenu(Ccore::$_cfg['menu']['cmenu']['daskboard']);        
        $this->_view_data['submenu'] = $this->h->getLiMenu(Ccore::$_cfg['menu']['submenu']['daskboard']);
              
    }

    public function start($args = false) {

        $ret = self::doAction($args, self::class);
    }


}
