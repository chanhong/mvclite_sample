<?php
$submenu = "";
// from controller
if (!empty($pageData['submenu'])){
    $submenu = $pageData['submenu'];
}                


$buff = <<<code
<p />
<div class="vmenu">
<ul class="nav navbar-nav">
code
. $submenu
. <<<code
</ul>
</div>
code
;
echo $buff;