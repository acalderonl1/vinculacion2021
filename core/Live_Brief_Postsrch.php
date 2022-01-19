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
$Live_Brief_Post_search = new Live_Brief_Post_search();

// Run the page
$Live_Brief_Post_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Live_Brief_Post_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($Live_Brief_Post_search->IsModal) { ?>
var fLive_Brief_Postsearch = currentAdvancedSearchForm = new ew.Form("fLive_Brief_Postsearch", "search");
<?php } else { ?>
var fLive_Brief_Postsearch = currentForm = new ew.Form("fLive_Brief_Postsearch", "search");
<?php } ?>

// Form_CustomValidate event
fLive_Brief_Postsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLive_Brief_Postsearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fLive_Brief_Postsearch.lists["x_tipoEvento"] = <?php echo $Live_Brief_Post_search->tipoEvento->Lookup->toClientList() ?>;
fLive_Brief_Postsearch.lists["x_tipoEvento"].options = <?php echo JsonEncode($Live_Brief_Post_search->tipoEvento->options(FALSE, TRUE)) ?>;
fLive_Brief_Postsearch.lists["x_CategoriaEvento"] = <?php echo $Live_Brief_Post_search->CategoriaEvento->Lookup->toClientList() ?>;
fLive_Brief_Postsearch.lists["x_CategoriaEvento"].options = <?php echo JsonEncode($Live_Brief_Post_search->CategoriaEvento->lookupOptions()) ?>;

// Form object for search
// Validate function for search

