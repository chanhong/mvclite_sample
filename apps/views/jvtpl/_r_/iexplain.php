@using System.Collections.Specialized;
@using Co;
@{
  Page.Title = "Explanation goes here";
  NameValueCollection onejv = PageData["onejv"];
}
<table class="jvtable">
  <tbody>
    <tr class="jvtable"><td class="jvtable" colspan="9"><b>Explanation:</b></td></tr>
    <tr class="jvExplanation">
      <td class="jvExplanation" colspan="9">
        <textarea name="explanation" rows="8" cols="95">@onejv["explanation"]</textarea>
      </td>
    </tr>
  </tbody>
</table>