@using System.Collections.Specialized;
@using Co;
@{
  Page.Title = "Maker";
  string dbenv = CJv.DbEnv();
  NameValueCollection onejv = PageData["onejv"];
  NameValueCollection jvInfo = CJv.GetJVnumInfo(onejv["jvid"], onejv["title"], onejv["logid"]);
  string acctmo = CJv.GetAcctMo(dbenv);
  string flag = CJvTpl.FlagRed(acctmo, "acctmo");
  CCore._uprf = CUtils.getSessNv("uinfo");

  /*
  CMsg._pdmsg(onejv, "onejv");
  CMsg._pdmsg(jvInfo, "jvInfo");
  */
}
<table class="jvtable">
  <tbody>
    <tr class="jvcolhdr">
      <td class="jvtable" colspan="2"><b>JV NUMBER:</b></td>
      <td class="jvtable">@jvInfo["jvnum"]</td>
    </tr>
    <tr class="jvcolhdr">
      <td class="jvtable" colspan="2"><b>JV DATE:</b></td>
      <td class="jvtable">@jvInfo["jvdate"]</td>
    </tr>
    <tr class="jvtable">
      <td class="jvtable" align="right">Department:</td>
      <td class="jvtable">@CCore._uprf["apventity"]</td>
      <td class="jvtable" @Html.Raw(flag)>
        Biennium Month: &nbsp;&nbsp;@acctmo
      </td>
    </tr>
    <tr class="jvtable">
      <td class="jvtable" align="right">Preparer:<br>Phone:</td>
      <td class="jvtable">
        @onejv["maker"]
        <br>@onejv["phone"]
      </td>
      <td class="jvtable" colspan="1">Transaction Code <font size="+3">35</font></td>
    </tr>
    <tr class="jvtable">
      <td class="jvtable" align="right">Authorized By:</td>
      <td class="jvtable" align="left" colspan="2">@jvInfo["super"]</td>
    </tr>
  </tbody>
</table>