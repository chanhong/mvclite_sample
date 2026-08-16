@using System.Collections.Specialized;
@using Co;
@{
  Layout = CUtils.GetLayout("_4pdf"); // render jv into html for pdf file creation
                                      // from _createpdf
}
<table class="jvtable">
  <tbody>
    <tr class="jvtable">
      <td class="jvheader" colspan="2">
        <font size=+2>@CSetting::get(("uwjv")</font>
        <br />@PageData["onejv"]["title"] 
      </td>
    </tr>
    <tr class="jvtable">
      <td class="jvtable" width="60%">
        @RenderPage("../../jvtpl/_r_/vmailto.cshtml")
      </td>
      <td class="jvtable" width="40%">
        @RenderPage("../../jvtpl/_r_/vmaker.cshtml")
      </td>
    </tr>
    <tr class="jvtable">
      <td class="jvtable" colspan="2">
        @RenderPage("../../jvtpl/_r_/vdetail.cshtml")
      </td>
    </tr>
    <tr class="jvExplanation">
      <td class="jvExplanation" colspan="2">
        @RenderPage("../../jvtpl/_r_/vexplain.cshtml")
      </td>
    </tr>
  </tbody>
</table>