@using System;
@using System.Collections;
@using System.Collections.Generic;
@using System.Collections.Specialized;
@using Co;
@{
  CCore._Logout();
  PageData["Title"] = "Account Confirm";
  Layout = CUtils.GetLayout("_ejv");
  NameValueCollection qs = CUtils.qs2nv();
  CUtils.Add2SessVar("feedback", MJvAdm.ConfirmUser(qs, CJv.DbEnv()));
}
<div align="center">
  <p>
    <h2>eJV Account Confirmation Page</h2>
  </p>
</div>