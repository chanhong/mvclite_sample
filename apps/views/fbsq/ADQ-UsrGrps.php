@using System.Collections.Specialized;
@using System.Data.OleDb;
@using Co;
@{
  string seljvt="";
  string filterN = "";
  string hdrMsg = "";
  List<Dictionary<string, object>> rows = new List<Dictionary<string, object>>();

  Layout = CUtils.GetLayout("_bootstrap_top");
  PageData["Title"] = "ADQuery User's Groups List";
  string dbenv = CCore._DbEnv("dbadq");
  string meqs = CUtils.tap("/fbsq/ADQ-UsrGrps");

  string tblcls = "jvtable";
  NameValueCollection clsName;
  NameValueCollection fName;
  clsName = new NameValueCollection
  {
    { "tcls", tblcls },
    { "rcls", "screen" },
  };
  fName = new NameValueCollection {
  // fldname, fldhdr, fldformat
  { "cn",",left"},
  { "description",",left"},
  };

  if (IsPost)
  {
    filterN = CCore.getSafeVar(Request.Form, "user", "raw");
    //    CMsg._pdmsg(filterN,"users");
    hdrMsg = string.Format("<H2>List of {0}'s groups</H2>", filterN);
    rows = CFbsQ.getADQUsersRows(filterN, dbenv);
  };
  seljvt = CHtml.dropDnList("user", CFbsQ.getADQUsersList(dbenv), filterN);
}
<div>
  <div>
    @Html.Raw(hdrMsg)
  </div>
  <div align=center>
    @Html.Raw(CHtml.FrmBeg(meqs))
    Filter by:&nbsp;&nbsp; @Html.Raw(seljvt)
    <input type="submit" name="submit" value="Go">
    @Html.Raw(CHtml.FrmEnd(meqs))
    @if (IsPost)
    {
      <table>
        <tbody>
          @Html.Raw(CHtml.OutTblRows(fName, rows, clsName))
        </tbody>
      </table>
    }
  </div>
</div>