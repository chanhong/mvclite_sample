<?php
use MvcLite\CCore;
  //Layout = CUtil::GetLayout("_4pdf");
  //  Dictionary<string, object> row;
  $one = new NameValueCollection();
  $dbenv = CJv::DbEnv();
  $PageData["Title"] = "View JV to Print";
  $iPath = CUtil::imgPath();
  $_qsa = CUtil::qs2nv();
  $jvid = $_qsa["p1"];
  $logid = $_qsa["p2"];
  $tsk = "/jvtpl";
  $mepath = $tsk + "/_view2print/";
  $meqs = CUtil::tap($mepath + $jvid + "/" + $logid);

  $PageData["onejv"] = CJvTpl::GetOneJvInfo($jvid, $dbenv);
  $PageData["onejv"]["logid"] = $logid; // use in __maker
  /*
    CMsg::_pdmsg(PageData["onejv"], "onejv");
    CMsg::_dprt(PageData["onejv"]);
  */
  $PageData["onejv"]["uploadedfiles"] = CJvTpl::UpldFilesInfo($meqs, $dbenv); // use in vexplian
?>
<div>
  <center>
    <center><h5>Print best in landscape orientation</h5></center>
    <?php include("_r_/jvview.cshtml");?>
  </center>
</div>