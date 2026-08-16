@using System.Collections.Specialized;
@using Co;

@{
  Layout = CUtils.GetLayout("_bootstrap_top");
  PageData["Title"] = "PC Deployment";
//  string ajax_qs = CUtils.Tap2Qs("/fbsq/__ajpcdeploy");
  string ajax_qs = CUtils.Tap2Qs("/udata/_itinvent") + "&c=fbsservers"; // refine ajx with &c=cmd
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
      { name: "application", type: "text", title: "Application", width: 8, validate: "required" },
      { name: "osversion", type: "text", title: "OSVersion", width: 8, validate: "required" },
      { name: "servername", type: "text", title: "ServerName", width: 15, validate: "required" },
      { name: "dbname", type: "text", title: "DbName", width: 15 },
      { name: "location", type: "text", title: "Location", width: 15 },
      { name: "ipaddress", type: "text", title: "IPAddress", width: 15 },
      { name: "backupmethod", type: "text", title: "BackupMethod", width: 15 },
      { name: "primaryfunction", type: "text", title: "PrimaryFunction", width: 15 },
      { name: "firewallinfo", type: "text", title: "FirewallInfo", width: 15 },
      { name: "notes", type: "text", title: "Notes", width: 15 },
      { name: "instancename", type: "text", title: "InstanceName", width: 15 },
      { name: "status", type: "text", title: "Status", width: 10 },
    ]
  });
</script>