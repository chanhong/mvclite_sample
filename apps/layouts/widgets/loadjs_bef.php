<?php
$buff = "<br />";
foreach (@$data['jsbef'] as $script) {
    $buff .= $this->h->jsSrc($script);
}
echo $buff;
