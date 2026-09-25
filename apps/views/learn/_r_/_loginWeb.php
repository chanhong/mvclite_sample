<?php
use MvcLite\CCore;
use MvcLite\CUtil;
use MvcLite\CHtml;

  $_qsa = CCore::qs2nvWithDefaultValue();
  CUtil::setActiveCtrl($_qsa);
  $app = strtoupper($PageData["app"]);
  //  $rUrl = CUtil::getReturnUrl();
    $loginUrl = CUtil::tap("/front/_login");
  pln($app, "app");
  pln($_qsa, "_qsa");
  pln($loginUrl, "loginUrl");
?>
<script>
  $(document).ready(function () {
    // validate the form when it is submitted
    $("#formLogin").validate({
      rules: {
        user_name: {
          required: true,
          minlength: 2
        },
        password: {
          required: true,
          minlength: 6
        }
      },
      messages: {
        username: {
          required: "Please enter a username",
          minlength: "Your username must consist of at least 2 characters"
        },
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 6 characters long"
        }
      }
    });
  });
</script>
<?php echo (CHtml::FrmBeg("", "LoginForm")); ?>
<fieldset>
  <legend>Web <?php echo $app; ?> Login Form</legend>
  <p />
  <?php // echo ($PageData["selentities"]);  // jv?>
  <input type="hidden" id="appid" name="appid" value="<?php echo $app; ?>" />
  <input type="hidden" id="logintype" name="logintype" value="WEB" />
  <p>
    <label for="user"><?php echo $app; ?> User Name</label>
    <input id="user_name" name="user_name" title="User name is required!" class="required" minlength="2" />
  </p>
  <p>
    <label for="pass"><?php echo $app; ?> Password</label>
    <input id="password" name="password"
           title="Password is required!"
           class="required" type="password" minlength="6" />
  </p>
  <p>
    <input class="submit" type="submit" value="Login with your Web Account" />
  </p>
</fieldset>
<?php echo (CHtml::FrmEnd()); ?>