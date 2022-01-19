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
$eventos_directores_addopt = new eventos_directores_addopt();

// Run the page
$eventos_directores_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$eventos_directores_addopt->Page_Render();
?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "addopt";
var feventos_directoresaddopt = currentForm = new ew.Form("feventos_directoresaddopt", "addopt");

// Validate form
feventos_directoresaddopt.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($eventos_directores_addopt->nombres->Required) { ?>
			elm = this.getElements("x" + infix + "_nombres");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_directores->nombres->caption(), $eventos_directores->nombres->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_directores_addopt->apellidos->Required) { ?>
			elm = this.getElements("x" + infix + "_apellidos");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_directores->apellidos->caption(), $eventos_directores->apellidos->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_directores_addopt->contacto->Required) { ?>
			elm = this.getElements("x" + infix + "_contacto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_directores->contacto->caption(), $eventos_directores->contacto->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_directores_addopt->_email->Required) { ?>
			elm = this.getElements("x" + infix + "__email");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_directores->_email->caption(), $eventos_directores->_email->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
feventos_directoresaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
feventos_directoresaddopt.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $eventos_directores_addopt->showPageHeader(); ?>
<?php
$eventos_directores_addopt->showMessage();
?>
<form name="feventos_directoresaddopt" id="feventos_directoresaddopt" class="ew-form ew-horizontal" action="<?php echo API_URL ?>" method="post">
<?php //if ($eventos_directores_addopt->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $eventos_directores_addopt->Token ?>">
<?php //} ?>
<input type="hidden" name="<?php echo API_ACTION_NAME ?>" id="<?php echo API_ACTION_NAME ?>" value="<?php echo API_ADD_ACTION ?>">
<input type="hidden" name="<?php echo API_OBJECT_NAME ?>" id="<?php echo API_OBJECT_NAME ?>" value="<?php echo $eventos_directores_addopt->TableVar ?>">
<?php if ($eventos_directores->nombres->Visible) { // nombres ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_nombres"><?php echo $eventos_directores->nombres->caption() ?><?php echo ($eventos_directores->nombres->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="eventos_directores" data-field="x_nombres" name="x_nombres" id="x_nombres" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($eventos_directores->nombres->getPlaceHolder()) ?>" value="<?php echo $eventos_directores->nombres->EditValue ?>"<?php echo $eventos_directores->nombres->editAttributes() ?>>
<?php echo $eventos_directores->nombres->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($eventos_directores->apellidos->Visible) { // apellidos ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_apellidos"><?php echo $eventos_directores->apellidos->caption() ?><?php echo ($eventos_directores->apellidos->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="eventos_directores" data-field="x_apellidos" name="x_apellidos" id="x_apellidos" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($eventos_directores->apellidos->getPlaceHolder()) ?>" value="<?php echo $eventos_directores->apellidos->EditValue ?>"<?php echo $eventos_directores->apellidos->editAttributes() ?>>
<?php echo $eventos_directores->apellidos->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($eventos_directores->contacto->Visible) { // contacto ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_contacto"><?php echo $eventos_directores->contacto->caption() ?><?php echo ($eventos_directores->contacto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="eventos_directores" data-field="x_contacto" name="x_contacto" id="x_contacto" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($eventos_directores->contacto->getPlaceHolder()) ?>" value="<?php echo $eventos_directores->contacto->EditValue ?>"<?php echo $eventos_directores->contacto->editAttributes() ?>>
<?php echo $eventos_directores->contacto->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($eventos_directores->_email->Visible) { // email ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x__email"><?php echo $eventos_directores->_email->caption() ?><?php echo ($eventos_directores->_email->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="eventos_directores" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($eventos_directores->_email->getPlaceHolder()) ?>" value="<?php echo $eventos_directores->_email->EditValue ?>"<?php echo $eventos_directores->_email->editAttributes() ?>>
<?php echo $eventos_directores->_email->CustomMsg ?></div>
	</div>
<?php } ?>
</form>
<?php
$eventos_directores_addopt->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php
$eventos_directores_addopt->terminate();
?>