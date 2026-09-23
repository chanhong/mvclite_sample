<?php
use MvcLite\CCore;

$PageData["Title"] = "Main Page";
$dbinfo = CJv::DbEnv();
$usrname = CCore::GetUsrName();
$usrname = CJv::getJvUsrname($usrname, $dbinfo); // let default to winuser
?>

<div align="center">
    <?php if (CJv::JvIsAuthorized($usrname, $dbinfo) && !CString::IsEmpty($usrname)): ?>
        <span>
            <h2>UW Medicine Electronic Journal Voucher</h2>
            <p>
                JV Inquiry menu item is for JV Searching and JV Archive lookup
            </p>
            <p>
                JV Templates menu item is for creating a new JV from the templates
            </p>
            <p>
                JV Approver menu item is for approving completed JV
            </p>
        </span>
    <?php elseif (CJv::JVIsNotAuthorized($usrname, $dbinfo) === true): ?>
        <?php CMsg::_pdmsg($usrname, "usrname-b"); ?>
        <?php $usrname = (CString::IsEmpty($usrname)) ? CSecs::winUser() : $usrname; ?>
        <H1><?= htmlspecialchars($usrname) ?>, you are not authorized!</H1>
    <?php endif; ?>
    <img src="apps/images/ejv.png" height="200" width="600"><p>
</div>