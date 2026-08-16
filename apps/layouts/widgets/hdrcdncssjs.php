<?php
$jquery = "jquery-3.6.0.min.js";
$jqui = "1.13.2";
$proper = "1.14.7";
$bootstrap = "5.8.2"; // use composer no need for version like CDN
$react = "18";
$bsawesome = "4.7.0";
$kendocss = "13.0.0";
$kendoui = "2026.1.212";
$kockout = "knockout-3.5.0.js";
$jqvalidate = "1.21.0";

echo $this->h->css($this->publicFolder . '/' . 'css/screen.css');
?>

<script src="https://code.jquery.com/<?php echo $jquery; ?>"></script>
<script src="https://code.jquery.com/ui/<?php echo $jqui; ?>/jquery-ui.min.js"></script>
<!-- jQuery UI CSS Theme -->
<link rel="stylesheet" href="https://code.jquery.com/ui/<?php echo $jqui; ?>/themes/base/jquery-ui.css">
<?php
// load bootstrap after jquery 

echo $this->h->css($this->vendorFolder . '/' . "twbs/bootstrap/dist/css/bootstrap.min.css");
// proper.js is in the bundle
echo $this->h->jsSrc($this->vendorFolder . '/' . "twbs/bootstrap/dist/js/bootstrap.bundle.min.js");
/*
or CDN

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

// proper in bootstrap bundle
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/<?php echo $proper; ?>/umd/popper.min.js"></script>

// remove not compatible with react 18-19
<script src="https://unpkg.com/react-beautiful-dnd@5.0.0/dist/react-beautiful-dnd.js"></script>
// this is better and compatible with react 18-19
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
// cause cursor to spin, not worth the load

<script src="https://cdn.jsdelivr.net/npm/modernizr@3.12.0/modernizr.min.js"></script>

*/
?>
<!-- load Bootstrap higher 5.0.2 cause cursor spinning-->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/<?php echo $bsawesome; ?>/css/font-awesome.min.css"
    rel="stylesheet" />

<!-- load Kendo -->
<link rel="stylesheet"
    href="https://kendo.cdn.telerik.com/themes/<?php echo $kendocss; ?>/default/default-ocean-blue.css">
<script src="http://kendo.cdn.telerik.com/<?php echo $kendoui; ?>/js/kendo.ui.core.min.js"></script>

<!-- React 18 is safer for CDN use than 19 -->
<script src="https://cdn.jsdelivr.net/npm/react@<?php echo $react; ?>/umd/react.development.js" crossorigin></script>
<script src="https://cdn.jsdelivr.net/npm/react-dom@<?php echo $react; ?>/umd/react-dom.development.js"
    crossorigin></script>
<script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>

<!-- load Knockout -->
<script src="http://ajax.aspnetcdn.com/ajax/knockout/<?php echo $kockout; ?>"></script>

<!-- load Validate -->
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/<?php echo $jqvalidate; ?>/jquery.validate.min.js"></script>

<!-- jsGrid CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />

<!-- jsGrid JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>