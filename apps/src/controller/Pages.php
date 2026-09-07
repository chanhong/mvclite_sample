<?php
namespace MvcLite;
class Pages extends BaseController {

    public function __construct() {
        
        parent::__construct();
//        $this->_view_data['cmenu'] = $this->h->getLiMenu($this->cfg->get('menu.cmenu.front'));        
        $this->_view_data['submenu'] = $this->h->getLiMenu($this->cfg->get('menu.submenu.page'));
    }

    public function start($args = false) {

        $ret = $this->doAction($args, static::class);  // static resolve to calling class name      

    }
}
