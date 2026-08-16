@using System.Collections.Specialized;
@using Co;

@{
  Layout = CUtils.GetLayout("_bootstrap_top");
  PageData["Title"] = "PC Deployment";
//  string ajax_qs = CUtils.Tap2Qs("/fbsq/__ajpcdeploy");
  string ajax_qs = CUtils.Tap2Qs("/udata/_itinvent") + "&c=fbssupportedpc"; // refine ajx with &c=cmd
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
      { name: "last", type: "text", title: "LName", width: 8, validate: "required" },
      { name: "first", type: "text", title: "FName", width: 8, validate: "required" },
      { name: "computername", type: "text", title: "PCName", width: 15, validate: "required" },
      { name: "location", type: "text", title: "Location", width: 15 },
      { name: "notes", type: "text", title: "Notes", width: 15 },
      { name: "replace", type: "text", title: "R", width: 2 },
      { name: "status", type: "text", title: "Status", width: 10 },
      { name: "description", type: "text", title: "Description", width: 10 },
      { name: "model", type: "text", title: "Model", width: 10 },
      { name: "os", type: "text", title: "OS", width: 10 },
      { name: "os_arch", type: "text", title: "OS_Arch", width: 10 },
      { name: "imagetype", type: "text", title: "ImageType", width: 15 },
      { name: "deployeddate", type: "text", title: "Deployed Date", width: 15 },
      { name: "subnet", type: "text", title: "Subnet", width: 15 },
      { name: "building", type: "text", title: "Building", width: 15 },
    ]
  });
</script>