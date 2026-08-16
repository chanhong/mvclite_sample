@using System.Collections.Specialized;
@using Co;
@{
  PageData["Title"] = "JV View to upload";
  string v2p = PageData["onejv"]["v2p"];
  int maxUpload = Convert.ToInt32(CSetting::get(("maxupload"));
  string meqs = PageData["meqs"];
}
<div>
  <center>
    <form enctype="multipart/form-data" action="@Html.Raw(meqs)" method="POST">
      <table border=0 width=100% align="center">
        <tr align="center">
          <td align="center" colspan=8>
            @Html.Raw(CJvTpl.UploadBox(maxUpload))
            <p />
            <input type="hidden" id="cmd" name="cmd" value="uploaddocs" />
            <input type="hidden" id="jvid" name="jvid" value="@PageData["onejv"]["jvid"]" />
            <input type="hidden" id="log_id" name="log_id" value="@PageData["onejv"]["logid"]" />
            <input type="submit" value="Upload Supporting Documents" />&nbsp;&nbsp;&nbsp;
            <input type="button" value="View JV to Print" onclick="@Html.Raw(v2p)">
          </td>
        </tr>
      </table>
    @Html.Raw(CHtml.FrmEnd(meqs))
  </center>
</div>