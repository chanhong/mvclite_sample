<?php

class Plain extends BaseController {

    public function __construct() {
        
        parent::__construct();
        $this->layout = "plain";                
        $this->add2HeaderArrays("css", "css/default.css");
        $this->add2HeaderArrays("meta", "utf-8");
        $this->setViewData($this->_class_path);
    }

    public function start($args = false) {

        $ret = self::doAction($args, self::class);
    }
}
