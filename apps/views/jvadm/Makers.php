@using System.Collections.Specialized;
@using Co;
@{
  Layout = CUtils.GetLayout("_ejv");
  PageData["Title"] = "JV Makers";
//  string ajax_qs = CUtils.Tap2Qs("/jvadm/__ajuser")+"&c=maker"; // refine ajx with &c=cmd
  string ajax_qs = CUtils.Tap2Qs("/udata/_ejv") + "&c=usr"; // refine ajx with &c=cmd
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
    height: "700px",

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
      { name: "user_id", type: "hidden", css: 'hide' },
      { name: "email_login", type: "text", title: "Email Login", width: 12, validate: "required" },
      { name: "name", type: "text", title: "Name", width: 15, validate: "required" },
      { name: "email", type: "text", title: "Email", width: 40, validate: "required" },
//      { name: "password", type: "text", title: "Password", width: 50 },
      { name: "remote_addr", type: "text", title: "IP", width: 25 },
      { name: "is_confirmed", type: "text", title: "A", width: 2 },
      { name: "phone", type: "text", title: "Phone", width: 8 },
      { name: "winuser", type: "text", title: "Win User", width: 12 },
      { name: "jvgroup", type: "text", title: "Group", width: 7 },
      { name: "jventity", type: "text", title: "Ent.", width: 5 },
      { name: "login_status", type: "text", title: "S", width: 2 },
      { name: "timestamp", type: "text", title: "TS", width: 35 },
      { name: "jventities", type: "text", title: "Entities", width: 28, validate: "required" },
      { name: "isjvloginform", type: "text", title: "Web", width: 3 },
      { name: "dmsg", type: "text", title: "Debug", width: 3 },
      ]
  });
</script>