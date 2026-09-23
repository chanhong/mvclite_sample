<?php
use MvcLite\CCore;
  $pageTitle = "Filter By";
  $meqs = CUtil::tap("/jvtpl/_jvlist");
  $sel = "";
  $filterMaker = "";
  $dbenv = CJv::DbEnv();
  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $filterMaker = CUtil::getSafeVar($_POST, "maker", "raw");
  }
  else
  {
    $filterMaker = CUtil::getSessTxt("name"); // session name setUserProfile
  }
  //  CMsg::_pdmsg(filterMaker, "filtermaker");
  $makers = array();
  $makers = CJv::getJVListMakers($dbenv);
  $sel = CHtml::dropDnList("maker", $makers, $filterMaker);
?>
<div>
  @Html.Raw(CHtml.FrmBeg(meqs))
  Filter by:&nbsp;&nbsp; @Html.Raw(sel)
  <input type="submit" name="submit" value="Go">
  @Html.Raw(CHtml.FrmEnd(meqs))
</div>
