<?php

$buff = "";
$home = $this->h->alink(array(
    'title' => 'Home',
    'path' => '/'));

$buff = <<<code
<li class="active">
code
        . $home
        . $this->h->getLiMenu(BaseCore::$_cfg['menu']['main'])
        ;
echo $buff;