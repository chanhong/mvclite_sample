@using System.Collections.Specialized;
@using Co;

@{
  Layout = CUtils.GetLayout("_ejv");
  PageData["Title"] = "JV Approvers";
  string ajax_qs = CUtils.Tap2Qs("/udata/_ejv") + "&c=appvr"; // refine ajx with &c=cmd
  string msg = PageData["Title"];
//  CMsg._dmsg(msg, "in");
  //  CUtils.Add2SessVar("feedback", msg);
}
<style>
  .hide {
    display: none;
  }
</style>
<div id="grid_table"></div>
<script>
  $('#grid_table').jsGrid({

    width: "100%",
    height: "600px",

    filtering: true,
    inserting: true,
    editing: true,
    sorting: true,
    paging: true,
    autoload: true,
    pageSize: 10,
    pageButtonCount: 5,
    deleteConfirm: "Do you really want to delete data?",

    controller: {
      loadData: function (filter) {
        return $.ajax({
          type: "GET",
          url: "@Html.Raw(ajax_qs)",
          data: filter
        });
      },
      insertItem: function (item) {
        return $.ajax({
          type: "POST",
          url: "@Html.Raw(ajax_qs)",
          data: item,
          success: function (item) {
            location.reload(); //reload the page on the success
          }
        });
      },
      updateItem: function (item) {
        return $.ajax({
          type: "PUT",
          url: "@Html.Raw(ajax_qs)",
          data: item,
          success: function (item) {
            location.reload(); //reload the page on the success
          }
        });
      },
      deleteItem: function (item) {
        return $.ajax({
          type: "DELETE",
          url: "@Html.Raw(ajax_qs)",
          data: item
        });
      },
    },
    fields: [
      { type: "control", width: 5},
      { name: "apvid", type: "hidden", css: 'hide' },
      { name: "apventity", type: "text", title: "Entity", width: 5, validate: "required" },
      { name: "apventityname", type: "text", title: "Entity Name", width: 30, validate: "required" },
      { name: "dayofmonth", type: "text", title: "DayofMonth", width: 2, validate: "required" },
      { name: "jvnum", type: "text", title: "Jvnum", width: 5, validate: "required" },
      { name: "apvemail", type: "text", title: "Email", width: 25, validate: "required" },
      { name: "apvcontact", type: "text", title: "Contact", width: 15, validate: "required" },
      { name: "apvmailouttxt", type: "text", title: "Mailout Text", width: 50, validate: "required" },
    ]
  });
</script>