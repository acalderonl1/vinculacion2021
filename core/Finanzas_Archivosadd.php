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
$Finanzas_Archivos_add = new Finanzas_Archivos_add();

// Run the page
$Finanzas_Archivos_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Finanzas_Archivos_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fFinanzas_Archivosadd = currentForm = new ew.Form("fFinanzas_Archivosadd", "add");

// Validate form
fFinanzas_Archivosadd.validate = function() {
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
		<?php if ($Finanzas_Archivos_add->archivo->Required) { ?>
			felm = this.getElements("x" + infix + "_archivo");
			elm = this.getElements("fn_x" + infix + "_archivo");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Finanzas_Archivos->archivo->caption(), $Finanzas_Archivos->archivo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($Finanzas_Archivos_add->fecha->Required) { ?>
			elm = this.getElements("x" + infix + "_fecha");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Finanzas_Archivos->fecha->caption(), $Finanzas_Archivos->fecha->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($Finanzas_Archivos_add->Saldo->Required) { ?>
			elm = this.getElements("x" + infix + "_Saldo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Finanzas_Archivos->Saldo->caption(), $Finanzas_Archivos->Saldo->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Saldo");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($Finanzas_Archivos->Saldo->errorMessage()) ?>");
		<?php if ($Finanzas_Archivos_add->Estado->Required) { ?>
			elm = this.getElements("x" + infix + "_Estado");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Finanzas_Archivos->Estado->caption(), $Finanzas_Archivos->Estado->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Estado");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($Finanzas_Archivos->Estado->errorMessage()) ?>");

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
fFinanzas_Archivosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fFinanzas_Archivosadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $Finanzas_Archivos_add->showPageHeader(); ?>
<?php
$Finanzas_Archivos_add->showMessage();
?>
<form name="fFinanzas_Archivosadd" id="fFinanzas_Archivosadd" class="<?php echo $Finanzas_Archivos_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Finanzas_Archivos_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $Finanzas_Archivos_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Finanzas_Archivos">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$Finanzas_Archivos_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Finanzas_Archivos->archivo->Visible) { // archivo ?>
	<div id="r_archivo" class="form-group row">
		<label id="elh_Finanzas_Archivos_archivo" class="<?php echo $Finanzas_Archivos_add->LeftColumnClass ?>"><?php echo $Finanzas_Archivos->archivo->caption() ?><?php echo ($Finanzas_Archivos->archivo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Finanzas_Archivos_add->RightColumnClass ?>"><div<?php echo $Finanzas_Archivos->archivo->cellAttributes() ?>>
<span id="el_Finanzas_Archivos_archivo">
<div id="fd_x_archivo">
<span title="<?php echo $Finanzas_Archivos->archivo->title() ? $Finanzas_Archivos->archivo->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($Finanzas_Archivos->archivo->ReadOnly || $Finanzas_Archivos->archivo->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="Finanzas_Archivos" data-field="x_archivo" name="x_archivo" id="x_archivo"<?php echo $Finanzas_Archivos->archivo->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_archivo" id= "fn_x_archivo" value="<?php echo $Finanzas_Archivos->archivo->Upload->FileName ?>">
<input type="hidden" name="fa_x_archivo" id= "fa_x_archivo" value="0">
<input type="hidden" name="fs_x_archivo" id= "fs_x_archivo" value="255">
<input type="hidden" name="fx_x_archivo" id= "fx_x_archivo" value="<?php echo $Finanzas_Archivos->archivo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_archivo" id= "fm_x_archivo" value="<?php echo $Finanzas_Archivos->archivo->UploadMaxFileSize ?>">
</div>
<table id="ft_x_archivo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Finanzas_Archivos->archivo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Finanzas_Archivos->Saldo->Visible) { // Saldo ?>
	<div id="r_Saldo" class="form-group row">
		<label id="elh_Finanzas_Archivos_Saldo" for="x_Saldo" class="<?php echo $Finanzas_Archivos_add->LeftColumnClass ?>"><?php echo $Finanzas_Archivos->Saldo->caption() ?><?php echo ($Finanzas_Archivos->Saldo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Finanzas_Archivos_add->RightColumnClass ?>"><div<?php echo $Finanzas_Archivos->Saldo->cellAttributes() ?>>
<span id="el_Finanzas_Archivos_Saldo">
<input type="text" data-table="Finanzas_Archivos" data-field="x_Saldo" name="x_Saldo" id="x_Saldo" size="30" placeholder="<?php echo HtmlEncode($Finanzas_Archivos->Saldo->getPlaceHolder()) ?>" value="<?php echo $Finanzas_Archivos->Saldo->EditValue ?>"<?php echo $Finanzas_Archivos->Saldo->editAttributes() ?>>
</span>
<?php echo $Finanzas_Archivos->Saldo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Finanzas_Archivos->Estado->Visible) { // Estado ?>
	<div id="r_Estado" class="form-group row">
		<label id="elh_Finanzas_Archivos_Estado" for="x_Estado" class="<?php echo $Finanzas_Archivos_add->LeftColumnClass ?>"><?php echo $Finanzas_Archivos->Estado->caption() ?><?php echo ($Finanzas_Archivos->Estado->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Finanzas_Archivos_add->RightColumnClass ?>"><div<?php echo $Finanzas_Archivos->Estado->cellAttributes() ?>>
<span id="el_Finanzas_Archivos_Estado">
<input type="text" data-table="Finanzas_Archivos" data-field="x_Estado" name="x_Estado" id="x_Estado" size="30" placeholder="<?php echo HtmlEncode($Finanzas_Archivos->Estado->getPlaceHolder()) ?>" value="<?php echo $Finanzas_Archivos->Estado->EditValue ?>"<?php echo $Finanzas_Archivos->Estado->editAttributes() ?>>
</span>
<?php echo $Finanzas_Archivos->Estado->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Finanzas_Archivos_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Finanzas_Archivos_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Finanzas_Archivos_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Finanzas_Archivos_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$Finanzas_Archivos_add->terminate();
?>