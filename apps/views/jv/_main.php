@using System.Collections.Specialized;
@using Co;
@{
  Layout = CUtils.GetLayout("_ejv");
  PageData["Title"] = "Main Page";
  string dbinfo = CJv.DbEnv();
  string usrname = CCore.GetUsrName();
  //  CMsg._pdmsg(usrname, "usrname-b");
  usrname = CJv.getJvUsrname(usrname, dbinfo); // let default to winuser
                                               //  CMsg._pdmsg(usrname, "usrname-a");
}
<div align="center">
  @{
    if (CJv.JvIsAuthorized(usrname, dbinfo) && !CString.IsEmpty(usrname))
    {
      // applicaton specific authorization check via winuser
      <span>
        <h2>UW Medicine Electronic Journal Voucher</h2>
        <p />
        JV Inquiry menu item is for JV Searching and JV Archive lookup
        <p />
        JV Templates menu item is for creating a new JV from the templates
        <p />
        JV Approver menu item is for approving completed JV
        <p />
      </span>
    }
    else if (CJv.JVIsNotAuthorized(usrname, dbinfo) == true) // applicaton specific NOT authorization check
    {
      CMsg._pdmsg(usrname, "usrname-b");
      usrname = (CString.IsEmpty(usrname)) ? CSecs.winUser() : usrname; // eJV use integrated security to fall when do lookup
      <H1>[@usrname], you are not authorized!</H1>
    }
  }
  <img src="~/Shared/images/ejv.png" height=200 width=600><p>
</div>