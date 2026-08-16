@using System.Collections.Specialized;
@using Co;
@{
  Layout = CUtils.GetLayout("_4pdf");
  //  Dictionary<string, object> row;
  NameValueCollection one = new NameValueCollection();
  string dbenv = CJv.DbEnv();
  PageData["Title"] = "View JV to Print";
  string iPath = CUtils.imgPath();
  NameValueCollection _qsa = CUtils.qs2nv();
  string jvid = _qsa["p1"];
  string logid = _qsa["p2"];
  string tsk = "/jvtpl";
  string mepath = tsk + "/_view2print/";
  string meqs = CUtils.tap(mepath + jvid + "/" + logid);

  PageData["onejv"] = CJvTpl.GetOneJvInfo(jvid, dbenv);
  PageData["onejv"]["logid"] = logid; // use in __maker
  /*
    CMsg._pdmsg(PageData["onejv"], "onejv");
    CMsg._dprt(PageData["onejv"]);
  */
  PageData["onejv"]["uploadedfiles"] = CJvTpl.UpldFilesInfo(meqs, dbenv); // use in vexplian
}
<div>
  <center>
    <center><h5>Print best in landscape orientation</h5></center>
    @RenderPage("_r_/jvview.cshtml")
  </center>
</div>