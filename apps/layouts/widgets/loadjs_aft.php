<?php
$buff = "<br />";
foreach (@$data['after'] as $script) {
    $buff .= $this->h->jsSrc($script);
}
echo $buff;
