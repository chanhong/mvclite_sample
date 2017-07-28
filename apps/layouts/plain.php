<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        echo @$data['header_bef'];
        echo $this->h->css($this->publicFolder . '/' .'css/bootstrap.min.css');
        echo $this->h->css($this->publicFolder . '/' .'css/bootstrap-custom.css');
        echo @$data['header_aft'];               
        ?>      
    </head>
    <body>
        <?php echo $this->doBodyNoLayout(); ?>
    </body>
</html>