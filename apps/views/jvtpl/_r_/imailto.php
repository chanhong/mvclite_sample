<?php
use MvcLite\CCore;
  $pageTitle = "Mailto";
  $tsk = "jvtpl";
  $mepath = sprintf("/%s/_edit/", $tsk);  // c use as sub-action such as clone, add, etc
  $iPath = CUtil::imgPath();
  $rows = array();
  $ka = null;
  $stitle = ""; $salign = ""; $slen = ""; $ssize = "";

  $tblcls = "jvtable";
  $linecls = "";

  $fName = array(
              // fldname, fldhdr, fldformat
                  "full_email" => "Full Email *,left,35,28",
                  "person"     => "Dept/Person *,left,30,18",
                  "box_num"    => "Mailstop *,,6,6",
                  "copies"     => "Copy,,,",
                  "attach"     => "Docs?,,,",
              );
  $cnt = 0;
  $_qsa = CCore::qs2nvWithDefaultValue();
  //  CMsg::_pdmsg(_qsa, "mailto");

  $orderby = "";
  $where = "";
  $strQry = "";
  $jvid = $_qsa["p1"];
  $action = $_qsa["a"];
  if (!CString::IsEmpty($jvid)) { // edit or create
    $orderby = " order by sub_id asc";
    $where = sprintf(" where jvid= '%s'", $jvid);
        $strQry = "select distinct * from mailto " . $where . " " . $orderby;
//    strQry = "select * from mailto " + where + " " + orderby; // want all mailto for this jvid
    CMsg::_pdmsg($strQry, "strQry");
    $rows = CDbPdo::oleGetRows($strQry, CJv::DbEnv());
    CMsg::_pdmsg(count($rows), "rows-cnt");
  }
?>
<div>
  @{
    foreach (Dictionary<string, object> r in rows)
    {

    <script type="text/JavaScript">
        $(function () {
                      @Html.Raw(CJv::JsAuto4Email("email", "/udata/_ejvauto", r["sub_id"].ToString())) // require auth
            @Html.Raw(CJv::JsAuto4Name("name", "/odata/_ldapuw", r["sub_id"].ToString())) // not require auth
          });
    </script>
    }
    string addMailtoUrl = CUtil::tap(mepath + jvid, "addmailto");
  }
  <table class="jvtable" id="jvMailto">
    <tbody>
      <tr class="jvtable">
        <input type="hidden" id="mailrows" name="mailrows" value="">
        <th class="jvtable" width="20px" title="add a line to JV maker" align="center">
          <a href="@addMailtoUrl" title="Add"><img class="icon" src="@iPath/add.png"></a>
        </th>
        @foreach (string s in fName.AllKeys)
        {
          ka = CUtil::Str2a(',', fName[s]); // get value of fName[s]
          stitle = (ka[0].Length > 0) ? ka[0] : s;
          <th class="@tblcls">@Html.Raw(stitle)</th>
        }
      </tr>
      @{
        cnt = 0;
        foreach (Dictionary<string, object> r in rows)
        {
          NameValueCollection rNv = CUtil::dict2nv(r); // convert Nv to get field name
                                                       //          string sid = rNv["sub_id"];
          CMsg::_pdmsg(rNv, "rNv");
          CMsg::_pdmsg(r, "r");
          string sid = r["sub_id"].ToString();
          cnt++;
          //                  CMsg::_pdmsg(cnt, "cnt");
          linecls = "screen" + CUtil::evenOrOdd(cnt);
          string delmailto = "delmailto" + sid;
          <tr class='@linecls'>
            <td class="jvtable" width="20px" align="center">
              <input type=checkbox id="@delmailto" name="@delmailto"
                     title="Mark the boxes to be deleted when click SAVE">
            </td>
            @foreach (string s in fName)
            {
              //            ka = CUtil::Str2a(',', fName[s]); // get value of fName[s]
              ka = fName[s].Split(','); // split into array
              salign = (ka.Count() > 1 && ka[1].Length > 0) ? ka[1] : "center";
              slen = (ka.Count() > 2 && ka[2].Length > 0) ? ka[2] : "3";
              ssize = (ka.Count() > 3 && ka[3].Length > 0) ? ka[3] : "3";
              string fldsid = s + sid;
              string flagFmt = "";
              string cTitle = "";
              string cWidth = "";
              string cInputCls = "";
              if (s == "full_email")
              {
                cWidth = " width=\"20px\"";
                cTitle = "title=\"Email is required!\"";
                flagFmt = CJvTpl::FlagRed(rNv[s], s, "email");
                //                flagFmt = CJvTpl::EmptyRecord(rNv[s], "email");
              }
              else if (s == "person")
              {
                cTitle = "title=\"Person name is required!\"";
                flagFmt = CJvTpl::FlagRed(rNv[s], s, "person");
              }
              else if (s == "box_num")
              {
                flagFmt = CJvTpl::FlagRed(rNv[s], s, "box_num");
                //                flagFmt = CJvTpl::EmptyRecord(rNv[s], "box_num");
                cTitle = "title=\"Mailstop name is required!\"";
              }
              <td class="jvtable" align="@salign" @Html.Raw(flagFmt) @Html.Raw(cWidth)>
                <input id="@fldsid" name="@fldsid" @Html.Raw(cInputCls) @Html.Raw(cTitle)
                       type="text"
                       maxlength=@slen size=@ssize
                       value="@rNv[s]">
              </td>
            }
          </tr>
        }
      }
    </tbody>
  </table>
</div>
