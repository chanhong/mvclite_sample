<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title>@ViewData["Title"]</title>
  <meta content="text/html; charset=windows-1252" http-equiv="Content-Type">
  <!--
    <link href="~/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  -->
  <?php
  echo $this->renderWidget('header_bef');
  include_once("widgets/hdrcdncssjs.php");
  include_once("widgets/hdrcss.php");
  ?>    
    <meta name="viewport" content="width=device-width" />
</head>
<body>
  <div class="mainbody">
    <div id="topHeader">
      <table class="mainbody" border="0" cellpadding="0" cellspacing="0">
        <tr valign="middle" width="100%">
          <td align="left">
            <img alt="[@CSetting::get("Name")]" src="@logo" vspace="2">
          </td>
          <td></td>
          <td align="right">
            <font color="LightGrey" face="helvetica, sans-serif;" size="6">@ViewData["Title"]</font>
          </td>
        </tr>
      </table>
    </div>
    <div class="navbar navbar-expand-sm" style="background-color: #E8EAED;">
      <ul class="navbar-nav mx-auto text-center">
  echo $this->renderWidget('footer_bef');        
        </ul>
    </div>
    <div class="main-content">
        <?php echo $this->doBody(); ?>      
    </div>
  </div>
  <?php
  /*
echo $this->h->css($this->vendorFolder . '/' . "twbs/bootstrap/dist/css/bootstrap.min.css");  
  <script src="~/Shared/js/site.js"></script>
  @RenderSection("Scripts", required: false)
  */?>
</body>
</html>