<?php
use MvcLite\CCore;
use MvcLite\CHtml;

$tblcls = "jvtable";

$hdrMsg = "";
$rows = [];

// Layout = CUtil::GetLayout("_bootstrap_top");
$PageData["Title"] = "PC older then 5 yrs List";
$hdrMsg = sprintf("<H2>List of PC %s yrs older</H2>", "5");

$dbenv = CCore::_DbEnv("dbitinvt");
$clsName = [
    "tcls" => $tblcls,
    "rcls" => "screen"
];
$fName = [
    "DiffYrs" => ["Yrs", ""],
    "ComputerName" => ["", ""],
    "Subnet" => ["", ""],
    "Description" => ["", ""],
    "Model" => ["", ""],
    "UserID" => ["", ""],
    "OS_Arch" => ["", ""],
    "OS" => ["", ""],
    "ImageType" => ["", ""],
    "DeployedDate" => ["Deployed<br />Date", ""],
    "Location" => ["", ""]
];
$rows = CFbsQ::getPCGt5YrsRows($dbenv);
?>

<div>
  <div>
    <?php echo $hdrMsg; ?>
  </div>
  <div align="center">
    <p />
    <table class="jvtable">
      <tbody>
        <?php echo CHtml::OutTblRows($fName, $rows, $clsName); ?>
      </tbody>
    </table>
  </div>
</div>