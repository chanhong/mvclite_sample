
<?php
use MvcLite\CCore;
  CCore::_Logout();
  $PageData["Title"] = "Account Confirm";
  //Layout = CUtil::GetLayout("_ejv");
  $qs = CUtil::qs2nv();
  CUtil::Add2SessVar("feedback", MJvAdm::ConfirmUser($qs, CJv::DbEnv()));
?>
<div align="center">
  <p>
    <h2>eJV Account Confirmation Page</h2>
  </p>
</div>