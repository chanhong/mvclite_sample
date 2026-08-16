@using System.Collections.Specialized;
@using Co;
@{
  //  Layout is already in index
  PageData["Title"] = "JV Approve";
  string msg;
  string meqs = PageData["meqs"];
  msg = "Email the accountant before approving this!";
  NameValueCollection qsa = CUtils.qs2nv(meqs);
  string apvbutton = CJvApv.ShowApprovalButton(qsa);
  //  CMsg._pdmsg(PageData["meqs"], "meqs");
}
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