@using System.Collections.Specialized;
@using System.Data.OleDb;
@using Co;
@{
  Layout = CUtils.GetLayout("_ejv");
  PageData["Title"] = "JV Template";
  string dbenv = CJv.DbEnv();

  string tsk = "jvtpl";
  string mepath = string.Format("/{0}/index/", tsk);  // c use as sub-action such as clone, add, etc
  string meqs = CUtils.tap(mepath);
  string iPath = CUtils.imgPath();
  string makerName = CUtils.getSessTxt("name");
  //  CMsg._dmsg(makerName, "maker");
  string filterMaker = CCore.getSafeVar(Request.Form, "maker", "raw");
  if (filterMaker == "")
  {
    filterMaker = CUtils.getSessTxt("name");
  }
  List<Dictionary<string, object>> rows = new List<Dictionary<string, object>>();
  rows = CJvTpl.GetJVListOfMakerByNameWithStatus(filterMaker, dbenv);

  string[] ka = null;
  string stitle = "", salign = "";
  string tblcls = "jvtable";
  string linecls = "";

  NameValueCollection fName = new NameValueCollection {
              // fldname, fldhdr, fldformat
                  { "approved","Approved,"},
                  { "mailed2depts","Mailed,"},
                  { "jvid","JVID,"},
                  { "super","Approver,"},
                  { "title","JV Title,left"},
              };
  int cnt = 0;
  //  <a href="@CUtils.tap("/" + tsk + "/_edit")" title="Create"><img class="icon" src="@iPath/add.png"></a>
  string createlUrl = CUtils.tap("/" + tsk + "/_edit/", "createjv");
  string edtUrl;
  edtUrl = "";
  NameValueCollection parm = new NameValueCollection();
  /*
  <a href="@delUrl" title="@delTitle"><img class="icon" src="@iPath/remove.png"></a>
                  <a href="@edtUrl" title="@edtTitle"><img class="icon" src="@iPath/@edtimg"></a>
                  <a href="@delUrl" onclick="return confirm('Are you sure?');" title="@delTitle"><img class="icon" src="@iPath/remove.png"></a>
                  <a href="@edtUrl" title="@edtTitle"><img class="icon" src="@iPath/@edtimg"></a>
  // replace this with alink()
  */
  CCore._uprf = CUtils.getSessNv("uinfo");
}
<div>
  <div>
    List of JV templates
  </div>
  <div>
    <div align=center>
      Note: JV with approved = P can be viewed to upload supporting documents
      <p />
      @RenderPage("_r_/filterby.cshtml")
    <table class="jvList">
        <tr>
            <th class="@tblcls" width="10%" align="center">
                Action&nbsp;&nbsp;&nbsp;
                <a href="@createlUrl" title="Create"><img class="icon" src="@iPath/add.png"></a>
            </th>
            @foreach (string s in fName.AllKeys)
            {
                ka = CUtils.Str2a(',', fName[s]); // get value of fName[s]
                stitle = (ka[0].Length > 0) ? ka[0] : s;
                <th class="@tblcls">@Html.Raw(stitle)</th>
            }
        </tr>
        @foreach (Dictionary<string, object> r in rows)
        {
            r["title"] = CCore.cleanStr(r["title"].ToString(), "dec4vw");
            cnt++;
            CMsg._pdmsg(r, "onejv");
            linecls = "screen" + CUtils.evenOrOdd(cnt);
            string jvid = r["jvid"].ToString();
            string logid = r["log_id"].ToString();
            string approved = r["approved"].ToString();
            string mailed2depts = r["mailed2depts"].ToString();

            string delUrl = CUtils.tap(mepath + jvid, "delete");
            string clnUrl = CUtils.tap(mepath + jvid, "clone");
            string edtimg = "info.png";
            string delTitle = "Delete";
            string edtTitle = "Edit";

            // maker is not the same as the filter namer then disable edit and delete template
            if (filterMaker != makerName || CCore._uprf["jvgroup"] == "")
            {
                edtUrl = delUrl = "";
                delTitle = "Delete DISABLED";
                edtTitle = "Edit DISABLED";
            }
            //if (!CString.IsEmpty(logid) && approved == "P")
            //else
            //{

                <tr class='@linecls'>
                    <td align="center">
                        @if (!CString.IsEmpty(logid) && approved == "P" && mailed2depts == "N")
                        {
                            delUrl = "";    // disable delete when in P
                            delTitle = "Delete DISABLED";
                            edtTitle = "View";

                            edtUrl = CUtils.tap("/" + tsk + "/_view/" + jvid + "/" + logid + "/" + r["title"]);
                            edtimg = "lock.png";

                            parm = new NameValueCollection() { { "img", iPath + "/remove.png" }, { "title", delTitle }, { "href", delUrl }, };
                            @Html.Raw(CHtml.Alink(parm))
                            <span>&nbsp;&nbsp;</span>
                            <a href="@clnUrl" title="Clone"><img class="icon" src="@iPath/smile.png"></a>
                            <span>&nbsp;&nbsp;</span>
                            parm = new NameValueCollection() { { "img", iPath + "/" + edtimg }, { "title", edtTitle }, { "href", edtUrl }, };
                            @Html.Raw(CHtml.Alink(parm))
                        }
                        else if (!CString.IsEmpty(logid) && approved == "Y" && mailed2depts == "N")
                        {
                            edtUrl = delUrl = ""; // if approved but not mailed then disable del and edit
                            delTitle = "DISABLED-Pending mail-out";
                            edtTitle = "DISABLED-Pending mail-out";
                            parm = new NameValueCollection() { { "img", iPath + "/remove.png" }, { "title", delTitle }, { "href", delUrl }, };
                            @Html.Raw(CHtml.Alink(parm))
                            <span>&nbsp;&nbsp;</span>
                            <a href="@clnUrl" title="Clone"><img class="icon" src="@iPath/smile.png"></a>
                            <span>&nbsp;&nbsp;</span>
                            parm = new NameValueCollection() { { "img", iPath + "/" + edtimg }, { "title", edtTitle }, { "href", edtUrl }, };
                            @Html.Raw(CHtml.Alink(parm))
                        }
                        else
                        {
                            edtUrl = CUtils.tap("/" + tsk + "/_edit/" + jvid + "/" + logid + "/" + HttpUtility.UrlEncode(r["title"].ToString()));
                            parm = new NameValueCollection() { { "img", iPath + "/remove.png" }, { "title", delTitle }, { "href", delUrl }, { "confirm", "Y" }, };
                            @Html.Raw(CHtml.Alink(parm))
                            <span>&nbsp;&nbsp;</span>
                            <a href="@clnUrl" title="Clone"><img class="icon" src="@iPath/smile.png"></a>
                            <span>&nbsp;&nbsp;</span>
                            parm = new NameValueCollection() { { "img", iPath + "/" + edtimg }, { "title", edtTitle }, { "href", edtUrl }, };
                            @Html.Raw(CHtml.Alink(parm))
                        }
                    </td>
                    @{
                        NameValueCollection rNv = CUtils.dict2nv(r); // convert Nv to get field name
                        foreach (string s in fName)
                        {
                            ka = CUtils.Str2a(',', fName[s]); // get value of fName[s]
                            salign = (ka[1].Length > 0) ? ka[1] : "center";
                            <td align="@salign">@rNv[s]</td>
                        }
                    }
                </tr>
            }
        </table>
    </div>
  </div>
</div>