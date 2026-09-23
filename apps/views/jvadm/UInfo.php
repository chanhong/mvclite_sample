<?php
use MvcLite\CCore;
$PageData["Title"] = "UInfo";
$viewPath = CSetting::get("viewpath") ?? "";
$routePath = CSetting::get("_rp") ?? "";
$viewFile = rtrim($viewPath, "/\\") . DIRECTORY_SEPARATOR . $routePath . DIRECTORY_SEPARATOR . "UInfo.php";
if (is_file($viewFile)) {
    include $viewFile;
}
?>