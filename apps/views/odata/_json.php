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

        $where = "";
        $sparm = [ "fl"=>"*", "top"=>"1000", "where"=> $where ];
                    $age = array(['name'=>"Peter",'age' => 35], ['name'=>"Ben",'age' => 37], ['name'=>"Joe",'age' => 43]);

        CAjx::Json($age);            
} catch (Exception $e) {
    // -----------------------------------------------------------------
    // 5️⃣ Error handling – print the exception (mirrors Response.Write)
    // -----------------------------------------------------------------
    header('Content-Type: text/plain');
    echo $e->getMessage();
}
