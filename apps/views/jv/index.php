<?php
use MvcLite\CCore;
  // don't set layout in index for consistency and avoid double layout
  $vFile = "";
  $retViewFile = "";
  $dbinfo = CJv::DbEnv();
  $_qsa = CCore::qs2nvWithDefaultValue();
  //  CMsg::_pdmsg(_qsa, "jvinx");
  CUtil::setActiveCtrl($_qsa);
  //  CSecs.setUsersInfo(); // default
  CJv::setUsersInfo($dbinfo); // MUST set JV Users info for the menu 

  $PageData["Title"] = "eJV System";
  $vFile = "_login.php";
  CCore::$_cfg["alert"] = CJv::JvOfflineMsg();

  CJv::IsJvUserForcedLogoff($dbinfo); // only when assoc with Windows account
  //    CJv::setUserProfile(); // app specific user profile, let see if set in login is good enough
  $retViewFile = CUtil::getReturnViewFileFromSess();
  CMsg::_pdmsg($retViewFile, "retViewFile");
  $vFile = (CString::IsEmpty($retViewFile) == false)
? $retViewFile // return to view before redirect to login
: "_main.php";
?>
<?php include("$vFile"); ?>