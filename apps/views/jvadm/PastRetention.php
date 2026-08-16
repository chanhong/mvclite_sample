@using System.Collections.Specialized;
@using Co;

@{
  Layout = CUtils.GetLayout("_ejv");
  string dbinfo = CJv.DbEnv();
  int retentionYears = Int32.Parse(CSetting::get(("retentionyrs"));
  /*
    string dateBeg = CJvAdm.OldestJvfromLog(retentionYears, dbinfo);
    string dateEnd = CDate.DateAfterRetention(retentionYears).ToShortDateString();
  */
  NameValueCollection purgeDays = CJvAdm.PastRetention(retentionYears, dbinfo);
  string dateBeg = purgeDays["datebeg"]; 
  string dateEnd = purgeDays["dateend"];

  List<Dictionary<string, object>> rows = new List<Dictionary<string, object>>();
  string meqs = CUtils.tap("/jvadm/PastRetention");
}
<table class="jvtable">
  <tbody>
    <tr class="jvtable">
      <td class="jvtable" COLSPAN="11" align="center">
        <table>
          <tr>
            <td class="jvtable" align="center">
              <form method="post" action="@meqs" )">
                Retention Years:
                <input class="txtReadOnly" type="text" size=3 name="retention" value="@retentionYears" READONLY />
                <input type="hidden" size=3 name="datebeg" value="@dateBeg" />
                <input type="hidden" size=3 name="dateend" value="@dateEnd" />
                <input type="submit" name="submit" value="Purge All Listed Below!">
              </form>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    @if (IsPost)
    {
      <p>
        Purging Journal Vouchers Log between @dateBeg and @dateEnd
      </p>
      CJvAdm.PurgeJVLogInDateRange(Request.Form, dbinfo);
      CUtils.Redirect(meqs);
    }
    else
    {
      CCore._rows = CJvAdm.jvLogPastRetention(dateBeg, dateEnd, dbinfo);
      if (CCore._rows.Count > 0)
      {
        <p>
          Purge Journal Vouchers Log between @dateBeg and @dateEnd
        </p>
        <tr class="jvtable">
          <th class="jvtable">JV Year</th>
          <th class="jvtable">JV Month</th>
          <th class="jvtable">Total JV</th>
        </tr>
        rows = CCore._rows; // from jv_search or jv_archive
        int cnt = 0;
        foreach (Dictionary<string, object> r in rows)
        {
          cnt++;
          NameValueCollection rNv = CUtils.dict2nv(r); // convert Nv to get field name
        string linecls = "screen" + CUtils.evenOrOdd(cnt);
          <tr class='@linecls'>
            <td class="jvtable" align="center">@rNv["jvyear"]</td>
            <td class="jvtable" align="center">@rNv["jvmonth"]</td>
            <td class="jvtable" align="center">@rNv["jvcnt"]</td>
          </tr>
        }
      }
      else
      {
        CUtils.Add2SessVar("feedback", "<p />No JV logs past retention periods are found!");
      }
    }
  </tbody>
</table>