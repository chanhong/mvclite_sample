@using System.Collections.Specialized;
@using Co;
@{
  Layout = CUtils.GetLayout("_ejv");
  PageData["Title"] = "JV Approval";
  //  CMsg._pdmsg(PageData["meqs"], "meqs");
        string dbenv = CJv.DbEnv();
      CCore._uprf = CUtils.getSessNv("uinfo");  
  if (!CString.IsEmpty(dbenv) && CString.IsEmpty(CCore._uprf["name"])) { 
CJv.setUserProfile(dbenv);  
  }
         PageData["acctmo"] = "0";
      PageData["jvnum"] = "0";          
  if (!CString.IsEmpty(dbenv) && !CString.IsEmpty(CCore._uprf["apventity"])) { 
      PageData["acctmo"] = Convert.ToInt32(CJv.GetAcctMo(dbenv));
      PageData["jvnum"] = Convert.ToInt32(CJv.GetJvNum(dbenv)); // show number only   
    CMsg._pdmsg(dbenv, "dbenv");
    CMsg._pdmsg(CCore._uprf, "uprf");

    CMsg._pdmsg(PageData["acctmo"], "acctmo");         
    CMsg._pdmsg(PageData["jvnum"], "jvnum");         
  } else{
    CCore._Logout();
    CUtils.Redirect(CUtils.getReturnUrl());    
  }

  /*
  <tr class="jvheader">
    <th colspan="12">
      <i>
        <FONT SIZE="+2" COLOR="black">
          JV's Awaiting Authorization, Upload to Campus' General Ledger, and Mailing Out to Depts.
        </FONT>
      </i>
    </th>
  </tr>
  <tr class="jvtable">
    <td class="jvtable" COLSPAN="6" align="center">
      @RenderPage("_r_/updjvnum.cshtml")
    </td>
    <td class="jvtable" COLSPAN="6" align="center">
      @RenderPage("_r_/updacctmo.cshtml")
    </td>
    @RenderPage("_r_/jvapproval.cshtml")
  </tr>
  <table class="jvtable">
  <tbody>
    @RenderPage("_r_/jvapproval.cshtml")
  </tbody>
</table>
<p />
<center>
  <B>
    There are maximum of 34 JVs can be submit in a given day!  After that,
    the program runs out of single digits and letters to assign to the .JV filename.
  </B>
</center>
  */
}
<table class="jvtable" border="0">
  <tbody>
    <tr class="jvheader">
      <td class="jvtable" colspan="2" align="center">
        <i>
          <FONT SIZE="+1" COLOR="black">
            JV's Awaiting Authorization, Upload to Campus' General Ledger, and Mailing Out to Depts.
          </FONT>
        </i>
      </td>
    </tr>
    <tr class="jvtable">
      <td class="jvtable" align="right">
        @RenderPage("_r_/updjvnum.cshtml")
      </td>
      <td class="jvtable" align="left">
        @RenderPage("_r_/updacctmo.cshtml")
      </td>
    </tr>
    <tr class="jvheader">
      <td class="jvtable" colspan="2" align="center">
        <center>
          <i><b>
  <FONT SIZE="-1" COLOR="black">
    There are maximum of 34 JVs can be submit in a given day!  After that,
    the program runs out of single digits and letters to assign to the .JV filename.
  </FONT>
</b>
          </i>
        </center>
        </td>
      </tr>
  </tbody>
</table>
@RenderPage("_r_/jvapproval.cshtml")