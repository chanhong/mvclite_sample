<?php

use MvcLite\CCore;
use MvcLite\CUtil;
use MvcLite\CSecs;
use MvcLite\CSetting;
  $_qsa = CCore::qs2nvWithDefaultValue();
  CUtil::setActiveCtrl($_qsa);
  $PageData["app"] = "Learn";
  CSecs::setUsersInfo(); // MUST set user info in case redirected
  $Layout = CUtil::GetLayout("_bootstrap");
    $PageData["header_title"] = "Login";
/*
  if ($PageData["header_title"] == CSetting::get("AppName"))
  {
    $PageData["header_title"] = "Login";
  }
    */
  //      CMsg::_msg(CUtil::getSessTxt("retUrl"), "sessrurl");
  if ($_POST)
  {
    if (CCore::CLogin($_POST) == true)
    {
      CUtil::Redirect("?"); // must do it this way to have a chance to set profile before redirect
    }
    else
    {
      CCore::ClearUser();
    }
  }

        $vfdr = CSetting::get("viewpath") . "/" . CSetting::get("_rp")."/" ??'';
        /*
        pln($vfdr,'vfdr');
        pln($PageData["app"],'app');
*/
?>
<div id="main" align="center">
<?php
    if (CSecs::IsNotAuthorized() == true)
    {
      echo "<H1>You are not authorized!</H1>";
    }
    else
    {
      if (CSecs::IsWebloginAllowed() == true)
      {
        include __DIR__."/_rp_/"."_loginWeb.php";
//        include $vfdr . "loginWeb.php";
      }
      if (CSecs::isIntrgUser() == true)
      {
        include $vfdr . "loginWin.php";
      }
    }

  ?>
</div>