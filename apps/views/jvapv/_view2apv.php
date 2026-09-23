<?php
use MvcLite\CCore;
  //Layout = CUtil::GetLayout("_ejv");
  //  Dictionary<string, object> row;
  $one = [];
  $dbenv = CJv::DbEnv();
  $PageData["Title"] = "View JV to Approve";
  $iPath = CUtil::imgPath();
  $_qsa = CUtil::qs2nv();
  //  CMsg::_pdmsg(_qsa, "v2p");
  $msg;
  $jvid = $_qsa["p1"];
  $logid = $_qsa["p2"];
  $tsk = "/jvapv";
  $mepath = $tsk . "/_createpdf/";
  $meqs = CUtil::tap($mepath . $jvid . "/" . $logid);
  $PageData["onejv"] = CJvTpl::GetOneJvInfo($jvid, $dbenv);
  $PageData["onejv"]["logid"] = $logid; // use in __maker
//  PageData["onejv"]["uploadedfiles"] = "<b>Uploaded Supporting Document(s):</b><br />" + CJvTpl::GetUploadedFiles(meqs, dbenv); // use in vexplian
  $PageData["onejv"]["uploadedfiles"] = CJvTpl::UpldFilesInfo($meqs, $dbenv); // use in vexplian
  $msg = "Email the accountant before approving this!";
?>
<div>
  <center>
    <?php if (is_file(__DIR__ . "/_r_/viewjv.php")) include(__DIR__ . "/_r_/viewjv.php"); ?>
    <div>
      <table border=0 width=100% align="center">
        <tr align="center">
          <td colspan=8>
            <?php $apvbutton = CJvApv::ShowApprovalButton($_qsa); ?>
            <input type="button" value="<?= htmlspecialchars($msg) ?>" onclick="window.open('mailto:')"><?= $apvbutton ?>
          </td>
        </tr>
      </table>
    </div>
  </center>
</div>