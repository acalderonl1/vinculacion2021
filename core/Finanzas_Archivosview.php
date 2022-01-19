<?php
namespace PHPMaker2019\LiveBrief;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$Finanzas_Archivos_view = new Finanzas_Archivos_view();

// Run the page
$Finanzas_Archivos_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Finanzas_Archivos_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$Finanzas_Archivos->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fFinanzas_Archivosview = currentForm = new ew.Form("fFinanzas_Archivosview", "view");

// Form_CustomValidate event
fFinanzas_Archivosview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fFinanzas_Archivosview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$Finanzas_Archivos->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Finanzas_Archivos_view->ExportOptions->render("body") ?>
<?php $Finanzas_Archivos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Finanzas_Archivos_view->showPageHeader(); ?>
<?php
$Finanzas_Archivos_view->showMessage();
?>
<form name="fFinanzas_Archivosview" id="fFinanzas_Archivosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Finanzas_Archivos_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $Finanzas_Archivos_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Finanzas_Archivos">
<input type="hidden" name="modal" value="<?php echo (int)$Finanzas_Archivos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Finanzas_Archivos->Id->Visible) { // Id ?>
	<tr id="r_Id">
		<td class="<?php echo $Finanzas_Archivos_view->TableLeftColumnClass ?>"><span id="elh_Finanzas_Archivos_Id"><?php echo $Finanzas_Archivos->Id->caption() ?></span></td>
		<td data-name="Id"<?php echo $Finanzas_Archivos->Id->cellAttributes() ?>>
<span id="el_Finanzas_Archivos_Id">
<span<?php echo $Finanzas_Archivos->Id->viewAttributes() ?>>
<?php echo $Finanzas_Archivos->Id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Finanzas_Archivos->archivo->Visible) { // archivo ?>
	<tr id="r_archivo">
		<td class="<?php echo $Finanzas_Archivos_view->TableLeftColumnClass ?>"><span id="elh_Finanzas_Archivos_archivo"><?php echo $Finanzas_Archivos->archivo->caption() ?></span></td>
		<td data-name="archivo"<?php echo $Finanzas_Archivos->archivo->cellAttributes() ?>>
<span id="el_Finanzas_Archivos_archivo">
<span<?php echo $Finanzas_Archivos->archivo->viewAttributes() ?>>
<?php echo $Finanzas_Archivos->archivo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Finanzas_Archivos->fecha->Visible) { // fecha ?>
	<tr id="r_fecha">
		<td class="<?php echo $Finanzas_Archivos_view->TableLeftColumnClass ?>"><span id="elh_Finanzas_Archivos_fecha"><?php echo $Finanzas_Archivos->fecha->caption() ?></span></td>
		<td data-name="fecha"<?php echo $Finanzas_Archivos->fecha->cellAttributes() ?>>
<span id="el_Finanzas_Archivos_fecha">
<span<?php echo $Finanzas_Archivos->fecha->viewAttributes() ?>>
<?php echo $Finanzas_Archivos->fecha->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$Finanzas_Archivos_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$Finanzas_Archivos->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$Finanzas_Archivos_view->terminate();
?>