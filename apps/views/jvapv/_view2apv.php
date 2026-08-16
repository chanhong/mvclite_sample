@using System.Collections.Specialized;
@using Co;
@{
  Layout = CUtils.GetLayout("_ejv");
  //  Dictionary<string, object> row;
  NameValueCollection one = new NameValueCollection();
  string dbenv = CJv.DbEnv();
  PageData["Title"] = "View JV to Approve";
  string iPath = CUtils.imgPath();
  NameValueCollection _qsa = CUtils.qs2nv();
  //  CMsg._pdmsg(_qsa, "v2p");
  string msg;
  string jvid = _qsa["p1"];
  string logid = _qsa["p2"];
  string tsk = "/jvapv";
  string mepath = tsk + "/_createpdf/";
  string meqs = CUtils.tap(mepath + jvid + "/" + logid);
  PageData["onejv"] = CJvTpl.GetOneJvInfo(jvid, dbenv);
  PageData["onejv"]["logid"] = logid; // use in __maker
//  PageData["onejv"]["uploadedfiles"] = "<b>Uploaded Supporting Document(s):</b><br />" + CJvTpl.GetUploadedFiles(meqs, dbenv); // use in vexplian
  PageData["onejv"]["uploadedfiles"] = CJvTpl.UpldFilesInfo(meqs, dbenv); // use in vexplian
  msg = "Email the accountant before approving this!";
}
<div>
  <center>
    @RenderPage("_r_/viewjv.cshtml")
    <div>
      <table border=0 width=100% align="center">
        <tr align="center">
          <td colspan=8>
            @{ // must be here to get the correct value
              string apvbutton = CJvApv.ShowApprovalButton(_qsa);
                    CMsg._pdmsg(CCore._eflag, "eflag");
            }
            <input type="button" value="@msg" onclick="window.open('mailto:')">@Html.Raw(apvbutton)
          </td>
        </tr>
      </table>
    </div>
  </center>
</div>