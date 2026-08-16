@using System;
@using System.Net;
@using System.Text;
@using System.Collections;
@using System.Collections.Generic;
@using System.Collections.Specialized;
@using System.Data.Common;
@using System.Data.SqlClient;
@using System.Data.OleDb;
@using System.Web.Script;
@using System.Web.Services;
@using System.DirectoryServices;
@using System.DirectoryServices.Protocols;
@using Co;
@{
    string msg = "";
    List<Dictionary<string, string>> aList = new List<Dictionary<string, string>>();
    string term = Request.Params["term"];
    string iType = Request.Params["c"]; // use &c=ajax to be consistent
    try
    {
      if (CString.IsEmpty(iType) == false && CString.IsEmpty(term) == false)
      {
        string aType = iType.ToLower();
        switch (aType)
        {
          case "email": // internal table
          case "acctcode":
          case "budget":
            aList = CJv.GetList4Ajax(aType, term, CJv.DbEnv());
            break;
        }
        CUtils.outJson(CUtils.List2json(aList));
      }
    }
  catch (Exception e)
  {
    //    Response.Write(e.ToString());
    string rUrl = CUtils.getReturnUrl();
    CMsg._dmsg(rUrl, "rUrl");
    msg = "catch:" + iType+e.ToString();
    CUtils.Add2SessVar("feedback", msg);
    CUtils.Redirect(rUrl);
  }
}