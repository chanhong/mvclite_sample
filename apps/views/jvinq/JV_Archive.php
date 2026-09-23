<?php

use MvcLite\CCore;
use MvcLite\CHtml;
use MvcLite\CJv;
use MvcLite\CJvInq;
use MvcLite\CUtil;

$PageData["Title"] = "JV Log Archive Lookup";
$meqs = CUtil::tap("/jvinq/jv_archive");
$isPost = (($_SERVER["REQUEST_METHOD"] ?? "GET") === "POST");
$dateBeg = CUtil::getSafeVar($_POST, "datebeg", "raw");
$dateEnd = CUtil::getSafeVar($_POST, "dateend", "raw");
$showJustMyJv = CUtil::getSafeVar($_POST, "showjustmyjv", "raw");

if ($dateBeg === "" || $dateEnd === "") {
    $last7days = CJvInq::Last7Days();
    $dateBeg = $last7days["datebeg"];
    $dateEnd = $last7days["dateend"];
}

$rows = [];
if ($isPost) {
    $rows = CJvInq::JvLogInDateRange(
        $dateBeg,
        $dateEnd,
        $showJustMyJv,
        CJv::DbEnv()
    );
    CCore::$_rows = $rows;
}
?>

<div class="jvbody">
    <div class="jvContent">
        <script type="text/javascript">
            $(document).ready(function () {
                $("#datebeg").kendoDatePicker();
                $("#dateend").kendoDatePicker();
            });
        </script>
        <table class="jvtable">
            <tbody>
                <tr>
                    <td colspan="9" align="center">
                        <?= CHtml::FrmBeg($meqs) ?>
                        <input type="hidden" name="daysnum" value="1">
                        <input type="hidden" name="pdatebeg" value="<?= htmlspecialchars($dateBeg, ENT_QUOTES, "UTF-8") ?>">
                        <input type="hidden" name="pdateend" value="<?= htmlspecialchars($dateEnd, ENT_QUOTES, "UTF-8") ?>">
                        Begin Date:
                        <input
                            type="text"
                            title="Pick begin date"
                            id="datebeg"
                            name="datebeg"
                            size="10"
                            maxlength="10"
                            value="<?= htmlspecialchars($dateBeg, ENT_QUOTES, "UTF-8") ?>"
                        >
                        End Date:
                        <input
                            type="text"
                            title="Pick end date"
                            id="dateend"
                            name="dateend"
                            size="10"
                            maxlength="10"
                            value="<?= htmlspecialchars($dateEnd, ENT_QUOTES, "UTF-8") ?>"
                        >
                        <label>
                            <input
                                type="checkbox"
                                name="showjustmyjv"
                                title="Check to show just my JV"
                                value="yes"
                                <?= $showJustMyJv === "yes" ? "checked" : "" ?>
                            >
                            Show just my JV
                        </label>
                        &nbsp;&nbsp;
                        <input type="submit" name="submit" value="Go">
                        <?= CHtml::FrmEnd($meqs) ?>
                    </td>
                </tr>
<?php if ($isPost): ?>
                <tr>
                    <td colspan="9">
                        Journal Vouchers Log between
                        <?= htmlspecialchars($dateBeg, ENT_QUOTES, "UTF-8") ?>
                        and
                        <?= htmlspecialchars($dateEnd, ENT_QUOTES, "UTF-8") ?>
                    </td>
                </tr>
<?php if ($rows === []): ?>
                <tr>
                    <td colspan="9">No journal vouchers found.</td>
                </tr>
<?php else: ?>
<?php
    $fName = [
        "log_id" => "ID,",
        "jvnum" => "JVNUM,",
        "title" => "JV Title,left",
        "maker" => "Prepared by,",
        "jvdate" => "JV Date,",
        "acctmo" => "Biennium<br />Month,",
        "ready4mailout" => "Mailout,",
        "voided" => "Voided,",
        "htmlfile" => "JV File,",
    ];
?>
                <tr class="jvtable">
<?php foreach ($fName as $field => $header): ?>
<?php $headerParts = explode(",", $header, 2); ?>
                    <th><?= $headerParts[0] !== "" ? $headerParts[0] : htmlspecialchars($field, ENT_QUOTES, "UTF-8") ?></th>
<?php endforeach; ?>
                </tr>
<?php foreach ($rows as $index => $row): ?>
                <tr class="screen<?= (($index + 1) % 2 === 0) ? "even" : "odd" ?>">
<?php foreach ($fName as $field => $header): ?>
<?php $headerParts = explode(",", $header, 2); $align = $headerParts[1] ?? "center"; ?>
                    <td align="<?= htmlspecialchars($align, ENT_QUOTES, "UTF-8") ?>">
<?php if ($field === "htmlfile"): ?>
                        <?= CJv::Row2ArchiveHref($row, "htmlfile") ?>
<?php else: ?>
                        <?= htmlspecialchars((string)($row[$field] ?? ""), ENT_QUOTES, "UTF-8") ?>
<?php endif; ?>
                    </td>
<?php endforeach; ?>
                </tr>
<?php endforeach; ?>
<?php endif; ?>
<?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
