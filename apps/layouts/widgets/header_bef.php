<?php

$buff = "";
$pmeta=$pageData['meta']??[];
foreach ($pmeta as $meta) {
    $buff .= $this->h->meta($meta);
}
if (isset($pageData['title']) && $pageData['title']!="") {
        $buff .= $this->h->tag("title", $pageData['title'])??'';
}
echo $buff;
