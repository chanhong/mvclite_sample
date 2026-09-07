<?php
use mvcLite\CUtil;
use mvcLite\CModel;
use mvcLite\CMsg;

$msg = "";
$where = "";
$tname = "";

$sparm = [];
$nvValue=[];

//  $dbinfo = CCore::$_DbEnv("dbacct");
$dbinfo = "coazportal_db";

$qsa = CUtil::qs2nv();
$scmd = (empty($qsa["c"]) <> true) ? strtolower($qsa["c"]) : '';
switch ($scmd) {
  case "links":
    $tname = "url_Useful";
    break;
    case "mylinks":
      $tname = "url_" + CCore::$_usr["usrname"];
      $idKey = "id";
      break;    
  default:
    break;
}
//pln("here: t:$tname w:$where");
/*
http://localhost:8000/?t=odata&a=_acctlinks
  [-QSA-] Array ( [t] => odata [a] => _acctlinks ) [-M-] Array ( [t] => odata [a] => _acctlinks ) here
Fatal error: Uncaught Error: Call to undefined method MvcLite\CUtil::nv2NvLike() in G:\needed\mvclite_work\apps\views\odata\_acctlinks.php:40 Stack trace: #0 G:\needed\mvclite_work\apps\Lib\mvclite\src\CController.php(149): include() #1 G:\needed\mvclite_work\apps\Lib\mvclite\src\CController.php(247): MvcLite\CController->captureContent('g:\\needed\\mvcli...') #2 G:\needed\mvclite_work\apps\Lib\mvclite\src\CController.php(459): MvcLite\CController->renderAppView('_acctlinks') #3 G:\needed\mvclite_work\apps\Lib\mvclite\src\CController.php(426): MvcLite\CController::doView(Object(MvcLite\Router), '_acctlinks', 'odata') #4 G:\needed\mvclite_work\apps\src\controller\Router.php(28): MvcLite\CController->doRouter(Array, 'MvcLite\\Router') #5 G:\needed\mvclite_work\public\index.php(89): MvcLite\Router->start() #6 G:\needed\mvclite_work\index.php(9): include_once('G:\\needed\\mvcli...') #7 {main} thrown in G:\needed\mvclite_work\apps\views\odata\_acctlinks.php on line 40
*/
$method = ($_GET);
try {
  switch ($method) {
      case "put":
        // work
        $nvValue = CModel::request2Nv(Request.Form, $tname, $dbinfo);
        $id = $nvValue[$idKey];
//        $nvValue.Remove("timestamp"); // can't update ts due to smalldatetime issue
//        $nvValue.Remove(idKey); // must remove ID before update record

        $where = sprintf("{0}='{1}'", $idKey,$id);
        $sparm = [ ["param"=>"yes"], ["where"=>$where]];
        CAjx::Put($tname, $sparm, $nvValue, $dbinfo);

        break;
      case "delete":
        // work
        $nvValue = CModel::request2Nv(Request.Form, $tname, $dbinfo); // get the id
        $id = $nvValue[$idKey];
        $where = sprintf("{0}='{1}'", $idKey,$id);
        $sparm = [ ["where"=>$where ]];
        CAjx::Del($tname, $sparm, $dbinfo);
        break;
      case "post":
        // work
        $nvValue = CModel::request2Nv(Request.Form, $tname, $dbinfo);
        $sparm = [ ["param"=>"yes"] ];
//        $nvValue.Remove($idKey); // must remove when have auto ID
        CAjx::Add($tname, $sparm, $nvValue, $dbinfo);
        break;
    default:
    case "get":
      // string strU = "http://localhost:83/portal/?t=odata&a=sample_data&id=1&first_name=&last_name=&age=&gender="; // wprl
        $nvValue = CModel::request2Nv($_REQUEST, $tname, $dbinfo);
        $nvValue = CDbHelper::nv2NvLike($nvValue); // patch % into nv
        $lke = CDbHelper::Nv2sLike($nvValue, "?");
        $lke = CDbHelper::AndOrNot($lke, ""); // add () to like
                                        //      CMsg._pdmsg(lke, "lke");
        $where = $lke;
        $sparm = [ "fl"=> "*" , "top"=> "1000", "where"=> $where  ];
        // must use third param to ensure to use param in exec code
        $nvValue = CDbHelper::nv2NvLike($nvValue);
        CAjx::Get($tname, $sparm, $nvValue, $dbinfo); // wrapper WORK
//pln("here: t:$tname w:$where");
//      CAjx::PdoGet($this, $tname, "select", $where);
      break;
  }
} catch (Exception $e) {
  $errorString = sprintf(
    "Exception: %s in %s on line %d\nStack trace:\n%s",
    $e->getMessage(),
    $e->getFile(),
    $e->getLine(),
    $e->getTraceAsString()
  );
  $method = $method ?? '';
  $rUrl = CUtil::getReturnUrl();
  CMsg::_dmsg($rUrl, "rUrl");
  $msg = "catch: "
    //    . $method
    . $errorString;
  pln($msg, 'msg');
  CUtil::Add2SessVar("feedback", $msg);
  //    CUtil::Redirect($rUrl);
}
