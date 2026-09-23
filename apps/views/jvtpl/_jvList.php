<?php

use MvcLite\CCore;
use MvcLite\CHtml;
use MvcLite\CJv;
use MvcLite\CJvTpl;
use MvcLite\CUtil;

$PageData["Title"] = "JV Template";
$dbenv = CJv::DbEnv();
$tsk = "jvtpl";
$mepath = "/{$tsk}/index/";
$meqs = CUtil::tap($mepath);
$iPath = CUtil::imgPath();
$makerName = CUtil::getSessTxt("name");
$filterMaker = CUtil::getSafeVar($_POST, "maker", "raw");
if ($filterMaker === "") {
    $filterMaker = $makerName;
}

$makers = CJv::getJVListMakers($dbenv);
$rows = CJvTpl::GetJVListOfMakerByNameWithStatus($filterMaker, $dbenv);
CCore::$_uprf = CUtil::getSessNv("uinfo");
$userGroup = (string)(CCore::$_uprf["jvgroup"] ?? "");

$fName = [
    "approved" => "Approved,",
    "mailed2depts" => "Mailed,",
    "jvid" => "JVID,",
    "super" => "Approver,",
    "title" => "JV Title,left",
];
?>

<div>
    <div>List of JV templates</div>
    <div align="center">
        Note: JV with approved = P can be viewed to upload supporting documents
        <p></p>

        <?= CHtml::FrmBeg(CUtil::tap("/jvtpl/_jvlist")) ?>
        Filter by:&nbsp;&nbsp;
        <?= CHtml::dropDnList("maker", $makers, $filterMaker) ?>
        <input type="submit" name="submit" value="Go">
        <?= CHtml::FrmEnd($meqs) ?>

        <table class="jvList">
            <tr>
                <th class="jvtable" width="10%" align="center">
                    Action&nbsp;&nbsp;
                    <?= CHtml::alink([
                        "img" => $iPath . "/add.png",
                        "title" => "Create",
                        "href" => CUtil::tap("/{$tsk}/_edit/", "createjv"),
                    ]) ?>
                </th>
<?php foreach ($fName as $field => $header): ?>
<?php $headerParts = explode(",", $header, 2); ?>
                <th class="jvtable"><?= $headerParts[0] !== "" ? $headerParts[0] : htmlspecialchars($field, ENT_QUOTES, "UTF-8") ?></th>
<?php endforeach; ?>
            </tr>

<?php foreach ($rows as $index => $row): ?>
<?php
    $title = CCore::cleanStr((string)($row["title"] ?? ""), "dec4vw");
    $jvid = (string)($row["jvid"] ?? "");
    $logid = (string)($row["log_id"] ?? "");
    $approved = (string)($row["approved"] ?? "");
    $mailed = (string)($row["mailed2depts"] ?? "");
    $delUrl = CUtil::tap($mepath . $jvid, "delete");
    $cloneUrl = CUtil::tap($mepath . $jvid, "clone");
    $editUrl = CUtil::tap("/{$tsk}/_edit/{$jvid}/{$logid}/" . rawurlencode($title));
    $editImage = "info.png";
    $deleteTitle = "Delete";
    $editTitle = "Edit";
    $canEdit = ($filterMaker === $makerName && $userGroup !== "");

    if (!$canEdit) {
        $delUrl = $editUrl = "";
        $deleteTitle = "Delete DISABLED";
        $editTitle = "Edit DISABLED";
    }

    if ($logid !== "" && $approved === "P" && $mailed === "N") {
        $delUrl = "";
        $deleteTitle = "Delete DISABLED";
        $editTitle = "View";
        $editUrl = CUtil::tap("/{$tsk}/_view/{$jvid}/{$logid}/" . rawurlencode($title));
        $editImage = "lock.png";
    } elseif ($logid !== "" && $approved === "Y" && $mailed === "N") {
        $delUrl = $editUrl = "";
        $deleteTitle = $editTitle = "DISABLED-Pending mail-out";
    }
?>
            <tr class="screen<?= (($index + 1) % 2 === 0) ? "even" : "odd" ?>">
                <td align="center">
                    <?= CHtml::alink([
                        "img" => $iPath . "/remove.png",
                        "title" => $deleteTitle,
                        "href" => $delUrl,
                        "confirm" => $delUrl !== "" ? "Y" : "",
                    ]) ?>
                    &nbsp;&nbsp;
                    <?= CHtml::alink([
                        "img" => $iPath . "/smile.png",
                        "title" => "Clone",
                        "href" => $cloneUrl,
                    ]) ?>
                    &nbsp;&nbsp;
                    <?= CHtml::alink([
                        "img" => $iPath . "/" . $editImage,
                        "title" => $editTitle,
                        "href" => $editUrl,
                    ]) ?>
                </td>
<?php foreach ($fName as $field => $header): ?>
<?php $headerParts = explode(",", $header, 2); $align = $headerParts[1] ?? "center"; ?>
                <td align="<?= htmlspecialchars($align, ENT_QUOTES, "UTF-8") ?>">
                    <?= htmlspecialchars((string)($field === "title" ? $title : ($row[$field] ?? "")), ENT_QUOTES, "UTF-8") ?>
                </td>
<?php endforeach; ?>
            </tr>
<?php endforeach; ?>
        </table>
    </div>
</div>
