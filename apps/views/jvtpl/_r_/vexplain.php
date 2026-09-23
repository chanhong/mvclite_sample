<?php
use MvcLite\CCore;
  $pageTitle = "Explanation goes here";
  $onejv = $PageData["onejv"];
  $uploadedFile = $onejv["uploadedfiles"];
?>
<table class="jvtable">
  <tbody>
    <tr class="jvtable"><td class="jvtable" colspan="9"><b>Explanation:</b></td></tr>
    <tr class="jvExplanation">
      <td class="jvExplanation" colspan="9">
        @onejv["explanation"]
        <p /> <p />
        @Html.Raw(uploadedFile)
      </td>
    </tr>
  </tbody>
</table>
