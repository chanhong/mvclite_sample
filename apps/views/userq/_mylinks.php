@using System.Collections.Specialized;
@using System.Data.OleDb;
@using Co;
@{
  //  Layout is already in _main
  PageData["Title"] = "My Links";
  string dbenv = CCore._DbEnv("dbacct");
  string ajax_qs = CUtils.Tap2Qs("/udata/_acctlinks") + "&c=mylinks"; // refine ajx with &c=cmd
  string msg = PageData["Title"];
  //  CMsg._dmsg(msg, "in");
  //  CUtils.Add2SessVar("feedback", msg);
  CCore._usr = CUtils.getSessNv("uinfo"); // use session instead
  CMsg._pdmsg(CCore._usr, "_usr");
}
<script>
      $(document).ready(function () { // load json file using jquery ajax
        $.getJSON("@Html.Raw(ajax_qs)", function (data) {
          var output = '<ul>';
          $.each(data, function (key, val) {
            output += '<li><a href="' + val.url + '" style="color: rgb(51, 102, 102);" target="_blank">' + val.name + '</a></li>';
          });
          output += '</ul>';
          $('#mylinks').html(output); 	// replace all existing content
        });
      });
</script>
<table border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr valign="top">
      <td width="5" nowrap>&nbsp;</td>
      <td width="4">&nbsp;</td>
      <td bgcolor="transparent" width="3">&nbsp;</td>
      <td width="4">&nbsp;</td>
      <td valign="top" width="723"><font size="2"></font></td>
    </tr>
    <tr valign="top">
      <td width="1" nowrap height="432">&nbsp;</td>
      <td width="1" height="432">&nbsp;</td>
      <td bgcolor="transparent" width="3" height="532">&nbsp;</td>
      <td width="2" height="432">&nbsp;</td>
      <td valign="top" height="432">
        <table cellspacing="0" cellpadding="0" border="0" id="table13" height="430">
          <tr valign="top">
            <td valign="top" width="15" height="430">&nbsp;</td>
            <td valign="top" width="723" height="430">
              <div id="mylinks"></div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </tbody>
</table>