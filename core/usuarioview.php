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
$usuario_view = new usuario_view();

// Run the page
$usuario_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuario_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$usuario->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fusuarioview = currentForm = new ew.Form("fusuarioview", "view");

// Form_CustomValidate event
fusuarioview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusuarioview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$usuario->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $usuario_view->ExportOptions->render("body") ?>
<?php $usuario_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $usuario_view->showPageHeader(); ?>
<?php
$usuario_view->showMessage();
?>
<form name="fusuarioview" id="fusuarioview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($usuario_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $usuario_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<input type="hidden" name="modal" value="<?php echo (int)$usuario_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($usuario->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_id"><?php echo $usuario->id->caption() ?></span></td>
		<td data-name="id"<?php echo $usuario->id->cellAttributes() ?>>
<span id="el_usuario_id">
<span<?php echo $usuario->id->viewAttributes() ?>>
<?php echo $usuario->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario->nombre->Visible) { // nombre ?>
	<tr id="r_nombre">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_nombre"><?php echo $usuario->nombre->caption() ?></span></td>
		<td data-name="nombre"<?php echo $usuario->nombre->cellAttributes() ?>>
<span id="el_usuario_nombre">
<span<?php echo $usuario->nombre->viewAttributes() ?>>
<?php echo $usuario->nombre->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario->usuario->Visible) { // usuario ?>
	<tr id="r_usuario">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_usuario"><?php echo $usuario->usuario->caption() ?></span></td>
		<td data-name="usuario"<?php echo $usuario->usuario->cellAttributes() ?>>
<span id="el_usuario_usuario">
<span<?php echo $usuario->usuario->viewAttributes() ?>>
<?php echo $usuario->usuario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario->clave->Visible) { // clave ?>
	<tr id="r_clave">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_clave"><?php echo $usuario->clave->caption() ?></span></td>
		<td data-name="clave"<?php echo $usuario->clave->cellAttributes() ?>>
<span id="el_usuario_clave">
<span<?php echo $usuario->clave->viewAttributes() ?>>
<?php echo $usuario->clave->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario->role->Visible) { // role ?>
	<tr id="r_role">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_role"><?php echo $usuario->role->caption() ?></span></td>
		<td data-name="role"<?php echo $usuario->role->cellAttributes() ?>>
<span id="el_usuario_role">
<span<?php echo $usuario->role->viewAttributes() ?>>
<?php echo $usuario->role->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario->foto->Visible) { // foto ?>
	<tr id="r_foto">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_foto"><?php echo $usuario->foto->caption() ?></span></td>
		<td data-name="foto"<?php echo $usuario->foto->cellAttributes() ?>>
<span id="el_usuario_foto">
<span>
<?php echo GetFileViewTag($usuario->foto, $usuario->foto->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario->calendario->Visible) { // calendario ?>
	<tr id="r_calendario">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_calendario"><?php echo $usuario->calendario->caption() ?></span></td>
		<td data-name="calendario"<?php echo $usuario->calendario->cellAttributes() ?>>
<span id="el_usuario_calendario">
<span<?php echo $usuario->calendario->viewAttributes() ?>>
<?php echo $usuario->calendario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario->brief->Visible) { // brief ?>
	<tr id="r_brief">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_brief"><?php echo $usuario->brief->caption() ?></span></td>
		<td data-name="brief"<?php echo $usuario->brief->cellAttributes() ?>>
<span id="el_usuario_brief">
<span<?php echo $usuario->brief->viewAttributes() ?>>
<?php echo $usuario->brief->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario__email"><?php echo $usuario->_email->caption() ?></span></td>
		<td data-name="_email"<?php echo $usuario->_email->cellAttributes() ?>>
<span id="el_usuario__email">
<span<?php echo $usuario->_email->viewAttributes() ?>>
<?php echo $usuario->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario->auth->Visible) { // auth ?>
	<tr id="r_auth">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_auth"><?php echo $usuario->auth->caption() ?></span></td>
		<td data-name="auth"<?php echo $usuario->auth->cellAttributes() ?>>
<span id="el_usuario_auth">
<span<?php echo $usuario->auth->viewAttributes() ?>>
<?php echo $usuario->auth->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario->_menu->Visible) { // menu ?>
	<tr id="r__menu">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario__menu"><?php echo $usuario->_menu->caption() ?></span></td>
		<td data-name="_menu"<?php echo $usuario->_menu->cellAttributes() ?>>
<span id="el_usuario__menu">
<span<?php echo $usuario->_menu->viewAttributes() ?>>
<?php echo $usuario->_menu->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$usuario_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$usuario->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$usuario_view->terminate();
?>