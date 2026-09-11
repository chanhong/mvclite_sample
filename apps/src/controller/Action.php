<?php
namespace MvcLite;
class Action extends BaseController
{

    public function __construct()
    {

        parent::__construct();
        $this->layout = "bootstrap";
        //        $this->_view_data['cmenu'] = $this->h->getLiMenu($this->cfg->get('menu.cmenu.front'));    
        $sel = "learn";
        //        CCore::SetMenuTop($sel); // add to get
//        $this->_view_data['topmenu'] = $this->h->getLiMenu($this->cfg->get('menu.main'))."=>&nbsp;&nbsp;".$this->h->getLiMenu($this->cfg->get('menu.cmenu.$sel'))
//        .$this->h->getLiMenu($this->cfg->get('mnutop'))
        ;

        //        $this->_view_data['submenu'] = $this->h->getLiMenu($this->cfg->get('menu.submenu.learn'))
//        .' : '. CUtil::getSubMenu();

    }

    public function start($args = false)
    {
        /*
        self::selfVsStatic(); // old static to object self:: (always CController) static::class (whoever call such as Authors)
        self::selfVsStatic($this::class,"authors"); // old static to object self:: (always CController) static::class (whoever call such as Authors)
*/
        $ret = $this->doAction($args, static::class);  // static resolve to calling class name      
    }

    public function logout($args = false)
    {
        $_retUrl = CUtil::getReturnUrl();
//        self::Add2SessVar("feedback", "You has been logout!"); _Logout() do this
        CCore::_Logout();
        $this->redirect2Url($_retUrl);
    }
}
