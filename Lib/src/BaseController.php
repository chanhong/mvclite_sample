<?php
namespace MvcLite;

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
            $this->publicFolder . '/' ."public/less/default-less.less",
        ];

        $this->stylesheets['before'] = [
            $this->publicFolder . '/' ."css/custom.css",
];

        $this->stylesheets['after'] = [
//            $this->publicFolder . '/' ."css/custom.css",
        ];
    }
    public function isAllow($uPath) {
        $isGood=false;
        if (!empty($_SESSION['userinfo']['username']) && $_SESSION['userinfo']['level']=="admin")
        {
            $isGood = true;
        } else{
            permDbg(MvcCore::$_userInfo,"N:");
            permDbg($_SESSION,"N:");
        }
        return $isGood;
    }

}