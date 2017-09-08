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
        /*
        $this->javascripts = [
            "js/jquery-3.2.1.min.js",
            "js/jquery-migrate-git.min.js",
            "js/jquery-ui.min.js",
//            "public/js/less-1.5.1.js",
            "js/bootstrap.min.js",
            "js/ie-emulation-modes-warning.js",
        ];
*/
        $this->javascripts['before'] = [
//            "http://code.jquery.com/jquery-3.2.1.min.js",
            $this->publicFolder . '/' ."js/jquery-3.2.1.min.js",
            $this->publicFolder . '/' ."js/jquery-migrate-1.4.1.min.js",
            $this->publicFolder . '/' ."js/jquery-ui-1.12.1.min.js",
//          $this->publicFolder . '/' . "public/js/less-1.5.1.js",
        ];

        $this->javascripts['after'] = [
            $this->publicFolder . '/' ."js/bootstrap.min.js",
            $this->publicFolder . '/' ."js/ie-emulation-modes-warning.js",
        ];

        // not use since it is not cross browser compatible yet
        $this->styleless = [
//            $this->publicFolder . '/' ."public/less/default-less.less",
        ];

        $this->stylesheets['before'] = [
            $this->publicFolder . '/' ."css/bootstrap/normalize.css",
        ];

        $this->stylesheets['after'] = [
            $this->publicFolder . '/' ."css/custom.css",
            $this->publicFolder . '/' ."css/jquery-ui.1.12.1.structure.min.css",
            $this->publicFolder . '/' ."css/jquery-ui.1.12.1.theme.min.css",
        ];

    }
    
}
