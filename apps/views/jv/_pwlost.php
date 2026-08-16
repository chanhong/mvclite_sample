@using System;
@using System.Collections;
@using System.Collections.Generic;
@using System.Collections.Specialized;
@using Co;
@{
  PageData["Title"] = "Lost Password";
  if (IsPost)
  {
    CJvAdm.SendPw(Request.Form, CJv.DbEnv());
    CUtils.Redirect("?");
  }
}
<div align="center">
  <p>
    A new generated password will be sent to your email address obtained from our record.
  </p>
  <form id="formLostPW" ACTION=@CUtils.tap("/jv/_pwlost") METHOD="POST">
    <fieldset>
      <legend>Lost Password Form</legend>
      <p>
        <label for="user">JV User ID</label>
        <input id="user_name"
               name="user_name"
               type="text"
               title="User name is required!"
               class="required"
               minlength="2" />
        <br />
        <font size="-1"><i>(the unique part of your email address)</i></font>
      </p>
      <p>
        <input name="submit" type="SUBMIT" value="Send the new password">
      </p>
    </fieldset>
  </form>
</div>