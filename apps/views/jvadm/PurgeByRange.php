<?php
use MvcLite\CCore;
  //Layout = CUtil::GetLayout("_ejv");
  $dbinfo = CJv::DbEnv();
  $PageData["Title"] = "JV Log Purge by Range";
  $PageData["meqs"] = CUtil::tap("/jvadm/PurgeByRange");
  $myUrl = CUtil::MyUrl();
  CJvAdm::PbOrRr($myUrl, CJv::DbEnv()); // process Post/Get Request
  $purgeDays;
  $PageData["retentionyrs"] = CSetting::get("retentionyrs");

// override the default dates from list submit
  if (CCore::$_Nv != null && count(CCore::$_Nv) > 0) {
    $purgeDays = CCore::$_Nv;
  } else {
// get the default dates
    $retentionYears = (int)$PageData["retentionyrs"];
    $purgeDays = CJvAdm::OldestMonthFromLog($retentionYears, $dbinfo);
  }

  $PageData["datebeg"] = $purgeDays["datebeg"]; // use by _jvlogbyrange
  $PageData["dateend"] = $purgeDays["dateend"];
  CCore::$_rows = CJvAdm::jvLogByRange($purgeDays, $dbinfo);
 ?>
  <div class="jvbody">
    <div class="jvContent">
      <table class="jvtable" border="0">
        <tbody>
          <tr class="jvtable">
            <td class="jvtable" align="right">
              <?php include(__DIR__ . "/_r_/jvlogform2list.php"); ?>
            </td>
            <td align="left" valign="middle" width="30%">
              <?php include(__DIR__ . "/_r_/jvlogform2purge.php"); ?>
            </td>
          </tr>
        </tbody>
      </table>
      <?php if (!empty(CCore::$_rows)): include(__DIR__ . "/_r_/jvlogbyrange.php"); CCore::$_Nv = null; else: ?>
        CUtil::Add2SessVar("feedback", "<p />No JV logs past retention periods are found!");
      <?php endif; ?>
    </div>
  </div>