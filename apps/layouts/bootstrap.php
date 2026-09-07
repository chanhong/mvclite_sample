<?php
use MvcLite\CCore;
use MvcLite\CSetting;
$grp=CCore::$_usr["usrgroup"]??'';
$grpno=CCore::$_usr["usrgrpno"]??'';
$uinfo=$_SESSION["uinfo"]??'';
$tile=$pageData['header_title']??'';
 $usrinfo=$pageData["usrinfo"]??'';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>

<head>
  <title><?php echo $tile; ?></title>
  <meta content="text/html; charset=windows-1252" http-equiv="Content-Type">
  <?php
  echo $this->renderWidget('header_bef');
  include_once("widgets/hdrcdncssjs.php");
  include_once("widgets/hdrcss.php");
  ?>
  <style type="text/css">
    .xl39 {
      background: #99CCFF;
    }
  </style>
  <meta name="viewport" content="width=device-width" />
</head>

<body>
  <div class="mainbody">
    <div id="topHeader">
      <table class="mainbody" border="0" cellpadding="0" cellspacing="0">
        <tr valign="middle" width="100%">
          <td align="left">
            <img alt="Logo" src="<?php echo $this->publicFolder; ?>/img/logo.jpg" vspace="2">
          </td>
          <td></td>
          <td align="right">
            <font color="LightGrey" face="helvetica, sans-serif;" size="6"><?php echo $tile; ?>
            </font>
          </td>
        </tr>
      </table>
    </div>
    <div class="navbar navbar-expand-sm hmenu" style="background-color: #E8EAED;">
      <ul class="navbar-nav mr-auto text-center">
        <?php
        echo $this->ut->getMenu("main"); 
//        echo $this->ut->getTopMenu();
        echo $this->ut->getMenu("app"); 
        ?>
      </ul>
    </div>
    <div class="main-content">
      <div class="text-right">&nbsp;
        <font color="LightGrey">
          <?php
          echo  $usrinfo;
          ?>
        </font>
      </div>
      <div class="navbar navbar-expand-sm hmenu">
        <ul class="navbar-nav ml-auto text-center"><?php 
//        echo $this->ut->getSubMenu(); 
        echo $this->ut->getMenu("sub"); 
        ?></ul>
      </div>
      <div class="main-body">
        <?php 
//            pln($this->stg->get('tg'),'bootstrap: tg');
//                    pln($grp.''.':'.$grpno,'g:n');
                    // [-UINFO-SS-] Array ( [usrname] => admin [usrgroup] => admin [usrgrpno] => 90 [usrpw] => 96e79218965eb72c92a549dd5a330112 [appid] => FRONT [usrentity] => [litype] => web [level] => admin )
//pln($uinfo,'uinfo-ss');
//            pln("Global task group<br />");
        echo $this->doBody(); ?>
      </div>
    </div>
    <div class="navbar navbar-expand-sm" style="background-color: #E8EAED;">
      <ul class="navbar-nav mx-auto text-center"> <?php
      echo $this->renderWidget('footer_bef');
      ?>
      </ul>
    </div>
    <div class="footer">
      <?php
      echo $this->renderWidget('footer_aft');
      echo $this->renderWidget('footer_dbg');
      ?>
    </div>
  </div>
</body>

</html>