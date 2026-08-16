@using System;
@using System.Collections;
@using System.Collections.Generic;
@using System.Collections.Specialized;
@using Co;
@{
  PageData["Title"] = "Change Password";
  var viewData = new NameValueCollection {
//  {"username",CCore._usr["usrname"]},
  {"username",CCore.GetUsrName()},
  };
  if (IsPost)
  {
    CJvAdm.ChgPw(Request.Form, CJv.DbEnv());
    CUtils.Redirect("?");
  }
}
<div align="center">
  <form class="LoginForm" id="changePWForm" ACTION="@CUtils.tap("/jv/_pwchg")" METHOD="POST">
    <fieldset>
      <legend>Change Password Form</legend>
      <p>
        <label for="user">JV User ID</label>
        <input STYLE="background-color: #eee;"
               value="@viewData["username"]" disabled />
      </p>
      <p>
        <label for="oldpass">Old Password</label>
        <input id="old_password"
               name="old_password"
               title="Password is required!"
               class="required"
               type="password" minlength="6" />
      </p>
      <p>
        <label for="newpass1">New Password</label>
        <input id="new_password1"
               name="new_password1"
               title="Password is required!"
               class="required" type="password" minlength="6" />
      </p>
      <p>
        <label for="newpass2">New Password</label>
        <input id="new_password2"
               name="new_password2"
               title="Password is required!"
               class="required" type="password" minlength="6" />
        <br />
        <font size="-1"><i>(Please enter new password again)</i></font>
      </p>
      <p>
        <input name="change_user_name"
               type="hidden"
               value="@viewData["username"]">
        <input class="submit" type="submit" value="Change My Password" />
      </p>
    </fieldset>
  </form>
</div>