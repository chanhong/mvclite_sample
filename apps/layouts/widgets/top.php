<?php
$buff = <<<code
<!-- htmnl go here -->

code
// render right here since main menu is same for all controller
    . $this->getLiMenu(BaseCore::$_cfg['menu']['main'])
    ;
echo $buff;