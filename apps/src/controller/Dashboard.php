<?php
//namespace MvcSample;

class Dashboard extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->layout = "dashboard";
        $this->add2HeaderArrays("css", "css/default.css");
        $this->add2HeaderArrays("css", "css/menu.css");
        $this->add2HeaderArrays("meta", "utf-8");
    }

    public function start($args = false) {

        $ret = self::doAction($args, self::class);
    }

    public function index($args = false) {
        $dashboardURL = "";
        foreach (BaseCore::$_cfg['menu']['daskboard']  as $one) {
            $dashboardURL .= "<li>".$this->h->alink($one)."</li>";
        }             
        $this->_view_data['menu'] = $this->h->getLiMenu($dashboardURL);   // prepend to standard menu     
        self::doView($this, "index");  
    }

}
