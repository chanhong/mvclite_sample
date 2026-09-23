
<?php
use MvcLite\CCore;

    $msg = "";
    $aList = array();
    $term = $_REQUEST["term"];
    $iType = $_REQUEST["c"]; // use &c=ajax to be consistent
    try
    {
      if (CString::IsEmpty($iType) == false && CString::IsEmpty($term) == false)
      {
        $aType = strtolower($iType);
        switch ($aType)
        {
          case "email": // internal table
          case "acctcode":
          case "budget":
            $aList = CJv::GetList4Ajax($aType, $term, CJv::DbEnv());
            break;
        }
        CUtil::outJson(CUtil::List2json($aList));
      }
    }
  catch (Exception $e)
  {
    //    Response.Write(e.ToString());
    $rUrl = CUtil::getReturnUrl();
    CMsg::_dmsg($rUrl, "rUrl");
    $msg = "catch:" . $iType . $e->getMessage();
    CUtil::Add2SessVar("feedback", $msg);
    CUtil::Redirect($rUrl);
  }