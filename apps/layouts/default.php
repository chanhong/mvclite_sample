<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  use MvcLite\CConfig;
    echo @$pageData['header_bef']; 
    echo $this->h->css($this->vendorFolder . '/' .'twbs/bootstrap/dist/css/bootstrap.min.css');
    echo $this->h->css($this->publicFolder . '/' .'css/bootstrap-custom.css');
    echo $this->h->css($this->publicFolder . '/' .'css/custom.css');
    echo $this->h->jsSrc($this->vendorFolder . '/' ."components/jquery/jquery.min.js");
    echo $this->h->jsSrc($this->vendorFolder . '/' ."components/jqueryui/jquery-ui.min.js");
    echo $this->h->jsSrc($this->vendorFolder . '/' ."twbs/bootstrap/dist/js/bootstrap.min.js");
    echo $this->h->jsSrc($this->publicFolder . '/' ."js/ie-emulation-modes-warning.js");
?>
</head>

<body>
  <div class="mainbody">
    <div id="topHeader">
      <?php echo @$pageData['header_title']; ?>
    </div>
    <!-- Fixed navbar -->
    <div class="navbar navbar-expand-sm" style="background-color: #E8EAED;">
      <ul class="navbar-nav mr-auto text-center">
      <?php
        echo $this->h->getLiMenu($this->cfg->get('menu.main'))."=>&nbsp;&nbsp;".@$pageData["cmenu"];
      ?>
      </ul>
    </div>    
    <div class="container">
      <div class="page-header">
      <font color="LightGrey"> &nbsp;
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
  <footer class="footer">
    <div class="container">
      <div id="navbar" class="collapse navbar-collapse">
          <ul class="navbar-nav mx-auto text-center">
          <?php 
          echo $this->renderWidget('footer_bef');          
          ?>
          </ul>
      </div>
      <p />
      <?php 
          echo $this->renderWidget('footer_aft');      
          echo $this->renderWidget('footer_dbg');                 
      ?>
    </div>
  </footer>
  </div>
</body>
</html>