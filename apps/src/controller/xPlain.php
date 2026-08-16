<?php
namespace MvcLite;
class Plain extends BaseController {

    public function __construct() {
        
        parent::__construct();
        $this->layout = "plain";                
    }

    public function start($args = false) {

        $ret = $this->doAction($args, static::class);  // static resolve to calling class name      

    }
}
