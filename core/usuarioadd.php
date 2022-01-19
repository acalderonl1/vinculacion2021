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
$usuario_add = new usuario_add();

// Run the page
$usuario_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuario_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fusuarioadd = currentForm = new ew.Form("fusuarioadd", "add");

// Validate form
fusuarioadd.validate = function() {
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
		<?php if ($usuario_add->nombre->Required) { ?>
			elm = this.getElements("x" + infix + "_nombre");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->nombre->caption(), $usuario->nombre->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($usuario_add->usuario->Required) { ?>
			elm = this.getElements("x" + infix + "_usuario");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->usuario->caption(), $usuario->usuario->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($usuario_add->clave->Required) { ?>
			elm = this.getElements("x" + infix + "_clave");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->clave->caption(), $usuario->clave->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($usuario_add->role->Required) { ?>
			elm = this.getElements("x" + infix + "_role");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->role->caption(), $usuario->role->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_role");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($usuario->role->errorMessage()) ?>");
		<?php if ($usuario_add->foto->Required) { ?>
			felm = this.getElements("x" + infix + "_foto");
			elm = this.getElements("fn_x" + infix + "_foto");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $usuario->foto->caption(), $usuario->foto->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($usuario_add->calendario->Required) { ?>
			elm = this.getElements("x" + infix + "_calendario");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->calendario->caption(), $usuario->calendario->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_calendario");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($usuario->calendario->errorMessage()) ?>");
		<?php if ($usuario_add->brief->Required) { ?>
			elm = this.getElements("x" + infix + "_brief");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->brief->caption(), $usuario->brief->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_brief");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($usuario->brief->errorMessage()) ?>");
		<?php if ($usuario_add->_email->Required) { ?>
			elm = this.getElements("x" + infix + "__email");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->_email->caption(), $usuario->_email->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($usuario_add->auth->Required) { ?>
			elm = this.getElements("x" + infix + "_auth");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->auth->caption(), $usuario->auth->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($usuario_add->_menu->Required) { ?>
			elm = this.getElements("x" + infix + "__menu");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->_menu->caption(), $usuario->_menu->RequiredErrorMessage)) ?>");
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
fusuarioadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusuarioadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $usuario_add->showPageHeader(); ?>
<?php
$usuario_add->showMessage();
?>
<form name="fusuarioadd" id="fusuarioadd" class="<?php echo $usuario_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($usuario_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $usuario_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$usuario_add->IsModal ?>">
<!-- Fields to prevent google autofill -->
<input class="d-none" type="text" name="<?php echo Encrypt(Random()) ?>">
<input class="d-none" type="password" name="<?php echo Encrypt(Random()) ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($usuario->nombre->Visible) { // nombre ?>
	<div id="r_nombre" class="form-group row">
		<label id="elh_usuario_nombre" for="x_nombre" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario->nombre->caption() ?><?php echo ($usuario->nombre->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div<?php echo $usuario->nombre->cellAttributes() ?>>
<span id="el_usuario_nombre">
<input type="text" data-table="usuario" data-field="x_nombre" name="x_nombre" id="x_nombre" placeholder="<?php echo HtmlEncode($usuario->nombre->getPlaceHolder()) ?>" value="<?php echo $usuario->nombre->EditValue ?>"<?php echo $usuario->nombre->editAttributes() ?>>
</span>
<?php echo $usuario->nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario->usuario->Visible) { // usuario ?>
	<div id="r_usuario" class="form-group row">
		<label id="elh_usuario_usuario" for="x_usuario" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario->usuario->caption() ?><?php echo ($usuario->usuario->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div<?php echo $usuario->usuario->cellAttributes() ?>>
<span id="el_usuario_usuario">
<input type="text" data-table="usuario" data-field="x_usuario" name="x_usuario" id="x_usuario" placeholder="<?php echo HtmlEncode($usuario->usuario->getPlaceHolder()) ?>" value="<?php echo $usuario->usuario->EditValue ?>"<?php echo $usuario->usuario->editAttributes() ?>>
</span>
<?php echo $usuario->usuario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario->clave->Visible) { // clave ?>
	<div id="r_clave" class="form-group row">
		<label id="elh_usuario_clave" for="x_clave" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario->clave->caption() ?><?php echo ($usuario->clave->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div<?php echo $usuario->clave->cellAttributes() ?>>
<span id="el_usuario_clave">
<input type="password" data-field="x_clave" name="x_clave" id="x_clave" placeholder="<?php echo HtmlEncode($usuario->clave->getPlaceHolder()) ?>"<?php echo $usuario->clave->editAttributes() ?>>
</span>
<?php echo $usuario->clave->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario->role->Visible) { // role ?>
	<div id="r_role" class="form-group row">
		<label id="elh_usuario_role" for="x_role" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario->role->caption() ?><?php echo ($usuario->role->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div<?php echo $usuario->role->cellAttributes() ?>>
<span id="el_usuario_role">
<input type="text" data-table="usuario" data-field="x_role" name="x_role" id="x_role" size="30" placeholder="<?php echo HtmlEncode($usuario->role->getPlaceHolder()) ?>" value="<?php echo $usuario->role->EditValue ?>"<?php echo $usuario->role->editAttributes() ?>>
</span>
<?php echo $usuario->role->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario->foto->Visible) { // foto ?>
	<div id="r_foto" class="form-group row">
		<label id="elh_usuario_foto" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario->foto->caption() ?><?php echo ($usuario->foto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div<?php echo $usuario->foto->cellAttributes() ?>>
<span id="el_usuario_foto">
<div id="fd_x_foto">
<span title="<?php echo $usuario->foto->title() ? $usuario->foto->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($usuario->foto->ReadOnly || $usuario->foto->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="usuario" data-field="x_foto" name="x_foto" id="x_foto"<?php echo $usuario->foto->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_foto" id= "fn_x_foto" value="<?php echo $usuario->foto->Upload->FileName ?>">
<input type="hidden" name="fa_x_foto" id= "fa_x_foto" value="0">
<input type="hidden" name="fs_x_foto" id= "fs_x_foto" value="255">
<input type="hidden" name="fx_x_foto" id= "fx_x_foto" value="<?php echo $usuario->foto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_foto" id= "fm_x_foto" value="<?php echo $usuario->foto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_foto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $usuario->foto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario->calendario->Visible) { // calendario ?>
	<div id="r_calendario" class="form-group row">
		<label id="elh_usuario_calendario" for="x_calendario" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario->calendario->caption() ?><?php echo ($usuario->calendario->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div<?php echo $usuario->calendario->cellAttributes() ?>>
<span id="el_usuario_calendario">
<input type="text" data-table="usuario" data-field="x_calendario" name="x_calendario" id="x_calendario" size="30" placeholder="<?php echo HtmlEncode($usuario->calendario->getPlaceHolder()) ?>" value="<?php echo $usuario->calendario->EditValue ?>"<?php echo $usuario->calendario->editAttributes() ?>>
</span>
<?php echo $usuario->calendario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario->brief->Visible) { // brief ?>
	<div id="r_brief" class="form-group row">
		<label id="elh_usuario_brief" for="x_brief" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario->brief->caption() ?><?php echo ($usuario->brief->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div<?php echo $usuario->brief->cellAttributes() ?>>
<span id="el_usuario_brief">
<input type="text" data-table="usuario" data-field="x_brief" name="x_brief" id="x_brief" size="30" placeholder="<?php echo HtmlEncode($usuario->brief->getPlaceHolder()) ?>" value="<?php echo $usuario->brief->EditValue ?>"<?php echo $usuario->brief->editAttributes() ?>>
</span>
<?php echo $usuario->brief->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_usuario__email" for="x__email" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario->_email->caption() ?><?php echo ($usuario->_email->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div<?php echo $usuario->_email->cellAttributes() ?>>
<span id="el_usuario__email">
<input type="text" data-table="usuario" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($usuario->_email->getPlaceHolder()) ?>" value="<?php echo $usuario->_email->EditValue ?>"<?php echo $usuario->_email->editAttributes() ?>>
</span>
<?php echo $usuario->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario->auth->Visible) { // auth ?>
	<div id="r_auth" class="form-group row">
		<label id="elh_usuario_auth" for="x_auth" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario->auth->caption() ?><?php echo ($usuario->auth->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div<?php echo $usuario->auth->cellAttributes() ?>>
<span id="el_usuario_auth">
<input type="text" data-table="usuario" data-field="x_auth" name="x_auth" id="x_auth" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($usuario->auth->getPlaceHolder()) ?>" value="<?php echo $usuario->auth->EditValue ?>"<?php echo $usuario->auth->editAttributes() ?>>
</span>
<?php echo $usuario->auth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario->_menu->Visible) { // menu ?>
	<div id="r__menu" class="form-group row">
		<label id="elh_usuario__menu" for="x__menu" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario->_menu->caption() ?><?php echo ($usuario->_menu->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div<?php echo $usuario->_menu->cellAttributes() ?>>
<span id="el_usuario__menu">
<input type="text" data-table="usuario" data-field="x__menu" name="x__menu" id="x__menu" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($usuario->_menu->getPlaceHolder()) ?>" value="<?php echo $usuario->_menu->EditValue ?>"<?php echo $usuario->_menu->editAttributes() ?>>
</span>
<?php echo $usuario->_menu->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$usuario_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $usuario_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $usuario_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$usuario_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$usuario_add->terminate();
?>