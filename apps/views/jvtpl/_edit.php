@using System.Collections.Specialized;
@using Co;
@{
  Layout = CUtils.GetLayout("_ejv");
  //  Dictionary<string, object> row;
  NameValueCollection one = new NameValueCollection();
  string dbenv = CJv.DbEnv();
  PageData["Title"] = "JV Edit";
  string iPath = CUtils.imgPath();
  NameValueCollection _qsa = CCore.qs2nvWithDefaultValue();
  //  CMsg._pdmsg(_qsa, "edit");
  string jvid = _qsa["p1"];
  //  string approved = _qsa["p3"];
  string tsk = "/jvtpl";
  string mepath = tsk + "/_edit/";
  string meqs = CUtils.tap(mepath + jvid);
  string pburl = CUtils.tap(tsk + "/index/" + jvid);
  CMsg._pdmsg(_qsa, "qs_pb");
  // start a clean flag per jv
  CCore._eflag = new NameValueCollection
  {
        { "dbcr", "" },
        { "sumamt",  ""},
  };
  string approvalButton = "";
  PageData["onejv"] = CJvTpl.GetOneJvInfo(jvid, dbenv);
  //  PageData["onejv"]["approved"] = approved; // use in __maker
  CJvTpl.PbOrRr(CUtils.MyUrl(), dbenv); // process Post/Get Request, use index instead of _pb to simplify logic
}
<div>
  <center>
    @Html.Raw(CHtml.FrmBeg(meqs))
    <table class="jvtable">
      <tbody>
        <tr class="jvtable">
          <td class="jvheader" colspan="2">
            <font size=+2>@CSetting::get(("uwjv")</font>
            <br><b>JV Title *:</b>&nbsp;&nbsp;
            <input type="text" name="title" size=35 value="@PageData["onejv"]["title"]">
          </td>
        </tr>
        <tr class="jvtable">
          <td class="jvtable" width="60%">
            @RenderPage("_r_/imailto.cshtml")
          </td>
          <td class="jvtable" width="40%">
            @RenderPage("_r_/imaker.cshtml")
          </td>
        </tr>
        <tr class="jvtable">
          <td class="jvtable" colspan="2">
            @RenderPage("_r_/idetail.cshtml")
          </td>
        </tr>
        <tr class="jvExplanation">
          <td class="jvExplanation" colspan="2">
            @RenderPage("_r_/iexplain.cshtml")
          </td>
        </tr>
      </tbody>
    </table>
    <input type="hidden" id="cmd" name="cmd" value="updjvt" />
    <input type="hidden" id="jvid" name="jvid" value="@jvid" />
    <input type="submit" name="submit" value="SAVE ALL CHANGES">
    @{ // must be here to get the correct value
      CMsg._pdmsg(PageData["onejv"], "onejv");
      //     <input type="submit" name="submit" value="SAVE ALL CHANGES">&nbsp;&nbsp;<INPUT TYPE="BUTTON" VALUE="Assign a JV Number then Send to JV approver" ONCLICK="window.location.href='?t=jvtpl&a=_edit&p1=3110&c=toapprover'">
      approvalButton = CJvTpl.Show2ApproverButton(PageData["onejv"]);  // pass entire jv record including jvid and prep_date
      CMsg._pdmsg(CCore._eflag, "eflag");
      //      CMsg._pdmsg(approvalButton, "approvalButton");
    }
    @Html.Raw(approvalButton)
    @Html.Raw(CHtml.FrmEnd(meqs))
  </center>
</div>