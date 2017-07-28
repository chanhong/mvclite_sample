<?php

class Plain extends BaseController {

    public function __construct() {
        
        parent::__construct();
        $this->layout = "plain";                
        $this->add2Array4Layout("meta", "utf-8");
        $this->setViewData($this->_class_path);
    }

    public function start($args = false) {

        $ret = self::doAction($args, self::class);
    }
}
