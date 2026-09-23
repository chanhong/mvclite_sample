<?php
use MvcLite\CCore;
  //Layout = CUtil::GetLayout("_ejv");
  //  Dictionary<string, object> row;
  $one = new NameValueCollection();
  $dbenv = CJv::DbEnv();
  $PageData["Title"] = "View JV Info";
  $iPath = CUtil::imgPath();
  //  NameValueCollection _qsa = CCore::qs2nvWithDefaultValue();
  $_qsa = CUtil::qs2nv();
  //  CMsg::_pdmsg(CUtil::MyUrl(), "myurl");
//  CMsg::_pdmsg(_qsa, "_view");
  $jvid = $_qsa["p1"];
  $logid = $_qsa["p2"];
  $approved = $_qsa["p4"];
  $tsk = "/jvtpl";
  $mepath = $tsk . "/_view/";
  $meqs = CUtil::tap($mepath . $jvid . "/" . $logid);
  $PageData["onejv"] = CJvTpl::GetOneJvInfo($jvid, $dbenv);
  $PageData["onejv"]["logid"] = $logid; // use in __maker
  $PageData["onejv"]["uploadedfiles"] = CJvTpl::UpldFilesInfo($meqs, $dbenv); // use in vexplian
  $PageData["onejv"]["v2p"] = "window.open('" . CUtil::Tap2Qs($tsk . "/_view2print/" . $jvid . "/" . $logid . "/" . $approved) . "')";
  $PageData["meqs"] = CUtil::MyUrl();
  // start a clean flag per jv
  CCore::$_eflag = array(
        "dbcr" => "",
        "sumamt" => "",
  );

//  CMsg::_pdmsg(meqs, "meqs");
  CJvTpl::PbOrRr(CUtil::MyUrl(), $dbenv); // process Post/Get Request, use index instead of _pb to simplify logic
?>
<div>
  <center>
    include("_r_/jvview.cshtml")
    include("_r_/jvview2upload.cshtml")
  </center>
</div>