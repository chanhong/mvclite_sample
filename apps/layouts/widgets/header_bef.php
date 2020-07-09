<?php

$buff = "";

foreach (@$pageData['meta'] as $meta) {
    $buff .= $this->h->meta($meta);
}
if ($pageData['title']!="") {
        $buff .= $this->h->tag("title", $pageData['title']);
}
echo $buff;
