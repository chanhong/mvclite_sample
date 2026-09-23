<?php
use MvcLite\CCore;

  $msg = "";
  $where = "";
  $tname="";

  $sparm = array();
  $nvValue;

  $dbinfo = CCore::_DbEnv("db");

  $qsa = CUtil::qs2nv();
  $scmd = strtolower($qsa["c"]);
  switch ($scmd)
  {
    case "client":
      $tname = "client";
      break;
    case "sample":
      $tname = "sample_data";
      break;
    default:
      break;
  }

  $method = $Request.ServerVariables["request_method"].ToLower();
  try
  {
    switch ($method)
    {
      default:
      case "get":
        // work
        // string strU = "http://localhost:83/portal/?t=odata&a=sample_data&id=1&first_name=&last_name=&age=&gender=";
        $nvValue = CModel::request2Nv(CUtil::qs2nv(), $tname, $dbinfo);
        $nvValue = CUtil::nv2NvLike($nvValue); // patch % into nv
        $lke = CUtil::Nv2sLike($nvValue, "?");
        $lke = CUtil::AndOrNot($lke, ""); // add () to like
        CMsg::_pdmsg($lke, "lke");
        $where = $lke;
        $sparm = array( array("fl", "*"), array("top", "1000"), array("where", $where) );
        // must use third param to ensure to use param in exec code
        $nvValue = CUtil::nv2NvLike($nvValue);
        CAjx::Get($tname, $sparm, $nvValue, $dbinfo);
        break;
    }
  }
  catch (Exception $e)
  {
    //    Response.Write(e.ToString());
    $rUrl = CUtil::getReturnUrl();
    CMsg::_dmsg($rUrl, "rUrl");
    $msg = "catch:" . $method . $e->getMessage();
    CUtil::Add2SessVar("feedback", $msg);
    CUtil::Redirect($rUrl);
  }