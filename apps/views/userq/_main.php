@using Co;
@{
  Layout = CUtils.GetLayout("_bootstrap_top");
  PageData["Title"] = "User Query Main";
}
<font color="LightGrey" face="helvetica, sans-serif;" size="6">@Page.title</font>
<H2>A simple web pages to do proof of concept on User queries</H2>
@RenderPage("_mylinks.cshtml")