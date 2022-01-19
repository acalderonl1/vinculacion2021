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
$register = new register();

// Run the page
$register->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$register->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "register";
var fregister = currentForm = new ew.Form("fregister", "register");

// Validate form
fregister.validate = function() {
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
		<?php if ($register->nombre->Required) { ?>
			elm = this.getElements("x" + infix + "_nombre");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->nombre->caption(), $usuario->nombre->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($register->usuario->Required) { ?>
			elm = this.getElements("x" + infix + "_usuario");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, ew.language.phrase("EnterUserName"));
		<?php } ?>
		<?php if ($register->clave->Required) { ?>
			elm = this.getElements("x" + infix + "_clave");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, ew.language.phrase("EnterPassword"));
		<?php } ?>
			if (fobj.c_clave.value != fobj.x_clave.value)
				return this.onError(fobj.c_clave, ew.language.phrase("MismatchPassword"));
		<?php if ($register->_email->Required) { ?>
			elm = this.getElements("x" + infix + "__email");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->_email->caption(), $usuario->_email->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fregister.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fregister.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $register->showPageHeader(); ?>
<?php
$register->showMessage();
?>
<form name="fregister" id="fregister" class="<?php echo $register->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($register->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $register->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<input type="hidden" name="action" id="action" value="insert">
<!-- Fields to prevent google autofill -->
<input type="hidden" type="text" name="<?php echo Encrypt(Random()) ?>">
<input type="hidden" type="password" name="<?php echo Encrypt(Random()) ?>">
<div class="ew-register-div"><!-- page* -->
<?php if ($usuario->nombre->Visible) { // nombre ?>
	<div id="r_nombre" class="form-group row">
		<label id="elh_usuario_nombre" for="x_nombre" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->nombre->caption() ?><?php echo ($usuario->nombre->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->nombre->cellAttributes() ?>>
<span id="el_usuario_nombre">
<input type="text" data-table="usuario" data-field="x_nombre" name="x_nombre" id="x_nombre" placeholder="<?php echo HtmlEncode($usuario->nombre->getPlaceHolder()) ?>" value="<?php echo $usuario->nombre->EditValue ?>"<?php echo $usuario->nombre->editAttributes() ?>>
</span>
<?php echo $usuario->nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario->usuario->Visible) { // usuario ?>
	<div id="r_usuario" class="form-group row">
		<label id="elh_usuario_usuario" for="x_usuario" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->usuario->caption() ?><?php echo ($usuario->usuario->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->usuario->cellAttributes() ?>>
<span id="el_usuario_usuario">
<input type="text" data-table="usuario" data-field="x_usuario" name="x_usuario" id="x_usuario" placeholder="<?php echo HtmlEncode($usuario->usuario->getPlaceHolder()) ?>" value="<?php echo $usuario->usuario->EditValue ?>"<?php echo $usuario->usuario->editAttributes() ?>>
</span>
<?php echo $usuario->usuario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario->clave->Visible) { // clave ?>
	<div id="r_clave" class="form-group row">
		<label id="elh_usuario_clave" for="x_clave" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->clave->caption() ?><?php echo ($usuario->clave->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->clave->cellAttributes() ?>>
<span id="el_usuario_clave">
<input type="password" data-field="x_clave" name="x_clave" id="x_clave" placeholder="<?php echo HtmlEncode($usuario->clave->getPlaceHolder()) ?>"<?php echo $usuario->clave->editAttributes() ?>>
</span>
<?php echo $usuario->clave->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario->clave->Visible) { // clave ?>
	<div id="r_c_clave" class="form-group row">
		<label id="elh_c_usuario_clave" for="c_clave" class="<?php echo $register->LeftColumnClass ?>"><?php echo $Language->phrase("Confirm") ?> <?php echo $usuario->clave->caption() ?><?php echo ($usuario->clave->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->clave->cellAttributes() ?>>
<span id="el_c_usuario_clave">
<input type="password" data-field="c_clave" name="c_clave" id="c_clave" placeholder="<?php echo HtmlEncode($usuario->clave->getPlaceHolder()) ?>"<?php echo $usuario->clave->editAttributes() ?>>
</span>
</div></div>
	</div>
<?php } ?>
<?php if ($usuario->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_usuario__email" for="x__email" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->_email->caption() ?><?php echo ($usuario->_email->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->_email->cellAttributes() ?>>
<span id="el_usuario__email">
<input type="text" data-table="usuario" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($usuario->_email->getPlaceHolder()) ?>" value="<?php echo $usuario->_email->EditValue ?>"<?php echo $usuario->_email->editAttributes() ?>>
</span>
<?php echo $usuario->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $register->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("RegisterBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
</form>
<?php
$register->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$register->terminate();
?>