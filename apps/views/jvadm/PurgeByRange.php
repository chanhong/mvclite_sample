@using System.Collections.Specialized;
@using Co;
@{
  Layout = CUtils.GetLayout("_ejv");
  string dbinfo = CJv.DbEnv();
  PageData["Title"] = "JV Log Purge by Range";
  PageData["meqs"] = CUtils.tap("/jvadm/PurgeByRange");
  string myUrl = CUtils.MyUrl();
  CJvAdm.PbOrRr(myUrl, CJv.DbEnv()); // process Post/Get Request
  NameValueCollection purgeDays;
  PageData["retentionyrs"] = CSetting::get(("retentionyrs");

// override the default dates from list submit
  if (CCore._Nv != null && CCore._Nv.Count > 0) {
    purgeDays = CCore._Nv;
  } else {
// get the default dates
    int retentionYears = Int32.Parse(PageData["retentionyrs"]);
    purgeDays = CJvAdm.OldestMonthFromLog(retentionYears, dbinfo);
  }

  PageData["datebeg"] = purgeDays["datebeg"]; // use by _jvlogbyrange
  PageData["dateend"] = purgeDays["dateend"];
  CCore._rows = CJvAdm.jvLogByRange(purgeDays, dbinfo);
 }
  <div class="jvbody">
    <div class="jvContent">
      <table class="jvtable" border="0">
        <tbody>
          <tr class="jvtable">
            <td class="jvtable" align="right">
              @RenderPage("_r_/jvlogform2list.cshtml")
            </td>
            <td align="left" valign="middle" width="30%">
              @RenderPage("_r_/jvlogform2purge.cshtml")
            </td>
          </tr>
        </tbody>
      </table>
      @if (CCore._rows != null && CCore._rows.Count > 0) {
        @RenderPage("_r_/jvlogbyrange.cshtml")
        CCore._Nv = null; // reset temp _Nv 
      }
      else
      {
        CUtils.Add2SessVar("feedback", "<p />No JV logs past retention periods are found!");
      }
    </div>
  </div>