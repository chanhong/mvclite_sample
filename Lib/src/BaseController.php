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
        // not use since it is not cross browser compatible yet
        $this->styleless = [
//            "public/less/default-less.less",
        ];

        $this->stylesheets['before'] = [
            "css/bootstrap/normalize.css",
        ];

        $this->stylesheets['after'] = [
            "css/custom.css",
        ];

        $this->javascripts = [
            "js/jquery-3.2.1.min",
            "js/jquery-migrate-git.min",
//            "public/js/less-1.5.1.js",
            "js/bootstrap.min.js",
            "js/ie-emulation-modes-warning.js",
        ];
    }
    
}
