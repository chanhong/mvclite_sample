
@using System;
@using System.Collections;
@using System.Collections.Generic;
@using System.Collections.Specialized;
@using System.Data.Common;
@using System.Data.SqlClient;
@using System.Web.Script;
@using System.Web.Services;
@using Co;
@{
  string strQry = "";
  string arrStr = "";
  strQry = "select * from sample_data";
  try
  {
    SqlConnection conn = CDbSql.sqlGetConnection(CDb.getSqlDsn(""));

    arrStr = CDbSql.sqlDt2Json(conn, strQry);
  } catch (Exception e)
  {
    Response.Write(e.ToString());
  }
}
@arrStr