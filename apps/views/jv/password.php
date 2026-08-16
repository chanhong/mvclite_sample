@using Co;
@{
  Layout = CUtils.GetLayout("_ejv");
  PageData["Title"] = "eJV System";
  if (CCore.GetUsrName() != "")
  {
    @RenderPage("_pwchg.cshtml")
  }
  else
  {
    @RenderPage("_pwlost.cshtml")
  }
}