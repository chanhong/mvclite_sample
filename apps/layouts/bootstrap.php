<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo @$pageData['header_title']; ?></title>
  <meta content="text/html; charset=windows-1252" http-equiv="Content-Type">
  <?php
      echo $this->renderWidget('header_bef');    
    echo $this->h->css($this->vendorFolder . '/' .'twbs/bootstrap/dist/css/bootstrap.min.css');
    echo $this->h->css($this->publicFolder . '/' .'css/bootstrap-custom.css');
    echo $this->h->css($this->publicFolder . '/' .'css/custom.css');
    echo $this->h->jsSrc($this->vendorFolder . '/' ."components/jquery/jquery.min.js");
    echo $this->h->jsSrc($this->vendorFolder . '/' ."components/jqueryui/jquery-ui.min.js");
    echo $this->h->jsSrc($this->vendorFolder . '/' ."twbs/bootstrap/dist/js/bootstrap.min.js");
    echo $this->h->jsSrc($this->publicFolder . '/' ."js/ie-emulation-modes-warning.js");
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
      echo $this->h->getLiMenu(MvcCore::$_cfg['menu']['main']) ."=>&nbsp;&nbsp;".@$pageData["cmenu"];
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
      <?php echo $this->doBody(); ?>
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
      ?>      
    </div>
  </div>
</body>
</html>