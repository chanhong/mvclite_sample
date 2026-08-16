@using System.Collections.Specialized;
@using Co;
@{
  Page.Title = "Filter By";
  string meqs = CUtils.tap("/jvadm/_search");

  string sel = "";
  string filterMaker = "";

  List<string> aiList = new List<string>();
  aiList = MJvAdm.GetAIList(CJv.DbEnv());

  if (IsPost)
  {
    filterMaker = CCore.getSafeVar(Request.Form, "isconfirmed", "raw");
    //    CMsg._pdmsg(filterMaker, "jvadm");
  };
  if (filterMaker == "")
  {
    filterMaker = "Active";
  }
  sel = CHtml.dropDnList("isconfirmed", aiList, filterMaker);
}
<div>
  @Html.Raw(CHtml.FrmBeg(meqs))
  Filter by:&nbsp;&nbsp; @Html.Raw(sel)
  <input type="text"
         name="q"
         title="Search Users (By Username or Email)"
         value="" id="q">&nbsp;
  <input type="submit" name="submit" value="Go">
  @Html.Raw(CHtml.FrmEnd(meqs))
</div>