
<?php
use MvcLite\CCore;
$PageData["Title"] = "Change Password";
$viewData = ["username" => CCore::GetUsrName()];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    CJvAdm::ChgPw($_POST, CJv::DbEnv());
    CUtil::Redirect("?");
}
?>
<div align="center">
  <form class="LoginForm" id="changePWForm" action="<?= htmlspecialchars(CUtil::tap("/jv/_pwchg"), ENT_QUOTES) ?>" method="POST">
    <fieldset>
      <legend>Change Password Form</legend>
      <p>
        <label for="user">JV User ID</label>
        <input STYLE="background-color: #eee;"
               value="<?= htmlspecialchars($viewData["username"], ENT_QUOTES) ?>" disabled />
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
               value="<?= htmlspecialchars($viewData["username"], ENT_QUOTES) ?>">
        <input class="submit" type="submit" value="Change My Password" />
      </p>
    </fieldset>
  </form>
</div>