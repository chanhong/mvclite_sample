@using System.Collections.Specialized;
@using Co;
@{
  Page.Title = "Search User";
  Layout = CUtils.GetLayout("_ejv");

  List<Dictionary<string, object>> rows = new List<Dictionary<string, object>>();
  string iPath = CUtils.imgPath();
  string tsk = "jvadm";
  string addusrqs = CUtils.tap(string.Format("/{0}/_edituser", tsk));
  string mepath = string.Format("/{0}/index/", tsk);  // c use as sub-action such as clone, add, etc

  string[] ka = null;
  string stitle = "", salign = "";
  string tblcls = "jvtable";
  NameValueCollection fName = new NameValueCollection {
              // fldname, fldhdr, fldformat
                  { "user_id","UserID,"},
                  { "name","Name,"},
                  { "email","Email,left"},
                  { "is_confirmed","Confirmed,"},
                  { "email_login","Email_Login,"},
                  { "winuser","WinUser,"},
                  { "jvgroup","Group,"},
                  { "jventity","Entity,"},
                  { "jventities","Entities,"},
                  { "login_status","Login Status,"},
                  { "remote_addr","User IP,"},
                  { "timestamp","Timestamp,"},
          };

  string _qisconfirmed = CCore.getSafeVar(Request.Form, "isconfirmed", "raw");
  string _q = CCore.getSafeVar(Request.Form, "q", "raw");
//  CMsg._dmsg(_q, "_q");
  rows = MJvAdm.UserSearch(_qisconfirmed, _q, CJv.DbEnv());
  int cnt = 0;

}
<div class="jvbody">
  <div class="jvContent">
    <table class="jvtable">
      <tbody>
        <tr class="jvtable">
          <td class="jvtable" COLSPAN="13" align="center">
            @RenderPage("_r_/filterby.cshtml")
          </td>
        </tr>
        <tr class="@tblcls">
          <th class="@tblcls" width="10%" align="center">
            Action&nbsp;&nbsp;&nbsp;<a href="@addusrqs" title="Create"><img class="icon" src="@iPath/add.png"></a>
          </th>
          @foreach (string s in fName.AllKeys)
          {
            ka = CUtils.Str2a(',', fName[s]); // get value of fName[s]
            stitle = (ka[0].Length > 0) ? ka[0] : s;
            <th class="@tblcls">@Html.Raw(stitle)</th>
          }
        </tr>
        @foreach (Dictionary<string, object> r in rows)
        {
//          CMsg._pdmsg(r, "r");
          cnt++;
          string linecls = "screen" + CUtils.evenOrOdd(cnt);
          string uid = r["user_id"].ToString();
          string delUrl = CUtils.tap(mepath + uid, "delete");
          string clnUrl = CUtils.tap(mepath + uid, "clone");
          string sndUrl = CUtils.tap(mepath + uid, "sendconfirm");
          string edtUrl = CUtils.tap(string.Format("/{0}/_edituser/{1}", tsk, uid));

          <tr class='@linecls'>
          <td align="center">
            <a href="@delUrl" onclick="return confirm('Are you sure?');" title="Delete User"><img class="icon" src="@iPath/remove.png"></a>
            &nbsp;&nbsp;
            <a href="@clnUrl" title="Clone User"><img class="icon" src="@iPath/smile.png"></a>
            &nbsp;&nbsp;
            <a href="@edtUrl" title="Edit"><img class="icon" src="@iPath/info.png"></a>
            &nbsp;&nbsp;
            <a href="@sndUrl" title="Send confirmation email"><img class="icon" src="@iPath/log.png"></a>
          </td>
          @{
            NameValueCollection rNv = CUtils.dict2nv(r); // convert Nv to get field name
            foreach (string s in fName)
            {
              ka = CUtils.Str2a(',', fName[s]); // get value of fName[s]
              salign = (ka[1].Length > 0) ? ka[1] : "center";
              <td align="@salign">@rNv[s]</td>
            }
          }
        </tr>
        }
      </tbody>
    </table>
  </div>
</div>