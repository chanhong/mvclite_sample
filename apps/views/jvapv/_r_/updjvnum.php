@using System.Collections.Specialized;
@using Co;
@{
  Page.Title = "Update JVNum";
  string meqs = PageData["meqs"];
//  int jvnum = 0;  
//  jvnum = Convert.ToInt32(PageData["jvnum"]);    
//  string dbenv = CJv.DbEnv();
 //   jvnum = Convert.ToInt32(CJv.GetJvNum(dbenv)); // show number only
  //  CMsg._pdmsg(PageData["meqs"], "meqs");
}
<div>
  @Html.Raw(CHtml.FrmBeg(meqs))
  <input type="text"
         name="nextjvnum"
         size=2
         maxlength="4"
         value="@PageData["jvnum"]">
  <input type="hidden" id="cmd" name="cmd" value="updjvnum" />
  <input type="submit" name="submit" value="Change next starting JVNUM">
  @Html.Raw(CHtml.FrmEnd(meqs))
</div>