<?php

use MvcLite\CCore;
use MvcLite\CHtml;
use MvcLite\CJv;
use MvcLite\CJvInq;
use MvcLite\CUtil;

$PageData["Title"] = "JV Search";
$meqs = CUtil::tap("/jvinq/jv_search");
$query = "";
$rows = [];
$isPost = (($_SERVER["REQUEST_METHOD"] ?? "GET") === "POST");

if ($isPost) {
    $query = CUtil::getSafeVar($_POST, "q", "raw");
    $rows = CJvInq::JvSearch($query, CJv::DbEnv());
    CCore::$_rows = $rows;
}
?>

<div class="jvbody">
    <div class="jvContent">
        <table class="jvtable">
            <tbody>
                <tr class="jvtable">
                    <td class="jvtable" colspan="9" align="center">
                        <?= CHtml::FrmBeg($meqs) ?>
                        <input
                            type="text"
                            name="q"
                            value="<?= htmlspecialchars($query, ENT_QUOTES, "UTF-8") ?>"
                            id="q"
                            title="Search by JVNUM, Title, Maker; limit last 30 JVs"
                        >
                        &nbsp;
                        <input type="submit" name="submit" value="Search">
                        <?= CHtml::FrmEnd($meqs) ?>
                    </td>
                </tr>
<?php if ($isPost): ?>
                <tr>
                    <td colspan="9">
                        Search results for
                        <strong><?= htmlspecialchars($query, ENT_QUOTES, "UTF-8") ?></strong>
                    </td>
                </tr>
<?php if ($rows === []): ?>
                <tr>
                    <td colspan="9">No journal vouchers found.</td>
                </tr>
<?php else: ?>
                <tr class="jvtable">
                    <th>ID</th>
                    <th>JVNUM</th>
                    <th>JV Title</th>
                    <th>Prepared by</th>
                    <th>JV Date</th>
                    <th>Biennium<br>Month</th>
                    <th>Mailout</th>
                    <th>Voided</th>
                    <th>JV File</th>
                </tr>
<?php foreach ($rows as $index => $row): ?>
                <tr class="screen<?= (($index + 1) % 2 === 0) ? "even" : "odd" ?>">
                    <td><?= htmlspecialchars((string)($row["log_id"] ?? ""), ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars((string)($row["jvnum"] ?? ""), ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars((string)($row["title"] ?? ""), ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars((string)($row["maker"] ?? ""), ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars((string)($row["jvdate"] ?? ""), ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars((string)($row["acctmo"] ?? ""), ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars((string)($row["ready4mailout"] ?? ""), ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars((string)($row["voided"] ?? ""), ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= CJv::Row2ArchiveHref($row, "htmlfile") ?></td>
                </tr>
<?php endforeach; ?>
<?php endif; ?>
<?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
