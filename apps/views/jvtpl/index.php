<?php
use MvcLite\CCore;

  $PageData["Title"] = "JV Template Index";
  $tsk = "jvtpl";
  $PageData["meqs"] = CUtil::tap("/" . $tsk . "/index/");
  $dbenv = CJv::DbEnv();
  CJvTpl::PbOrRr(CUtil::MyUrl(), $dbenv); // process Post/Get Request, use index instead of _pb to simplify logic
  CJv::IsJvUserForcedLogoff(CJv::DbEnv());
  CCore::$_uprf = CUtil::getSessNv("uinfo");  
  if (!CString::IsEmpty($dbenv) && CString::IsEmpty(@CCore::$_uprf["name"])) { 
    CJv::setUserProfile($dbenv);  
  }

  include("_jvlist.php");