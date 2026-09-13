<?php 
use MvcLite\CCore;
use MvcLite\CUtil;
$this->_view_data['header_title'] = 'Logout';
        $_retUrl = CUtil::getReturnUrl();
//        self::Add2SessVar("feedback", "You has been logout!"); _Logout() do this
        CCore::_Logout();
        $this->redirect2Url($_retUrl);