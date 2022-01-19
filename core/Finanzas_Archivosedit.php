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
$Finanzas_Archivos_edit = new Finanzas_Archivos_edit();

// Run the page
$Finanzas_Archivos_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Finanzas_Archivos_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fFinanzas_Archivosedit = currentForm = new ew.Form("fFinanzas_Archivosedit", "edit");

// Validate form
fFinanzas_Archivosedit.validate = function() {
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
		<?php if ($Finanzas_Archivos_edit->Id->Required) { ?>
			elm = this.getElements("x" + infix + "_Id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Finanzas_Archivos->Id->caption(), $Finanzas_Archivos->Id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($Finanzas_Archivos_edit->archivo->Required) { ?>
			elm = this.getElements("x" + infix + "_archivo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Finanzas_Archivos->archivo->caption(), $Finanzas_Archivos->archivo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($Finanzas_Archivos_edit->fecha->Required) { ?>
			elm = this.getElements("x" + infix + "_fecha");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Finanzas_Archivos->fecha->caption(), $Finanzas_Archivos->fecha->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fecha");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($Finanzas_Archivos->fecha->errorMessage()) ?>");

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
fFinanzas_Archivosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fFinanzas_Archivosedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $Finanzas_Archivos_edit->showPageHeader(); ?>
<?php
$Finanzas_Archivos_edit->showMessage();
?>
<form name="fFinanzas_Archivosedit" id="fFinanzas_Archivosedit" class="<?php echo $Finanzas_Archivos_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Finanzas_Archivos_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $Finanzas_Archivos_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Finanzas_Archivos">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$Finanzas_Archivos_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Finanzas_Archivos->Id->Visible) { // Id ?>
	<div id="r_Id" class="form-group row">
		<label id="elh_Finanzas_Archivos_Id" class="<?php echo $Finanzas_Archivos_edit->LeftColumnClass ?>"><?php echo $Finanzas_Archivos->Id->caption() ?><?php echo ($Finanzas_Archivos->Id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Finanzas_Archivos_edit->RightColumnClass ?>"><div<?php echo $Finanzas_Archivos->Id->cellAttributes() ?>>
<span id="el_Finanzas_Archivos_Id">
<span<?php echo $Finanzas_Archivos->Id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($Finanzas_Archivos->Id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="Finanzas_Archivos" data-field="x_Id" name="x_Id" id="x_Id" value="<?php echo HtmlEncode($Finanzas_Archivos->Id->CurrentValue) ?>">
<?php echo $Finanzas_Archivos->Id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Finanzas_Archivos->archivo->Visible) { // archivo ?>
	<div id="r_archivo" class="form-group row">
		<label id="elh_Finanzas_Archivos_archivo" for="x_archivo" class="<?php echo $Finanzas_Archivos_edit->LeftColumnClass ?>"><?php echo $Finanzas_Archivos->archivo->caption() ?><?php echo ($Finanzas_Archivos->archivo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Finanzas_Archivos_edit->RightColumnClass ?>"><div<?php echo $Finanzas_Archivos->archivo->cellAttributes() ?>>
<span id="el_Finanzas_Archivos_archivo">
<input type="text" data-table="Finanzas_Archivos" data-field="x_archivo" name="x_archivo" id="x_archivo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Finanzas_Archivos->archivo->getPlaceHolder()) ?>" value="<?php echo $Finanzas_Archivos->archivo->EditValue ?>"<?php echo $Finanzas_Archivos->archivo->editAttributes() ?>>
</span>
<?php echo $Finanzas_Archivos->archivo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Finanzas_Archivos->fecha->Visible) { // fecha ?>
	<div id="r_fecha" class="form-group row">
		<label id="elh_Finanzas_Archivos_fecha" for="x_fecha" class="<?php echo $Finanzas_Archivos_edit->LeftColumnClass ?>"><?php echo $Finanzas_Archivos->fecha->caption() ?><?php echo ($Finanzas_Archivos->fecha->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Finanzas_Archivos_edit->RightColumnClass ?>"><div<?php echo $Finanzas_Archivos->fecha->cellAttributes() ?>>
<span id="el_Finanzas_Archivos_fecha">
<input type="text" data-table="Finanzas_Archivos" data-field="x_fecha" name="x_fecha" id="x_fecha" placeholder="<?php echo HtmlEncode($Finanzas_Archivos->fecha->getPlaceHolder()) ?>" value="<?php echo $Finanzas_Archivos->fecha->EditValue ?>"<?php echo $Finanzas_Archivos->fecha->editAttributes() ?>>
<?php if (!$Finanzas_Archivos->fecha->ReadOnly && !$Finanzas_Archivos->fecha->Disabled && !isset($Finanzas_Archivos->fecha->EditAttrs["readonly"]) && !isset($Finanzas_Archivos->fecha->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fFinanzas_Archivosedit", "x_fecha", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $Finanzas_Archivos->fecha->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Finanzas_Archivos_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Finanzas_Archivos_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Finanzas_Archivos_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Finanzas_Archivos_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$Finanzas_Archivos_edit->terminate();
?>