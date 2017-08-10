<?php

class Plain extends BaseController {

    public function __construct() {
        
        parent::__construct();
        $this->layout = "plain";                
    }

    public function start($args = false) {

        $ret = self::doAction($args, self::class);
    }
}
