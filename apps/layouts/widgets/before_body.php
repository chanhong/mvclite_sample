<?php
$menu = "";

if (!empty($data['menu'])){
    $menu = $data['menu'];
}

$buff = <<<code
<p />
<div class="hmenu">
    <ul id="liMenu">  
code
        . $menu
        . <<<code
    </ul>
</div>
code;
echo $buff;
