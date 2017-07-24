<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace MvcSample;

use MvcLite\MvcController;

class BaseController extends MvcController {
    
    public function __construct() {
        
        parent::__construct();  
        // common set of header stuff like css, jv, etc
        $this->styleless = array(// not use since it is not cross browser compatible yet
//            "public/less/default-less.less",
        );
        $this->stylesheets = array(
            "css/bootstrap/normalize.css",
//            "public/css/default.css",
            "css/menu.css",
        );
        $this->javascripts = array(
            "js/jquery-2.0.3.min.js",
//            "public/js/less-1.5.1.js",
            "js/bootstrap.js",
        );
    }
}
