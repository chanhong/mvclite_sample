@using Co;
@{
  PageData["Title"] = "JV Template Index";
  string tsk = "jvtpl";
  PageData["meqs"] = CUtils.tap("/" + tsk + "/index/");
  string dbenv = CJv.DbEnv();
  CJvTpl.PbOrRr(CUtils.MyUrl(), dbenv); // process Post/Get Request, use index instead of _pb to simplify logic
  CJv.IsJvUserForcedLogoff(CJv.DbEnv());
  CCore._uprf = CUtils.getSessNv("uinfo");  
  if (!CString.IsEmpty(dbenv) && CString.IsEmpty(CCore._uprf["name"])) { 
    CJv.setUserProfile(dbenv);  
  }
}
  @RenderPage("_jvlist.cshtml")