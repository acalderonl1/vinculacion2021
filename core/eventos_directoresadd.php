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
$eventos_directores_add = new eventos_directores_add();

// Run the page
$eventos_directores_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$eventos_directores_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var feventos_directoresadd = currentForm = new ew.Form("feventos_directoresadd", "add");

// Validate form
feventos_directoresadd.validate = function() {
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
		<?php if ($eventos_directores_add->nombres->Required) { ?>
			elm = this.getElements("x" + infix + "_nombres");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_directores->nombres->caption(), $eventos_directores->nombres->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_directores_add->apellidos->Required) { ?>
			elm = this.getElements("x" + infix + "_apellidos");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_directores->apellidos->caption(), $eventos_directores->apellidos->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_directores_add->contacto->Required) { ?>
			elm = this.getElements("x" + infix + "_contacto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_directores->contacto->caption(), $eventos_directores->contacto->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($eventos_directores_add->_email->Required) { ?>
			elm = this.getElements("x" + infix + "__email");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $eventos_directores->_email->caption(), $eventos_directores->_email->RequiredErrorMessage)) ?>");
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
feventos_directoresadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
feventos_directoresadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $eventos_directores_add->showPageHeader(); ?>
<?php
$eventos_directores_add->showMessage();
?>
<form name="feventos_directoresadd" id="feventos_directoresadd" class="<?php echo $eventos_directores_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($eventos_directores_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $eventos_directores_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="eventos_directores">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$eventos_directores_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($eventos_directores->nombres->Visible) { // nombres ?>
	<div id="r_nombres" class="form-group row">
		<label id="elh_eventos_directores_nombres" for="x_nombres" class="<?php echo $eventos_directores_add->LeftColumnClass ?>"><?php echo $eventos_directores->nombres->caption() ?><?php echo ($eventos_directores->nombres->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $eventos_directores_add->RightColumnClass ?>"><div<?php echo $eventos_directores->nombres->cellAttributes() ?>>
<span id="el_eventos_directores_nombres">
<input type="text" data-table="eventos_directores" data-field="x_nombres" name="x_nombres" id="x_nombres" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($eventos_directores->nombres->getPlaceHolder()) ?>" value="<?php echo $eventos_directores->nombres->EditValue ?>"<?php echo $eventos_directores->nombres->editAttributes() ?>>
</span>
<?php echo $eventos_directores->nombres->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($eventos_directores->apellidos->Visible) { // apellidos ?>
	<div id="r_apellidos" class="form-group row">
		<label id="elh_eventos_directores_apellidos" for="x_apellidos" class="<?php echo $eventos_directores_add->LeftColumnClass ?>"><?php echo $eventos_directores->apellidos->caption() ?><?php echo ($eventos_directores->apellidos->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $eventos_directores_add->RightColumnClass ?>"><div<?php echo $eventos_directores->apellidos->cellAttributes() ?>>
<span id="el_eventos_directores_apellidos">
<input type="text" data-table="eventos_directores" data-field="x_apellidos" name="x_apellidos" id="x_apellidos" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($eventos_directores->apellidos->getPlaceHolder()) ?>" value="<?php echo $eventos_directores->apellidos->EditValue ?>"<?php echo $eventos_directores->apellidos->editAttributes() ?>>
</span>
<?php echo $eventos_directores->apellidos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($eventos_directores->contacto->Visible) { // contacto ?>
	<div id="r_contacto" class="form-group row">
		<label id="elh_eventos_directores_contacto" for="x_contacto" class="<?php echo $eventos_directores_add->LeftColumnClass ?>"><?php echo $eventos_directores->contacto->caption() ?><?php echo ($eventos_directores->contacto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $eventos_directores_add->RightColumnClass ?>"><div<?php echo $eventos_directores->contacto->cellAttributes() ?>>
<span id="el_eventos_directores_contacto">
<input type="text" data-table="eventos_directores" data-field="x_contacto" name="x_contacto" id="x_contacto" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($eventos_directores->contacto->getPlaceHolder()) ?>" value="<?php echo $eventos_directores->contacto->EditValue ?>"<?php echo $eventos_directores->contacto->editAttributes() ?>>
</span>
<?php echo $eventos_directores->contacto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($eventos_directores->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_eventos_directores__email" for="x__email" class="<?php echo $eventos_directores_add->LeftColumnClass ?>"><?php echo $eventos_directores->_email->caption() ?><?php echo ($eventos_directores->_email->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $eventos_directores_add->RightColumnClass ?>"><div<?php echo $eventos_directores->_email->cellAttributes() ?>>
<span id="el_eventos_directores__email">
<input type="text" data-table="eventos_directores" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($eventos_directores->_email->getPlaceHolder()) ?>" value="<?php echo $eventos_directores->_email->EditValue ?>"<?php echo $eventos_directores->_email->editAttributes() ?>>
</span>
<?php echo $eventos_directores->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$eventos_directores_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $eventos_directores_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $eventos_directores_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$eventos_directores_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$eventos_directores_add->terminate();
?>