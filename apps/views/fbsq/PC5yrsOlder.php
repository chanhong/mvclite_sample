@using System.Collections.Specialized;
@using System.Data.OleDb;
@using Co;

@{
  string tblcls = "jvtable";

  string hdrMsg = "";
  List<Dictionary<string, object>> rows = new List<Dictionary<string, object>>();

  Layout = CUtils.GetLayout("_bootstrap_top");
  PageData["Title"] = "PC older then 5 yrs List";
  hdrMsg = string.Format("<H2>List of PC {0} yrs older</H2>", "5");

  string dbenv = CCore._DbEnv("dbitinvt");
  NameValueCollection clsName = new NameValueCollection
  {
    { "tcls", tblcls },
    { "rcls", "screen" },
  };
  NameValueCollection fName = new NameValueCollection {
  // fldname, fldhdr, fldformat
  { "DiffYrs","Yrs,"},
  { "ComputerName",","},
  { "Subnet",","},
  { "Description",","},
  { "Model",","},
  { "UserID",","},
  { "OS_Arch",","},
    { "OS",","},
  { "ImageType",","},
  { "DeployedDate","Deployed<br />Date,"},
  { "Location",","},
  };
  rows = CFbsQ.getPCGt5YrsRows(dbenv);
}
<div>
  <div>
    @Html.Raw(hdrMsg)
  </div>
  <div align=center>
    <p />
    <table class="jvtable">
      <tbody>
        @Html.Raw(CHtml.OutTblRows(fName, rows, clsName))
      </tbody>
    </table>
  </div>
</div>