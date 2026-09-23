<?php
use MvcLite\CCore;

  // lasyout is already in _search
  $PageData["Title"] = "JV Admin Index";
  $dbenv = CJv::DbEnv();

  CJvAdm::PbOrRr(CUtil::MyUrl(), $dbenv); // process Post/Get Request
  CJv::IsJvUserForcedLogoff($dbenv);
  CCore::$_uprf = CUtil::getSessNv("uinfo");  
  if (!empty($dbenv) && empty(CCore::$_uprf["name"])) { 
    CJv::setUserProfile($dbenv);  
  }
?>
<?php include(__DIR__ . "/_search.php"); ?>