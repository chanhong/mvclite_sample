<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    echo @$data['header_bef']; 
    echo $this->h->css($this->vendorFolder . '/' .'twbs/bootstrap/dist/css/bootstrap.min.css');
//    echo $this->h->css($this->publicFolder . '/' .'css/ie10-viewport-bug-workaround.css');
    echo $this->h->css($this->publicFolder . '/' .'css/bootstrap-custom.css');
    echo @$data['header_aft'];  
    echo @$data['loadjs_bef'];           
?>
</head>

<body>
  <div class="mainbody">
    <div id="topHeader">
      <?php echo @$data['header_title']; ?>
    </div>
    <!-- Fixed navbar -->
    <div class="navbar navbar-expand-sm" style="background-color: #E8EAED;">
    <!--
    <nav class="navbar navbar-expand-lg  navbarBGcolor fixed-top">   
    --> 
      <div class="container">
      <div id="navbar navbar-expand-sm hmenu">
          <ul class="nav navbar-nav">
            <?php echo @$data['top']; ?>
          </ul>
        </div>
        <!--/.nav-collapse -->
      </div>
    </nav>
    </div>
    <div class="container">
      <div class="page-header">
        <?php echo @$data['body_bef']; ?>
      </div>
      <?php echo $this->doBody(); ?>
    </div>
  </div>
  <footer class="footer">
    <div class="container">
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <?php echo @$data['footer_bef']; ?>
        </ul>
      </div>
      <!--/.nav-collapse -->
      <p />
      <?php echo @$data['footer_aft']; ?>
    </div>
  </footer>
  <?php echo @$data['loadjs_aft']; ?>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</body>

</html>