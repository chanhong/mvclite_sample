<?php
use MvcLite\CCore;
  $PageData["Title"] = "JvLog Purge";
  $meqs = $PageData["meqs"] ?? "";
  //  CMsg::_pdmsg(PageData["meqs"], "meqs");
?>
  <?= CHtml::FrmBeg($meqs) ?>
  <input type="hidden" size=3 name="datebeg" value="<?= htmlspecialchars($PageData["datebeg"] ?? "") ?>" />
  <input type="hidden" size=3 name="dateend" value="<?= htmlspecialchars($PageData["dateend"] ?? "") ?>" />
  <input type="hidden" size=3 name="cmd" value="purge" />
  <input type="submit" name="submit" value="Purge listed below!">
  <?= CHtml::FrmEnd($meqs) ?>