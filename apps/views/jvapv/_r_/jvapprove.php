<?php
use MvcLite\CCore;
  //  Layout is already in index
  $PageData["Title"] = "JV Approve";
  $msg;
  $meqs = $PageData["meqs"];
  $msg = "Email the accountant before approving this!";
  $qsa = CUtil::qs2nv($meqs);
  $apvbutton = CJvApv::ShowApprovalButton(qsa);
  //  CMsg::_pdmsg(PageData["meqs"], "meqs");
?>
<div>
  @Html.Raw(CHtml.FrmBeg(meqs))
    <table border=0 width=100% align="center">
      <tr align="center">
        <td colspan=8>
          <input type="button" value="@msg" onclick="window.open('mailto:')">@Html.Raw(apvbutton)
        </td>
      </tr>
    </table>
  @Html.Raw(CHtml.FrmEnd(meqs))
</div>