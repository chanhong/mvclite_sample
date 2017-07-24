<?php
$buff="";
foreach (@$data['javascripts'] as $script) {
    $buff .= $this->h->jsSrc($this->publicFolder . '/' .$script);
}
echo $buff;
