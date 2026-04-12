<?php
use MvcLite\CAuth;
use MvcLite\CCore;

$this->_view_data['header_title'] = 'Front';

$uname = $this->ut->getSafeVar($_SESSION, "loggedin", "raw");
Ccore::$_usrInfo = $this->getUser($uname,"users");
pln(Ccore::$_usrInfo,'uin@front');
pln($_SESSION,'s@front');
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

