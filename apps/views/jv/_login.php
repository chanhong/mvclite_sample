<?php
use MvcLite\CCore;

$dbinfo = CJv::DbEnv();

CJv::setUsersInfo($dbinfo); // MUST set JV Users info in case redirected to login

$PageData["app"] = "jv";

if (@$PageData["Title"] === CSetting::get("Name")) {
    $PageData["Title"] = "Login";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (CCore::_Login($_POST) === true) {
        $rUrl = CUtil::getReturnUrl();
        CMsg::_dmsg($rUrl, "login");
        CJv::setUserProfile($dbinfo); // always attempt to set profile
        CMsg::_dmsg(CCore::$_usr, "login");
        CUtil::Redirect($rUrl); // must do it this way to have a chance to set profile before redirect
    } else {
        CCore::ClearUser();
    }
}
?>

<div id="main" align="center">
    <?php if (CSecs::IsNotAuthorized() === true): ?>
        <span>
            <H1>You are not authorized!</H1>
        </span>
    <?php else: ?>
        <?php if (CSecs::isIntrgUser() === true): ?>
            <?php $PageData["selentities"] = CJv::getUserEntities4DropdownList(""); ?>
            <?php include(CSetting::get("viewpath") . "/" . CSetting::get("_rp") . "/loginWin.php"); ?>
        <?php endif; ?>

        <?php if (CSecs::IsWebloginAllowed() === true): ?>
            <?php $aList = CUtil::Str2a('|', "HMC|UWMC|DEV|TEST"); ?>
            <?php $PageData["selentities"] = CJv::getEntitiesDropdownList($aList, "DEV"); ?>
            <?php include(CSetting::get("viewpath") . "/" . CSetting::get("_rp") . "/loginWeb.php"); ?>
        <?php endif; ?>
    <?php endif; ?>
</div>