<?php
  $layout = CUtils.GetLayout("_bootstrap");
  $PageData["Title"] = "Test Email";
  $meqs = CUtil::tap("/admin/testmail");
  $message = "";
  try
  {
    if (IsPost)
    {
      CMsg::_pdmsg(Request.Form, "frm");
      CUtil::SmtpClient(Request.Form);
      /*
            WebMail.Send(
                to: Request.Form["emailAddress"],
                subject: Request.Form["emailSubject"],
                body: Request.Form["emailBody"]
           );
      */
      $message = "Email sent!";
      $_SESSION["feedback"] = $message;
    }
  } catch (Exception)
  {
    $message = "Email could not be sent!";
  }
}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Test Email</title>
</head>
<body>
  <h1>Test Email</h1>
 <?php echo htmlspecialchars(CHtml.FrmBeg($meqs)); ?>
    <p>
      @Html.Label("Email address:", "emailAddress")
      @Html.TextBox("emailAddress")
    </p>
    <p>
      @Html.Label("Subject:", "emailSubject")
      @Html.TextBox("emailSubject")
    </p>
    <p>
      @Html.Label("Text to send:", "emailBody")<br />
      @Html.TextArea("emailBody", "")
    </p>
    <p><input type="submit" value="Send!" /></p>
    @if (IsPost)
    {
      <p>@message</p>
    }
    <?php echo htmlspecialchars(CHtml.FrmEnd($meqs)); ?>
</body>
</html>