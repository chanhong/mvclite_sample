
<?php
use MvcLite\CCore;
  //Layout = CUtil::GetLayout("_bootstrap_2c");
  if ($PageData["Title"] == CSetting::get("Name"))
  {
    $PageData["Title"] = "Upload";
  }
  if (IsPost)
  {
    $archive = Server.MapPath("~/App_Data/uploads/");
    CFiles.uploadFiles(archive);
  }

  $upload = new StringBuilder();
  $maxUpload = 6;
  $i = 0;
  $padding = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  do
  {
    $i++;
    $buff = String.Format("<input title=\"Allowed extention: {0}\" name=\"files[]\" type=\"file\" {1} />", CSetting::get("allowedext"), padding);
    upload.Append(buff);
    if (i == maxUpload / 2)
    {
      upload.Append("<p />");
    }
  } while (i < maxUpload);
?>

<form enctype="multipart/form-data" action="@CUtil::tap("/jendo/upload")" method="POST">
  Please choose a file:<p /><p />
  @Html.Raw(upload)
  <p />
  <input type="submit" value="Click to Upload" />
</form>