<?php

$buff = "";

foreach (@$data['meta'] as $meta) {
    $buff .= $this->h->meta($meta);
}
foreach (@$data['pagetitle'] as $title) {
    $buff .= $this->h->tag("title", $title);
}
foreach (@$data['styleless'] as $styleless) {
    $buff .= $this->h->less($this->publicFolder . '/' . $styleless);
}
foreach (@$data['stylesheets'] as $stylesheet) {
    $buff .= $this->h->css($this->publicFolder . '/' . $stylesheet);
}
echo $buff;
