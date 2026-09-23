<?php
use MvcLite\CCore;
  $PageData["Title"] = "Filter By";
  $meqs = CUtil::tap("/jvadm/_search");

  $sel = "";
  $filterMaker = "";

  $aiList = MJvAdm::GetAIList(CJv::DbEnv());

  if ($_SERVER["REQUEST_METHOD"] === "POST")
  {
    $filterMaker = CUtil::getSafeVar($_POST, "isconfirmed", "raw");
    //    CMsg::_pdmsg(filterMaker, "jvadm");
  };
  if ($filterMaker == "")
  {
    $filterMaker = "Active";
  }
  $sel = CHtml::dropDnList("isconfirmed", $aiList, $filterMaker);
?>
<div>
  <?= CHtml::FrmBeg($meqs) ?>
  Filter by:&nbsp;&nbsp; <?= $sel ?>
  <input type="text"
         name="q"
         title="Search Users (By Username or Email)"
         value="" id="q">&nbsp;
  <input type="submit" name="submit" value="Go">
  <?= CHtml::FrmEnd($meqs) ?>
</div>