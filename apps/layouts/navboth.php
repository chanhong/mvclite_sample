<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        echo @$data['header_bef'];        
        echo $this->h->css($this->publicFolder . '/' .'css/bootstrap.css');
        echo $this->h->css($this->publicFolder . '/' .'css/sticky-footer-navbar.css');
    echo @$data['header_aft'];                
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
                </div><!--/.nav-collapse -->
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
                </div><!--/.nav-collapse -->
            </div> 
            <div>
                  <?php echo @$data['footer_aft']; ?>
            </div>                 
        </div>
                <?php echo @$data['loadjs']; ?>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="public/js/html5shiv.js"></script>
        <script src="public/js/respond.min.js"></script>
        <![endif]-->  
    </body>
</html>
