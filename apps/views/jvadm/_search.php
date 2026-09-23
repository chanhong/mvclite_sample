<?php
use MvcLite\CCore;
  $PageData["Title"] = "Search User";
  //Layout = CUtil::GetLayout("_ejv");

  $rows = [];
  $iPath = CUtil::imgPath();
  $tsk = "jvadm";
  $addusrqs = CUtil::tap(sprintf("/%s/_edituser", $tsk));
  $mepath = sprintf("/%s/index/", $tsk);  // c use as sub-action such as clone, add, etc

  $ka = null;
  $stitle = ""; $salign = "";
  $tblcls = "jvtable";
  $fName = [
              // fldname, fldhdr, fldformat
                    "user_id" => "UserID,", "name" => "Name,", "email" => "Email,left",
                    "is_confirmed" => "Confirmed,", "email_login" => "Email_Login,", "winuser" => "WinUser,",
                    "jvgroup" => "Group,", "jventity" => "Entity,", "jventities" => "Entities,",
                    "login_status" => "Login Status,", "remote_addr" => "User IP,", "timestamp" => "Timestamp,"
                  ];

  $_qisconfirmed = CUtil::getSafeVar($_POST, "isconfirmed", "raw");
  $_q = CUtil::getSafeVar($_POST, "q", "raw");
//  CMsg::_dmsg(_q, "_q");
  $rows = MJvAdm::UserSearch($_qisconfirmed, $_q, CJv::DbEnv());
  $cnt = 0;
?>
<div class="jvbody">
  <div class="jvContent">
    <table class="jvtable">
      <tbody>
        <tr class="jvtable">
          <td class="jvtable" COLSPAN="13" align="center">
            <?php include(__DIR__ . "/_r_/filterby.php"); ?>
          </td>
        </tr>
        <tr class="<?= htmlspecialchars($tblcls) ?>">
          <th class="<?= htmlspecialchars($tblcls) ?>" width="10%" align="center">
            Action&nbsp;&nbsp;&nbsp;<a href="<?= htmlspecialchars($addusrqs) ?>" title="Create"><img class="icon" src="<?= htmlspecialchars($iPath) ?>/add.png"></a>
          </th>
          <?php foreach ($fName as $s => $format): $ka = CUtil::Str2a(',', $format); $stitle = strlen($ka[0]) > 0 ? $ka[0] : $s; ?>
            <th class="<?= htmlspecialchars($tblcls) ?>"><?= $stitle ?></th>
          <?php endforeach; ?>
        </tr>
        <?php foreach ($rows as $r) {
//          CMsg::_pdmsg(r, "r");
          $cnt++;
          $linecls = "screen" . CUtil::evenOrOdd($cnt);
          $uid = (string)$r["user_id"];
          $delUrl = CUtil::tap($mepath . $uid, "delete");
          $clnUrl = CUtil::tap($mepath . $uid, "clone");
          $sndUrl = CUtil::tap($mepath . $uid, "sendconfirm");
          $edtUrl = CUtil::tap(sprintf("/%s/_edituser/%s", $tsk, $uid));

          ?>
          <tr class="<?= htmlspecialchars($linecls) ?>">
          <td align="center">
            <a href="<?= htmlspecialchars($delUrl) ?>" onclick="return confirm('Are you sure?');" title="Delete User"><img class="icon" src="<?= htmlspecialchars($iPath) ?>/remove.png"></a>
            &nbsp;&nbsp;
            <a href="<?= htmlspecialchars($clnUrl) ?>" title="Clone User"><img class="icon" src="<?= htmlspecialchars($iPath) ?>/smile.png"></a>
            &nbsp;&nbsp;
            <a href="<?= htmlspecialchars($edtUrl) ?>" title="Edit"><img class="icon" src="<?= htmlspecialchars($iPath) ?>/info.png"></a>
            &nbsp;&nbsp;
            <a href="<?= htmlspecialchars($sndUrl) ?>" title="Send confirmation email"><img class="icon" src="<?= htmlspecialchars($iPath) ?>/log.png"></a>
          </td>
          <?php foreach ($fName as $s => $format) { $ka = CUtil::Str2a(',', $format); $salign = !empty($ka[1]) ? $ka[1] : "center"; ?>
              <td align="<?= htmlspecialchars($salign) ?>"><?= htmlspecialchars((string)($r[$s] ?? "")) ?></td>
          <?php } ?>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>