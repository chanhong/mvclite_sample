<?php
use MvcLite\CCore;

  $PageData["Title"] = "JV wait for approvel";
  $PageData["meqs"] = CUtil::tap("/jvapv/index/");
  CJvApv::PbOrRr(CUtil::MyUrl(), CJv::DbEnv()); // process Post/Get Request, use index instead of _pb to simplify logic
  CJv::IsJvUserForcedLogoff(CJv::DbEnv());

include("JV_Approval.php");