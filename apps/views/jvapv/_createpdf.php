@using System;
@using System.Collections.Generic;
@using System.Linq;
@using System.Web;
@using System.Web.Mvc;
@using System.Web.UI;
@using System.Web.UI.WebControls;
@using System.IO;
@using System.Collections;
@using System.Collections.Specialized;
@using SelectPdf;
@using Co;
@{
  Layout = CUtils.GetLayout("_4pdf"); // create pdf file
  string dbenv = CJv.DbEnv();
  NameValueCollection _qsa = CUtils.qs2nv();
  //  CMsg._pdmsg(_qsa, "createpdf");
  string jvid = _qsa["p1"];
  string logid = _qsa["p2"];
  PageData["onejv"] = CJvTpl.GetOneJvInfo(jvid, dbenv);
  PageData["onejv"]["logid"] = logid; // use in __viewjv
  string tsk = "/jvapv";
  string mepath = tsk + "/index/";
  string meqs = CUtils.tap(mepath + jvid + "/" + logid);
  PageData["onejv"]["uploadedfiles"] = CJvTpl.UpldFilesInfo(meqs, dbenv); // use in vexplian
  _qsa["jvhtml"] = @RenderPage("_r_/viewjv.cshtml").ToHtmlString(); // render jv into html string
  MJvApv.JvExport(_qsa, dbenv);
  CUtils.Redirect(CJv.Url("jvapv"));
}