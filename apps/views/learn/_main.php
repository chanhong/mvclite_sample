<?php

use MvcLite\CCore;
// =============================================
// PHP version of your Razor layout/content page
// =============================================

// Set the layout (equivalent to Layout = ... in Razor)
// $layout = CUtil::GetLayout("_bootstrap"); // not exist

// Optional: Set default title if not already set
if (empty($pageTitle)) {
    $pageTitle = "Learn";
}

// If the title is same as App Name, change it to "Learn"
if (!empty($pageTitle) && $pageTitle === CSetting::get("Name")) {
    $pageTitle = "Learn";
}
?>

<!-- HTML Content -->
<font color="LightGrey" face="helvetica, sans-serif" size="6">
    <?= htmlspecialchars($pageTitle) ?>
</font>

<h2>Learn CSharp, Razor, and Javascript.</h2>