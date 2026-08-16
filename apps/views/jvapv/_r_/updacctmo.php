@using System.Collections.Specialized;
@using Co;
@{
  Page.Title = "Update JVNum";
  string meqs = PageData["meqs"];
//  int bieniummonth = 0;
//  bieniummonth =Convert.ToInt32(PageData["acctmo"]);

//  string dbenv = CJv.DbEnv();
//    bieniummonth = Convert.ToInt32(CJv.GetAcctMo(dbenv)); // show number only
  //  CMsg._pdmsg(PageData["meqs"], "meqs");
}
<div>
  @Html.Raw(CHtml.FrmBeg(meqs))
  <input type="text"
         name="newmonth"
         size=2
         value="@PageData["acctmo"]">
  <input type="hidden" id="cmd" name="cmd" value="updacctmo" />
  <input type="submit" name="submit" value="Change default Biennium month">
  @Html.Raw(CHtml.FrmEnd(meqs))
</div>