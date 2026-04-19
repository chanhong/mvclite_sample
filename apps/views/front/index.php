<?php
use MvcLite\CAuth;
use MvcLite\CCore;
use MvcLite\CSetting;

$this->_view_data['header_title'] = 'Front';

$uname = $this->ut->getSafeVar($_SESSION, "loggedin", "raw");
CSetting::$_usrInfo = $this->getUser($uname,"users");
pln(CSetting::$_usrInfo,'Suin@front');
pln($this->stg->get('_usrInfo'),'uin@front');
//pln($_SESSION,'s@front');
/*
self::$_usrInfo = $this->getUser($uname,"users");
self::$_cfg["uinfo"]= self::$_usrInfo;
$this->_profile = self::$_usrInfo;
pln($this->_profile,'prf@front');
pln(self::$_cfg["uinfo"],'ucfg');
pln($_SESSION,'s@front');
*/
?>
This is front

