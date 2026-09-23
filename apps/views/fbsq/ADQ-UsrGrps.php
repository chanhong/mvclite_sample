<?php
use MvcLite\CCore;
use MvcLite\CUtil;
use MvcLite\CFbsQ;
use MvcLite\CHtml;


$seljvt = "";
$filterN = "";
$hdrMsg = "";
$rows = [];

// Layout = CUtil::GetLayout("_bootstrap_top");
$PageData["Title"] = "ADQuery User's Groups List";
$dbenv = CCore::_DbEnv("dbadq");
$meqs = CUtil::tap("/fbsq/ADQ-UsrGrps");

$tblcls = "jvtable";
$clsName = [
    "tcls" => $tblcls,
    "rcls" => "screen"
];
$fName = [
    // "fldname", "fldhdr", "fldformat"
    "cn" => [",", "left"],
    "description" => [",", "left"]
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filterN = CUtil::getSafeVar($_REQUEST, "user", "raw");
    // CMsg::_pdmsg(filterN,"users");
    $hdrMsg = sprintf("<H2>List of %s' groups</H2>", $filterN);
    $rows = CFbsQ::getADQUsersRows($filterN, $dbenv);
}

$seljvt = CHtml::dropDnList("user", CFbsQ::getADQUsersList($dbenv), $filterN);
?>

<div>
  <div>
    <?php echo $hdrMsg; ?>
  </div>
  <div align="center">
    <?php echo CHtml::FrmBeg($meqs); ?>
    Filter by:&nbsp;&nbsp; <?php echo $seljvt; ?>
    <input type="submit" name="submit" value="Go">
    <?php echo CHtml::FrmEnd($meqs); ?>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
      <table>
        <tbody>
          <?php echo CHtml::OutTblRows($fName, $rows, $clsName); ?>
        </tbody>
      </table>
    <?php } ?>
  </div>
</div>