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
$eventos_empresarios_add = new eventos_empresarios_add();

// Run the page
$eventos_empresarios_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$eventos_empresarios_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var feventos_empresariosadd = currentForm = new ew.Form("feventos_empresariosadd", "add");

// Validate form
feventos_empresariosadd.validate = function() {
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
		<?php if ($eventos_empresarios_add->nombres->Required) { ?>
			elm = this.getElements("x" + infix + "_nombres");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_empresarios->nombres->caption(), $eventos_empresarios->nombres->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_empresarios_add->empresa->Required) { ?>
			elm = this.getElements("x" + infix + "_empresa");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_empresarios->empresa->caption(), $eventos_empresarios->empresa->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_empresarios_add->contacto->Required) { ?>
			elm = this.getElements("x" + infix + "_contacto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_empresarios->contacto->caption(), $eventos_empresarios->contacto->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_empresarios_add->_email->Required) { ?>
			elm = this.getElements("x" + infix + "__email");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_empresarios->_email->caption(), $eventos_empresarios->_email->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_empresarios_add->contacto2->Required) { ?>
			elm = this.getElements("x" + infix + "_contacto2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_empresarios->contacto2->caption(), $eventos_empresarios->contacto2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_empresarios_add->ruc->Required) { ?>
			elm = this.getElements("x" + infix + "_ruc");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_empresarios->ruc->caption(), $eventos_empresarios->ruc->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_empresarios_add->direccion->Required) { ?>
			elm = this.getElements("x" + infix + "_direccion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_empresarios->direccion->caption(), $eventos_empresarios->direccion->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_empresarios_add->razonsocial->Required) { ?>
			elm = this.getElements("x" + infix + "_razonsocial");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_empresarios->razonsocial->caption(), $eventos_empresarios->razonsocial->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
feventos_empresariosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
feventos_empresariosadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $eventos_empresarios_add->showPageHeader(); ?>
<?php
$eventos_empresarios_add->showMessage();
?>
<form name="feventos_empresariosadd" id="feventos_empresariosadd" class="<?php echo $eventos_empresarios_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($eventos_empresarios_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $eventos_empresarios_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="eventos_empresarios">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$eventos_empresarios_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($eventos_empresarios->nombres->Visible) { // nombres ?>
	<div id="r_nombres" class="form-group row">
		<label id="elh_eventos_empresarios_nombres" for="x_nombres" class="<?php echo $eventos_empresarios_add->LeftColumnClass ?>"><?php echo $eventos_empresarios->nombres->caption() ?><?php echo ($eventos_empresarios->nombres->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $eventos_empresarios_add->RightColumnClass ?>"><div<?php echo $eventos_empresarios->nombres->cellAttributes() ?>>
<span id="el_eventos_empresarios_nombres">
<input type="text" data-table="eventos_empresarios" data-field="x_nombres" name="x_nombres" id="x_nombres" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($eventos_empresarios->nombres->getPlaceHolder()) ?>" value="<?php echo $eventos_empresarios->nombres->EditValue ?>"<?php echo $eventos_empresarios->nombres->editAttributes() ?>>
</span>
<?php echo $eventos_empresarios->nombres->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($eventos_empresarios->empresa->Visible) { // empresa ?>
	<div id="r_empresa" class="form-group row">
		<label id="elh_eventos_empresarios_empresa" for="x_empresa" class="<?php echo $eventos_empresarios_add->LeftColumnClass ?>"><?php echo $eventos_empresarios->empresa->caption() ?><?php echo ($eventos_empresarios->empresa->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $eventos_empresarios_add->RightColumnClass ?>"><div<?php echo $eventos_empresarios->empresa->cellAttributes() ?>>
<span id="el_eventos_empresarios_empresa">
<input type="text" data-table="eventos_empresarios" data-field="x_empresa" name="x_empresa" id="x_empresa" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($eventos_empresarios->empresa->getPlaceHolder()) ?>" value="<?php echo $eventos_empresarios->empresa->EditValue ?>"<?php echo $eventos_empresarios->empresa->editAttributes() ?>>
</span>
<?php echo $eventos_empresarios->empresa->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($eventos_empresarios->contacto->Visible) { // contacto ?>
	<div id="r_contacto" class="form-group row">
		<label id="elh_eventos_empresarios_contacto" for="x_contacto" class="<?php echo $eventos_empresarios_add->LeftColumnClass ?>"><?php echo $eventos_empresarios->contacto->caption() ?><?php echo ($eventos_empresarios->contacto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $eventos_empresarios_add->RightColumnClass ?>"><div<?php echo $eventos_empresarios->contacto->cellAttributes() ?>>
<span id="el_eventos_empresarios_contacto">
<input type="text" data-table="eventos_empresarios" data-field="x_contacto" name="x_contacto" id="x_contacto" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($eventos_empresarios->contacto->getPlaceHolder()) ?>" value="<?php echo $eventos_empresarios->contacto->EditValue ?>"<?php echo $eventos_empresarios->contacto->editAttributes() ?>>
</span>
<?php echo $eventos_empresarios->contacto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($eventos_empresarios->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_eventos_empresarios__email" for="x__email" class="<?php echo $eventos_empresarios_add->LeftColumnClass ?>"><?php echo $eventos_empresarios->_email->caption() ?><?php echo ($eventos_empresarios->_email->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $eventos_empresarios_add->RightColumnClass ?>"><div<?php echo $eventos_empresarios->_email->cellAttributes() ?>>
<span id="el_eventos_empresarios__email">
<input type="text" data-table="eventos_empresarios" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($eventos_empresarios->_email->getPlaceHolder()) ?>" value="<?php echo $eventos_empresarios->_email->EditValue ?>"<?php echo $eventos_empresarios->_email->editAttributes() ?>>
</span>
<?php echo $eventos_empresarios->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($eventos_empresarios->contacto2->Visible) { // contacto2 ?>
	<div id="r_contacto2" class="form-group row">
		<label id="elh_eventos_empresarios_contacto2" for="x_contacto2" class="<?php echo $eventos_empresarios_add->LeftColumnClass ?>"><?php echo $eventos_empresarios->contacto2->caption() ?><?php echo ($eventos_empresarios->contacto2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $eventos_empresarios_add->RightColumnClass ?>"><div<?php echo $eventos_empresarios->contacto2->cellAttributes() ?>>
<span id="el_eventos_empresarios_contacto2">
<input type="text" data-table="eventos_empresarios" data-field="x_contacto2" name="x_contacto2" id="x_contacto2" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($eventos_empresarios->contacto2->getPlaceHolder()) ?>" value="<?php echo $eventos_empresarios->contacto2->EditValue ?>"<?php echo $eventos_empresarios->contacto2->editAttributes() ?>>
</span>
<?php echo $eventos_empresarios->contacto2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($eventos_empresarios->ruc->Visible) { // ruc ?>
	<div id="r_ruc" class="form-group row">
		<label id="elh_eventos_empresarios_ruc" for="x_ruc" class="<?php echo $eventos_empresarios_add->LeftColumnClass ?>"><?php echo $eventos_empresarios->ruc->caption() ?><?php echo ($eventos_empresarios->ruc->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $eventos_empresarios_add->RightColumnClass ?>"><div<?php echo $eventos_empresarios->ruc->cellAttributes() ?>>
<span id="el_eventos_empresarios_ruc">
<input type="text" data-table="eventos_empresarios" data-field="x_ruc" name="x_ruc" id="x_ruc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($eventos_empresarios->ruc->getPlaceHolder()) ?>" value="<?php echo $eventos_empresarios->ruc->EditValue ?>"<?php echo $eventos_empresarios->ruc->editAttributes() ?>>
</span>
<?php echo $eventos_empresarios->ruc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($eventos_empresarios->direccion->Visible) { // direccion ?>
	<div id="r_direccion" class="form-group row">
		<label id="elh_eventos_empresarios_direccion" for="x_direccion" class="<?php echo $eventos_empresarios_add->LeftColumnClass ?>"><?php echo $eventos_empresarios->direccion->caption() ?><?php echo ($eventos_empresarios->direccion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $eventos_empresarios_add->RightColumnClass ?>"><div<?php echo $eventos_empresarios->direccion->cellAttributes() ?>>
<span id="el_eventos_empresarios_direccion">
<input type="text" data-table="eventos_empresarios" data-field="x_direccion" name="x_direccion" id="x_direccion" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($eventos_empresarios->direccion->getPlaceHolder()) ?>" value="<?php echo $eventos_empresarios->direccion->EditValue ?>"<?php echo $eventos_empresarios->direccion->editAttributes() ?>>
</span>
<?php echo $eventos_empresarios->direccion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($eventos_empresarios->razonsocial->Visible) { // razonsocial ?>
	<div id="r_razonsocial" class="form-group row">
		<label id="elh_eventos_empresarios_razonsocial" for="x_razonsocial" class="<?php echo $eventos_empresarios_add->LeftColumnClass ?>"><?php echo $eventos_empresarios->razonsocial->caption() ?><?php echo ($eventos_empresarios->razonsocial->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $eventos_empresarios_add->RightColumnClass ?>"><div<?php echo $eventos_empresarios->razonsocial->cellAttributes() ?>>
<span id="el_eventos_empresarios_razonsocial">
<input type="text" data-table="eventos_empresarios" data-field="x_razonsocial" name="x_razonsocial" id="x_razonsocial" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($eventos_empresarios->razonsocial->getPlaceHolder()) ?>" value="<?php echo $eventos_empresarios->razonsocial->EditValue ?>"<?php echo $eventos_empresarios->razonsocial->editAttributes() ?>>
</span>
<?php echo $eventos_empresarios->razonsocial->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$eventos_empresarios_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $eventos_empresarios_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $eventos_empresarios_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$eventos_empresarios_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$eventos_empresarios_add->terminate();
?>