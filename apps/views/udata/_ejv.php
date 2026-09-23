<?php
use MvcLite\CCore;

  $msg = "";
  $id = "";
  $idKey= "";
  $where = "";
  $tname="";

  $sparm = array();
  $nvValue;

  $dbinfo = CJv::DbEnv();

  $qsa = CUtil::qs2nv();
  $scmd = "";
  if (!CString::IsEmpty($qsa["c"]))
  {
    $scmd = $qsa["c"].ToLower();
  };
  switch ($scmd)
  {
    case "usr":
      $tname = "maker";
      $idKey = "user_id";
      break;
    case "appvr":
      $tname = "jvapprover";
      $idKey = "apvid";
      break;
    case "recpt":
      $tname = "recipient";
      $idKey = "id";
      break;
    case "mailto":
      $tname = "mailto";
      $idKey = "id";
      break;
    case "budget":
      $tname = "budget";
      $idKey = "id";
      break;
    case "acctcode":
      $tname = "acctcode";
      $idKey = "id";
      break;
    default:
      break;
  }

  $method = $Request.ServerVariables["request_method"].ToLower();
  try
  {
    switch ($method)
    {
      case "put":
        // work
        $nvValue = CModel::request2Nv($Request->Form, $tname, $dbinfo);
        $id = $nvValue[$idKey];
        $nvValue->Remove("timestamp"); // can't update ts due to smalldatetime issue
        $nvValue->Remove("login_date"); // can't update ts due to smalldatetime issue
        $nvValue->Remove($idKey); // must remove ID before update record
        //sparm = new array [ {"param","yes"}, {"where","\""+idKey+"\"='"+id+"'"} };
        $where = sprintf("%s='%s'", $idKey, $id);
        $sparm = array( array("param","yes"), array("where",$where) );
        CAjx::Put($tname, $sparm, $nvValue, $dbinfo);
        break;
      case "delete":
        // work
        $nvValue = CModel::request2Nv($Request->Form, $tname, $dbinfo); // get the id
        $id = $nvValue[$idKey];
        //        sparm = new array [ {"where","\""+idKey+"\"='"+id+"'"} };
        $where = sprintf("%s='%s'", $idKey, $id);
        $sparm = array( array("where",$where) );
        CAjx::Del($tname, $sparm, $dbinfo);
        break;
      case "post":
        // work
        $nvValue = CModel::request2Nv($Request->Form, $tname, $dbinfo);
        //        nvValue.Remove(idKey); // must remove when have auto ID
        $nextid = CDbPdo::oleGetNextId($tname, $idKey, $dbinfo);
        $nvValue->Set($idKey, $nextid);
        $sparm = array( array("param","yes") );
        CAjx::Add($tname, $sparm, $nvValue, $dbinfo);
        break;
      default:
      case "get":
        // work
        // string strU = "http://localhost:83/portal/?t=odata&a=sample_data&id=1&first_name=&last_name=&age=&gender=";
        $nvValue = CModel::request2Nv(CUtil::qs2nv(), $tname, $dbinfo);
        $nvValue = CUtil::nv2NvLike($nvValue); // patch % into nv
        $lke = CUtil::Nv2sLike($nvValue, "?");
        $lke = CUtil::AndOrNot($lke, ""); // add () to like
                                        //      CMsg::_pdmsg(lke, "lke");
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