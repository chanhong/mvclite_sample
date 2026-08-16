<?php
    $msg = "";
    $aList = array();

    $host = "directory.washington.edu";
    $searchStr = "o=University of Washington, c=US";

    $term = $_GET["term"];
    $iType = $_GET["c"]; // use &c=ajax to be consistent
    try
    {
      if (CString.IsEmpty(iType) == false && CString.IsEmpty(term) == false)
      {
        $aType = str2lower($iType);
        switch (aType)
        {
          case "emailuw":
            $aList = CLdap::LdapListByEmail($host, $searchStr, $term);
            break;
          case "name":
            $aList = CLdap::LdapListByName($host, $searchStr, $term);
            break;
        }
        CUtil::outJson(CUtils.List2json($aList));
      }
    }
  catch (Exception e)
  {
    //    Response.Write(e.ToString());
    $rUrl = CUtil::getReturnUrl();
    CMsg::_dmsg($rUrl, "rUrl");
    $msg = "catch:" + $iType+e.ToString();
    CUtil::Add2SessVar("feedback", $msg);
    CUtil::Redirect($rUrl);
  }
}