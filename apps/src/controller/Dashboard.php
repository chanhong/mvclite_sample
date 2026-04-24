<?php
//namespace MvcSample;
namespace MvcLite;
class Dashboard extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->layout = "dashboard";
        $this->_view_data['cmenu'] = $this->h->getLiMenu($this->cfg->get('menu.cmenu.dashboard'));        
        $this->_view_data['submenu'] = $this->h->getLiMenu($this->cfg->get('menu.submenu.dashboard'));
    }

    public function start($args = false) {

        $ret = $this->doAction($args, static::class);  // static resolve to calling class name      


    }


}
