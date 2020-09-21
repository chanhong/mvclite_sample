<?php

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
        if (!empty($_SESSION['uinfo']['username']) && $_SESSION['uinfo']['level']=="admin")
        {
            permDbg(self::$_usrInfo,"Y:");
            $isGood = true;
        } else{
//            permDbg(self::$_usrInfo,"N:");
//            permDbg($_SESSION,"N:");
//                pln("here");
        }
        return $isGood;
    }

    public function doBody() {

        $youare = $dmsg = $alertMsg = $feedback = $buff = $ui = $uf = "";
/*
        permDbg(self::$_usrInfo,'ubody');
        permDbg(self::$_cfg,'cfg');
        */
        $dmsg = $this->ut->getSafeVar($_SESSION, "debug");
        $ui = $this->ut->getSafeVar(self::$_usrInfo, "debug");
        (!empty($dmsg)) ? $dmsg = "<center>" . $dmsg . "</center>" : $dmsg = "";

        $feedback = $this->feedback("feedback", "DarkGreen");
        $alertMsg = $this->feedback("alert", "IndianRed");

        $buff .=  $youare .$ui. $dmsg . $alertMsg .$feedback;
        $buff .=  $this->Error;
        $buff .=  $this->doBodyNoLayout();
        $_SESSION["debug"] = $_SESSION["feedback"] = $_SESSION["alert"] = "";
        echo $buff; 
    } 

}