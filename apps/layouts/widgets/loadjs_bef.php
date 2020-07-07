<?php
$buff = "<br />";
foreach (@$data['before'] as $script) {
    $buff .= $this->h->jsSrc($script);
}
echo $buff;
