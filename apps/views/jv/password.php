<?php
use MvcLite\CCore;

  //Layout = CUtil::GetLayout("_ejv");
  $PageData["Title"] = "eJV System";
  if (CCore::GetUsrName() != "")
  {
    include(__DIR__ . "/_pwchg.php");
  }

  else
  {
    include(__DIR__ . "/_pwlost.php");
  }

?>