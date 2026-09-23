
<?php
use MvcLite\CCore;

  //Layout = CUtil::GetLayout("_4pdf"); // create pdf file
  $dbenv = CJv::DbEnv();
  $_qsa = CUtil::qs2nv();
  //  CMsg::_pdmsg(_qsa, "createpdf");
  $jvid = $_qsa["p1"];
  $logid = $_qsa["p2"];
  $PageData["onejv"] = CJvTpl::GetOneJvInfo($jvid, $dbenv);
  $PageData["onejv"]["logid"] = $logid; // use in __viewjv
  $tsk = "/jvapv";
  $mepath = $tsk . "/index/";
  $meqs = CUtil::tap($mepath . $jvid . "/" . $logid);
  $PageData["onejv"]["uploadedfiles"] = CJvTpl::UpldFilesInfo($meqs, $dbenv); // use in vexplian
  $_qsa["jvhtml"] = "";
  MJvApv::JvExport($_qsa, $dbenv);
  CUtil::Redirect(CJv::Url("jvapv"));
?>