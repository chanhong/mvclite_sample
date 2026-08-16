@using System.Collections.Specialized;
@using Co;
@{
  Page.Title = "Filter By";
  string meqs = CUtils.tap("/jvtpl/_jvlist");
  string sel = "";
  string filterMaker = "";
  string dbenv = CJv.DbEnv();
  if (IsPost)
  {
    filterMaker = CCore.getSafeVar(Request.Form, "maker", "raw");
  }
  else
  {
    filterMaker = CUtils.getSessTxt("name"); // session name setUserProfile
  }
  //  CMsg._pdmsg(filterMaker, "filtermaker");
  List<string> makers = new List<string>();
  makers = CJv.getJVListMakers(dbenv);
  sel = CHtml.dropDnList("maker", makers, filterMaker);
}
<div>
  @Html.Raw(CHtml.FrmBeg(meqs))
  Filter by:&nbsp;&nbsp; @Html.Raw(sel)
  <input type="submit" name="submit" value="Go">
  @Html.Raw(CHtml.FrmEnd(meqs))
</div>