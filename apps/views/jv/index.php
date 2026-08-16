@using System.Collections.Specialized;
@using Co;
@{
  // don't set layout in index for consistency and avoid double layout
  string vFile;
  string retViewFile;
  string dbinfo = CJv.DbEnv();
  NameValueCollection _qsa = CCore.qs2nvWithDefaultValue();
  //  CMsg._pdmsg(_qsa, "jvinx");
  CUtils.setActiveCtrl(_qsa);
  //  CSecs.setUsersInfo(); // default
  CJv.setUsersInfo(dbinfo); // MUST set JV Users info for the menu 

  PageData["Title"] = "eJV System";
  vFile = "_login.cshtml";
  CCore._cfg["alert"] = CJv.JvOfflineMsg();

  CJv.IsJvUserForcedLogoff(dbinfo); // only when assoc with Windows account
  //    CJv.setUserProfile(); // app specific user profile, let see if set in login is good enough
  retViewFile = CUtils.getReturnViewFileFromSess();
  CMsg._pdmsg(retViewFile, "retViewFile");
  vFile = (CString.IsEmpty(retViewFile) == false)
? retViewFile // return to view before redirect to login
: "_main.cshtml";
}
@RenderPage(vFile)