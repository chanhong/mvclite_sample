<?php

use MvcLite\CSetting;
  $_qsa = CCore::qs2nvWithDefaultValue();
  CUtil::setActiveCtrl($_qsa);
  $PageData["app"] = "front";
  CSecs::setUsersInfo(); // MUST set user info in case redirected
  $Layout = CUtil::GetLayout("_bootstrap");
    $PageData["header_title"] = "Login";
/*
  if ($PageData["header_title"] == CSetting::get("AppName"))
  {
    $PageData["header_title"] = "Login";
  }
    */
  //      CMsg::_pdmsg(CUtil::getSessTxt("retUrl"), "sessrurl");
  if ($_POST)
  {
    if (CCore::_Login($_POST) == true)
    {
      $rUrl = CUtil::getReturnUrl();
      //     CMsg::_dmsg(rUrl, "rUrl");
      CUtil::Redirect($rUrl); // must do it this way to have a chance to set profile before redirect
    }
    else
    {
      CCore::ClearUser();
    }
  }

        pln($PageData["app"],'app');

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
        include (CSetting::get("viewpath") . "/" . CSetting::get("_rp") . "/loginWeb.php");
      }
      if (CSecs::isIntrgUser() == true)
      {
        include (CSetting::get("viewpath") . "/" . CSetting::get("_rp") . "/loginWin.php");
      }
    }

  ?>
</div>