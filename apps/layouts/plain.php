<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        echo $this->h->css($this->publicFolder . '/' .'css/bootstrap-less.css');
        echo $this->h->css($this->publicFolder . '/' .'css/bootstrap-custom.css');
        ?>      
    </head>
    <body>
        <?php echo $this->doBodyNoLayout(); ?>
    </body>
</html>