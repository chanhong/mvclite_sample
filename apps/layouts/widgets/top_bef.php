<?php
$menu = "";

if (!empty($pageData['cmenu'])){
    $menu = $pageData['cmenu'];
}

$buff = <<<code
<p />
<div class="hmenu">
    <ul id="liMenu">  
code
        . $menu
        . <<<code
    </ul></div>
code
;
echo $buff;
