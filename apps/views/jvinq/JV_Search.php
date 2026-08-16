@using System.Collections.Specialized;
@using Co;

@{
//  CJv.setUserProfile(); // always attempt to set profile on each entry view
  if (IsPost)
  {
  };
  Layout = CUtils.GetLayout("_ejv");
  PageData["Title"] = "JV Search";
  string meqs = CUtils.tap("/jvinq/jv_search");
}
<div class="jvbody">
  <div class="jvContent">
    <table class="jvtable">
      <tbody>
        <tr class="jvtable">
          <td class="jvtable" COLSPAN="9" align="center">
            @Html.Raw(CHtml.FrmBeg(meqs))
              <input type="text" name="q" value="" id="q"
                     title="Search by JVNUM, Title, Maker limit laat 30 JVs">
              &nbsp;
              <input type="submit" name="submit" value="Search">
             @Html.Raw(CHtml.FrmEnd(meqs))
          </td>
        </tr>
        @if (IsPost)
        {
          string _q = CCore.getSafeVar(Request.Form, "q", "raw");
          CCore._rows = CJvInq.JvSearch(_q, CJv.DbEnv());
          @RenderPage("_jvlog.cshtml")
        }
      </tbody>
    </table>
  </div>
</div>