<!DOCTYPE html>
<html>
  <head>
    <?php
    echo @$data['header_bef'];
    echo $this->h->css('public/css/default-less.css');
    echo @$data['header_aft'];           
    ?>
  </head>
  <body>
    <div class="mainbody">
      <div id="topHeader">
        <?php echo @$data['header_title']; ?>
      </div>
      <div class="navcontainer">
        <div class="topnav">
          <ul id="liMenu">
            <?php echo @$data['top']; ?>
          </ul>
        </div>
        <?php echo @$data['body_bef']; ?>
      </div>
      <div class="main-content">
        <?php echo $this->doBody(); ?>
      </div>
      <div class="footerholder">
        <div class="navcontainer">
          <div class="bottomnav">
            <ul id="liMenu">
              <?php echo @$data['footer_bef']; ?>
            </ul>
          </div>
        </div>
        <div class="footer">
          <?php echo @$data['footer_aft']; ?>
        </div>
      </div>
    </div>
    <?php echo @$data['loadjs']; ?>
  </body>
</html>
