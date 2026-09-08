<?php
namespace MvcLite;

use MvcLite\CController;

class BaseController extends CController
{

    public function __construct()
    {

        parent::__construct();

        // common set of header stuff like css, jv, etc
        $this->javascripts['before'] = [
            $this->vendorFolder . '/' . "components/jquery.min.js",
            $this->vendorFolder . '/' . "components/jqueryui/jquery-ui.min.js",
            //          $this->publicFolder . '/' . "public/js/less-1.5.1.js",
        ];

        $this->javascripts['after'] = [
            $this->vendorFolder . '/' . "twbs/bootstrap/dist/js/bootstrap.min.js",
            $this->publicFolder . '/' . "js/ie-emulation-modes-warning.js",
        ];

        // not use since it is not cross browser compatible yet
        $this->styleless = [
            $this->publicFolder . '/' . "public/less/default-less.less",
        ];

        $this->stylesheets['before'] = [
            $this->publicFolder . '/' . "css/custom.css",
        ];

        $this->stylesheets['after'] = [
            //            $this->publicFolder . '/' ."css/custom.css",
        ];
    }
    public function isAllow($uPath)
    {
        $isGood = false;
        //        pln($_SESSION['uinfo'],'uinfo');
        if (isset($_SESSION['uinfo'])) {
            pln($_SESSION['uinfo'], 'uinfo');
        }
        //        $_SESSION['uinfo']['level']=(isset($_SESSION['uinfo']['usrgroup']) )?  $_SESSION['uinfo']['usrgroup']:'';
        $uname = $_SESSION['uinfo']['username'] ?? $_SESSION['uinfo']['usrname'] ?? ''; // authenticate from user table or default security
        $ugrp = $_SESSION['uinfo']['level'] ?? $_SESSION['uinfo']['usrgroup'] ?? ''; // authenticate from user table or default security
//        if (!empty($_SESSION['uinfo']['username'] ||!empty($_SESSION['uinfo']['usrname'])) && 
        if (!empty($uname) && !empty($ugrp))
        //        (($_SESSION['uinfo']['level']=="admin")|| $_SESSION['uinfo']['usrgroup']=="admin"))
        {
            permDbg(CSetting::$_usrInfo, "Y:");
            $isGood = true;
        } else {
            permDbg(CSetting::$_usrInfo, "N:");
            permDbg($_SESSION, "N:");
        }
        return $isGood;
    }

    public function doBody()
    {

        //    $fbdmsg ="";
        $youare = $dmsg = $alertMsg = $feedback = $buff = $ui = $uf = "";
        //        pln(CSetting::$_usrInfo,'ubody');
//         pln($this->cfg->getAll()); //DI??
        $fbdmsg = $this->ut->getSafeVar($_SESSION, "fbdmsg");
        $dmsg = $this->ut->getSafeVar($_SESSION, "debug");
        $ui = $this->ut->getSafeVar(CSetting::$_usrInfo, "debug");
        (!empty($dmsg)) ? $dmsg = "<center>" . $dmsg . "</center>" : $dmsg = "";

        $feedback = $this->feedback("feedback", "DarkGreen");
        $alertMsg = $this->feedback("alert", "IndianRed");

        $buff .= $youare . $ui . $dmsg . $fbdmsg . $alertMsg . $feedback;
        $buff .= $this->Error;
        $buff .= $this->doBodyNoLayout();
        //         $_SESSION["fbdmsg"] ="";
        $_SESSION["debug"] = $_SESSION["feedback"] = $_SESSION["alert"] = "";
        echo $buff;
    }

}