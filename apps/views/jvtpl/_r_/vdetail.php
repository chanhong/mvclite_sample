<?php
use MvcLite\CCore;
  $this->title = "Detail";
  $tsk = "jvtpl";
  $mepath = sprintf("/%s/_view/", $tsk);  // c use as sub-action such as clone, add, etc

  $iPath = CUtil::imgPath();
  $rows = array();
  $ka = null;
  $stitle = ""; $salign = ""; $slen = ""; $ssize = "";
  $tblcls = "jvtable";
  $linecls = "";

  $fName = array (
              // fldname, fldhdr, fldformat, maxlength, size
                  "descript" => "Description *,left,30,30",
                  "budget" => "Budget *,,7,9",
                  "acctcode" => "AcctCode *,,8,10",
                  "task" => "Task,,3,3",
                  "optn" => "Option,,3,3",
                  "proj" => "Project,,6,6",
                  "debit" => "Debit *,right,13,13",
                  "credit" => "Credit *,right,13,13",
              );
  $cnt = 0;
  $_qsa = CCore::qs2nvWithDefaultValue();
  // [detail]:(t=[jvtpl],a=[_edit],p1=[3110],p2=[TEST CWH_112113_001_Testing TE])
//  CMsg::_pdmsg($_qsa, "detail");

  $orderby;
  $where;
  $strQry;
  $jvid = $_qsa["p1"];
  $action = $_qsa["a"];

  $orderby = " order by ordering,sub_id asc";
  $where = sprintf(" where jvid= '%s'", $jvid);
  $strQry = "select distinct * from jvdetail" . $where . " " . $orderby;
  $rows = CDbPdo::oleGetRows($strQry, CJv::DbEnv());

  $colspan; // colspan for the total line
                  //  CCore::$_eflag = new NameValueCollection();
?>
@{
  //  cnt = 0;
  foreach ($rows as $r)
  {
    // $cnt++;
    <script type="text/JavaScript">
$(function () {
    <?php echo CJv::Js4AutoComplete("budget", "/udata/_ejvauto", $r["sub_id"], "4"); ?> // require auth
    <?php echo CJv::Js4AutoComplete("acctcode", "/udata/_ejvauto", $r["sub_id"], "3"); ?> // require auth
});
    </script>
  }
  $addDetUrl = CUtil::tap($mepath . $jvid, "adddetail");
}
<table class="jvtable" id="jvDetail">
  <tbody>
    <tr class="jvtable">
      <?php foreach (array_keys($fName) as $s): ?>
      {
        $ka = CUtil::Str2a(',', $fName[$s]); // get value of fName[s]
        $stitle = (strlen($ka[0]) > 0) ? $ka[0] : $s;
        <th class="<?php echo $tblcls; ?>">
          <?php echo $stitle; ?>
        </th>
      <?php endforeach; ?>
    </tr>
    @{
      $cnt = 0;
      $debitsum = 0;
      $creditsum = 0;
      $flagsumamt = "";
      $flagdbcr = "";

      foreach ($rows as $r)
      {
        $rNv = CUtil::dict2nv($r); // convert Nv to get field name
        $cnt++;
        $linecls = "screen" . CUtil::evenOrOdd($cnt);
        $sid = $rNv["sub_id"];
        $deldet_sid = "deldet" . $sid;
        $debitsum += (float)$rNv["debit"];
        $creditsum += (float)$rNv["credit"];
        $flagdbcr = CJvTpl::FlagDebitCredit($rNv["debit"], $rNv["credit"]);
        <tr class='jvtable'>
          <?php foreach ($fName as $s): ?>
          {
            //            $ka = CUtil::Str2a(',', $fName[$s]); // get value of $fName[$s]
            $ka = explode(',', $fName[$s]); // split into array
            $salign = (count($ka) > 1 && strlen($ka[1]) > 0) ? $ka[1] : "center";
            $slen = (count($ka) > 2 && strlen($ka[2]) > 0) ? $ka[2] : "3";
            $ssize = (count($ka) > 3 && strlen($ka[3]) > 0) ? $ka[3] : "3";
            $fldsid = $s . $sid;
            $flagFmt = "";
            $cWidth = "";
             if ($s == "descript")
            {
              $flagFmt = CJvTpl::FlagRed($rNv[$s], $s, "desc");
            }
            else if ($s == "budget")
            {
              $flagFmt = CJvTpl::FlagRed($rNv[$s], $s, "budget");
            }
            else if ($s == "acctcode")
            {
              $flagFmt = CJvTpl::FlagRed($rNv[$s], $s, "acctcode");
            }
            else if ($s == "debit")
            {
              $flagFmt = $flagdbcr;
            }
            else if ($s == "credit")
            {
              $flagFmt = $flagdbcr;
            }
            <td class="jvtable" align="<?php echo $salign; ?>" <?php echo $flagFmt; ?> <?php echo $cWidth; ?>>
              <?php echo $rNv[$s]; ?>
            </td>
          <?php endforeach; ?>
        </tr>
      }
      $debitsum = round($debitsum, 2);
      $creditsum = round($creditsum, 2);
      if (count($rows) < 1)
      {
        $colspan = (string)(count($fName) - 2); // colspan for the no detail line
        <tr class="jvtable" <?php echo CJvTpl::FlagRed("nodetail", "nodetail"); ?>>
          <td class="jvtable" width="20px">&nbsp;</td>
          <td class="jvtable" width="40px">&nbsp;</td>
          <td class="jvtable" colspan="<?php echo $colspan; ?>" align="center">&nbsp;</td>
        </tr>
      }
      $flagsumamt = CJvTpl::FlagSumAmt($debitsum, $creditsum);
      $colspan = (string)(count($fName) - 3); // colspan for the total line
    }
    <tr class="jvtable" <?php echo $flagsumamt; ?>>
      <td class="jvtable" colspan="<?php echo $colspan; ?>" align="right">
        <i>Note: Please use paper JV if each amount exceed [$9,999,999.99]</i>
      </td>
      <td class="jvtable" align="right"><b>Totals:</b></td>
      <td class="jvtable" align="right"><b><?php echo $debitsum; ?></b></td>
      <td class="jvtable" align="right"><b><?php echo $creditsum; ?></b></td>
      <input type="hidden" id="detailrows" name="detailrows" value="">
    </tr>
  </tbody>
</table>