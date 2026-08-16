@using System.Collections.Specialized;
@using Co;
@{
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
        @RenderPage("vmailto.cshtml")
      </td>
      <td class="jvtable" width="40%">
        @RenderPage("vmaker.cshtml")
      </td>
    </tr>
    <tr class="jvtable">
      <td class="jvtable" colspan="2">
        @RenderPage("vdetail.cshtml")
      </td>
    </tr>
    <tr class="jvExplanation">
      <td class="jvExplanation" colspan="2">
        @RenderPage("vexplain.cshtml")
      </td>
    </tr>
  </tbody>
</table>