<?php
use MvcLite\CCore;
  $rows = CCore::$_rows ?? [];
  $aUrl = "";
  $ka = [];
  $stitle = ""; $salign = "";
  $tblcls = "jvtable";

  $fName = [
              // fldname, fldhdr, fldformat
    "log_id" => "ID,", "jvnum" => "JVNUM,", "title" => "JV Title,left",
    "maker" => "Prepared by,", "jvdate" => "JV Date,", "acctmo" => "Biennium<br />Month,",
    "ready4mailout" => "Mailout,", "voided" => "Voided,", "htmlfile" => "JV File,",
    "jvfolder" => "JV Folder,", "upldfile" => "Upload File,"
  ];
  $cnt = 0;
?>
  <table class="jvtable" border="0">
    <tbody>
      <tr class="jvheader">
        <th class="jvtable" colspan="11" align="center">
            Journal Vouchers Log between <?= htmlspecialchars($PageData["datebeg"] ?? "") ?> and <?= htmlspecialchars($PageData["dateend"] ?? "") ?>
        </th>
      </tr>
      <tr class="@tblcls">
        <?php foreach ($fName as $s => $format): $ka = CUtil::Str2a(',', $format); $stitle = !empty($ka[0]) ? $ka[0] : $s; ?>
          <th class="<?= htmlspecialchars($tblcls) ?>"><?= $stitle ?></th>
        <?php endforeach; ?>
      </tr>
      <?php foreach ($rows as $r):
//        CMsg::_pdmsg(r, "list-r");
        $aUrl = CJv::Row2ArchiveHref($r, "htmlfile");
        $cnt++;
        $linecls = "screen" . CUtil::evenOrOdd($cnt);
        ?>
        <tr class="<?= htmlspecialchars($linecls) ?>">
          <?php foreach ($fName as $s => $format): $ka = CUtil::Str2a(',', $format); $salign = !empty($ka[1]) ? $ka[1] : "center"; ?>
            <td align="<?= htmlspecialchars($salign) ?>"><?= $s === "htmlfile" ? $aUrl : htmlspecialchars((string)($r[$s] ?? "")) ?></td>
          <?php endforeach; ?>
        </tr>
      <?php endforeach; ?>
      </tbody>
</table>