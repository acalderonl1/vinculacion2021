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
$Live_Brief_Post_edit = new Live_Brief_Post_edit();

// Run the page
$Live_Brief_Post_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Live_Brief_Post_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fLive_Brief_Postedit = currentForm = new ew.Form("fLive_Brief_Postedit", "edit");

// Validate form
fLive_Brief_Postedit.validate = function() {
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
		<?php if ($Live_Brief_Post_edit->Id->Required) { ?>
			elm = this.getElements("x" + infix + "_Id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Live_Brief_Post->Id->caption(), $Live_Brief_Post->Id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($Live_Brief_Post_edit->tipo->Required) { ?>
			elm = this.getElements("x" + infix + "_tipo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Live_Brief_Post->tipo->caption(), $Live_Brief_Post->tipo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($Live_Brief_Post_edit->tipoEvento->Required) { ?>
			elm = this.getElements("x" + infix + "_tipoEvento");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Live_Brief_Post->tipoEvento->caption(), $Live_Brief_Post->tipoEvento->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($Live_Brief_Post_edit->CategoriaEvento->Required) { ?>
			elm = this.getElements("x" + infix + "_CategoriaEvento");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Live_Brief_Post->CategoriaEvento->caption(), $Live_Brief_Post->CategoriaEvento->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($Live_Brief_Post_edit->evento->Required) { ?>
			elm = this.getElements("x" + infix + "_evento");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Live_Brief_Post->evento->caption(), $Live_Brief_Post->evento->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($Live_Brief_Post_edit->imagen->Required) { ?>
			felm = this.getElements("x" + infix + "_imagen");
			elm = this.getElements("fn_x" + infix + "_imagen");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Live_Brief_Post->imagen->caption(), $Live_Brief_Post->imagen->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($Live_Brief_Post_edit->__post->Required) { ?>
			elm = this.getElements("x" + infix + "___post");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Live_Brief_Post->__post->caption(), $Live_Brief_Post->__post->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($Live_Brief_Post_edit->fecha->Required) { ?>
			elm = this.getElements("x" + infix + "_fecha");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Live_Brief_Post->fecha->caption(), $Live_Brief_Post->fecha->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fecha");
			if (elm && !ew.checkDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($Live_Brief_Post->fecha->errorMessage()) ?>");
		<?php if ($Live_Brief_Post_edit->captura->Required) { ?>
			felm = this.getElements("x" + infix + "_captura");
			elm = this.getElements("fn_x" + infix + "_captura");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Live_Brief_Post->captura->caption(), $Live_Brief_Post->captura->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($Live_Brief_Post_edit->urlIG->Required) { ?>
			elm = this.getElements("x" + infix + "_urlIG");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Live_Brief_Post->urlIG->caption(), $Live_Brief_Post->urlIG->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($Live_Brief_Post_edit->urlFB->Required) { ?>
			elm = this.getElements("x" + infix + "_urlFB");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Live_Brief_Post->urlFB->caption(), $Live_Brief_Post->urlFB->RequiredErrorMessage)) ?>");
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
fLive_Brief_Postedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLive_Brief_Postedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fLive_Brief_Postedit.lists["x_tipo"] = <?php echo $Live_Brief_Post_edit->tipo->Lookup->toClientList() ?>;
fLive_Brief_Postedit.lists["x_tipo"].options = <?php echo JsonEncode($Live_Brief_Post_edit->tipo->options(FALSE, TRUE)) ?>;
fLive_Brief_Postedit.lists["x_tipoEvento"] = <?php echo $Live_Brief_Post_edit->tipoEvento->Lookup->toClientList() ?>;
fLive_Brief_Postedit.lists["x_tipoEvento"].options = <?php echo JsonEncode($Live_Brief_Post_edit->tipoEvento->options(FALSE, TRUE)) ?>;
fLive_Brief_Postedit.lists["x_CategoriaEvento"] = <?php echo $Live_Brief_Post_edit->CategoriaEvento->Lookup->toClientList() ?>;
fLive_Brief_Postedit.lists["x_CategoriaEvento"].options = <?php echo JsonEncode($Live_Brief_Post_edit->CategoriaEvento->lookupOptions()) ?>;
fLive_Brief_Postedit.lists["x_evento"] = <?php echo $Live_Brief_Post_edit->evento->Lookup->toClientList() ?>;
fLive_Brief_Postedit.lists["x_evento"].options = <?php echo JsonEncode($Live_Brief_Post_edit->evento->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $Live_Brief_Post_edit->showPageHeader(); ?>
<?php
$Live_Brief_Post_edit->showMessage();
?>
<form name="fLive_Brief_Postedit" id="fLive_Brief_Postedit" class="<?php echo $Live_Brief_Post_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Live_Brief_Post_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $Live_Brief_Post_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Live_Brief_Post">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$Live_Brief_Post_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Live_Brief_Post->Id->Visible) { // Id ?>
	<div id="r_Id" class="form-group row">
		<label id="elh_Live_Brief_Post_Id" class="<?php echo $Live_Brief_Post_edit->LeftColumnClass ?>"><?php echo $Live_Brief_Post->Id->caption() ?><?php echo ($Live_Brief_Post->Id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Live_Brief_Post_edit->RightColumnClass ?>"><div<?php echo $Live_Brief_Post->Id->cellAttributes() ?>>
<span id="el_Live_Brief_Post_Id">
<span<?php echo $Live_Brief_Post->Id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($Live_Brief_Post->Id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="Live_Brief_Post" data-field="x_Id" name="x_Id" id="x_Id" value="<?php echo HtmlEncode($Live_Brief_Post->Id->CurrentValue) ?>">
<?php echo $Live_Brief_Post->Id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Live_Brief_Post->tipo->Visible) { // tipo ?>
	<div id="r_tipo" class="form-group row">
		<label id="elh_Live_Brief_Post_tipo" for="x_tipo" class="<?php echo $Live_Brief_Post_edit->LeftColumnClass ?>"><?php echo $Live_Brief_Post->tipo->caption() ?><?php echo ($Live_Brief_Post->tipo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Live_Brief_Post_edit->RightColumnClass ?>"><div<?php echo $Live_Brief_Post->tipo->cellAttributes() ?>>
<span id="el_Live_Brief_Post_tipo">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Live_Brief_Post" data-field="x_tipo" data-value-separator="<?php echo $Live_Brief_Post->tipo->displayValueSeparatorAttribute() ?>" id="x_tipo" name="x_tipo"<?php echo $Live_Brief_Post->tipo->editAttributes() ?>>
		<?php echo $Live_Brief_Post->tipo->selectOptionListHtml("x_tipo") ?>
	</select>
</div>
</span>
<?php echo $Live_Brief_Post->tipo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Live_Brief_Post->tipoEvento->Visible) { // tipoEvento ?>
	<div id="r_tipoEvento" class="form-group row">
		<label id="elh_Live_Brief_Post_tipoEvento" for="x_tipoEvento" class="<?php echo $Live_Brief_Post_edit->LeftColumnClass ?>"><?php echo $Live_Brief_Post->tipoEvento->caption() ?><?php echo ($Live_Brief_Post->tipoEvento->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Live_Brief_Post_edit->RightColumnClass ?>"><div<?php echo $Live_Brief_Post->tipoEvento->cellAttributes() ?>>
<span id="el_Live_Brief_Post_tipoEvento">
<?php $Live_Brief_Post->tipoEvento->EditAttrs["onchange"] = "ew.updateOptions.call(this);" . @$Live_Brief_Post->tipoEvento->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Live_Brief_Post" data-field="x_tipoEvento" data-value-separator="<?php echo $Live_Brief_Post->tipoEvento->displayValueSeparatorAttribute() ?>" id="x_tipoEvento" name="x_tipoEvento"<?php echo $Live_Brief_Post->tipoEvento->editAttributes() ?>>
		<?php echo $Live_Brief_Post->tipoEvento->selectOptionListHtml("x_tipoEvento") ?>
	</select>
</div>
</span>
<?php echo $Live_Brief_Post->tipoEvento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Live_Brief_Post->CategoriaEvento->Visible) { // CategoriaEvento ?>
	<div id="r_CategoriaEvento" class="form-group row">
		<label id="elh_Live_Brief_Post_CategoriaEvento" for="x_CategoriaEvento" class="<?php echo $Live_Brief_Post_edit->LeftColumnClass ?>"><?php echo $Live_Brief_Post->CategoriaEvento->caption() ?><?php echo ($Live_Brief_Post->CategoriaEvento->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Live_Brief_Post_edit->RightColumnClass ?>"><div<?php echo $Live_Brief_Post->CategoriaEvento->cellAttributes() ?>>
<span id="el_Live_Brief_Post_CategoriaEvento">
<?php $Live_Brief_Post->CategoriaEvento->EditAttrs["onchange"] = "ew.updateOptions.call(this);" . @$Live_Brief_Post->CategoriaEvento->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Live_Brief_Post" data-field="x_CategoriaEvento" data-value-separator="<?php echo $Live_Brief_Post->CategoriaEvento->displayValueSeparatorAttribute() ?>" id="x_CategoriaEvento" name="x_CategoriaEvento"<?php echo $Live_Brief_Post->CategoriaEvento->editAttributes() ?>>
		<?php echo $Live_Brief_Post->CategoriaEvento->selectOptionListHtml("x_CategoriaEvento") ?>
	</select>
</div>
<?php echo $Live_Brief_Post->CategoriaEvento->Lookup->getParamTag("p_x_CategoriaEvento") ?>
</span>
<?php echo $Live_Brief_Post->CategoriaEvento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Live_Brief_Post->evento->Visible) { // evento ?>
	<div id="r_evento" class="form-group row">
		<label id="elh_Live_Brief_Post_evento" for="x_evento" class="<?php echo $Live_Brief_Post_edit->LeftColumnClass ?>"><?php echo $Live_Brief_Post->evento->caption() ?><?php echo ($Live_Brief_Post->evento->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Live_Brief_Post_edit->RightColumnClass ?>"><div<?php echo $Live_Brief_Post->evento->cellAttributes() ?>>
<span id="el_Live_Brief_Post_evento">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Live_Brief_Post" data-field="x_evento" data-value-separator="<?php echo $Live_Brief_Post->evento->displayValueSeparatorAttribute() ?>" id="x_evento" name="x_evento"<?php echo $Live_Brief_Post->evento->editAttributes() ?>>
		<?php echo $Live_Brief_Post->evento->selectOptionListHtml("x_evento") ?>
	</select>
</div>
<?php echo $Live_Brief_Post->evento->Lookup->getParamTag("p_x_evento") ?>
</span>
<?php echo $Live_Brief_Post->evento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Live_Brief_Post->imagen->Visible) { // imagen ?>
	<div id="r_imagen" class="form-group row">
		<label id="elh_Live_Brief_Post_imagen" class="<?php echo $Live_Brief_Post_edit->LeftColumnClass ?>"><?php echo $Live_Brief_Post->imagen->caption() ?><?php echo ($Live_Brief_Post->imagen->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Live_Brief_Post_edit->RightColumnClass ?>"><div<?php echo $Live_Brief_Post->imagen->cellAttributes() ?>>
<span id="el_Live_Brief_Post_imagen">
<div id="fd_x_imagen">
<span title="<?php echo $Live_Brief_Post->imagen->title() ? $Live_Brief_Post->imagen->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($Live_Brief_Post->imagen->ReadOnly || $Live_Brief_Post->imagen->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="Live_Brief_Post" data-field="x_imagen" name="x_imagen" id="x_imagen"<?php echo $Live_Brief_Post->imagen->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen" id= "fn_x_imagen" value="<?php echo $Live_Brief_Post->imagen->Upload->FileName ?>">
<?php if (Post("fa_x_imagen") == "0") { ?>
<input type="hidden" name="fa_x_imagen" id= "fa_x_imagen" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen" id= "fa_x_imagen" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen" id= "fs_x_imagen" value="255">
<input type="hidden" name="fx_x_imagen" id= "fx_x_imagen" value="<?php echo $Live_Brief_Post->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen" id= "fm_x_imagen" value="<?php echo $Live_Brief_Post->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Live_Brief_Post->imagen->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Live_Brief_Post->__post->Visible) { // post ?>
	<div id="r___post" class="form-group row">
		<label id="elh_Live_Brief_Post___post" class="<?php echo $Live_Brief_Post_edit->LeftColumnClass ?>"><?php echo $Live_Brief_Post->__post->caption() ?><?php echo ($Live_Brief_Post->__post->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Live_Brief_Post_edit->RightColumnClass ?>"><div<?php echo $Live_Brief_Post->__post->cellAttributes() ?>>
<span id="el_Live_Brief_Post___post">
<?php AppendClass($Live_Brief_Post->__post->EditAttrs["class"], "editor"); ?>
<textarea data-table="Live_Brief_Post" data-field="x___post" name="x___post" id="x___post" cols="35" rows="4" placeholder="<?php echo HtmlEncode($Live_Brief_Post->__post->getPlaceHolder()) ?>"<?php echo $Live_Brief_Post->__post->editAttributes() ?>><?php echo $Live_Brief_Post->__post->EditValue ?></textarea>
<script>
ew.createEditor("fLive_Brief_Postedit", "x___post", 35, 4, <?php echo ($Live_Brief_Post->__post->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $Live_Brief_Post->__post->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Live_Brief_Post->fecha->Visible) { // fecha ?>
	<div id="r_fecha" class="form-group row">
		<label id="elh_Live_Brief_Post_fecha" for="x_fecha" class="<?php echo $Live_Brief_Post_edit->LeftColumnClass ?>"><?php echo $Live_Brief_Post->fecha->caption() ?><?php echo ($Live_Brief_Post->fecha->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Live_Brief_Post_edit->RightColumnClass ?>"><div<?php echo $Live_Brief_Post->fecha->cellAttributes() ?>>
<span id="el_Live_Brief_Post_fecha">
<input type="text" data-table="Live_Brief_Post" data-field="x_fecha" data-format="5" name="x_fecha" id="x_fecha" placeholder="<?php echo HtmlEncode($Live_Brief_Post->fecha->getPlaceHolder()) ?>" value="<?php echo $Live_Brief_Post->fecha->EditValue ?>"<?php echo $Live_Brief_Post->fecha->editAttributes() ?>>
<?php if (!$Live_Brief_Post->fecha->ReadOnly && !$Live_Brief_Post->fecha->Disabled && !isset($Live_Brief_Post->fecha->EditAttrs["readonly"]) && !isset($Live_Brief_Post->fecha->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fLive_Brief_Postedit", "x_fecha", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<?php echo $Live_Brief_Post->fecha->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Live_Brief_Post->captura->Visible) { // captura ?>
	<div id="r_captura" class="form-group row">
		<label id="elh_Live_Brief_Post_captura" class="<?php echo $Live_Brief_Post_edit->LeftColumnClass ?>"><?php echo $Live_Brief_Post->captura->caption() ?><?php echo ($Live_Brief_Post->captura->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Live_Brief_Post_edit->RightColumnClass ?>"><div<?php echo $Live_Brief_Post->captura->cellAttributes() ?>>
<span id="el_Live_Brief_Post_captura">
<div id="fd_x_captura">
<span title="<?php echo $Live_Brief_Post->captura->title() ? $Live_Brief_Post->captura->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($Live_Brief_Post->captura->ReadOnly || $Live_Brief_Post->captura->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="Live_Brief_Post" data-field="x_captura" name="x_captura" id="x_captura"<?php echo $Live_Brief_Post->captura->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_captura" id= "fn_x_captura" value="<?php echo $Live_Brief_Post->captura->Upload->FileName ?>">
<?php if (Post("fa_x_captura") == "0") { ?>
<input type="hidden" name="fa_x_captura" id= "fa_x_captura" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_captura" id= "fa_x_captura" value="1">
<?php } ?>
<input type="hidden" name="fs_x_captura" id= "fs_x_captura" value="255">
<input type="hidden" name="fx_x_captura" id= "fx_x_captura" value="<?php echo $Live_Brief_Post->captura->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_captura" id= "fm_x_captura" value="<?php echo $Live_Brief_Post->captura->UploadMaxFileSize ?>">
</div>
<table id="ft_x_captura" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Live_Brief_Post->captura->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Live_Brief_Post->urlIG->Visible) { // urlIG ?>
	<div id="r_urlIG" class="form-group row">
		<label id="elh_Live_Brief_Post_urlIG" for="x_urlIG" class="<?php echo $Live_Brief_Post_edit->LeftColumnClass ?>"><?php echo $Live_Brief_Post->urlIG->caption() ?><?php echo ($Live_Brief_Post->urlIG->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Live_Brief_Post_edit->RightColumnClass ?>"><div<?php echo $Live_Brief_Post->urlIG->cellAttributes() ?>>
<span id="el_Live_Brief_Post_urlIG">
<textarea data-table="Live_Brief_Post" data-field="x_urlIG" name="x_urlIG" id="x_urlIG" cols="35" rows="4" placeholder="<?php echo HtmlEncode($Live_Brief_Post->urlIG->getPlaceHolder()) ?>"<?php echo $Live_Brief_Post->urlIG->editAttributes() ?>><?php echo $Live_Brief_Post->urlIG->EditValue ?></textarea>
</span>
<?php echo $Live_Brief_Post->urlIG->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Live_Brief_Post->urlFB->Visible) { // urlFB ?>
	<div id="r_urlFB" class="form-group row">
		<label id="elh_Live_Brief_Post_urlFB" for="x_urlFB" class="<?php echo $Live_Brief_Post_edit->LeftColumnClass ?>"><?php echo $Live_Brief_Post->urlFB->caption() ?><?php echo ($Live_Brief_Post->urlFB->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Live_Brief_Post_edit->RightColumnClass ?>"><div<?php echo $Live_Brief_Post->urlFB->cellAttributes() ?>>
<span id="el_Live_Brief_Post_urlFB">
<textarea data-table="Live_Brief_Post" data-field="x_urlFB" name="x_urlFB" id="x_urlFB" cols="35" rows="4" placeholder="<?php echo HtmlEncode($Live_Brief_Post->urlFB->getPlaceHolder()) ?>"<?php echo $Live_Brief_Post->urlFB->editAttributes() ?>><?php echo $Live_Brief_Post->urlFB->EditValue ?></textarea>
</span>
<?php echo $Live_Brief_Post->urlFB->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Live_Brief_Post_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Live_Brief_Post_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Live_Brief_Post_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Live_Brief_Post_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$Live_Brief_Post_edit->terminate();
?>