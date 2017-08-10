<?php
$cmenu = $submenu = "";
// from controller
if (!empty($data['cmenu'])){
   $cmenu = $data['cmenu'];
}                
if (!empty($data['submenu'])){
    $submenu = $data['submenu'];
}                

$buff = <<<code
<ul class="nav nav-sidebar">
<li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
</ul>
<ul class="nav nav-sidebar">
code
. $cmenu
. <<<code
</ul>
<ul class="nav nav-sidebar">
code
. $submenu
. <<<code
</ul>
code
;
echo $buff;