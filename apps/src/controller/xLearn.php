<?php
namespace MvcLite;
class Learn extends BaseController {

    public function __construct() {
        
        parent::__construct();
        $this->layout = "bootstrap";           
//        $this->_view_data['cmenu'] = $this->h->getLiMenu($this->cfg->get('menu.cmenu.front'));    
        $sel="learn";
//        CCore::SetMenuTop($sel); // add to get
//        $this->_view_data['topmenu'] = $this->h->getLiMenu($this->cfg->get('menu.main'))."=>&nbsp;&nbsp;".$this->h->getLiMenu($this->cfg->get('menu.cmenu.$sel'))
//        .$this->h->getLiMenu($this->cfg->get('mnutop'))
        ;

//        $this->_view_data['submenu'] = $this->h->getLiMenu($this->cfg->get('menu.submenu.learn'))
//        .' : '. CUtil::getSubMenu();

    }

    public function start($args = false) {

        $ret = $this->doAction($args, static::class);  // static resolve to calling class name      

    }
}
