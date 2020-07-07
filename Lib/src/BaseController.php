<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#namespace MvcSample;
#namespace MvcLite;

use MvcLite\MvcController;

class BaseController extends MvcController {
    
    public function __construct() {
        
        parent::__construct(); 
        
        // common set of header stuff like css, jv, etc
        $this->javascripts['before'] = [
            $this->vendorFolder . '/' ."components/jquery.min.js",
            $this->vendorFolder . '/' ."components/jqueryui/jquery-ui.min.js",
//          $this->publicFolder . '/' . "public/js/less-1.5.1.js",
        ];

        $this->javascripts['after'] = [
            $this->vendorFolder . '/' ."twbs/bootstrap/dist/js/bootstrap.min.js",
            $this->publicFolder . '/' ."js/ie-emulation-modes-warning.js",
        ];

        // not use since it is not cross browser compatible yet
        $this->styleless = [
//            $this->publicFolder . '/' ."public/less/default-less.less",
        ];

        $this->stylesheets['before'] = [
//            $this->publicFolder . '/' ."bootstrap/css/bootstrap/normalize.css",
        ];

        $this->stylesheets['after'] = [
            $this->publicFolder . '/' ."css/custom.css",
        ];

    }
    
}
