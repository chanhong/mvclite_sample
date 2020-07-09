<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title>@PageData["Title"]</title>
  <meta content="text/html; charset=windows-1252" http-equiv="Content-Type">
  <?php
    echo @$data['header_bef']; 
    echo $this->h->css($this->vendorFolder . '/' .'twbs/bootstrap/dist/css/bootstrap.min.css');
    echo $this->h->css($this->publicFolder . '/' .'css/bootstrap-custom.css');
    echo $this->h->css($this->publicFolder . '/' .'css/custom.css');
    echo $this->h->jsSrc($this->vendorFolder . '/' ."components/jquery.min.js");
    echo $this->h->jsSrc($this->vendorFolder . '/' ."components/jqueryui/jquery-ui.min.js");
    echo $this->h->jsSrc($this->vendorFolder . '/' ."twbs/bootstrap/dist/js/bootstrap.min.js");
    echo $this->h->jsSrc($this->publicFolder . '/' ."js/ie-emulation-modes-warning.js");
?>  
  <style type="text/css">
    .xl39 {
      background: #99CCFF;
    }
  </style>
  <meta name="viewport" content="width=device-width" />
</head>
<body>
  <div class="mainbody">
    <div id="topHeader">
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr valign="middle" width="100%">
          <td align="left">
            <img alt="[@AppState["Name"]]" border="1" src="~/Shared/images/logo.gif" vspace="2">
          </td>
          <td align="right">
            <font color="LightGrey" face="helvetica, sans-serif;" size="6">@PageData["Title"]</font>
          </td>
          <td></td>
        </tr>
      </table>
    </div>
    <div class="navbar navbar-expand-sm" style="background-color: #E8EAED;">
      <ul class="navbar-nav mr-auto text-center">@RenderPage("~/Shared/views/_top.cshtml")</ul>
    </div>
    <div class="main-content">
      <div class="text-right">
        <font color="LightGrey">
          @Html.Raw(usrinfo)
        </font>
      </div>
      <div class="vmenu">
        <ul class="navbar-nav ml-auto">@RenderPage("~/Shared/views/_top_header.cshtml")</ul>
      </div>
      <div class="main-body">
        <div class="text-center">
          @Html.Raw(CUtils.getAppMsg("broadcast"))
          @Html.Raw(CUtils.getSessMsg("feedback"))
          @Html.Raw(CUtils.getSessMsg("fbdmsg", "grey"))
        </div>
        @RenderBody()
      </div>
    </div>
    <div class="navbar navbar-expand-sm" style="background-color: #E8EAED;">
      <ul class="navbar-nav mx-auto text-center">@RenderPage("~/Shared/views/_footer_bef.cshtml")</ul>
    </div>
    <div class="footer">
      @RenderPage("~/Shared/views/_footer_aft.cshtml")
      @if (IsSectionDefined("address"))
      {
        @RenderSection("address")
      }
    </div>
  </div>
  <script src="~/Shared/js/site.js"></script>
  @RenderSection("Scripts", required: false)
</body>
</html>