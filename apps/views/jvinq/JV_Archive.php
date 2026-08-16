@using System.Collections.Specialized;
@using Co;
@{
//  CJv.setUserProfile(); // always attempt to set profile on each entry view
  Layout = CUtils.GetLayout("_ejv");
  if (PageData["Title"] == AppState["Name"])
  {
    PageData["Title"] = "JV Log Archive Lookup";
  }
  string meqs = CUtils.tap("/jvinq/jv_archive");

  string iPath = CUtils.imgPath();
  NameValueCollection last7days;
  string dateBeg="", dateEnd="", showjustmyjv="";
  string pdateBeg="", pdateEnd="";

  if (IsPost) // save previous value
  {
    pdateBeg = Request.Form["datebeg"];
    pdateEnd = Request.Form["dateend"];
  }

  if (CString.IsEmpty(pdateBeg) == true || CString.IsEmpty(pdateEnd) == true) // if no previous value get the default last 7 days
  {
    last7days = CJvInq.Last7Days();
    dateBeg = last7days["datebeg"];
    dateEnd = last7days["dateend"];
  } else // restore the previous values
  {
    dateBeg = pdateBeg;
    dateEnd = pdateEnd;
  }
  /*
  CMsg._pdmsg(pdateBeg, "pdateBeg");
  CMsg._pdmsg(pdateEnd, "pdateEnd");
  */
  }
  <div class="jvbody">
    <div class="jvContent">
        <script type="text/javascript">
          $(document).ready(function () {
            $("#datebeg").kendoDatePicker();
            $("#dateend").kendoDatePicker();
          });
        </script>
        <table class="jvtable">
          <tbody>
            <tr>
              <td COLSPAN="9" align="center">
                @Html.Raw(CHtml.FrmBeg(meqs))
                  <input type="hidden" name="daysnum" size=2 maxlength="2" value="1">
                  <input type="hidden" name="pdatebeg" value="@pdateBeg">
                  <input type="hidden" name="pdateend" value="@pdateEnd">
                  Begin Date:
                  <input type="text"
                         title="Pick begin date"
                         id="datebeg"
                         name="datebeg"
                         size=10
                         maxlength="10"
                         value="@dateBeg">
                  End Date:
                  <input type="text"
                         title="Pick end date"
                         id="dateend"
                         name="dateend"
                         size=10
                         maxlength="10"
                         value="@dateEnd">
                  <input type="checkbox" name="showjustmyjv" Title="Check to show just my JV" value="yes">&nbsp;&nbsp;
                  <input type="submit" name="submit" value="Go">
                  @Html.Raw(CHtml.FrmEnd(meqs))
              </td>
            </tr>
            @if (IsPost)
            {
              dateBeg = CCore.getSafeVar(Request.Form, "datebeg", "raw");
              dateEnd = CCore.getSafeVar(Request.Form, "dateend", "raw");
              showjustmyjv = CCore.getSafeVar(Request.Form, "showjustmyjv", "raw");
              <p>
                Journal Vouchers Log between @dateBeg and @dateEnd
              </p>
              CCore._rows = CJvInq.JvLogInDateRange(dateBeg, dateEnd, showjustmyjv, CJv.DbEnv());
              @RenderPage("_jvlog.cshtml")
            }
          </tbody>
        </table>
      </div>
    </div>