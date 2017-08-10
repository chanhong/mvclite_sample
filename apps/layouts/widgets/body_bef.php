<?php
$menu = $submenu = "";

if (!empty($data['cmenu'])){
    $menu = $data['cmenu'];
}

if (!empty($data['submenu'])){
    $submenu = $data['submenu'];
}

$buff = <<<code
<p />
<div class="hmenu">
    <ul id="liMenu">  
code
        . $menu
        . <<<code
    </ul></div>
        <div>
          <ul class="nav navbar-nav navbar-right">    
code
        . $submenu
        . <<<code
    </ul>
</div>
code
;
echo $buff;
