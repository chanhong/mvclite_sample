<?php
// for the controller to append to override css in layout
$buff = "<br >";

foreach (@$data['cssaft'] as $stylesheet) {
    $buff .= $this->h->css($this->publicFolder . '/' . $stylesheet);
}
echo $buff;
