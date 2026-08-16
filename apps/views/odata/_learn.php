@using System;
@using System.Text;
@using System.Collections;
@using System.Collections.Generic;
@using System.Data.Common;
@using System.Data.SqlClient;
@using System.Data.OleDb;
@using System.Web.Script;
@using System.Web.Services;
@using System.Collections.Specialized;
@using Co;
@using System.Globalization;
@{
  string msg = "";
  string where = "";
  string tname="";

  NameValueCollection sparm = new NameValueCollection();
  NameValueCollection nvValue;

  string dbinfo = CCore._DbEnv("db");

  NameValueCollection qsa = CUtils.qs2nv();
  string scmd = qsa["c"].ToLower();
  switch (scmd)
  {
    case "client":
      tname = "client";
      break;
    case "sample":
      tname = "sample_data";
      break;
    default:
      break;
  }

  string method = Request.ServerVariables["request_method"].ToLower();
  try
  {
    switch (method)
    {
      default:
      case "get":
        // work
        // string strU = "http://localhost:83/portal/?t=odata&a=sample_data&id=1&first_name=&last_name=&age=&gender=";
        nvValue = CModel.request2Nv(CUtils.qs2nv(), tname, dbinfo);
        nvValue = CUtils.nv2NvLike(nvValue); // patch % into nv
        string lke = CUtils.Nv2sLike(nvValue, "?");
        lke = CUtils.AndOrNot(lke, ""); // add () to like
        CMsg._pdmsg(lke, "lke");
        where = lke;
        sparm = new NameValueCollection { { "fl", "*" }, { "top", "1000" }, { "where", where } };
        // must use third param to ensure to use param in exec code
        nvValue = CUtils.nv2NvLike(nvValue);
        CAjx.Get(tname, sparm, nvValue, dbinfo);
        break;
    }
  }
  catch (Exception e)
  {
    //    Response.Write(e.ToString());
    string rUrl = CUtils.getReturnUrl();
    CMsg._dmsg(rUrl, "rUrl");
    msg = "catch:" + method+ e.ToString();
    CUtils.Add2SessVar("feedback", msg);
    CUtils.Redirect(rUrl);
  }
}