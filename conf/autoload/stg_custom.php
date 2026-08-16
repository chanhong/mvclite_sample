<?php

/**
 * cfg.php — Application configuration.
 *
 * Returns a plain PHP array that index.php passes directly to CConfig:
 *
 *   $container->singleton('cfg', fn() =>
 *       new \MvcLite\CConfig(require DOCROOT . '/conf/cfg.php')
 *   );
 *
 * Nothing is assigned to a static variable here.  All consumers should
 * retrieve the CConfig instance from the DI container and use dot-notation:
 *
 *   $cfg->get('info.emailfrom');
 *   $cfg->get('folder.app');
 *   $cfg->get('levels.admin');
 *
 * -------------------------------------------------------------------------
 * LEGACY BRIDGE
 * During migration, index.php syncs the built array back to CConfig::$_cfg
 * so any code still using CConfig::$_cfg['key'] keeps working unchanged.
 * Remove that sync line once all call-sites are updated.
 * -------------------------------------------------------------------------
 *
 * global.php / bootstrap.php must load before this file.
 *
 * @author chanhong
 */

namespace MvcLite;

use MvcLite\CUtil;

$r = [
    // -----------------------------------------------------------------------
    // custom settings
    // -----------------------------------------------------------------------


    "logo" => "logo.gif",
    "Title" => "University of Washington Medical Center Accounting",
    "Name" => "Dept Name",
    "smtp" => "smtp.net",
    "emailfrom" => "email@email.com",
    "ITContact" => "email@email.com",
    "subjprf" => "[eNET]",
    "retentionyrs" => "6",
    "allowedext" => "txt,rtf,pdf,doc,docx,xls,xlsx",
    "maxfilesize" => "2048",
    "maxupload" => "6",

    "archivepath" => "//abc/data/rchive/archive",
    "oldarchivepath" => "//cde/share$/archive",
    "archive" => "", // set in CUtils.getEnv()
    "oldarchive" => "", // set in CUtils.getEnv()
    "archivetype" => "pdf",
    "textfiles" => "textfiles",
    "support_docs" => "_support_docs",
    "uwjv" => "J-VOUCHER",

    "toUserTxt" => "The Journal Voucher number is {0}\n\n"
        . "The JV has been sent to the email account for JV approvers. Copy of the approved JV "
        . "will be emailed to you and to the departments involved the JV has been submitted and accepted via FASTRAN."
        . "\n\nPlease, file your pre-approve JV with its backup in the JV binder"
        . " or send electronic version to {1} if you are external JV preparer.",
    "toApproverTxt" => "Click {0} to login to see a list of JV's not yet approved or ftp'd or submitted for processing.",
    "toAdminTxt" => "From email: {0} \r\nSend by JV form.",
    "acctConfirmTxt" => "Please click on this link to confirm to the eJV System"
        . " that you are the person approved for the account: {0}\n\n"
        . "Once confirmed, a temporary password will be sent to you and"
        . " you should change your password to one that only you know.\n\nThanks",
    "hash" => "GeorgeWashingtongrewhemp",
    "JVUserOffline" => "",
    "JVApproverOffline" => "",
    "OfflineMsg" => "Announcement: The system will be offline due maintenance until further notice.",
/*
// dup    'apps' => 'ajws,front,learn,pages,spage',   // comma-separated app list like appstart
    // -----------------------------------------------------------------------
    // Defaults / active-dispatch placeholders (overwritten at runtime)
    // -----------------------------------------------------------------------
// dup in stg.php
//     'defctrl' => 'learn', // front, learn
//     'selctl' => '',            // populated by setActiveCtrl() each request
//     'defview' => "index",
//    'viewext' => '.php',
//    'deflayout' => 'default',
//    'login' => '_login',     // login action name _ prefix to exclude dynamic menu
//    'urllogin' => '', // too early CUtil::setLoginUrl(),          // built at runtime: /selctl/login
//    'urllogout' => CUtil::tap('/action/logout'),
//    'logoff' => '',   // usrname to force logoff        
//    'viewpath' => '', // set in constructor of CController to app/view
    '404' => "Error",
    'siteroot' => CUtil::rootSite(),
    'urlsite' => CUtil::siteURL(),
*/

];

//print ("<pre>R: " . print_r($r, true) . "</pre>");
//print ("<pre>shared: " . print_r(CUtil::csShared(), true) . "</pre>");
//return array_merge($r, $r2);
return $r;
