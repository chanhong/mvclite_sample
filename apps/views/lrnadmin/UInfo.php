@using System.Collections.Specialized;
@using Co;
@{
  Page.Title = "UInfo";
  Layout = CUtils.GetLayout("_bootstrap_top");
}
@RenderPage(AppState["viewpath"] + "/" + AppState["_rp"] + "/UInfo.cshtml")