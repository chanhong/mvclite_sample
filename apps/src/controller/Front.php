<?php
#namespace MvcSample;
namespace MvcLite;
class Front extends BaseController {

    public function __construct() {
        
        parent::__construct();
        $this->layout = "bootstrap";        
        $this->_view_data['profile'] = CSetting::$_usrInfo;  
        $this->_view_data['cmenu'] = $this->h->getLiMenu($this->cfg->get('menu.cmenu.front'));        
        $this->_view_data['submenu'] = $this->h->getLiMenu($this->cfg->get('menu.submenu.front'));
    }

    public function start($args = false) {
//        var_dump(spl_object_id($this->db)); //int(16)
        $ret = $this->doAction($args, self::class);
    }

}
