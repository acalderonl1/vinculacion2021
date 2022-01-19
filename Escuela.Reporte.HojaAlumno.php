<?php
namespace PHPMaker2019\LiveBrief;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 
?>
<?php
$RELATIVE_PATH = "./core/";
$ROOT_RELATIVE_PATH = "./core/";
?>
<?php include_once $RELATIVE_PATH . "autoload.php" ?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$main = new main();

// Run the page
$main->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>


<?php
namespace PHPMaker2019\LiveBrief;
/*-----------------False Key---------------------*/function random_str(    int $length = 23,    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string {    if ($length < 1) {        throw new \RangeException("Length must be a positive integer");    }    $pieces = [];    $max = mb_strlen($keyspace, '8bit') - 1;    for ($i = 0; $i < $length; ++$i) {        $pieces []= $keyspace[random_int(0, $max)];    }    return implode('', $pieces);}//$a = random_str(128);
$falsekey=random_str(128);
if($_GET[exportar]=='word'){
?>
<?php
$name= date(YmdHms);
 header("Content-Type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=".$name.".doc");
?>
<?php } ?>
<!DOCTYPE html>
<html>
<head>
<title>BMP 2020 - Teatro Centro de Arte</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="Favico.png">
<link rel="apple-touch-icon-precomposed" href="Favico.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="Favico.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="Favico.png">
<?php if (@$ExportType == "" || @$ExportType == "print") { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $RELATIVE_PATH ?>adminlte3/css/<?php echo CssFile("adminlte.css") ?>">
<link rel="stylesheet" type="text/css" href="<?php echo $RELATIVE_PATH ?>plugins/font-awesome/css/font-awesome.min.css">
<?php } ?>
<?php if (@$ExportType == "" || @$ExportType == "print") { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $RELATIVE_PATH ?>phpcss/jquery.fileupload.css">
<link rel="stylesheet" type="text/css" href="<?php echo $RELATIVE_PATH ?>phpcss/jquery.fileupload-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo $RELATIVE_PATH ?>colorbox/colorbox.css">
<?php foreach ($STYLESHEET_FILES as $cssfile) { // External Stylesheets ?>
<link rel="stylesheet" type="text/css" href="<?php echo (IsRemote($cssfile) ? "" : $RELATIVE_PATH) . $cssfile ?>">
<?php } ?>
<?php } ?>
<?php if (@$ExportType == "" || @$ExportType == "print") { ?>
<?php if (IsResponsiveLayout()) { ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php } ?>
<link rel="stylesheet" type="text/css" href="<?php echo $RELATIVE_PATH ?><?php echo CssFile(PROJECT_STYLESHEET_FILENAME) ?>">
<?php if (@$CustomExportType == "pdf" && PDF_STYLESHEET_FILENAME <> "") { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $RELATIVE_PATH ?><?php echo PDF_STYLESHEET_FILENAME ?>">
<?php } ?>
<script src="<?php echo $RELATIVE_PATH ?>jquery/jquery-3.4.1.min.js"></script>
<script src="<?php echo $RELATIVE_PATH ?>jquery/jquery.ui.widget.js"></script>
<script src="<?php echo $RELATIVE_PATH ?>jquery/jquery.storageapi.min.js"></script>
<?php } ?>
<?php if (@$ExportType == "" || @$ExportType == "print") { ?>
<script src="<?php echo $RELATIVE_PATH ?>bootstrap4/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $RELATIVE_PATH ?>adminlte3/js/adminlte.js"></script>
<script src="<?php echo $RELATIVE_PATH ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo $RELATIVE_PATH ?>jquery/jquery.fileDownload.min.js"></script>
<script src="<?php echo $RELATIVE_PATH ?>jquery/load-image.all.min.js"></script>
<script src="<?php echo $RELATIVE_PATH ?>jquery/jqueryfileupload.min.js"></script>
<script src="<?php echo $RELATIVE_PATH ?>phpjs/typeahead.jquery.js"></script>
<script src="<?php echo $RELATIVE_PATH ?>colorbox/jquery.colorbox-min.js"></script>
<script src="<?php echo $RELATIVE_PATH ?>phpjs/mobile-detect.min.js"></script>
<script src="<?php echo $RELATIVE_PATH ?>moment/moment.min.js"></script>
<?php foreach ($JAVASCRIPT_FILES as $jsfile) { // External JavaScripts ?>
<script src="<?php echo (IsRemote($jsfile) ? "" : $RELATIVE_PATH) . $jsfile ?>"></script>
<?php } ?>
<?php } ?>
<?php if (@$ExportType == "" || @$ExportType == "print") { ?>
<script src="<?php echo $RELATIVE_PATH ?>phpjs/jsrender.min.js"></script>
<script src="<?php echo $RELATIVE_PATH ?>phpjs/ewp15.js"></script>
<script>
jQuery.extend(ew, {
	LANGUAGE_ID: "<?php echo $CurrentLanguage ?>",
	DATE_SEPARATOR: "<?php echo $DATE_SEPARATOR ?>", // Date separator
	TIME_SEPARATOR: "<?php echo $TIME_SEPARATOR ?>", // Time separator
	DATE_FORMAT: "<?php echo $DATE_FORMAT ?>", // Default date format
	DATE_FORMAT_ID: <?php echo $DATE_FORMAT_ID ?>, // Default date format ID
	DATETIME_WITHOUT_SECONDS: <?php echo DATETIME_WITHOUT_SECONDS ? "true" : "false" ?>, // Date/Time without seconds
	DECIMAL_POINT: "<?php echo $DECIMAL_POINT ?>",
	THOUSANDS_SEP: "<?php echo $THOUSANDS_SEP ?>",
	SESSION_TIMEOUT: <?php echo (SESSION_TIMEOUT > 0) ? SessionTimeoutTime() : 0 ?>, // Session timeout time (seconds)
	SESSION_TIMEOUT_COUNTDOWN: <?php echo SESSION_TIMEOUT_COUNTDOWN ?>, // Count down time to session timeout (seconds)
	SESSION_KEEP_ALIVE_INTERVAL: <?php echo SESSION_KEEP_ALIVE_INTERVAL ?>, // Keep alive interval (seconds)
	RELATIVE_PATH: "<?php echo $RELATIVE_PATH ?>", // Relative path
	IS_LOGGEDIN: <?php echo IsLoggedIn() ? "true" : "false" ?>, // Is logged in
	IS_SYS_ADMIN: <?php echo IsSysAdmin() ? "true" : "false" ?>, // Is sys admin
	CURRENT_USER_NAME: "<?php echo JsEncode(CurrentUserName()) ?>", // Current user name
	IS_AUTOLOGIN: <?php echo IsAutoLogin() ? "true" : "false" ?>, // Is logged in with option "Auto login until I logout explicitly"
	TIMEOUT_URL: "<?php echo $RELATIVE_PATH ?>logout.php", // Timeout URL
	API_URL: "<?php echo $RELATIVE_PATH ?><?php echo API_URL ?>", // API file name
	API_ACTION_NAME: "<?php echo API_ACTION_NAME ?>", // API action name
	API_OBJECT_NAME: "<?php echo API_OBJECT_NAME ?>", // API object name
	API_FIELD_NAME: "<?php echo API_FIELD_NAME ?>", // API field name
	API_KEY_NAME: "<?php echo API_KEY_NAME ?>", // API key name
	API_LIST_ACTION: "<?php echo API_LIST_ACTION ?>", // API list action
	API_VIEW_ACTION: "<?php echo API_VIEW_ACTION ?>", // API view action
	API_ADD_ACTION: "<?php echo API_ADD_ACTION ?>", // API add action
	API_EDIT_ACTION: "<?php echo API_EDIT_ACTION ?>", // API edit action
	API_DELETE_ACTION: "<?php echo API_DELETE_ACTION ?>", // API delete action
	API_LOGIN_ACTION: "<?php echo API_LOGIN_ACTION ?>", // API login action
	API_FILE_ACTION: "<?php echo API_FILE_ACTION ?>", // API file action
	API_UPLOAD_ACTION: "<?php echo API_UPLOAD_ACTION ?>", // API upload action
	API_JQUERY_UPLOAD_ACTION: "<?php echo API_JQUERY_UPLOAD_ACTION ?>", // API jQuery upload action
	API_SESSION_ACTION: "<?php echo API_SESSION_ACTION ?>", // API get session action
	API_LOOKUP_ACTION: "<?php echo API_LOOKUP_ACTION ?>", // API lookup action
	API_LOOKUP_TABLE: "<?php echo API_LOOKUP_TABLE ?>", // API lookup table name
	API_PROGRESS_ACTION: "<?php echo API_PROGRESS_ACTION ?>", // API progress action
	LOOKUP_FILTER_VALUE_SEPARATOR: "<?php echo LOOKUP_FILTER_VALUE_SEPARATOR ?>", // Lookup filter value separator
	AUTO_SUGGEST_MAX_ENTRIES: <?php echo AUTO_SUGGEST_MAX_ENTRIES ?>, // Auto-Suggest max entries
	DISABLE_BUTTON_ON_SUBMIT: true,
	IMAGE_FOLDER: "phpimages/", // Image folder
	SESSION_ID: "<?php echo Encrypt(session_id()) ?>", // Session ID
	UPLOAD_URL: "<?php echo API_URL ?>", // Upload URL
	UPLOAD_TYPE: "<?php echo $UPLOAD_TYPE ?>", // Upload type
	UPLOAD_THUMBNAIL_WIDTH: <?php echo UPLOAD_THUMBNAIL_WIDTH ?>, // Upload thumbnail width
	UPLOAD_THUMBNAIL_HEIGHT: <?php echo UPLOAD_THUMBNAIL_HEIGHT ?>, // Upload thumbnail height
	MULTIPLE_UPLOAD_SEPARATOR: "<?php echo MULTIPLE_UPLOAD_SEPARATOR ?>", // Upload multiple separator
	IMPORT_FILE_ALLOWED_EXT: "<?php echo IMPORT_FILE_ALLOWED_EXT ?>", // Import file allowed extensions
	USE_COLORBOX: <?php echo (USE_COLORBOX) ? "true" : "false" ?>,
	USE_JAVASCRIPT_MESSAGE: false,
	PROJECT_STYLESHEET_FILENAME: "<?php echo PROJECT_STYLESHEET_FILENAME ?>", // Project style sheet
	PDF_STYLESHEET_FILENAME: "<?php echo PDF_STYLESHEET_FILENAME ?>", // PDF style sheet
	ANTIFORGERY_TOKEN: "<?php echo @$CurrentToken ?>",
	CSS_FLIP: <?php echo ($CSS_FLIP) ? "true" : "false" ?>,
	LAZY_LOAD: <?php echo ($LAZY_LOAD) ? "true" : "false" ?>,
	RESET_HEIGHT: <?php echo ($RESET_HEIGHT) ? "true" : "false" ?>,
	DEBUG_ENABLED: <?php echo (DEBUG_ENABLED) ? "true" : "false" ?>,
	SEARCH_FILTER_OPTION: "<?php echo SEARCH_FILTER_OPTION ?>",
	OPTION_HTML_TEMPLATE: <?php echo JsonEncode($OPTION_HTML_TEMPLATE) ?>
});
</script>
<?php } ?>
<?php if (@$ExportType == "" || @$ExportType == "print") { ?>
<script>
<?php echo $Language->toJson() ?>
ew.vars = <?php echo JsonEncode($CLIENT_VAR) ?>;
</script>
<script src="<?php echo $RELATIVE_PATH ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo $RELATIVE_PATH ?>phpjs/eweditor.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $RELATIVE_PATH ?>phpcss/bootstrap-datetimepicker.css">
<script src="<?php echo $RELATIVE_PATH ?>phpjs/bootstrap-datetimepicker.js"></script>
<script src="<?php echo $RELATIVE_PATH ?>phpjs/ewdatetimepicker.js"></script>
<script src="<?php echo $RELATIVE_PATH ?>phpjs/userfn15.js"></script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $RELATIVE_PATH ?>tcaintranet.ico"><link rel="icon" type="image/x-icon" href="<?php echo $RELATIVE_PATH ?>tcaintranet.ico">
<meta name="generator" content="PHPMaker v2019.0.10">
</head>
<body class="<?php echo $BODY_CLASS ?>" dir="<?php echo ($CSS_FLIP) ? "rtl" : "ltr" ?>"  
<?php
if($_GET[exportar]=='word'){?> style="width:20cm" <?php } ?>
>
<script type="text/javascript">
<!--
window.print();
//-->
</script>
<style>
@media print {
     .new-page {
       page-break-before: always;
     }
}

</style>




<?php

/***************************************************
			PARAMETROS DE INICIALIZAR reporte
/***************************************************/


if($_GET[filtro]==''){$filtro = '0';}else{$filtro=$_GET[filtro];}
?>

 <?php 
 

/**************************
REPORTE ESCUELAS
/**************************/

$t=0;
   $sql = "
SELECT
  `teatro13_temporada`.`esc_matriculas`.`Id`,
  `teatro13_temporada`.`esc_matriculas`.`alumno`,
  `teatro13_temporada`.`esc_matriculas`.`modalidad`,
  `teatro13_temporada`.`esc_alumnos`.`cedula`,
  `teatro13_temporada`.`esc_alumnos`.`apellidos`,
  `teatro13_temporada`.`esc_alumnos`.`nombres`,
  `teatro13_temporada`.`esc_alumnos`.`direccion`,
  `teatro13_temporada`.`esc_alumnos`.`email`,
  `teatro13_temporada`.`esc_alumnos`.`whatsapp`,
  `teatro13_temporada`.`esc_alumnos`.`nacimiento`,
  `teatro13_temporada`.`esc_alumnos`.`ruc`,
  `teatro13_temporada`.`esc_alumnos`.`razonsocial`,
  `teatro13_temporada`.`esc_alumnos`.`ruc_email`
FROM
  `teatro13_temporada`.`esc_alumnos`
  INNER JOIN `teatro13_temporada`.`esc_matriculas` ON
    `teatro13_temporada`.`esc_alumnos`.`Id` =
    `teatro13_temporada`.`esc_matriculas`.`alumno`
WHERE
  `teatro13_temporada`.`esc_matriculas`.`modalidad` = '$filtro'
  
    
  
  
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>

<div class="new-page" style="    text-transform: uppercase">

<table class="table table-sm"><tr>
<td>
<img src="https://www.tca.ec/images/2019/Logo-Teatro-Centro-de-Arte.svg" style="height: 150px; ">
</td>
<td>
<img src="data:image/png;base64,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">
</td></tr></table>


<h3 style="    margin-left: auto;
    margin-right: auto;">ESCUELAS DE ARTE</h3>

<br>
<h6>DATOS DEL ALUMNO</h6>
<hr>

	
<table class="table table-bordered">
<tr><td><h8>NOMBRES Y APELLIDOS</h8>
<hr>
<h6><?php echo $obj->apellidos;?> <?php echo $obj->nombres;?></h6>
</td></tr>
</table>
<table class="table table-bordered">
<tr>
<td><h8>CEDULA DE IDENTIDAD</h8>
<hr>
<h6><?php echo  $obj->cedula;?></h6>
</td>
<td><h8>EMAIL</h8>
<hr>
<h6><?php echo  $obj->email;?></h6>
</td>
<td><h8>TELEFONO</h8>
<hr>
<h6><?php echo  $obj->whatsapp;?></h6>
</td>
</tr>
</table>
<table class="table table-bordered">
<tr>
<td><h8>FECHA DE NACIMIENTO</h8>
<hr>
<h6><?php echo  $obj->nacimiento;?></h6>
</td>
<td><h8>DIRECCION</h8>
<hr>
<h6><?php echo  $obj->dirección;?></h6>
</td>
</tr>
</table>

<br>
<br>
<h6>DATOS DE FACTURACIÓN</h6>
<hr>
<table class="table table-bordered">
<tr>
<td><h8>RAZON SOCIAL </h8>
<hr>
<h6><?php echo  $obj->razonsocial;?></h6>
</td>
<td><h8>RUC</h8>
<hr>
<h6><?php echo  $obj->ruc;?></h6>
</td>
<td><h8>E-MAIL</h8>
<hr>
<h6><?php echo  $obj->ruc_email;?></h6>
</td>
</tr>
</table>

  
  </div>


<?php }   ?>


<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
</body></html>
<?php
$Reporte_Escuelas->terminate();
?>