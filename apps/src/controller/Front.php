<?php
//namespace MvcSample;

class Front extends BaseController {

    public function __construct() {
        
        parent::__construct();
        $this->layout = "default";                
        $this->add2HeaderArrays("css", "css/default.css");
        $this->add2HeaderArrays("css", "css/menu.css");
        $this->add2HeaderArrays("meta", "utf-8");
        $this->_view_data['profile'] = BaseCore::$_userInfo;            
        $this->setViewData($this->_class_path);
    }

    public function start($args = false) {

        $ret = self::doAction($args, self::class);
    }
}
