<?php
use mvcLite\CUtil;
use mvcLite\CModel;
use mvcLite\CMsg;

  $msg = "";
  $where = "";
  $tname="";

  $sparm = [];

  // ---------------------------------------------------------------
// Required extensions:
// * sqlsrv (Microsoft Drivers for PHP for SQL Server)
// ---------------------------------------------------------------

// Build the query
$tname = "sample_data";
$dbinfo="";
$nvValue=[];
try {

  $strQry = "select * from sample_data";
//    $conn = CDbSql::sqlGetConnection(CDb::getSqlDsn(""));
//    $arrStr = CDbSql::sqlDt2Json($conn, $strQry);
//echo $arrStr;
        $nvValue = CModel::request2Nv($_REQUEST, $tname, $dbinfo);
        $nvValue = CDbHelper::nv2NvLike($nvValue); // patch % into nv
        $lke = CDbHelper::Nv2sLike($nvValue, "?");
        $lke = CDbHelper::AndOrNot($lke, ""); // add () to like
                                        //      CMsg::_pdmsg(lke, "lke");
        $where = $lke;
        $sparm = [ "fl"=> "*" , "top"=> "1000", "where"=> $where  ];
        // must use third param to ensure to use param in exec code
        $nvValue = CDbHelper::nv2NvLike($nvValue);
        CAjx::Get($tname, $sparm, $nvValue, $dbinfo); // wrapper WORK
        
//      CAjx::PdoGet($this, $tname, "select", $where);

} catch (Exception $e) {
    // -----------------------------------------------------------------
    // 5️⃣ Error handling – print the exception (mirrors Response.Write)
    // -----------------------------------------------------------------
//    header('Content-Type: text/plain');
    echo $e->getMessage();
}
