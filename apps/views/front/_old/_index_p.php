<?php
use MvcLite\CAuth;
use MvcLite\CCore;
use MvcLite\CSetting;

$this->_view_data['header_title'] = 'Front';

$uname = $this->ut->getSafeVar($_SESSION, "loggedin", "raw");
$usrn = $this->getUser($uname,"users"); // query users table
$this->stg->_set('_usrInfo', $usrn);  // ← correct
$this->stg->_set('uinfo', $usrn);  // ← correct,  use uinfo going forward, _usrInfo old
pln($this->stg->_get('uinfo'),'suin@front');  // CCore::pln only after loggedin
//pln($_SESSION,'s@front');
//pln($this->_profile,'prf@front');
?>
This is front

