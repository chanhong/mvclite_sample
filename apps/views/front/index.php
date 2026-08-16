<?php
use MvcLite\CCore;
use MvcLite\CSecs;
use MvcLite\CUtil;
use MvcLite\CString;

  // don't set layout in index for consistency and avoid double layout
  $_qsa = CCore::qs2nvWithDefaultValue();
  CUtil::setActiveCtrl($_qsa);
CUtil::setLoginUrl()  ;
  $PageData["Title"] = "Front Page";
  CSecs::setUsersInfo(); // MUST set it before it is being used in the class
  $retViewFile = CUtil::getReturnViewFileFromSess();
  $vFile = (CString::IsEmpty($retViewFile) == false)
    ? $retViewFile // return to view before redirect to login
    : "_main.php";
include($vFile);

