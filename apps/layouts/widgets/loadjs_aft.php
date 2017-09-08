<?php
$buff = "<br />";
foreach (@$data['jsaft'] as $script) {
    $buff .= $this->h->jsSrc($script);
}
echo $buff;