fLive_Brief_Postsearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_fecha");
	if (elm && !ew.checkDate(elm.value))
		return this.onError(elm, "<?php echo JsEncode($Live_Brief_Post->fecha->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $Live_Brief_Post_search->showPageHeader(); ?>
<?php
$Live_Brief_Post_search->showMessage();
?>
<form name="fLive_Brief_Postsearch" id="fLive_Brief_Postsearch" class="<?php echo $Live_Brief_Post_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Live_Brief_Post_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $Live_Brief_Post_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Live_Brief_Post">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$Live_Brief_Post_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Live_Brief_Post->tipoEvento->Visible) { // tipoEvento ?>
	<div id="r_tipoEvento" class="form-group row">
		<label for="x_tipoEvento" class="<?php echo $Live_Brief_Post_search->LeftColumnClass ?>"><span id="elh_Live_Brief_Post_tipoEvento"><?php echo $Live_Brief_Post->tipoEvento->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_tipoEvento" id="z_tipoEvento" value="="></span>
		</label>
		<div class="<?php echo $Live_Brief_Post_search->RightColumnClass ?>"><div<?php echo $Live_Brief_Post->tipoEvento->cellAttributes() ?>>
			<span id="el_Live_Brief_Post_tipoEvento">
<?php $Live_Brief_Post->tipoEvento->EditAttrs["onchange"] = "ew.updateOptions.call(this);" . @$Live_Brief_Post->tipoEvento->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Live_Brief_Post" data-field="x_tipoEvento" data-value-separator="<?php echo $Live_Brief_Post->tipoEvento->displayValueSeparatorAttribute() ?>" id="x_tipoEvento" name="x_tipoEvento"<?php echo $Live_Brief_Post->tipoEvento->editAttributes() ?>>
		<?php echo $Live_Brief_Post->tipoEvento->selectOptionListHtml("x_tipoEvento") ?>
	</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($Live_Brief_Post->CategoriaEvento->Visible) { // CategoriaEvento ?>
	<div id="r_CategoriaEvento" class="form-group row">
		<label for="x_CategoriaEvento" class="<?php echo $Live_Brief_Post_search->LeftColumnClass ?>"><span id="elh_Live_Brief_Post_CategoriaEvento"><?php echo $Live_Brief_Post->CategoriaEvento->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_CategoriaEvento" id="z_CategoriaEvento" value="="></span>
		</label>
		<div class="<?php echo $Live_Brief_Post_search->RightColumnClass ?>"><div<?php echo $Live_Brief_Post->CategoriaEvento->cellAttributes() ?>>
			<span id="el_Live_Brief_Post_CategoriaEvento">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Live_Brief_Post" data-field="x_CategoriaEvento" data-value-separator="<?php echo $Live_Brief_Post->CategoriaEvento->displayValueSeparatorAttribute() ?>" id="x_CategoriaEvento" name="x_CategoriaEvento"<?php echo $Live_Brief_Post->CategoriaEvento->editAttributes() ?>>
		<?php echo $Live_Brief_Post->CategoriaEvento->selectOptionListHtml("x_CategoriaEvento") ?>
	</select>
</div>
<?php echo $Live_Brief_Post->CategoriaEvento->Lookup->getParamTag("p_x_CategoriaEvento") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($Live_Brief_Post->fecha->Visible) { // fecha ?>
	<div id="r_fecha" class="form-group row">
		<label for="x_fecha" class="<?php echo $Live_Brief_Post_search->LeftColumnClass ?>"><span id="elh_Live_Brief_Post_fecha"><?php echo $Live_Brief_Post->fecha->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("BETWEEN") ?><input type="hidden" name="z_fecha" id="z_fecha" value="BETWEEN"></span>
		</label>
		<div class="<?php echo $Live_Brief_Post_search->RightColumnClass ?>"><div<?php echo $Live_Brief_Post->fecha->cellAttributes() ?>>
			<span id="el_Live_Brief_Post_fecha">
<input type="text" data-table="Live_Brief_Post" data-field="x_fecha" data-format="5" name="x_fecha" id="x_fecha" placeholder="<?php echo HtmlEncode($Live_Brief_Post->fecha->getPlaceHolder()) ?>" value="<?php echo $Live_Brief_Post->fecha->EditValue ?>"<?php echo $Live_Brief_Post->fecha->editAttributes() ?>>
<?php if (!$Live_Brief_Post->fecha->ReadOnly && !$Live_Brief_Post->fecha->Disabled && !isset($Live_Brief_Post->fecha->EditAttrs["readonly"]) && !isset($Live_Brief_Post->fecha->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fLive_Brief_Postsearch", "x_fecha", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
			<span class="ew-search-cond btw1_fecha"><label><?php echo $Language->Phrase("AND") ?></label></span>
			<span id="e2_Live_Brief_Post_fecha" class="btw1_fecha">
<input type="text" data-table="Live_Brief_Post" data-field="x_fecha" data-format="5" name="y_fecha" id="y_fecha" placeholder="<?php echo HtmlEncode($Live_Brief_Post->fecha->getPlaceHolder()) ?>" value="<?php echo $Live_Brief_Post->fecha->EditValue2 ?>"<?php echo $Live_Brief_Post->fecha->editAttributes() ?>>
<?php if (!$Live_Brief_Post->fecha->ReadOnly && !$Live_Brief_Post->fecha->Disabled && !isset($Live_Brief_Post->fecha->EditAttrs["readonly"]) && !isset($Live_Brief_Post->fecha->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fLive_Brief_Postsearch", "y_fecha", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($Live_Brief_Post->urlFB->Visible) { // urlFB ?>
	<div id="r_urlFB" class="form-group row">
		<label for="x_urlFB" class="<?php echo $Live_Brief_Post_search->LeftColumnClass ?>"><span id="elh_Live_Brief_Post_urlFB"><?php echo $Live_Brief_Post->urlFB->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_urlFB" id="z_urlFB" value="LIKE"></span>
		</label>
		<div class="<?php echo $Live_Brief_Post_search->RightColumnClass ?>"><div<?php echo $Live_Brief_Post->urlFB->cellAttributes() ?>>
			<span id="el_Live_Brief_Post_urlFB">
<input type="text" data-table="Live_Brief_Post" data-field="x_urlFB" name="x_urlFB" id="x_urlFB" size="35" placeholder="<?php echo HtmlEncode($Live_Brief_Post->urlFB->getPlaceHolder()) ?>" value="<?php echo $Live_Brief_Post->urlFB->EditValue ?>"<?php echo $Live_Brief_Post->urlFB->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Live_Brief_Post_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Live_Brief_Post_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Live_Brief_Post_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$Live_Brief_Post_search->terminate();
?>