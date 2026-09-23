<?php
use MvcLite\CCore;
?>
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
        include("vmailto.cshtml")
      </td>
      <td class="jvtable" width="40%">
        include("vmaker.cshtml")
      </td>
    </tr>
    <tr class="jvtable">
      <td class="jvtable" colspan="2">
        include("vdetail.cshtml")
      </td>
    </tr>
    <tr class="jvExplanation">
      <td class="jvExplanation" colspan="2">
        include("vexplain.cshtml")
      </td>
    </tr>
  </tbody>
</table>
