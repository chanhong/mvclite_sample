@using System.Collections.Specialized;
@using Co;
@{
  Layout = CUtils.GetLayout("_ejv");
  //  Dictionary<string, object> row;
  NameValueCollection one = new NameValueCollection();
  string dbenv = CJv.DbEnv();
  PageData["Title"] = "View JV Info";
  string iPath = CUtils.imgPath();
  //  NameValueCollection _qsa = CCore.qs2nvWithDefaultValue();
  NameValueCollection _qsa = CUtils.qs2nv();
  //  CMsg._pdmsg(CUtils.MyUrl(), "myurl");
//  CMsg._pdmsg(_qsa, "_view");
  string jvid = _qsa["p1"];
  string logid = _qsa["p2"];
  string approved = _qsa["p4"];
  string tsk = "/jvtpl";
  string mepath = tsk + "/_view/";
  string meqs = CUtils.tap(mepath + jvid+"/"+logid);
  PageData["onejv"] = CJvTpl.GetOneJvInfo(jvid, dbenv);
  PageData["onejv"]["logid"] = logid; // use in __maker
  PageData["onejv"]["uploadedfiles"] = CJvTpl.UpldFilesInfo(meqs, dbenv); // use in vexplian
  PageData["onejv"]["v2p"] = "window.open('" + CUtils.Tap2Qs(tsk + "/_view2print/" + jvid + "/" + logid + "/" + approved) + "')";
  PageData["meqs"] = CUtils.MyUrl();
  // start a clean flag per jv
  CCore._eflag = new NameValueCollection
  {
        { "dbcr", "" },
        { "sumamt",  ""},
  };

//  CMsg._pdmsg(meqs, "meqs");
  CJvTpl.PbOrRr(CUtils.MyUrl(), dbenv); // process Post/Get Request, use index instead of _pb to simplify logic
}
<div>
  <center>
    @RenderPage("_r_/jvview.cshtml")
    @RenderPage("_r_/jvview2upload.cshtml")
  </center>
</div>