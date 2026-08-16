@using Co;
@{
  PageData["Title"] = "JV wait for approvel";
  PageData["meqs"] = CUtils.tap("/jvapv/index/");
  CJvApv.PbOrRr(CUtils.MyUrl(), CJv.DbEnv()); // process Post/Get Request, use index instead of _pb to simplify logic
  CJv.IsJvUserForcedLogoff(CJv.DbEnv());
}
@RenderPage("JV_Approval.cshtml")