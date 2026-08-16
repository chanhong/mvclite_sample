@using Co;
@{
  // lasyout is already in _search
  PageData["Title"] = "JV Admin Index";
  string dbenv = CJv.DbEnv();

  CJvAdm.PbOrRr(CUtils.MyUrl(), dbenv); // process Post/Get Request
  CJv.IsJvUserForcedLogoff(dbenv);
  CCore._uprf = CUtils.getSessNv("uinfo");  
  if (!CString.IsEmpty(dbenv) && CString.IsEmpty(CCore._uprf["name"])) { 
    CJv.setUserProfile(dbenv);  
  }
}
@RenderPage("_search.cshtml")