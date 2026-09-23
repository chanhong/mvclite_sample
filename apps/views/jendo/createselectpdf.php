<?php
use MvcLite\CCore;

$PageData["Title"] = "Upload";
$archive = __DIR__ . "/App_Data/uploads/";
//$baseUrl = CHelpers\getSiteUrl();
$baseUrl = CUtil::siteUrl();
pln($baseUrl,'url');
// CUtil::siteUrl(Request.Url.ToString()

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    CFiles::createPDF($archive, $baseUrl);
}

$PageSizes = CreatePdf::getPageSizes();
$PageOrientations = CreatePdf::getPageOrientations();
?>

<article class="post type-post status-publish format-standard hentry">
  <header class="entry-header">
    <h1 class="entry-title">SelectPdf Free Html To Pdf Converter for PHP</h1>
  </header>
  <form method="POST">
    <p>Pdf Page Size:
      <?= CHtml::dropDnList("DdlPageSize", $PageSizes, "Letter") ?>
    </p>

    <p>Pdf Page Orientation:
      <?= CHtml::dropDnList("DdlPageOrientation", $PageOrientations, "Landscape") ?>
    </p>

    <p>
      <?= CHtml::label("TxtWidth:", "TxtWidth") ?>
      <?= CHtml::textInput("TxtWidth", "1024") ?>
    </p>
    <p>
      <?= CHtml::label("TxtHeight:", "TxtHeight") ?>
      <?= CHtml::textInput("TxtHeight", "25") ?>
    </p>

    <p>
      <?= CHtml::label("Html Code:", "TxtHtmlCode") ?><br />
      <?= CHtml::textArea("TxtHtmlCode", "Hello World using SelectPDF.") ?>
    </p>
    <p><input type="submit" value="Create!" /></p>
  </form>
</article>