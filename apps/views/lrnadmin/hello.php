@using Co;
@{
  Layout = CUtils.GetLayout("_bootstrap");
  if (PageData["Title"] == AppState["Name"])
  {
    PageData["Title"] = "Hello";
  }
}
@ServerInfo.GetHtml()