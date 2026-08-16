@using System.Collections.Specialized;
@using Co;
@{
  Page.Title = "Detail";
  string tsk = "jvtpl";
  string mepath = string.Format("/{0}/_view/", tsk);  // c use as sub-action such as clone, add, etc

  string iPath = CUtils.imgPath();
  List<Dictionary<string, object>> rows = new List<Dictionary<string, object>>();
  string[] ka = null;
  string stitle = "", salign = "", slen = "", ssize = "";
  string tblcls = "jvtable";
  string linecls = "";

  NameValueCollection fName = new NameValueCollection {
              // fldname, fldhdr, fldformat, maxlength, size
                  { "descript","Description *,left,30,30"},
                  { "budget","Budget *,,7,9"},
                  { "acctcode","AcctCode *,,8,10"},
                  { "task","Task,,3,3"},
                  { "optn","Option,,3,3"},
                  { "proj","Project,,6,6"},
                  { "debit","Debit *,right,13,13"},
                  { "credit","Credit *,right,13,13"},
              };
  int cnt = 0;
  NameValueCollection _qsa = CCore.qs2nvWithDefaultValue();
  // [detail]:(t=[jvtpl],a=[_edit],p1=[3110],p2=[TEST CWH_112113_001_Testing TE])
//  CMsg._pdmsg(_qsa, "detail");

  string orderby;
  string where;
  string strQry;
  string jvid = _qsa["p1"];
  string action = _qsa["a"];

  orderby = " order by ordering,sub_id asc";
  where = String.Format(" where jvid= '{0}'", jvid);
  strQry = "select distinct * from jvdetail" + where + " " + orderby;
  rows = CDbOle.oleGetRows(strQry, CJv.DbEnv());

  string colspan; // colspan for the total line
                  //  CCore._eflag = new NameValueCollection();
}
@{
  //  cnt = 0;
  foreach (Dictionary<string, object> r in rows)
  {
    //    cnt++;
    <script type="text/JavaScript">
$(function () {
    @Html.Raw(CJv.Js4AutoComplete("budget", "/udata/_ejvauto", r["sub_id"].ToString(), "4")) // require auth
    @Html.Raw(CJv.Js4AutoComplete("acctcode", "/udata/_ejvauto", r["sub_id"].ToString(), "3")) // require auth
});
    </script>
  }
  string addDetUrl = CUtils.tap(mepath + jvid, "adddetail");
}
<table class="jvtable" id="jvDetail">
  <tbody>
    <tr class="jvtable">
      @foreach (string s in fName.AllKeys)
      {
        ka = CUtils.Str2a(',', fName[s]); // get value of fName[s]
        stitle = (ka[0].Length > 0) ? ka[0] : s;
        <th class="@tblcls">
          @Html.Raw(stitle)
        </th>
      }
    </tr>
    @{
      cnt = 0;
      decimal debitsum = 0;
      decimal creditsum = 0;
      string flagsumamt = "";
      string flagdbcr = "";

      foreach (Dictionary<string, object> r in rows)
      {
        NameValueCollection rNv = CUtils.dict2nv(r); // convert Nv to get field name
        cnt++;
        linecls = "screen" + CUtils.evenOrOdd(cnt);
        string sid = rNv["sub_id"];
        string deldet_sid = "deldet" + sid;
        debitsum += Convert.ToDecimal(rNv["debit"]);
        creditsum += Convert.ToDecimal(rNv["credit"]);
        flagdbcr = CJvTpl.FlagDebitCredit(rNv["debit"], rNv["credit"]);
        <tr class='jvtable'>
          @foreach (string s in fName)
          {
            //            ka = CUtils.Str2a(',', fName[s]); // get value of fName[s]
            ka = fName[s].Split(','); // split into array
            salign = (ka.Count() > 1 && ka[1].Length > 0) ? ka[1] : "center";
            slen = (ka.Count() > 2 && ka[2].Length > 0) ? ka[2] : "3";
            ssize = (ka.Count() > 3 && ka[3].Length > 0) ? ka[3] : "3";
            string fldsid = s + sid;
            string flagFmt = "";
            string cWidth = "";
             if (s == "descript")
            {
              flagFmt = CJvTpl.FlagRed(rNv[s], s, "desc");
            }
            else if (s == "budget")
            {
              flagFmt = CJvTpl.FlagRed(rNv[s], s, "budget");
            }
            else if (s == "acctcode")
            {
              flagFmt = CJvTpl.FlagRed(rNv[s], s, "acctcode");
            }
            else if (s == "debit")
            {
              flagFmt = flagdbcr;
            }
            else if (s == "credit")
            {
              flagFmt = flagdbcr;
            }
            <td class="jvtable" align="@salign" @Html.Raw(flagFmt) @Html.Raw(cWidth)>
              @rNv[s]
            </td>
          }
        </tr>
      }
      debitsum = Math.Round(debitsum, 2);
      creditsum = Math.Round(creditsum, 2);
      if (rows.Count < 1)
      {
        colspan = (fName.Count - 2).ToString(); // colspan for the no detail line
        <tr class="jvtable" @Html.Raw(CJvTpl.FlagRed("nodetail", "nodetail"))>
          <td class="jvtable" width="20px">&nbsp;</td>
          <td class="jvtable" width="40px">&nbsp;</td>
          <td class="jvtable" colspan="@colspan" align="center">&nbsp;</td>
        </tr>
      }
      flagsumamt = CJvTpl.FlagSumAmt(debitsum, creditsum);
      colspan = (fName.Count - 3).ToString(); // colspan for the total line
    }
    <tr class="jvtable" @Html.Raw(flagsumamt)>
      <td class="jvtable" colspan="@colspan" align="right">
        <i>Note: Please use paper JV if each amount exceed [$9,999,999.99]</i>
      </td>
      <td class="jvtable" align="right"><b>Totals:</b></td>
      <td class="jvtable" align="right"><b>@debitsum</b></td>
      <td class="jvtable" align="right"><b>@creditsum</b></td>
      <input type="hidden" id="detailrows" name="detailrows" value="">
    </tr>
  </tbody>
</table>