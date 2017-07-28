<?php

$buff = "";

foreach (@$data['meta'] as $meta) {
    $buff .= $this->h->meta($meta);
}
foreach (@$data['title'] as $title) {
    $buff .= $this->h->tag("title", $title);
}
foreach (@$data['less'] as $styleless) {
    $buff .= $this->h->less($this->publicFolder . '/' . $styleless);
}
foreach (@$data['cssbef'] as $stylesheet) {
    $buff .= $this->h->css($this->publicFolder . '/' . $stylesheet);
}
echo $buff;
