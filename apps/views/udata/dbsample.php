<?php
use MvcLite\CCore;

  $strQry = "";
  $arrStr = "";
  $strQry = "select * from sample_data";
  try
  {
    $conn = CDbSql::sqlGetConnection(CDb::getSqlDsn(""));

    $arrStr = CDbSql::sqlDt2Json($conn, $strQry);
  } catch (Exception $e)
  {
    $Response.Write($e.ToString());
  }
?>
@arrStr