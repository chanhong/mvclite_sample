@using System.Collections.Specialized;
@using Co;
@{
  string dbinfo = CJv.DbEnv();

  CJv.setUsersInfo(dbinfo); // MUST set JV Users info in case redirected to login 
  Layout = CUtils.GetLayout("_ejv");
  //  string usrname = CCore.GetUsrName(); 

  PageData["app"] = "jv";
  if (PageData["Title"] == AppState["Name"])
  {
    PageData["Title"] = "Login";
  }
  if (IsPost)
  {
    if (CCore._Login(Request.Form) == true)
    {
      string rUrl = CUtils.getReturnUrl();
      CMsg._dmsg(rUrl, "login");
      CJv.setUserProfile(dbinfo); // always attempt to set profile
      CMsg._dmsg(CCore._usr, "login");
      // to debug jvinq web login
      CUtils.Redirect(rUrl); // must do it this way to have a chance to set profile before redirect
                             //                                             CUtils.Redirect("?"); // must do it this way to have a chance to set profile before redirect
    }
    else
    {
      //      CMsg._pdmsg(Request.Form, "login failed!");
      //      CMsg._dprt(Request.Form, "login failed!");
      CCore.ClearUser();
    }
  }
}
<div id="main" align="center">
  @{
    if (CSecs.IsNotAuthorized() == true)
    {
      <span>
        <H1> You are not authorized! </H1>
      </span>
    }
    else
    {
       if (CSecs.isIntrgUser() == true)
      {
        PageData["selentities"] = CJv.getUserEntities4DropdownList("");

        @RenderPage(AppState["viewpath"]+"/"+ AppState["_rp"]+"/loginWin.cshtml")
      }
        if (CSecs.IsWebloginAllowed() == true)
        {
          List<string> aList = CUtils.Str2a('|', "HMC|UWMC|DEV|TEST").ToList();
        PageData["selentities"] = CJv.getEntitiesDropdownList(aList, "DEV");

        @RenderPage(AppState["viewpath"]+"/"+ AppState["_rp"]+"/loginWeb.cshtml")
      }
    }
  }
</div>