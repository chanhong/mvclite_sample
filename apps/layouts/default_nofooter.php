<!DOCTYPE html>
<html>

<head>
<?php
        echo @$data['header_bef'];
        echo $this->h->css($this->publicFolder . '/' .'css/bootstrap.min.css');
//        echo $this->h->css($this->publicFolder . '/' .'css/ie10-viewport-bug-workaround.css');
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
    <div class="navbar navbar-default" role="navigation">
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <?php echo @$data['top']; ?>
        </ul>
      </div>
      <?php echo @$data['body_bef']; ?>
    </div>
    <div class="container">
      <?php echo $this->doBody(); ?>
      <?php echo @$data['body_aft']; ?>
    </div>
  <?php echo @$data['loadjs_aft']; ?>

  
</body>

</html>