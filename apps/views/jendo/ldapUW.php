<?php
  $Layout = CUtil::GetLayout("_bootstrap_2c");
  if ($PageData["Title"] == $AppState["Name"])
  {
    $PageData["Title"] = "Ldap UW";
  }
?>
<html>
<head>
  <title>Ajax with jQuery Example</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/JavaScript">
    $(function () {
      function log(message) {
        $("<div/>").text(message).prependTo("#log");
        $("#log").attr("scrollTop", 0);
      }

      $("#email").autocomplete({
        source: "?t=odata&a=_ldapuw&c=emailuw",
        minLength: 2,
        select: function (event, ui) {
          $("#name").val(ui.item.cn);
          $("#mailstop").val(ui.item.mailstop);
          log(ui.item ?
            "Selected: " + ui.item.mail + " aka " + ui.item.cn :
            "Nothing selected, input was " + this.mail);
        }
      });
      $("#name").autocomplete({
        source: "?t=odata&a=_ldapuw&c=name",
        minLength: 2,
        select: function (event, ui) {
          $("#email").val(ui.item.mail);
          $("#mailstop").val(ui.item.mailstop);
          log(ui.item ?
            "Selected: " + ui.item.mail + " aka " + ui.item.cn :
            "Nothing selected, input was " + this.mail);
        }
      });
    });
  </script>
</head>
<body>
  <h3>LDAP query test (must login to JV)</h3>
  <form id="ldapForm" ACTION="" METHOD="POST">
    <fieldset>
      <legend>Ldap Form</legend>
      <p>
        <label for="email">Email</label>
        <input id="email" name="email" type="text" size="30" />
      </p>
      <p>
        <label for="name">Name</label>
        <input id="name" name="name" minlength="2" size="30" />
      </p>
      <p>
        <label for="mailstop">Mail Stop</label>
        <input id="mailstop" name="mailstop" type="text" />
      </p>
      <p>
        <input class="submit" type="submit" />
      </p>
    </fieldset>
  </form>
  <div id="list">
    <div class="ui-widget" style="margin-top:2em; font-family:Arial">
      Result:
      <div id="log" style="height: 200px; width: 100%; overflow: auto;" class="ui-widget-content"></div>
    </div>
  </div>
</body>
</html>