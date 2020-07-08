<?php

$buff = "";

foreach (@$data['meta'] as $meta) {
    $buff .= $this->h->meta($meta);
}
if ($data['title']!="") {
        $buff .= $this->h->tag("title", $data['title']);
}
echo $buff;
