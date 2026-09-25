<?php
  $_qsa = CCore::qs2nvWithDefaultValue();
  CUtil::setActiveCtrl($_qsa);
  $username = CSecs::winUser();
  $app = strtoupper($PageData["app"]);
  $rUrl = CUtil::getReturnUrl();
  pln($rUrl, "rUrl");
?>
<?php echo (CHtml::FrmBeg(CUtil::tap("/" . strtolower($app) + "/login"), "LoginForm")); ?>
<fieldset>
  <legend>Win <?php echo $app; ?> Login Form</legend>
  <p>
    Your Windows login [<?php echo $username; ?>] is pre-authorized to have direct access without using user name and password.
  </p>
  <p />
  <?php // echo ($PageData["selentities"]); // jv ?>
  <input type="hidden" id="appid" name="appid" value="<?php echo $app; ?>" />
  <input id="user_name" name="user_name" type="hidden" value="<?php echo $username; ?>" />
  <input type="hidden" id="logintype" name="logintype" value="WIN" />
  <p />
  <input class="submit" type="submit" value="Login with your Windows credential" />
  <p />
  <font size="-1"><i>(Click button above to login with your Windows credential)</i></font>
  </p>
</fieldset>
<?php echo (CHtml::FrmEnd($rUrl)); ?>