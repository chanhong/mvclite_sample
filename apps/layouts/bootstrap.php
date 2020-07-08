<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    echo @$data['header_bef']; 
    echo $this->h->css($this->vendorFolder . '/' .'twbs/bootstrap/dist/css/bootstrap.min.css');
    echo $this->h->css($this->publicFolder . '/' .'css/bootstrap-custom.css');
    echo $this->h->css($this->publicFolder . '/' .'css/custom.css');
    echo $this->h->jsSrc($this->vendorFolder . '/' ."components/jquery.min.js");
    echo $this->h->jsSrc($this->vendorFolder . '/' ."components/jqueryui/jquery-ui.min.js");
    echo $this->h->jsSrc($this->vendorFolder . '/' ."twbs/bootstrap/dist/js/bootstrap.min.js");
    echo $this->h->jsSrc($this->publicFolder . '/' ."js/ie-emulation-modes-warning.js");
?>
</head>

<body>
  <div class="mainbody">
    <div id="topHeader">
      <?php echo @$data['header_title']; ?>
    </div>
    <!-- Fixed navbar -->
    <div class="navbar navbar-expand-sm" style="background-color: #E8EAED;">
      <ul class="navbar-nav mr-auto text-center">
      <?php
        echo $this->h->getLiMenu(BaseCore::$_cfg['menu']['main']);
      ?>
      </ul>
    </div>    
    <div class="container">
      <div class="page-header">
        <?php echo @$data['body_bef']; ?>
      </div>
      <?php echo $this->doBody(); ?>
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
      ?>
    </div>
  </footer>
  </div>
</body>
</html>