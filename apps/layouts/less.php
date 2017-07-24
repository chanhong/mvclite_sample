<!DOCTYPE html>
<html>
  <head>
    <?php
            echo @$data['header'];
            echo $this->h->css('public/css/default-less.css');
            ?>
  </head>
  <body>
    <div class="mainbody">
      <div id="topHeader">
        <?php echo @$data['title']; ?>
      </div>
      <div class="navcontainer">
        <div class="topnav">
          <ul id="liMenu">
            <?php echo @$data['top']; ?>
          </ul>
        </div>
        <?php echo @$data['before_body']; ?>
      </div>
      <div class="main-content">
        <?php echo $this->doBody(); ?>
      </div>
      <div class="footerholder">
        <div class="navcontainer">
          <div class="bottomnav">
            <ul id="liMenu">
              <?php echo @$data['footer']; ?>
            </ul>
          </div>
        </div>
        <div class="footer">
          <?php echo @$data['after_footer']; ?>
        </div>
      </div>
    </div>
    <?php echo @$data['loadjs']; ?>
  </body>
</html>
