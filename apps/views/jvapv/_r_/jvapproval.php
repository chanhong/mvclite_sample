
<?php
use MvcLite\CCore;
  $rows = [];
  $tblcls = "jvtable";

  $fName = [
              // fldname, fldhdr, fldformat
    "log_id" => "ID,", "title" => "JV Title,left", "jvdate" => "JV Date,",
    "maker" => "Prepared by,", "jvnum" => "View to<br />Approve,", "approved" => "Approved?<br />*,",
    "ftpd" => "Ftp'd?<br />* *,",
//    { "ready4mailout",","},
//    { "mailed2depts","Mailout?<br />,"},
    "ready4mailout" => "Mailout?<br />,", "textfile" => "Text file<br />for Ftp,",
    "htmlfile" => "Archive file<br />for Mailing,", "voided" => "Void JV,"
  ];

  //  rows = CCore::_rows;
  $cnt = 0;
  $dbenv = CJv::DbEnv();
  $where = "( mailed2depts = 'N' and voided = 'N' )";
  $orderby = "order by jvnum asc";
  $sqlSel = sprintf("select * from %s where %s", CJv::myJvLog(), $where);
  $strQry = sprintf("%s %s", $sqlSel, $orderby);

  //  CMsg::_dmsg(CCore::$_uprf, "uprf");
  //  CMsg::_dmsg(CCore::_usr, "usr");

  //  CMsg::_dmsg((NameValueCollection)CCore::_cfg["uinfo"], "uinfo");
  //  CMsg::_pdmsg(strQry, "sql");
  $rows = CDbPdo::oleGetRows($strQry, $dbenv);
?>
<?php $cnt = 0; ?>
<?php /* The table helpers return already-rendered cells. */ ?>
<?php if (!empty($rows)): ?>
  <table class="jvtable">
    <tbody>
      <tr class="@tblcls">
        <?= CJvApv::JvWait4ApprvTitle($fName, $tblcls, $dbenv) ?>
      </tr>
      <?php foreach ($rows as $r): $cnt++; $linecls = "screen" . CUtil::evenOrOdd($cnt); ?>
        <tr class="<?= htmlspecialchars($linecls) ?>">
          <?= CJvApv::JvWait4ApprvDet($r, $fName, $dbenv) ?>
        </tr>
      <?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>