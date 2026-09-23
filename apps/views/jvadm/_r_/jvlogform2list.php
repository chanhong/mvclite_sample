<?php
use MvcLite\CCore;
  $PageData["Title"] = "JvLog List";
  $meqs = $PageData["meqs"] ?? "";
  //  CMsg::_pdmsg(PageData["meqs"], "meqs");
?>
<script type="text/javascript">
        $(document).ready(function () {
          $("#datebeg").kendoDatePicker();
          $("#dateend").kendoDatePicker();
        });
</script>
<?= CHtml::FrmBeg($meqs) ?>
  Retention Years:
<input class="txtReadOnly" type="text" size=3 name="retention" value="<?= htmlspecialchars($PageData["retentionyrs"] ?? "") ?>" READONLY />
  Begin Date:
<input type="text" title="Pick begin date"
      id="datebeg" name="datebeg" size=10 maxlength="10" value="<?= htmlspecialchars($PageData["datebeg"] ?? "") ?>">
  End Date:
<input type="text" title="Pick end date"
      id="dateend" name="dateend" size=10 maxlength="10" value="<?= htmlspecialchars($PageData["dateend"] ?? "") ?>">
<input type="hidden" size=3 name="cmd" value="list" />
<input type="submit" name="submit" value="List">
<?= CHtml::FrmEnd($meqs) ?>