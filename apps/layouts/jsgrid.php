<?php
$jsgrid = $this->publicFolder . '/' . 'jsgrid'.'/';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo @$pageData['header_title']; ?></title>
  <meta content="text/html; charset=windows-1252" http-equiv="Content-Type">
  <?php
      echo $this->renderWidget('header_bef'); 
    include_once("widgets/hdrcdncssjs.php");

    include_once("widgets/hdrcss.php");
?>  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo $jsgrid; ?>/demos.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,600,400' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="<?php echo $jsgrid; ?>/css/jsgrid.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $jsgrid; ?>/css/theme.css" />

    <script src="<?php echo $jsgrid; ?>/external/jquery/jquery-1.8.3.js"></script>
    <script src="<?php echo $jsgrid; ?>/db.js"></script>

    <script src="<?php echo $jsgrid; ?>/src/jsgrid.core.js"></script>
    <script src="<?php echo $jsgrid; ?>/src/jsgrid.load-indicator.js"></script>
    <script src="<?php echo $jsgrid; ?>/src/jsgrid.load-strategies.js"></script>
    <script src="<?php echo $jsgrid; ?>/src/jsgrid.sort-strategies.js"></script>
    <script src="<?php echo $jsgrid; ?>/src/jsgrid.field.js"></script>
    <script src="<?php echo $jsgrid; ?>/src/fields/jsgrid.field.text.js"></script>
    <script src="<?php echo $jsgrid; ?>/src/fields/jsgrid.field.number.js"></script>
    <script src="<?php echo $jsgrid; ?>/src/fields/jsgrid.field.select.js"></script>
    <script src="<?php echo $jsgrid; ?>/src/fields/jsgrid.field.checkbox.js"></script>
    <script src="<?php echo $jsgrid; ?>/src/fields/jsgrid.field.control.js"></script>  
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
          <img alt="Logo" src="<?php echo $this->publicFolder;?>/img/logo.jpg" vspace="2">
          </td>
          <td></td>
          <td align="right">
            <font color="LightGrey" face="helvetica, sans-serif;" size="6"><?php echo @$pageData["header_title"];?></font>
          </td>
        </tr>
      </table>
    </div>
    <div class="navbar navbar-expand-sm" style="background-color: #E8EAED;">
      <ul class="navbar-nav mr-auto text-center">
      <?php
        echo $this->h->getLiMenu($this->cfg->get('menu.main'))."=>&nbsp;&nbsp;".@$pageData["cmenu"];
      ?> 
      </ul>
    </div>
    <div class="main-content">
      <div class="text-right">&nbsp;
        <font color="LightGrey"> 
        <?php 
          echo @$pageData["usrinfo"];
          ?>
        </font>
      </div>
      <div class="navbar navbar-expand-sm hmenu">
        <ul class="navbar-nav ml-auto text-center">        
        <?php
        echo @$pageData["submenu"];
      ?> 
      </ul>
      </div>
      <div class="main-body">

        <?php echo $this->doBody(); ?>
      </div>      
    </div>
    <div class="navbar navbar-expand-sm" style="background-color: #E8EAED;">
      <ul class="navbar-nav mx-auto text-center">      <?php
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