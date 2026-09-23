<?php
use MvcLite\CCore;
  $this->title = "Maker";
  $dbenv = CJv::DbEnv();
  $onejv = $PageData["onejv"];
  $jvInfo = CJv::GetJVnumInfo($onejv["jvid"], $onejv["title"], $onejv["logid"]);
  $acctmo = CJv::GetAcctMo($dbenv);
  $flag = CJvTpl::FlagRed($acctmo, "acctmo");
  CCore::$_uprf = CUtil::getSessNv("uinfo");

  /*
  CMsg::_pdmsg(onejv, "onejv");
  CMsg::_pdmsg(jvInfo, "jvInfo");
  */
?>
<table class="jvtable">
  <tbody>
    <tr class="jvcolhdr">
      <td class="jvtable" colspan="2"><b>JV NUMBER:</b></td>
      <td class="jvtable"><?php echo $jvInfo["jvnum"]; ?></td>
    </tr>
    <tr class="jvcolhdr">
      <td class="jvtable" colspan="2"><b>JV DATE:</b></td>
      <td class="jvtable"><?php echo $jvInfo["jvdate"]; ?></td>
    </tr>
    <tr class="jvtable">
      <td class="jvtable" align="right">Department:</td>
      <td class="jvtable"><?php echo CCore::$_uprf["apventity"]; ?></td>
      <td class="jvtable" <?php echo $flag; ?>>
        Biennium Month: &nbsp;&nbsp;<?php echo $acctmo; ?>
      </td>
    </tr>
    <tr class="jvtable">
      <td class="jvtable" align="right">Preparer:<br>Phone:</td>
      <td class="jvtable">
        <?php echo $onejv["maker"]; ?>
        <br><?php echo $onejv["phone"]; ?>
      </td>
      <td class="jvtable" colspan="1">Transaction Code <font size="+3">35</font></td>
    </tr>
    <tr class="jvtable">
      <td class="jvtable" align="right">Authorized By:</td>
      <td class="jvtable" align="left" colspan="2"><?php echo $jvInfo["super"]; ?></td>
    </tr>
  </tbody>
</table>
