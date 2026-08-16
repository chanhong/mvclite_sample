@using System.Collections.Specialized;
@using Co;

@{
  List<Dictionary<string, object>> rows = new List<Dictionary<string, object>>();
  string aUrl = "";
  string[] ka = null;
  string stitle = "", salign = "";
  string tblcls = "jvtable";

  NameValueCollection fName = new NameValueCollection {
              // fldname, fldhdr, fldformat
    { "log_id","ID,"},
    { "jvnum","JVNUM,"},
    { "title","JV Title,left"},
    { "maker","Prepared by,"},
    { "jvdate","JV Date,"},
    { "acctmo","Biennium<br />Month,"},
    { "ready4mailout","Mailout,"},
    { "voided","Voided,"},
    { "htmlfile","JV File,"},
};
  rows = CCore._rows; // from jv_search or jv_archive
  int cnt = 0;

<tr class="@tblcls">
  @foreach (string s in fName.AllKeys)
  {
    ka = CUtils.Str2a(',', fName[s]); // get value of fName[s]
    stitle = (ka[0].Length > 0) ? ka[0] : s;
    <th class="@tblcls">@Html.Raw(stitle)</th>
  }
</tr>
  foreach (Dictionary<string, object> r in rows)
  {
  aUrl = CJv.Row2ArchiveHref(r,"htmlfile");
  cnt++;
  string linecls = "screen" + CUtils.evenOrOdd(cnt);
  <tr class='@linecls'>
    @{
      NameValueCollection rNv = CUtils.dict2nv(r); // convert Nv to get field name
      foreach (string s in fName)
      {
        ka = CUtils.Str2a(',', fName[s]); // get value of fName[s]
        salign = (ka[1].Length > 0) ? ka[1] : "center";
        if (s == "htmlfile")
        {
          <td align="@salign">@Html.Raw(aUrl)</td>
        }
        else
        {
          <td align="@salign">@rNv[s]</td>
        }
      }
    }
  </tr>
  }
}