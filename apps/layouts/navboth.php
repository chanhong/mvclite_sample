<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        echo @$data['header_bef'];        
        echo $this->h->css($this->publicFolder . '/' .'css/bootstrap.css');
        echo $this->h->css($this->publicFolder . '/' .'css/sticky-footer-navbar.css');
        echo @$data['header_aft']; 
        echo @$data['loadjs_bef'];           
        ?>
</head>

<body>
    <!-- Wrap all page content here -->
    <div id="wrap">
        <div id="topHeader">
            <?php echo @$data['header_title']; ?>
        </div>
        <!-- Fixed navbar -->
        <div class="navbar navbar-default" role="navigation">
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php echo @$data['top']; ?>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
        <?php echo @$data['body_bef']; ?>
        <!-- Begin page content -->
        <div class="containerex">
            <?php echo $this->doBody(); ?>
        </div>
    </div>
    <div id="footer">
        <div class="navbar navbar-default" role="navigation">
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php echo @$data['footer_bef']; ?>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
        <div>
            <?php echo @$data['footer_aft']; ?>
        </div>
    </div>
    <?php echo @$data['loadjs_aft']; ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</body>

</html>