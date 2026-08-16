<?php
use mvcLite\CUtil;
use mvcLite\CModel;
use mvcLite\CMsg;

  $msg = "";
  $where = "";
  $tname="";

  $sparm = [];
  $nvValue;

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
        $this->meTable = "sample_data";
        $this->model = new CModel($this->meTable); // create a mini model class in model folder
        $where = "1 = 1";
        $nvValue= $this->model->_dbt("select", ['where' => $where]); 
//            \CUtil::outJson(json_encode($rows)); // Assuming static method call      

        $sparm = [ "fl"=>"*", "top"=>"1000", "where"=> $where ];
        CAjx::Get($tname, $sparm, $nvValue, $dbinfo);  

} catch (Exception $e) {
    // -----------------------------------------------------------------
    // 5️⃣ Error handling – print the exception (mirrors Response.Write)
    // -----------------------------------------------------------------
    header('Content-Type: text/plain');
    echo $e->getMessage();
}
