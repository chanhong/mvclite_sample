@using System.Collections.Specialized;
@using Co;

@{
  Layout = CUtils.GetLayout("_bootstrap_top");
  PageData["Title"] = "PC Deployment";
//  string ajax_qs = CUtils.Tap2Qs("/fbsq/__ajpcdeploy");
  string ajax_qs = CUtils.Tap2Qs("/udata/_itinvent") + "&c=pcdeploy"; // refine ajx with &c=cmd
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
    height: "auto",

    filtering: true,
    inserting: true,
    editing: true,
    sorting: true,
    paging: true,
    autoload: true,
    pageSize: 15,
    pageButtonCount: 5,
    deleteConfirm: "Do you really want to delete data?",

    controller: {
      loadData: function (filter) {
        return $.ajax({
          type: "GET",
          url: "@Html.Raw(ajax_qs)",
          data: filter,
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
      { name: "id", type: "hidden", css: 'hide' },
      { name: "pcname", type: "text", title: "PC Name", width: 30, validate: "required" },
      { name: "deployeddate", type: "text", title: "Deployed Date", width: 15},
      { name: "cube", type: "text", title: "Cube", width: 10 },
      { name: "comment", type: "text", title: "Comment", width: 25 },
    ]
  });
</script>