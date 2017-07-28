<?php
//namespace MvcSample;

class Front extends BaseController {

    public function __construct() {
        
        parent::__construct();
        $this->layout = "default";  
        $this->add2Array4Layout("meta", "utf-8");
        $this->_view_data['profile'] = BaseCore::$_userInfo;            
        $this->setViewData($this->_class_path);
        $this->home = $this->h->tap('/front/index');
        $this->_view_data['menu'] = $this->h->getLiMenu(BaseCore::$_cfg['menu']['front']);        
    }

    public function start($args = false) {

        $ret = self::doAction($args, self::class);
    }

}
