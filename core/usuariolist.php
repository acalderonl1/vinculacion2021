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
$usuario_list = new usuario_list();

// Run the page
$usuario_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuario_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$usuario->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fusuariolist = currentForm = new ew.Form("fusuariolist", "list");
fusuariolist.formKeyCountName = '<?php echo $usuario_list->FormKeyCountName ?>';

// Form_CustomValidate event
fusuariolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusuariolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script src="phpjs/ewpreview.js"></script>
<script>
ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
ew.PREVIEW_SINGLE_ROW = false;
ew.PREVIEW_OVERLAY = false;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$usuario->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($usuario_list->TotalRecs > 0 && $usuario_list->ExportOptions->visible()) { ?>
<?php $usuario_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($usuario_list->ImportOptions->visible()) { ?>
<?php $usuario_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$usuario_list->renderOtherOptions();
?>
<?php $usuario_list->showPageHeader(); ?>
<?php
$usuario_list->showMessage();
?>
<?php if ($usuario_list->TotalRecs > 0 || $usuario->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($usuario_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> usuario">
<?php if (!$usuario->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$usuario->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($usuario_list->Pager)) $usuario_list->Pager = new NumericPager($usuario_list->StartRec, $usuario_list->DisplayRecs, $usuario_list->TotalRecs, $usuario_list->RecRange, $usuario_list->AutoHidePager) ?>
<?php if ($usuario_list->Pager->RecordCount > 0 && $usuario_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($usuario_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $usuario_list->pageUrl() ?>start=<?php echo $usuario_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($usuario_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $usuario_list->pageUrl() ?>start=<?php echo $usuario_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($usuario_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $usuario_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($usuario_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $usuario_list->pageUrl() ?>start=<?php echo $usuario_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($usuario_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $usuario_list->pageUrl() ?>start=<?php echo $usuario_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($usuario_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $usuario_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $usuario_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $usuario_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $usuario_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fusuariolist" id="fusuariolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($usuario_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $usuario_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<div id="gmp_usuario" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($usuario_list->TotalRecs > 0 || $usuario->isGridEdit()) { ?>
<table id="tbl_usuariolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$usuario_list->RowType = ROWTYPE_HEADER;

// Render list options
$usuario_list->renderListOptions();

// Render list options (header, left)
$usuario_list->ListOptions->render("header", "left");
?>
<?php if ($usuario->id->Visible) { // id ?>
	<?php if ($usuario->sortUrl($usuario->id) == "") { ?>
		<th data-name="id" class="<?php echo $usuario->id->headerCellClass() ?>"><div id="elh_usuario_id" class="usuario_id"><div class="ew-table-header-caption"><?php echo $usuario->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $usuario->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $usuario->SortUrl($usuario->id) ?>',1);"><div id="elh_usuario_id" class="usuario_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($usuario->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($usuario->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuario->nombre->Visible) { // nombre ?>
	<?php if ($usuario->sortUrl($usuario->nombre) == "") { ?>
		<th data-name="nombre" class="<?php echo $usuario->nombre->headerCellClass() ?>"><div id="elh_usuario_nombre" class="usuario_nombre"><div class="ew-table-header-caption"><?php echo $usuario->nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre" class="<?php echo $usuario->nombre->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $usuario->SortUrl($usuario->nombre) ?>',1);"><div id="elh_usuario_nombre" class="usuario_nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario->nombre->caption() ?></span><span class="ew-table-header-sort"><?php if ($usuario->nombre->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($usuario->nombre->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuario->foto->Visible) { // foto ?>
	<?php if ($usuario->sortUrl($usuario->foto) == "") { ?>
		<th data-name="foto" class="<?php echo $usuario->foto->headerCellClass() ?>"><div id="elh_usuario_foto" class="usuario_foto"><div class="ew-table-header-caption"><?php echo $usuario->foto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="foto" class="<?php echo $usuario->foto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $usuario->SortUrl($usuario->foto) ?>',1);"><div id="elh_usuario_foto" class="usuario_foto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario->foto->caption() ?></span><span class="ew-table-header-sort"><?php if ($usuario->foto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($usuario->foto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuario->brief->Visible) { // brief ?>
	<?php if ($usuario->sortUrl($usuario->brief) == "") { ?>
		<th data-name="brief" class="<?php echo $usuario->brief->headerCellClass() ?>"><div id="elh_usuario_brief" class="usuario_brief"><div class="ew-table-header-caption"><?php echo $usuario->brief->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="brief" class="<?php echo $usuario->brief->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $usuario->SortUrl($usuario->brief) ?>',1);"><div id="elh_usuario_brief" class="usuario_brief">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario->brief->caption() ?></span><span class="ew-table-header-sort"><?php if ($usuario->brief->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($usuario->brief->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuario->_email->Visible) { // email ?>
	<?php if ($usuario->sortUrl($usuario->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $usuario->_email->headerCellClass() ?>"><div id="elh_usuario__email" class="usuario__email"><div class="ew-table-header-caption"><?php echo $usuario->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $usuario->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $usuario->SortUrl($usuario->_email) ?>',1);"><div id="elh_usuario__email" class="usuario__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario->_email->caption() ?></span><span class="ew-table-header-sort"><?php if ($usuario->_email->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($usuario->_email->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuario->auth->Visible) { // auth ?>
	<?php if ($usuario->sortUrl($usuario->auth) == "") { ?>
		<th data-name="auth" class="<?php echo $usuario->auth->headerCellClass() ?>"><div id="elh_usuario_auth" class="usuario_auth"><div class="ew-table-header-caption"><?php echo $usuario->auth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="auth" class="<?php echo $usuario->auth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $usuario->SortUrl($usuario->auth) ?>',1);"><div id="elh_usuario_auth" class="usuario_auth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario->auth->caption() ?></span><span class="ew-table-header-sort"><?php if ($usuario->auth->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($usuario->auth->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuario->_menu->Visible) { // menu ?>
	<?php if ($usuario->sortUrl($usuario->_menu) == "") { ?>
		<th data-name="_menu" class="<?php echo $usuario->_menu->headerCellClass() ?>"><div id="elh_usuario__menu" class="usuario__menu"><div class="ew-table-header-caption"><?php echo $usuario->_menu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_menu" class="<?php echo $usuario->_menu->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $usuario->SortUrl($usuario->_menu) ?>',1);"><div id="elh_usuario__menu" class="usuario__menu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario->_menu->caption() ?></span><span class="ew-table-header-sort"><?php if ($usuario->_menu->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($usuario->_menu->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$usuario_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($usuario->ExportAll && $usuario->isExport()) {
	$usuario_list->StopRec = $usuario_list->TotalRecs;
} else {

	// Set the last record to display
	if ($usuario_list->TotalRecs > $usuario_list->StartRec + $usuario_list->DisplayRecs - 1)
		$usuario_list->StopRec = $usuario_list->StartRec + $usuario_list->DisplayRecs - 1;
	else
		$usuario_list->StopRec = $usuario_list->TotalRecs;
}
$usuario_list->RecCnt = $usuario_list->StartRec - 1;
if ($usuario_list->Recordset && !$usuario_list->Recordset->EOF) {
	$usuario_list->Recordset->moveFirst();
	$selectLimit = $usuario_list->UseSelectLimit;
	if (!$selectLimit && $usuario_list->StartRec > 1)
		$usuario_list->Recordset->move($usuario_list->StartRec - 1);
} elseif (!$usuario->AllowAddDeleteRow && $usuario_list->StopRec == 0) {
	$usuario_list->StopRec = $usuario->GridAddRowCount;
}

// Initialize aggregate
$usuario->RowType = ROWTYPE_AGGREGATEINIT;
$usuario->resetAttributes();
$usuario_list->renderRow();
while ($usuario_list->RecCnt < $usuario_list->StopRec) {
	$usuario_list->RecCnt++;
	if ($usuario_list->RecCnt >= $usuario_list->StartRec) {
		$usuario_list->RowCnt++;

		// Set up key count
		$usuario_list->KeyCount = $usuario_list->RowIndex;

		// Init row class and style
		$usuario->resetAttributes();
		$usuario->CssClass = "";
		if ($usuario->isGridAdd()) {
		} else {
			$usuario_list->loadRowValues($usuario_list->Recordset); // Load row values
		}
		$usuario->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$usuario->RowAttrs = array_merge($usuario->RowAttrs, array('data-rowindex'=>$usuario_list->RowCnt, 'id'=>'r' . $usuario_list->RowCnt . '_usuario', 'data-rowtype'=>$usuario->RowType));

		// Render row
		$usuario_list->renderRow();

		// Render list options
		$usuario_list->renderListOptions();
?>
	<tr<?php echo $usuario->rowAttributes() ?>>
<?php

// Render list options (body, left)
$usuario_list->ListOptions->render("body", "left", $usuario_list->RowCnt);
?>
	<?php if ($usuario->id->Visible) { // id ?>
		<td data-name="id"<?php echo $usuario->id->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCnt ?>_usuario_id" class="usuario_id">
<span<?php echo $usuario->id->viewAttributes() ?>>
<?php echo $usuario->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuario->nombre->Visible) { // nombre ?>
		<td data-name="nombre"<?php echo $usuario->nombre->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCnt ?>_usuario_nombre" class="usuario_nombre">
<span<?php echo $usuario->nombre->viewAttributes() ?>>
<?php echo $usuario->nombre->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuario->foto->Visible) { // foto ?>
		<td data-name="foto"<?php echo $usuario->foto->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCnt ?>_usuario_foto" class="usuario_foto">
<span>
<?php echo GetFileViewTag($usuario->foto, $usuario->foto->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($usuario->brief->Visible) { // brief ?>
		<td data-name="brief"<?php echo $usuario->brief->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCnt ?>_usuario_brief" class="usuario_brief">
<span<?php echo $usuario->brief->viewAttributes() ?>>
<?php echo $usuario->brief->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuario->_email->Visible) { // email ?>
		<td data-name="_email"<?php echo $usuario->_email->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCnt ?>_usuario__email" class="usuario__email">
<span<?php echo $usuario->_email->viewAttributes() ?>>
<?php echo $usuario->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuario->auth->Visible) { // auth ?>
		<td data-name="auth"<?php echo $usuario->auth->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCnt ?>_usuario_auth" class="usuario_auth">
<span<?php echo $usuario->auth->viewAttributes() ?>>
<?php echo $usuario->auth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuario->_menu->Visible) { // menu ?>
		<td data-name="_menu"<?php echo $usuario->_menu->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCnt ?>_usuario__menu" class="usuario__menu">
<span<?php echo $usuario->_menu->viewAttributes() ?>>
<?php echo $usuario->_menu->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$usuario_list->ListOptions->render("body", "right", $usuario_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$usuario->isGridAdd())
		$usuario_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$usuario->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($usuario_list->Recordset)
	$usuario_list->Recordset->Close();
?>
<?php if (!$usuario->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$usuario->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($usuario_list->Pager)) $usuario_list->Pager = new NumericPager($usuario_list->StartRec, $usuario_list->DisplayRecs, $usuario_list->TotalRecs, $usuario_list->RecRange, $usuario_list->AutoHidePager) ?>
<?php if ($usuario_list->Pager->RecordCount > 0 && $usuario_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($usuario_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $usuario_list->pageUrl() ?>start=<?php echo $usuario_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($usuario_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $usuario_list->pageUrl() ?>start=<?php echo $usuario_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($usuario_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $usuario_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($usuario_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $usuario_list->pageUrl() ?>start=<?php echo $usuario_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($usuario_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $usuario_list->pageUrl() ?>start=<?php echo $usuario_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($usuario_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $usuario_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $usuario_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $usuario_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $usuario_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($usuario_list->TotalRecs == 0 && !$usuario->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $usuario_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$usuario_list->showPageFooter();
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
$usuario_list->terminate();
?>