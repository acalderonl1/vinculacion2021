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
$Finanzas_Archivos_delete = new Finanzas_Archivos_delete();

// Run the page
$Finanzas_Archivos_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Finanzas_Archivos_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fFinanzas_Archivosdelete = currentForm = new ew.Form("fFinanzas_Archivosdelete", "delete");

// Form_CustomValidate event
fFinanzas_Archivosdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fFinanzas_Archivosdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $Finanzas_Archivos_delete->showPageHeader(); ?>
<?php
$Finanzas_Archivos_delete->showMessage();
?>
<form name="fFinanzas_Archivosdelete" id="fFinanzas_Archivosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Finanzas_Archivos_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $Finanzas_Archivos_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Finanzas_Archivos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Finanzas_Archivos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Finanzas_Archivos->Id->Visible) { // Id ?>
		<th class="<?php echo $Finanzas_Archivos->Id->headerCellClass() ?>"><span id="elh_Finanzas_Archivos_Id" class="Finanzas_Archivos_Id"><?php echo $Finanzas_Archivos->Id->caption() ?></span></th>
<?php } ?>
<?php if ($Finanzas_Archivos->archivo->Visible) { // archivo ?>
		<th class="<?php echo $Finanzas_Archivos->archivo->headerCellClass() ?>"><span id="elh_Finanzas_Archivos_archivo" class="Finanzas_Archivos_archivo"><?php echo $Finanzas_Archivos->archivo->caption() ?></span></th>
<?php } ?>
<?php if ($Finanzas_Archivos->fecha->Visible) { // fecha ?>
		<th class="<?php echo $Finanzas_Archivos->fecha->headerCellClass() ?>"><span id="elh_Finanzas_Archivos_fecha" class="Finanzas_Archivos_fecha"><?php echo $Finanzas_Archivos->fecha->caption() ?></span></th>
<?php } ?>
<?php if ($Finanzas_Archivos->Saldo->Visible) { // Saldo ?>
		<th class="<?php echo $Finanzas_Archivos->Saldo->headerCellClass() ?>"><span id="elh_Finanzas_Archivos_Saldo" class="Finanzas_Archivos_Saldo"><?php echo $Finanzas_Archivos->Saldo->caption() ?></span></th>
<?php } ?>
<?php if ($Finanzas_Archivos->Estado->Visible) { // Estado ?>
		<th class="<?php echo $Finanzas_Archivos->Estado->headerCellClass() ?>"><span id="elh_Finanzas_Archivos_Estado" class="Finanzas_Archivos_Estado"><?php echo $Finanzas_Archivos->Estado->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Finanzas_Archivos_delete->RecCnt = 0;
$i = 0;
while (!$Finanzas_Archivos_delete->Recordset->EOF) {
	$Finanzas_Archivos_delete->RecCnt++;
	$Finanzas_Archivos_delete->RowCnt++;

	// Set row properties
	$Finanzas_Archivos->resetAttributes();
	$Finanzas_Archivos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Finanzas_Archivos_delete->loadRowValues($Finanzas_Archivos_delete->Recordset);

	// Render row
	$Finanzas_Archivos_delete->renderRow();
?>
	<tr<?php echo $Finanzas_Archivos->rowAttributes() ?>>
<?php if ($Finanzas_Archivos->Id->Visible) { // Id ?>
		<td<?php echo $Finanzas_Archivos->Id->cellAttributes() ?>>
<span id="el<?php echo $Finanzas_Archivos_delete->RowCnt ?>_Finanzas_Archivos_Id" class="Finanzas_Archivos_Id">
<span<?php echo $Finanzas_Archivos->Id->viewAttributes() ?>>
<?php echo $Finanzas_Archivos->Id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Finanzas_Archivos->archivo->Visible) { // archivo ?>
		<td<?php echo $Finanzas_Archivos->archivo->cellAttributes() ?>>
<span id="el<?php echo $Finanzas_Archivos_delete->RowCnt ?>_Finanzas_Archivos_archivo" class="Finanzas_Archivos_archivo">
<span<?php echo $Finanzas_Archivos->archivo->viewAttributes() ?>>
<?php echo GetFileViewTag($Finanzas_Archivos->archivo, $Finanzas_Archivos->archivo->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Finanzas_Archivos->fecha->Visible) { // fecha ?>
		<td<?php echo $Finanzas_Archivos->fecha->cellAttributes() ?>>
<span id="el<?php echo $Finanzas_Archivos_delete->RowCnt ?>_Finanzas_Archivos_fecha" class="Finanzas_Archivos_fecha">
<span<?php echo $Finanzas_Archivos->fecha->viewAttributes() ?>>
<?php echo $Finanzas_Archivos->fecha->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Finanzas_Archivos->Saldo->Visible) { // Saldo ?>
		<td<?php echo $Finanzas_Archivos->Saldo->cellAttributes() ?>>
<span id="el<?php echo $Finanzas_Archivos_delete->RowCnt ?>_Finanzas_Archivos_Saldo" class="Finanzas_Archivos_Saldo">
<span<?php echo $Finanzas_Archivos->Saldo->viewAttributes() ?>>
<?php echo $Finanzas_Archivos->Saldo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Finanzas_Archivos->Estado->Visible) { // Estado ?>
		<td<?php echo $Finanzas_Archivos->Estado->cellAttributes() ?>>
<span id="el<?php echo $Finanzas_Archivos_delete->RowCnt ?>_Finanzas_Archivos_Estado" class="Finanzas_Archivos_Estado">
<span<?php echo $Finanzas_Archivos->Estado->viewAttributes() ?>>
<?php echo $Finanzas_Archivos->Estado->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Finanzas_Archivos_delete->Recordset->moveNext();
}
$Finanzas_Archivos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Finanzas_Archivos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Finanzas_Archivos_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$Finanzas_Archivos_delete->terminate();
?>