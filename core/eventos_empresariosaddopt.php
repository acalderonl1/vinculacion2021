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
$eventos_empresarios_addopt = new eventos_empresarios_addopt();

// Run the page
$eventos_empresarios_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$eventos_empresarios_addopt->Page_Render();
?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "addopt";
var feventos_empresariosaddopt = currentForm = new ew.Form("feventos_empresariosaddopt", "addopt");

// Validate form
feventos_empresariosaddopt.validate = function() {
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
		<?php if ($eventos_empresarios_addopt->nombres->Required) { ?>
			elm = this.getElements("x" + infix + "_nombres");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_empresarios->nombres->caption(), $eventos_empresarios->nombres->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_empresarios_addopt->empresa->Required) { ?>
			elm = this.getElements("x" + infix + "_empresa");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_empresarios->empresa->caption(), $eventos_empresarios->empresa->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_empresarios_addopt->contacto->Required) { ?>
			elm = this.getElements("x" + infix + "_contacto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_empresarios->contacto->caption(), $eventos_empresarios->contacto->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_empresarios_addopt->_email->Required) { ?>
			elm = this.getElements("x" + infix + "__email");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_empresarios->_email->caption(), $eventos_empresarios->_email->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_empresarios_addopt->contacto2->Required) { ?>
			elm = this.getElements("x" + infix + "_contacto2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_empresarios->contacto2->caption(), $eventos_empresarios->contacto2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_empresarios_addopt->ruc->Required) { ?>
			elm = this.getElements("x" + infix + "_ruc");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_empresarios->ruc->caption(), $eventos_empresarios->ruc->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_empresarios_addopt->direccion->Required) { ?>
			elm = this.getElements("x" + infix + "_direccion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_empresarios->direccion->caption(), $eventos_empresarios->direccion->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_empresarios_addopt->razonsocial->Required) { ?>
			elm = this.getElements("x" + infix + "_razonsocial");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_empresarios->razonsocial->caption(), $eventos_empresarios->razonsocial->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
feventos_empresariosaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
feventos_empresariosaddopt.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $eventos_empresarios_addopt->showPageHeader(); ?>
<?php
$eventos_empresarios_addopt->showMessage();
?>
<form name="feventos_empresariosaddopt" id="feventos_empresariosaddopt" class="ew-form ew-horizontal" action="<?php echo API_URL ?>" method="post">
<?php //if ($eventos_empresarios_addopt->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $eventos_empresarios_addopt->Token ?>">
<?php //} ?>
<input type="hidden" name="<?php echo API_ACTION_NAME ?>" id="<?php echo API_ACTION_NAME ?>" value="<?php echo API_ADD_ACTION ?>">
<input type="hidden" name="<?php echo API_OBJECT_NAME ?>" id="<?php echo API_OBJECT_NAME ?>" value="<?php echo $eventos_empresarios_addopt->TableVar ?>">
<?php if ($eventos_empresarios->nombres->Visible) { // nombres ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_nombres"><?php echo $eventos_empresarios->nombres->caption() ?><?php echo ($eventos_empresarios->nombres->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="eventos_empresarios" data-field="x_nombres" name="x_nombres" id="x_nombres" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($eventos_empresarios->nombres->getPlaceHolder()) ?>" value="<?php echo $eventos_empresarios->nombres->EditValue ?>"<?php echo $eventos_empresarios->nombres->editAttributes() ?>>
<?php echo $eventos_empresarios->nombres->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($eventos_empresarios->empresa->Visible) { // empresa ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_empresa"><?php echo $eventos_empresarios->empresa->caption() ?><?php echo ($eventos_empresarios->empresa->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="eventos_empresarios" data-field="x_empresa" name="x_empresa" id="x_empresa" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($eventos_empresarios->empresa->getPlaceHolder()) ?>" value="<?php echo $eventos_empresarios->empresa->EditValue ?>"<?php echo $eventos_empresarios->empresa->editAttributes() ?>>
<?php echo $eventos_empresarios->empresa->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($eventos_empresarios->contacto->Visible) { // contacto ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_contacto"><?php echo $eventos_empresarios->contacto->caption() ?><?php echo ($eventos_empresarios->contacto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="eventos_empresarios" data-field="x_contacto" name="x_contacto" id="x_contacto" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($eventos_empresarios->contacto->getPlaceHolder()) ?>" value="<?php echo $eventos_empresarios->contacto->EditValue ?>"<?php echo $eventos_empresarios->contacto->editAttributes() ?>>
<?php echo $eventos_empresarios->contacto->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($eventos_empresarios->_email->Visible) { // email ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x__email"><?php echo $eventos_empresarios->_email->caption() ?><?php echo ($eventos_empresarios->_email->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="eventos_empresarios" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($eventos_empresarios->_email->getPlaceHolder()) ?>" value="<?php echo $eventos_empresarios->_email->EditValue ?>"<?php echo $eventos_empresarios->_email->editAttributes() ?>>
<?php echo $eventos_empresarios->_email->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($eventos_empresarios->contacto2->Visible) { // contacto2 ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_contacto2"><?php echo $eventos_empresarios->contacto2->caption() ?><?php echo ($eventos_empresarios->contacto2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="eventos_empresarios" data-field="x_contacto2" name="x_contacto2" id="x_contacto2" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($eventos_empresarios->contacto2->getPlaceHolder()) ?>" value="<?php echo $eventos_empresarios->contacto2->EditValue ?>"<?php echo $eventos_empresarios->contacto2->editAttributes() ?>>
<?php echo $eventos_empresarios->contacto2->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($eventos_empresarios->ruc->Visible) { // ruc ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_ruc"><?php echo $eventos_empresarios->ruc->caption() ?><?php echo ($eventos_empresarios->ruc->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="eventos_empresarios" data-field="x_ruc" name="x_ruc" id="x_ruc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($eventos_empresarios->ruc->getPlaceHolder()) ?>" value="<?php echo $eventos_empresarios->ruc->EditValue ?>"<?php echo $eventos_empresarios->ruc->editAttributes() ?>>
<?php echo $eventos_empresarios->ruc->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($eventos_empresarios->direccion->Visible) { // direccion ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_direccion"><?php echo $eventos_empresarios->direccion->caption() ?><?php echo ($eventos_empresarios->direccion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="eventos_empresarios" data-field="x_direccion" name="x_direccion" id="x_direccion" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($eventos_empresarios->direccion->getPlaceHolder()) ?>" value="<?php echo $eventos_empresarios->direccion->EditValue ?>"<?php echo $eventos_empresarios->direccion->editAttributes() ?>>
<?php echo $eventos_empresarios->direccion->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($eventos_empresarios->razonsocial->Visible) { // razonsocial ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_razonsocial"><?php echo $eventos_empresarios->razonsocial->caption() ?><?php echo ($eventos_empresarios->razonsocial->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="eventos_empresarios" data-field="x_razonsocial" name="x_razonsocial" id="x_razonsocial" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($eventos_empresarios->razonsocial->getPlaceHolder()) ?>" value="<?php echo $eventos_empresarios->razonsocial->EditValue ?>"<?php echo $eventos_empresarios->razonsocial->editAttributes() ?>>
<?php echo $eventos_empresarios->razonsocial->CustomMsg ?></div>
	</div>
<?php } ?>
</form>
<?php
$eventos_empresarios_addopt->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php
$eventos_empresarios_addopt->terminate();
?>