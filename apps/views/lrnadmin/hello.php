<?php
use MvcLite\CCore;

  //Layout = CUtil::GetLayout("_bootstrap");
  if ($PageData["Title"] == CSetting::get("Name"))
  {
    $PageData["Title"] = "Hello";
  }
?>
@ServerInfo.GetHtml()