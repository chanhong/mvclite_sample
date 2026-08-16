@using System.Text;
@using System.Collections.Specialized;
@using Co;

@{
  List<Dictionary<string, object>> rows = new List<Dictionary<string, object>>();
  string tblcls = "jvtable";

  NameValueCollection fName = new NameValueCollection {
              // fldname, fldhdr, fldformat
    { "log_id","ID,"},
    { "title","JV Title,left"},
    { "jvdate","JV Date,"},
    { "maker","Prepared by,"},
    { "jvnum","View to<br />Approve,"},
    { "approved","Approved?<br />*,"},
    { "ftpd","Ftp'd?<br />* *,"},
//    { "ready4mailout",","},
//    { "mailed2depts","Mailout?<br />,"},
    { "ready4mailout","Mailout?<br />,"},
    { "textfile","Text file<br />for Ftp,"},
    { "htmlfile","Archive file<br />for Mailing,"},
    { "voided","Void JV,"},
};

  //  rows = CCore._rows;
  int cnt = 0;
  string dbenv = CJv.DbEnv();
  string where = "( mailed2depts = 'N' and voided = 'N' )";
  string orderby = "order by jvnum asc";
  string sqlSel = string.Format("select * from {0} where {1}", CJv.myJvLog(), where);
  string strQry = string.Format("{0} {1}", sqlSel, orderby);

  //  CMsg._dmsg(CCore._uprf, "uprf");
  //  CMsg._dmsg(CCore._usr, "usr");

  //  CMsg._dmsg((NameValueCollection)CCore._cfg["uinfo"], "uinfo");
  //  CMsg._pdmsg(strQry, "sql");
  rows = CDbOle.oleGetRows(strQry, dbenv);
  <table class="jvtable">
    <tbody>
      <tr class="@tblcls">
        @Html.Raw(CJvApv.JvWait4ApprvTitle(fName, tblcls, dbenv))
      </tr>
      @foreach (Dictionary<string, object> r in rows)
      {
        cnt++;
        string linecls = "screen" + CUtils.evenOrOdd(cnt);
        <tr class="@linecls">
          @Html.Raw(CJvApv.JvWait4ApprvDet(r, fName, dbenv))
        </tr>
      }
  </tbody>
</table>
}