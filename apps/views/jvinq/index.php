@using Co;
@{
  //  CJv.setUserProfile(); // always attempt to set profile
  PageData["Title"] = "eJV Inqury";
  string dbenv = CJv.DbEnv();
  CJvInq.PbOrRr(CUtils.MyUrl(), dbenv); // process Post/Get Request, use index instead of _pb to simplify logic
  CJv.IsJvUserForcedLogoff(CJv.DbEnv());
}
@RenderPage("JV_Search.cshtml")