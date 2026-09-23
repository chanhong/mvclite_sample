<?php
use MvcLite\CCore;
  //Layout = CUtil::GetLayout("_ejv");
  //  Dictionary<string, object> row;
  $one = array();
  $dbenv = CJv::DbEnv();
  $PageData["Title"] = "JV Edit";
  $iPath = CUtil::imgPath();
  $_qsa = CCore::qs2nvWithDefaultValue();
  //  CMsg::_pdmsg(_qsa, "edit");
  $jvid = $_qsa["p1"];
  //  string approved = _qsa["p3"];
  $tsk = "/jvtpl";
  $mepath = $tsk . "/_edit/";
  $meqs = CUtil::tap($mepath . $jvid);
  $pburl = CUtil::tap($tsk . "/index/" . $jvid);
  CMsg::_pdmsg($_qsa, "qs_pb");
  // start a clean flag per jv
  CCore::$_eflag = array(
        "dbcr"   => "",
        "sumamt" => "",
  );
  $approvalButton = "";
  $PageData["onejv"] = CJvTpl::GetOneJvInfo($jvid, $dbenv);
  //  PageData["onejv"]["approved"] = approved; // use in __maker
  CJvTpl::PbOrRr(CUtil::MyUrl(), $dbenv); // process Post/Get Request, use index instead of _pb to simplify logic
?>
<div>
  <center>
    @Html.Raw(CHtml.FrmBeg(meqs))
    <table class="jvtable">
      <tbody>
        <tr class="jvtable">
          <td class="jvheader" colspan="2">
            <font size=+2>@CSetting::get(("uwjv")</font>
            <br><b>JV Title *:</b>&nbsp;&nbsp;
            <input type="text" name="title" size=35 value="@PageData["onejv"]["title"]">
          </td>
        </tr>
        <tr class="jvtable">
          <td class="jvtable" width="60%">
            include("_r_/imailto.cshtml")
          </td>
          <td class="jvtable" width="40%">
            include("_r_/imaker.cshtml")
          </td>
        </tr>
        <tr class="jvtable">
          <td class="jvtable" colspan="2">
            include("_r_/idetail.cshtml")
          </td>
        </tr>
        <tr class="jvExplanation">
          <td class="jvExplanation" colspan="2">
            include("_r_/iexplain.cshtml")
          </td>
        </tr>
      </tbody>
    </table>
    <input type="hidden" id="cmd" name="cmd" value="updjvt" />
    <input type="hidden" id="jvid" name="jvid" value="@jvid" />
    <input type="submit" name="submit" value="SAVE ALL CHANGES">
    @{ // must be here to get the correct value
      CMsg::_pdmsg(PageData["onejv"], "onejv");
      //     <input type="submit" name="submit" value="SAVE ALL CHANGES">&nbsp;&nbsp;<INPUT TYPE="BUTTON" VALUE="Assign a JV Number then Send to JV approver" ONCLICK="window.location.href='?t=jvtpl&a=_edit&p1=3110&c=toapprover'">
      approvalButton = CJvTpl::Show2ApproverButton(PageData["onejv"]);  // pass entire jv record including jvid and prep_date
      CMsg::_pdmsg(CCore::$_eflag, "eflag");
      //      CMsg::_pdmsg(approvalButton, "approvalButton");
    }
    @Html.Raw(approvalButton)
    @Html.Raw(CHtml.FrmEnd(meqs))
  </center>
</div>