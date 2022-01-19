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
$Live_Brief_Post_view = new Live_Brief_Post_view();

// Run the page
$Live_Brief_Post_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Live_Brief_Post_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$Live_Brief_Post->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fLive_Brief_Postview = currentForm = new ew.Form("fLive_Brief_Postview", "view");

// Form_CustomValidate event
fLive_Brief_Postview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLive_Brief_Postview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fLive_Brief_Postview.lists["x_tipo"] = <?php echo $Live_Brief_Post_view->tipo->Lookup->toClientList() ?>;
fLive_Brief_Postview.lists["x_tipo"].options = <?php echo JsonEncode($Live_Brief_Post_view->tipo->options(FALSE, TRUE)) ?>;
fLive_Brief_Postview.lists["x_tipoEvento"] = <?php echo $Live_Brief_Post_view->tipoEvento->Lookup->toClientList() ?>;
fLive_Brief_Postview.lists["x_tipoEvento"].options = <?php echo JsonEncode($Live_Brief_Post_view->tipoEvento->options(FALSE, TRUE)) ?>;
fLive_Brief_Postview.lists["x_CategoriaEvento"] = <?php echo $Live_Brief_Post_view->CategoriaEvento->Lookup->toClientList() ?>;
fLive_Brief_Postview.lists["x_CategoriaEvento"].options = <?php echo JsonEncode($Live_Brief_Post_view->CategoriaEvento->lookupOptions()) ?>;
fLive_Brief_Postview.lists["x_evento"] = <?php echo $Live_Brief_Post_view->evento->Lookup->toClientList() ?>;
fLive_Brief_Postview.lists["x_evento"].options = <?php echo JsonEncode($Live_Brief_Post_view->evento->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$Live_Brief_Post->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Live_Brief_Post_view->ExportOptions->render("body") ?>
<?php $Live_Brief_Post_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Live_Brief_Post_view->showPageHeader(); ?>
<?php
$Live_Brief_Post_view->showMessage();
?>
<form name="fLive_Brief_Postview" id="fLive_Brief_Postview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Live_Brief_Post_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $Live_Brief_Post_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Live_Brief_Post">
<input type="hidden" name="modal" value="<?php echo (int)$Live_Brief_Post_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Live_Brief_Post->Id->Visible) { // Id ?>
	<tr id="r_Id">
		<td class="<?php echo $Live_Brief_Post_view->TableLeftColumnClass ?>"><span id="elh_Live_Brief_Post_Id"><?php echo $Live_Brief_Post->Id->caption() ?></span></td>
		<td data-name="Id"<?php echo $Live_Brief_Post->Id->cellAttributes() ?>>
<span id="el_Live_Brief_Post_Id">
<span<?php echo $Live_Brief_Post->Id->viewAttributes() ?>>
<?php echo $Live_Brief_Post->Id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Live_Brief_Post->tipo->Visible) { // tipo ?>
	<tr id="r_tipo">
		<td class="<?php echo $Live_Brief_Post_view->TableLeftColumnClass ?>"><span id="elh_Live_Brief_Post_tipo"><?php echo $Live_Brief_Post->tipo->caption() ?></span></td>
		<td data-name="tipo"<?php echo $Live_Brief_Post->tipo->cellAttributes() ?>>
<span id="el_Live_Brief_Post_tipo">
<span<?php echo $Live_Brief_Post->tipo->viewAttributes() ?>>
<?php echo $Live_Brief_Post->tipo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Live_Brief_Post->tipoEvento->Visible) { // tipoEvento ?>
	<tr id="r_tipoEvento">
		<td class="<?php echo $Live_Brief_Post_view->TableLeftColumnClass ?>"><span id="elh_Live_Brief_Post_tipoEvento"><?php echo $Live_Brief_Post->tipoEvento->caption() ?></span></td>
		<td data-name="tipoEvento"<?php echo $Live_Brief_Post->tipoEvento->cellAttributes() ?>>
<span id="el_Live_Brief_Post_tipoEvento">
<span<?php echo $Live_Brief_Post->tipoEvento->viewAttributes() ?>>
<?php echo $Live_Brief_Post->tipoEvento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Live_Brief_Post->CategoriaEvento->Visible) { // CategoriaEvento ?>
	<tr id="r_CategoriaEvento">
		<td class="<?php echo $Live_Brief_Post_view->TableLeftColumnClass ?>"><span id="elh_Live_Brief_Post_CategoriaEvento"><?php echo $Live_Brief_Post->CategoriaEvento->caption() ?></span></td>
		<td data-name="CategoriaEvento"<?php echo $Live_Brief_Post->CategoriaEvento->cellAttributes() ?>>
<span id="el_Live_Brief_Post_CategoriaEvento">
<span<?php echo $Live_Brief_Post->CategoriaEvento->viewAttributes() ?>>
<?php echo $Live_Brief_Post->CategoriaEvento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Live_Brief_Post->evento->Visible) { // evento ?>
	<tr id="r_evento">
		<td class="<?php echo $Live_Brief_Post_view->TableLeftColumnClass ?>"><span id="elh_Live_Brief_Post_evento"><?php echo $Live_Brief_Post->evento->caption() ?></span></td>
		<td data-name="evento"<?php echo $Live_Brief_Post->evento->cellAttributes() ?>>
<span id="el_Live_Brief_Post_evento">
<span<?php echo $Live_Brief_Post->evento->viewAttributes() ?>>
<?php echo $Live_Brief_Post->evento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Live_Brief_Post->imagen->Visible) { // imagen ?>
	<tr id="r_imagen">
		<td class="<?php echo $Live_Brief_Post_view->TableLeftColumnClass ?>"><span id="elh_Live_Brief_Post_imagen"><?php echo $Live_Brief_Post->imagen->caption() ?></span></td>
		<td data-name="imagen"<?php echo $Live_Brief_Post->imagen->cellAttributes() ?>>
<span id="el_Live_Brief_Post_imagen">
<span>
<?php echo GetFileViewTag($Live_Brief_Post->imagen, $Live_Brief_Post->imagen->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Live_Brief_Post->__post->Visible) { // post ?>
	<tr id="r___post">
		<td class="<?php echo $Live_Brief_Post_view->TableLeftColumnClass ?>"><span id="elh_Live_Brief_Post___post"><?php echo $Live_Brief_Post->__post->caption() ?></span></td>
		<td data-name="__post"<?php echo $Live_Brief_Post->__post->cellAttributes() ?>>
<span id="el_Live_Brief_Post___post">
<span<?php echo $Live_Brief_Post->__post->viewAttributes() ?>>
<?php echo $Live_Brief_Post->__post->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Live_Brief_Post->fecha->Visible) { // fecha ?>
	<tr id="r_fecha">
		<td class="<?php echo $Live_Brief_Post_view->TableLeftColumnClass ?>"><span id="elh_Live_Brief_Post_fecha"><?php echo $Live_Brief_Post->fecha->caption() ?></span></td>
		<td data-name="fecha"<?php echo $Live_Brief_Post->fecha->cellAttributes() ?>>
<span id="el_Live_Brief_Post_fecha">
<span<?php echo $Live_Brief_Post->fecha->viewAttributes() ?>>
<?php echo $Live_Brief_Post->fecha->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Live_Brief_Post->captura->Visible) { // captura ?>
	<tr id="r_captura">
		<td class="<?php echo $Live_Brief_Post_view->TableLeftColumnClass ?>"><span id="elh_Live_Brief_Post_captura"><?php echo $Live_Brief_Post->captura->caption() ?></span></td>
		<td data-name="captura"<?php echo $Live_Brief_Post->captura->cellAttributes() ?>>
<span id="el_Live_Brief_Post_captura">
<span>
<?php echo GetFileViewTag($Live_Brief_Post->captura, $Live_Brief_Post->captura->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Live_Brief_Post->urlIG->Visible) { // urlIG ?>
	<tr id="r_urlIG">
		<td class="<?php echo $Live_Brief_Post_view->TableLeftColumnClass ?>"><span id="elh_Live_Brief_Post_urlIG"><?php echo $Live_Brief_Post->urlIG->caption() ?></span></td>
		<td data-name="urlIG"<?php echo $Live_Brief_Post->urlIG->cellAttributes() ?>>
<span id="el_Live_Brief_Post_urlIG">
<span<?php echo $Live_Brief_Post->urlIG->viewAttributes() ?>>
<?php echo $Live_Brief_Post->urlIG->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Live_Brief_Post->urlFB->Visible) { // urlFB ?>
	<tr id="r_urlFB">
		<td class="<?php echo $Live_Brief_Post_view->TableLeftColumnClass ?>"><span id="elh_Live_Brief_Post_urlFB"><?php echo $Live_Brief_Post->urlFB->caption() ?></span></td>
		<td data-name="urlFB"<?php echo $Live_Brief_Post->urlFB->cellAttributes() ?>>
<span id="el_Live_Brief_Post_urlFB">
<span<?php echo $Live_Brief_Post->urlFB->viewAttributes() ?>>
<?php echo $Live_Brief_Post->urlFB->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$Live_Brief_Post_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$Live_Brief_Post->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$Live_Brief_Post_view->terminate();
?>