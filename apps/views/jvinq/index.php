<?php
use MvcLite\CCore;

  //  CJv::setUserProfile(); // always attempt to set profile
  $PageData["Title"] = "eJV Inqury";
  $dbenv = CJv::DbEnv();
  CJvInq::PbOrRr(CUtil::MyUrl(), $dbenv); // process Post/Get Request, use index instead of _pb to simplify logic
  CJv::IsJvUserForcedLogoff(CJv::DbEnv());

include("JV_Search.php");