@using System;
@using System.Text;
@using System.Web;
@using System.Web.UI;
@using System.Web.Helpers;
@using System.Collections.Specialized;
@using Co;
@{
  Layout = CUtils.GetLayout("_bootstrap_2c");
  if (PageData["Title"] == AppState["Name"])
  {
    PageData["Title"] = "Upload";
  }
  if (IsPost)
  {
    var archive = Server.MapPath("~/App_Data/uploads/");
    CFiles.uploadFiles(archive);
  }

  StringBuilder upload = new StringBuilder();
  int maxUpload = 6;
  int i = 0;
  string padding = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  do
  {
    i++;
    string buff = String.Format("<input title=\"Allowed extention: {0}\" name=\"files[]\" type=\"file\" {1} />", AppState["allowedext"], padding);
    upload.Append(buff);
    if (i == maxUpload / 2)
    {
      upload.Append("<p />");
    }
  } while (i < maxUpload);
}

<form enctype="multipart/form-data" action="@CUtils.tap("/jendo/upload")" method="POST">
  Please choose a file:<p /><p />
  @Html.Raw(upload)
  <p />
  <input type="submit" value="Click to Upload" />
</form>