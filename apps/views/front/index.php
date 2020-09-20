<?php
use MvcLite\MvcAuth;
$this->_view_data['header_title'] = 'Front';

$uname = $this->ut->getSafeVar($_SESSION, "loggedin", "raw");
MvcCore::$_usrInfo = $this->getUser($uname,"users");
//pln(MvcCore::$_usrInfo,'uin@front');
//pln($_SESSION,'s@front');
?>
This is front

