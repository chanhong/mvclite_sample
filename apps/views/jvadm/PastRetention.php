<?php
use MvcLite\CCore;
  $dbinfo = CJv::DbEnv();
  $retentionYears = (int)CSetting::get("retentionyrs");
  /*
    string dateBeg = CJvAdm::OldestJvfromLog(retentionYears, dbinfo);
    string dateEnd = CDate.DateAfterRetention(retentionYears).ToShortDateString();
  */
  $purgeDays = CJvAdm::PastRetention($retentionYears, $dbinfo);
  $dateBeg = $purgeDays["datebeg"] ?? "";
  $dateEnd = $purgeDays["dateend"] ?? "";

  $rows = [];
  $meqs = CUtil::tap("/jvadm/PastRetention");
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    CJvAdm::PurgeJVLogInDateRange($_POST, $dbinfo);
    CUtil::Redirect($meqs);
  }
  $rows = CJvAdm::jvLogPastRetention($dateBeg, $dateEnd, $dbinfo);
?>
<table class="jvtable">
  <tbody>
    <tr class="jvtable">
      <td class="jvtable" COLSPAN="11" align="center">
        <table>
          <tr>
            <td class="jvtable" align="center">
              <form method="post" action="<?= htmlspecialchars($meqs) ?>">
                Retention Years:
                <input class="txtReadOnly" type="text" size=3 name="retention" value="<?= $retentionYears ?>" READONLY />
                <input type="hidden" size=3 name="datebeg" value="<?= htmlspecialchars($dateBeg) ?>" />
                <input type="hidden" size=3 name="dateend" value="<?= htmlspecialchars($dateEnd) ?>" />
                <input type="submit" name="submit" value="Purge All Listed Below!">
              </form>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <?php if (count($rows) > 0): ?>
        <tr>
          <td colspan="11" align="center">
            <p>Purge Journal Vouchers Log between <?= htmlspecialchars($dateBeg) ?> and <?= htmlspecialchars($dateEnd) ?></p>
          </td>
        </tr>
        <tr class="jvtable">
          <th class="jvtable">JV Year</th>
          <th class="jvtable">JV Month</th>
          <th class="jvtable">Total JV</th>
        </tr>
        <?php $cnt = 0; foreach ($rows as $r): $cnt++; $linecls = "screen" . CUtil::evenOrOdd($cnt); ?>
          <tr class="<?= htmlspecialchars($linecls) ?>">
            <td class="jvtable" align="center"><?= htmlspecialchars((string)($r["jvyear"] ?? "")) ?></td>
            <td class="jvtable" align="center"><?= htmlspecialchars((string)($r["jvmonth"] ?? "")) ?></td>
            <td class="jvtable" align="center"><?= htmlspecialchars((string)($r["jvcnt"] ?? "")) ?></td>
          </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
          <td colspan="11" align="center">
            No JV logs past the retention period were found.
          </td>
        </tr>
    <?php endif; ?>
  </tbody>
</table>