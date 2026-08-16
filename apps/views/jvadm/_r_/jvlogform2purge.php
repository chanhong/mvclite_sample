@using System.Collections.Specialized;
@using Co;
@{
  Page.Title = "JvLog Purge";
  string meqs = PageData["meqs"];
  //  CMsg._pdmsg(PageData["meqs"], "meqs");
}
  @Html.Raw(CHtml.FrmBeg(meqs))
  <input type="hidden" size=3 name="datebeg" value="@PageData["datebeg"]" />
  <input type="hidden" size=3 name="dateend" value="@PageData["dateend"]" />
  <input type="hidden" size=3 name="cmd" value="purge" />
  <input type="submit" name="submit" value="Purge listed below!">
  @Html.Raw(CHtml.FrmEnd(meqs))