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
$Live_Brief_Post_delete = new Live_Brief_Post_delete();

// Run the page
$Live_Brief_Post_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Live_Brief_Post_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fLive_Brief_Postdelete = currentForm = new ew.Form("fLive_Brief_Postdelete", "delete");

// Form_CustomValidate event
fLive_Brief_Postdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLive_Brief_Postdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fLive_Brief_Postdelete.lists["x_tipo"] = <?php echo $Live_Brief_Post_delete->tipo->Lookup->toClientList() ?>;
fLive_Brief_Postdelete.lists["x_tipo"].options = <?php echo JsonEncode($Live_Brief_Post_delete->tipo->options(FALSE, TRUE)) ?>;
fLive_Brief_Postdelete.lists["x_tipoEvento"] = <?php echo $Live_Brief_Post_delete->tipoEvento->Lookup->toClientList() ?>;
fLive_Brief_Postdelete.lists["x_tipoEvento"].options = <?php echo JsonEncode($Live_Brief_Post_delete->tipoEvento->options(FALSE, TRUE)) ?>;
fLive_Brief_Postdelete.lists["x_CategoriaEvento"] = <?php echo $Live_Brief_Post_delete->CategoriaEvento->Lookup->toClientList() ?>;
fLive_Brief_Postdelete.lists["x_CategoriaEvento"].options = <?php echo JsonEncode($Live_Brief_Post_delete->CategoriaEvento->lookupOptions()) ?>;
fLive_Brief_Postdelete.lists["x_evento"] = <?php echo $Live_Brief_Post_delete->evento->Lookup->toClientList() ?>;
fLive_Brief_Postdelete.lists["x_evento"].options = <?php echo JsonEncode($Live_Brief_Post_delete->evento->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $Live_Brief_Post_delete->showPageHeader(); ?>
<?php
$Live_Brief_Post_delete->showMessage();
?>
<form name="fLive_Brief_Postdelete" id="fLive_Brief_Postdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Live_Brief_Post_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $Live_Brief_Post_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Live_Brief_Post">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Live_Brief_Post_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Live_Brief_Post->tipo->Visible) { // tipo ?>
		<th class="<?php echo $Live_Brief_Post->tipo->headerCellClass() ?>"><span id="elh_Live_Brief_Post_tipo" class="Live_Brief_Post_tipo"><?php echo $Live_Brief_Post->tipo->caption() ?></span></th>
<?php } ?>
<?php if ($Live_Brief_Post->tipoEvento->Visible) { // tipoEvento ?>
		<th class="<?php echo $Live_Brief_Post->tipoEvento->headerCellClass() ?>"><span id="elh_Live_Brief_Post_tipoEvento" class="Live_Brief_Post_tipoEvento"><?php echo $Live_Brief_Post->tipoEvento->caption() ?></span></th>
<?php } ?>
<?php if ($Live_Brief_Post->CategoriaEvento->Visible) { // CategoriaEvento ?>
		<th class="<?php echo $Live_Brief_Post->CategoriaEvento->headerCellClass() ?>"><span id="elh_Live_Brief_Post_CategoriaEvento" class="Live_Brief_Post_CategoriaEvento"><?php echo $Live_Brief_Post->CategoriaEvento->caption() ?></span></th>
<?php } ?>
<?php if ($Live_Brief_Post->evento->Visible) { // evento ?>
		<th class="<?php echo $Live_Brief_Post->evento->headerCellClass() ?>"><span id="elh_Live_Brief_Post_evento" class="Live_Brief_Post_evento"><?php echo $Live_Brief_Post->evento->caption() ?></span></th>
<?php } ?>
<?php if ($Live_Brief_Post->imagen->Visible) { // imagen ?>
		<th class="<?php echo $Live_Brief_Post->imagen->headerCellClass() ?>"><span id="elh_Live_Brief_Post_imagen" class="Live_Brief_Post_imagen"><?php echo $Live_Brief_Post->imagen->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Live_Brief_Post_delete->RecCnt = 0;
$i = 0;
while (!$Live_Brief_Post_delete->Recordset->EOF) {
	$Live_Brief_Post_delete->RecCnt++;
	$Live_Brief_Post_delete->RowCnt++;

	// Set row properties
	$Live_Brief_Post->resetAttributes();
	$Live_Brief_Post->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Live_Brief_Post_delete->loadRowValues($Live_Brief_Post_delete->Recordset);

	// Render row
	$Live_Brief_Post_delete->renderRow();
?>
	<tr<?php echo $Live_Brief_Post->rowAttributes() ?>>
<?php if ($Live_Brief_Post->tipo->Visible) { // tipo ?>
		<td<?php echo $Live_Brief_Post->tipo->cellAttributes() ?>>
<span id="el<?php echo $Live_Brief_Post_delete->RowCnt ?>_Live_Brief_Post_tipo" class="Live_Brief_Post_tipo">
<span<?php echo $Live_Brief_Post->tipo->viewAttributes() ?>>
<?php echo $Live_Brief_Post->tipo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Live_Brief_Post->tipoEvento->Visible) { // tipoEvento ?>
		<td<?php echo $Live_Brief_Post->tipoEvento->cellAttributes() ?>>
<span id="el<?php echo $Live_Brief_Post_delete->RowCnt ?>_Live_Brief_Post_tipoEvento" class="Live_Brief_Post_tipoEvento">
<span<?php echo $Live_Brief_Post->tipoEvento->viewAttributes() ?>>
<?php echo $Live_Brief_Post->tipoEvento->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Live_Brief_Post->CategoriaEvento->Visible) { // CategoriaEvento ?>
		<td<?php echo $Live_Brief_Post->CategoriaEvento->cellAttributes() ?>>
<span id="el<?php echo $Live_Brief_Post_delete->RowCnt ?>_Live_Brief_Post_CategoriaEvento" class="Live_Brief_Post_CategoriaEvento">
<span<?php echo $Live_Brief_Post->CategoriaEvento->viewAttributes() ?>>
<?php echo $Live_Brief_Post->CategoriaEvento->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Live_Brief_Post->evento->Visible) { // evento ?>
		<td<?php echo $Live_Brief_Post->evento->cellAttributes() ?>>
<span id="el<?php echo $Live_Brief_Post_delete->RowCnt ?>_Live_Brief_Post_evento" class="Live_Brief_Post_evento">
<span<?php echo $Live_Brief_Post->evento->viewAttributes() ?>>
<?php echo $Live_Brief_Post->evento->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Live_Brief_Post->imagen->Visible) { // imagen ?>
		<td<?php echo $Live_Brief_Post->imagen->cellAttributes() ?>>
<span id="el<?php echo $Live_Brief_Post_delete->RowCnt ?>_Live_Brief_Post_imagen" class="Live_Brief_Post_imagen">
<span>
<?php echo GetFileViewTag($Live_Brief_Post->imagen, $Live_Brief_Post->imagen->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Live_Brief_Post_delete->Recordset->moveNext();
}
$Live_Brief_Post_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Live_Brief_Post_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Live_Brief_Post_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$Live_Brief_Post_delete->terminate();
?>