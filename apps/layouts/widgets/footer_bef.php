<?php

$buff = "";
$dashboardURL = $this->h->alink(array(
    'title' => 'Dashboard',
    'path' => '/dashboard/index'));

$home = $this->h->alink(array(
    'title' => 'Home',
    'path' => '/'));

$buff = <<<code
<li class="active">$home</li>
<li>$dashboardURL</li>
code
;
// un-comment line below to turn on footer
echo $buff;

