@using System;
@using System.Collections.Generic;
@using System.Linq;
@using System.IO;
@using System.Collections;
@using System.Text;
@using System.Collections.Specialized;

@using System.Web;
@using System.Web.Mvc;
@using System.Web.Helpers;
@using System.Web.UI;
@using System.Web.UI.WebControls;
@using SelectPdf;
@using Co;
@using Co.SelectPdf;

@{
  Layout = CUtils.GetLayout("_bootstrap_2c");
  if (PageData["Title"] == AppState["Name"])
  {
    PageData["Title"] = "Upload";
  }

  if (IsPost)
  {
    var archive = Server.MapPath("~/App_Data/uploads/");
    string baseUrl = CHelpers.siteUrl().ToString();
    CFiles.createPDF(archive, baseUrl);
  }
  List<SelectListItem> PageSizes = CreatePdf.PageSizes;
  List<SelectListItem> PageOrientations = CreatePdf.PageOrientations;
}
<article class="post type-post status-publish format-standard hentry">
  <header class="entry-header">
    <h1 class="entry-title">SelectPdf Free Html To Pdf Converter for .NET Core</h1>
  </header>
  <form method="POST">
    <p />Pdf Page Size:
    @Html.Raw(CHtml.dropDnList("DdlPageSize", PageSizes, "Letter"))

    <p />Pdf Page Orientation:
    @Html.Raw(CHtml.dropDnList("DdlPageOrientation", PageOrientations, "Landscape"))

    <p>
      @Html.Label("TxtWidth:", "TxtWidth")
      @Html.TextBox("TxtWidth", "1024")
    </p>
    <p>
      @Html.Label("TxtHeight:", "TxtHeight")
      @Html.TextBox("TxtHeight", "25")
    </p>

    <p>
      @Html.Label("Html Code:", "TxtHtmlCode")<br />
      @Html.TextArea("TxtHtmlCode", "Hello World using SelectPDF.")
    </p>
    <p><input type="submit" value="Create!" /></p>

  </form>
</article>