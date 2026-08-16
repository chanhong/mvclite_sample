@using System.Collections.Specialized;
@using Co;
@{
  Page.Title = "Mailto";
  string tsk = "jvtpl";
  string mepath = string.Format("/{0}/_view/", tsk);  // c use as sub-action such as clone, add, etc

  string iPath = CUtils.imgPath();
  List<Dictionary<string, object>> rows = new List<Dictionary<string, object>>();
  string[] ka = null;
  string stitle = "", salign = "", slen = "", ssize = "";

  string tblcls = "jvtable";
  string linecls = "";

  NameValueCollection fName = new NameValueCollection {
              // fldname, fldhdr, fldformat
                  { "full_email","Full Email *,left,35,28"},
                  { "person","Dept/Person *,left,30,18"},
                  { "box_num","Mailstop *,,6,6"},
                  { "copies","Copy,,,"},
                  { "attach","Docs?,,,"},
              };
  int cnt = 0;
  NameValueCollection _qsa = CCore.qs2nvWithDefaultValue();
  //  CMsg._pdmsg(_qsa, "mailto");

  string orderby;
  string where;
  string strQry;
  string jvid = _qsa["p1"];
  string action = _qsa["a"];

  orderby = " order by sub_id asc";
  where = String.Format(" where jvid= '{0}'", jvid);
  strQry = "select distinct * from mailto " + where + " " + orderby;
  rows = CDbOle.oleGetRows(strQry, CJv.DbEnv());
}
<div>
  @{
    //      cnt = 0;
    foreach (Dictionary<string, object> r in rows)
    {
      //        cnt++;
      //        CMsg._pdmsg(r, "r");

      <script type="text/JavaScript">
          $(function () {
            @Html.Raw(CJv.JsAuto4Email("email", "/udata/_ejvauto", r["sub_id"].ToString())) // require auth
            @Html.Raw(CJv.JsAuto4Name("name", "/odata/_ldapuw", r["sub_id"].ToString())) // not require auth
          });
      </script>
    }
    string addMailtoUrl = CUtils.tap(mepath + jvid, "addmailto");
  }
  <table class="jvtable" id="jvMailto">
    <tbody>
      <tr class="jvtable">
        @foreach (string s in fName.AllKeys)
        {
          ka = CUtils.Str2a(',', fName[s]); // get value of fName[s]
          stitle = (ka[0].Length > 0) ? ka[0] : s;
          <th class="@tblcls">@Html.Raw(stitle)</th>
        }
      </tr>
      @{
        cnt = 0;
        foreach (Dictionary<string, object> r in rows)
        {
          NameValueCollection rNv = CUtils.dict2nv(r); // convert Nv to get field name
                                                       //          string sid = rNv["sub_id"];
          string sid = r["sub_id"].ToString();
          cnt++;
          linecls = "screen" + CUtils.evenOrOdd(cnt);
          string delmailto = "delmailto" + sid;
          <tr class='@linecls'>
            @foreach (string s in fName) {
              //            ka = CUtils.Str2a(',', fName[s]); // get value of fName[s]
              ka = fName[s].Split(','); // split into array
              salign = (ka.Count() > 1 && ka[1].Length > 0) ? ka[1] : "center";
              slen = (ka.Count() > 2 && ka[2].Length > 0) ? ka[2] : "3";
              ssize = (ka.Count() > 3 && ka[3].Length > 0) ? ka[3] : "3";
              string fldsid = s + sid;
              string flagFmt = "";
              string cWidth = "";
                if (s == "full_email")
              {
                //                cWidth = " width=\"20px\"";
                flagFmt = CJvTpl.FlagRed(rNv[s], s, "email");
              }
              else if (s == "person")
              {
                flagFmt = CJvTpl.FlagRed(rNv[s], s, "person");
              }
              else if (s == "box_num")
              {
                flagFmt = CJvTpl.FlagRed(rNv[s], s, "box_num");
              }
              <td class="jvtable" align="@salign" @Html.Raw(flagFmt) @Html.Raw(cWidth)>
                @rNv[s]
              </td>
            }
          </tr>
        }
      }
    </tbody>
  </table>
</div>