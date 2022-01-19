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
$Live_Brief_Post_list = new Live_Brief_Post_list();

// Run the page
$Live_Brief_Post_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Live_Brief_Post_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$Live_Brief_Post->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fLive_Brief_Postlist = currentForm = new ew.Form("fLive_Brief_Postlist", "list");
fLive_Brief_Postlist.formKeyCountName = '<?php echo $Live_Brief_Post_list->FormKeyCountName ?>';

// Form_CustomValidate event
fLive_Brief_Postlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLive_Brief_Postlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fLive_Brief_Postlist.lists["x_tipo"] = <?php echo $Live_Brief_Post_list->tipo->Lookup->toClientList() ?>;
fLive_Brief_Postlist.lists["x_tipo"].options = <?php echo JsonEncode($Live_Brief_Post_list->tipo->options(FALSE, TRUE)) ?>;
fLive_Brief_Postlist.lists["x_tipoEvento"] = <?php echo $Live_Brief_Post_list->tipoEvento->Lookup->toClientList() ?>;
fLive_Brief_Postlist.lists["x_tipoEvento"].options = <?php echo JsonEncode($Live_Brief_Post_list->tipoEvento->options(FALSE, TRUE)) ?>;
fLive_Brief_Postlist.lists["x_CategoriaEvento"] = <?php echo $Live_Brief_Post_list->CategoriaEvento->Lookup->toClientList() ?>;
fLive_Brief_Postlist.lists["x_CategoriaEvento"].options = <?php echo JsonEncode($Live_Brief_Post_list->CategoriaEvento->lookupOptions()) ?>;
fLive_Brief_Postlist.lists["x_evento"] = <?php echo $Live_Brief_Post_list->evento->Lookup->toClientList() ?>;
fLive_Brief_Postlist.lists["x_evento"].options = <?php echo JsonEncode($Live_Brief_Post_list->evento->lookupOptions()) ?>;

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
<?php if (!$Live_Brief_Post->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Live_Brief_Post_list->TotalRecs > 0 && $Live_Brief_Post_list->ExportOptions->visible()) { ?>
<?php $Live_Brief_Post_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Live_Brief_Post_list->ImportOptions->visible()) { ?>
<?php $Live_Brief_Post_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Live_Brief_Post_list->renderOtherOptions();
?>
<?php $Live_Brief_Post_list->showPageHeader(); ?>
<?php
$Live_Brief_Post_list->showMessage();
?>
<?php if ($Live_Brief_Post_list->TotalRecs > 0 || $Live_Brief_Post->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Live_Brief_Post_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Live_Brief_Post">
<?php if (!$Live_Brief_Post->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Live_Brief_Post->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($Live_Brief_Post_list->Pager)) $Live_Brief_Post_list->Pager = new NumericPager($Live_Brief_Post_list->StartRec, $Live_Brief_Post_list->DisplayRecs, $Live_Brief_Post_list->TotalRecs, $Live_Brief_Post_list->RecRange, $Live_Brief_Post_list->AutoHidePager) ?>
<?php if ($Live_Brief_Post_list->Pager->RecordCount > 0 && $Live_Brief_Post_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($Live_Brief_Post_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Live_Brief_Post_list->pageUrl() ?>start=<?php echo $Live_Brief_Post_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($Live_Brief_Post_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Live_Brief_Post_list->pageUrl() ?>start=<?php echo $Live_Brief_Post_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($Live_Brief_Post_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $Live_Brief_Post_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($Live_Brief_Post_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Live_Brief_Post_list->pageUrl() ?>start=<?php echo $Live_Brief_Post_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($Live_Brief_Post_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Live_Brief_Post_list->pageUrl() ?>start=<?php echo $Live_Brief_Post_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($Live_Brief_Post_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $Live_Brief_Post_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $Live_Brief_Post_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $Live_Brief_Post_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Live_Brief_Post_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fLive_Brief_Postlist" id="fLive_Brief_Postlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Live_Brief_Post_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $Live_Brief_Post_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Live_Brief_Post">
<div id="gmp_Live_Brief_Post" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($Live_Brief_Post_list->TotalRecs > 0 || $Live_Brief_Post->isGridEdit()) { ?>
<table id="tbl_Live_Brief_Postlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Live_Brief_Post_list->RowType = ROWTYPE_HEADER;

// Render list options
$Live_Brief_Post_list->renderListOptions();

// Render list options (header, left)
$Live_Brief_Post_list->ListOptions->render("header", "left");
?>
<?php if ($Live_Brief_Post->tipo->Visible) { // tipo ?>
	<?php if ($Live_Brief_Post->sortUrl($Live_Brief_Post->tipo) == "") { ?>
		<th data-name="tipo" class="<?php echo $Live_Brief_Post->tipo->headerCellClass() ?>"><div id="elh_Live_Brief_Post_tipo" class="Live_Brief_Post_tipo"><div class="ew-table-header-caption"><?php echo $Live_Brief_Post->tipo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipo" class="<?php echo $Live_Brief_Post->tipo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Live_Brief_Post->SortUrl($Live_Brief_Post->tipo) ?>',1);"><div id="elh_Live_Brief_Post_tipo" class="Live_Brief_Post_tipo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Live_Brief_Post->tipo->caption() ?></span><span class="ew-table-header-sort"><?php if ($Live_Brief_Post->tipo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Live_Brief_Post->tipo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Live_Brief_Post->tipoEvento->Visible) { // tipoEvento ?>
	<?php if ($Live_Brief_Post->sortUrl($Live_Brief_Post->tipoEvento) == "") { ?>
		<th data-name="tipoEvento" class="<?php echo $Live_Brief_Post->tipoEvento->headerCellClass() ?>"><div id="elh_Live_Brief_Post_tipoEvento" class="Live_Brief_Post_tipoEvento"><div class="ew-table-header-caption"><?php echo $Live_Brief_Post->tipoEvento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipoEvento" class="<?php echo $Live_Brief_Post->tipoEvento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Live_Brief_Post->SortUrl($Live_Brief_Post->tipoEvento) ?>',1);"><div id="elh_Live_Brief_Post_tipoEvento" class="Live_Brief_Post_tipoEvento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Live_Brief_Post->tipoEvento->caption() ?></span><span class="ew-table-header-sort"><?php if ($Live_Brief_Post->tipoEvento->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Live_Brief_Post->tipoEvento->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Live_Brief_Post->CategoriaEvento->Visible) { // CategoriaEvento ?>
	<?php if ($Live_Brief_Post->sortUrl($Live_Brief_Post->CategoriaEvento) == "") { ?>
		<th data-name="CategoriaEvento" class="<?php echo $Live_Brief_Post->CategoriaEvento->headerCellClass() ?>"><div id="elh_Live_Brief_Post_CategoriaEvento" class="Live_Brief_Post_CategoriaEvento"><div class="ew-table-header-caption"><?php echo $Live_Brief_Post->CategoriaEvento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CategoriaEvento" class="<?php echo $Live_Brief_Post->CategoriaEvento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Live_Brief_Post->SortUrl($Live_Brief_Post->CategoriaEvento) ?>',1);"><div id="elh_Live_Brief_Post_CategoriaEvento" class="Live_Brief_Post_CategoriaEvento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Live_Brief_Post->CategoriaEvento->caption() ?></span><span class="ew-table-header-sort"><?php if ($Live_Brief_Post->CategoriaEvento->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Live_Brief_Post->CategoriaEvento->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Live_Brief_Post->evento->Visible) { // evento ?>
	<?php if ($Live_Brief_Post->sortUrl($Live_Brief_Post->evento) == "") { ?>
		<th data-name="evento" class="<?php echo $Live_Brief_Post->evento->headerCellClass() ?>"><div id="elh_Live_Brief_Post_evento" class="Live_Brief_Post_evento"><div class="ew-table-header-caption"><?php echo $Live_Brief_Post->evento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="evento" class="<?php echo $Live_Brief_Post->evento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Live_Brief_Post->SortUrl($Live_Brief_Post->evento) ?>',1);"><div id="elh_Live_Brief_Post_evento" class="Live_Brief_Post_evento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Live_Brief_Post->evento->caption() ?></span><span class="ew-table-header-sort"><?php if ($Live_Brief_Post->evento->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Live_Brief_Post->evento->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Live_Brief_Post->imagen->Visible) { // imagen ?>
	<?php if ($Live_Brief_Post->sortUrl($Live_Brief_Post->imagen) == "") { ?>
		<th data-name="imagen" class="<?php echo $Live_Brief_Post->imagen->headerCellClass() ?>"><div id="elh_Live_Brief_Post_imagen" class="Live_Brief_Post_imagen"><div class="ew-table-header-caption"><?php echo $Live_Brief_Post->imagen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="imagen" class="<?php echo $Live_Brief_Post->imagen->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Live_Brief_Post->SortUrl($Live_Brief_Post->imagen) ?>',1);"><div id="elh_Live_Brief_Post_imagen" class="Live_Brief_Post_imagen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Live_Brief_Post->imagen->caption() ?></span><span class="ew-table-header-sort"><?php if ($Live_Brief_Post->imagen->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Live_Brief_Post->imagen->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Live_Brief_Post_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($Live_Brief_Post->ExportAll && $Live_Brief_Post->isExport()) {
	$Live_Brief_Post_list->StopRec = $Live_Brief_Post_list->TotalRecs;
} else {

	// Set the last record to display
	if ($Live_Brief_Post_list->TotalRecs > $Live_Brief_Post_list->StartRec + $Live_Brief_Post_list->DisplayRecs - 1)
		$Live_Brief_Post_list->StopRec = $Live_Brief_Post_list->StartRec + $Live_Brief_Post_list->DisplayRecs - 1;
	else
		$Live_Brief_Post_list->StopRec = $Live_Brief_Post_list->TotalRecs;
}
$Live_Brief_Post_list->RecCnt = $Live_Brief_Post_list->StartRec - 1;
if ($Live_Brief_Post_list->Recordset && !$Live_Brief_Post_list->Recordset->EOF) {
	$Live_Brief_Post_list->Recordset->moveFirst();
	$selectLimit = $Live_Brief_Post_list->UseSelectLimit;
	if (!$selectLimit && $Live_Brief_Post_list->StartRec > 1)
		$Live_Brief_Post_list->Recordset->move($Live_Brief_Post_list->StartRec - 1);
} elseif (!$Live_Brief_Post->AllowAddDeleteRow && $Live_Brief_Post_list->StopRec == 0) {
	$Live_Brief_Post_list->StopRec = $Live_Brief_Post->GridAddRowCount;
}

// Initialize aggregate
$Live_Brief_Post->RowType = ROWTYPE_AGGREGATEINIT;
$Live_Brief_Post->resetAttributes();
$Live_Brief_Post_list->renderRow();
while ($Live_Brief_Post_list->RecCnt < $Live_Brief_Post_list->StopRec) {
	$Live_Brief_Post_list->RecCnt++;
	if ($Live_Brief_Post_list->RecCnt >= $Live_Brief_Post_list->StartRec) {
		$Live_Brief_Post_list->RowCnt++;

		// Set up key count
		$Live_Brief_Post_list->KeyCount = $Live_Brief_Post_list->RowIndex;

		// Init row class and style
		$Live_Brief_Post->resetAttributes();
		$Live_Brief_Post->CssClass = "";
		if ($Live_Brief_Post->isGridAdd()) {
		} else {
			$Live_Brief_Post_list->loadRowValues($Live_Brief_Post_list->Recordset); // Load row values
		}
		$Live_Brief_Post->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$Live_Brief_Post->RowAttrs = array_merge($Live_Brief_Post->RowAttrs, array('data-rowindex'=>$Live_Brief_Post_list->RowCnt, 'id'=>'r' . $Live_Brief_Post_list->RowCnt . '_Live_Brief_Post', 'data-rowtype'=>$Live_Brief_Post->RowType));

		// Render row
		$Live_Brief_Post_list->renderRow();

		// Render list options
		$Live_Brief_Post_list->renderListOptions();
?>
	<tr<?php echo $Live_Brief_Post->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Live_Brief_Post_list->ListOptions->render("body", "left", $Live_Brief_Post_list->RowCnt);
?>
	<?php if ($Live_Brief_Post->tipo->Visible) { // tipo ?>
		<td data-name="tipo"<?php echo $Live_Brief_Post->tipo->cellAttributes() ?>>
<span id="el<?php echo $Live_Brief_Post_list->RowCnt ?>_Live_Brief_Post_tipo" class="Live_Brief_Post_tipo">
<span<?php echo $Live_Brief_Post->tipo->viewAttributes() ?>>
<?php echo $Live_Brief_Post->tipo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Live_Brief_Post->tipoEvento->Visible) { // tipoEvento ?>
		<td data-name="tipoEvento"<?php echo $Live_Brief_Post->tipoEvento->cellAttributes() ?>>
<span id="el<?php echo $Live_Brief_Post_list->RowCnt ?>_Live_Brief_Post_tipoEvento" class="Live_Brief_Post_tipoEvento">
<span<?php echo $Live_Brief_Post->tipoEvento->viewAttributes() ?>>
<?php echo $Live_Brief_Post->tipoEvento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Live_Brief_Post->CategoriaEvento->Visible) { // CategoriaEvento ?>
		<td data-name="CategoriaEvento"<?php echo $Live_Brief_Post->CategoriaEvento->cellAttributes() ?>>
<span id="el<?php echo $Live_Brief_Post_list->RowCnt ?>_Live_Brief_Post_CategoriaEvento" class="Live_Brief_Post_CategoriaEvento">
<span<?php echo $Live_Brief_Post->CategoriaEvento->viewAttributes() ?>>
<?php echo $Live_Brief_Post->CategoriaEvento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Live_Brief_Post->evento->Visible) { // evento ?>
		<td data-name="evento"<?php echo $Live_Brief_Post->evento->cellAttributes() ?>>
<span id="el<?php echo $Live_Brief_Post_list->RowCnt ?>_Live_Brief_Post_evento" class="Live_Brief_Post_evento">
<span<?php echo $Live_Brief_Post->evento->viewAttributes() ?>>
<?php echo $Live_Brief_Post->evento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Live_Brief_Post->imagen->Visible) { // imagen ?>
		<td data-name="imagen"<?php echo $Live_Brief_Post->imagen->cellAttributes() ?>>
<span id="el<?php echo $Live_Brief_Post_list->RowCnt ?>_Live_Brief_Post_imagen" class="Live_Brief_Post_imagen">
<span>
<?php echo GetFileViewTag($Live_Brief_Post->imagen, $Live_Brief_Post->imagen->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Live_Brief_Post_list->ListOptions->render("body", "right", $Live_Brief_Post_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$Live_Brief_Post->isGridAdd())
		$Live_Brief_Post_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$Live_Brief_Post->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Live_Brief_Post_list->Recordset)
	$Live_Brief_Post_list->Recordset->Close();
?>
<?php if (!$Live_Brief_Post->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Live_Brief_Post->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($Live_Brief_Post_list->Pager)) $Live_Brief_Post_list->Pager = new NumericPager($Live_Brief_Post_list->StartRec, $Live_Brief_Post_list->DisplayRecs, $Live_Brief_Post_list->TotalRecs, $Live_Brief_Post_list->RecRange, $Live_Brief_Post_list->AutoHidePager) ?>
<?php if ($Live_Brief_Post_list->Pager->RecordCount > 0 && $Live_Brief_Post_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($Live_Brief_Post_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Live_Brief_Post_list->pageUrl() ?>start=<?php echo $Live_Brief_Post_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($Live_Brief_Post_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Live_Brief_Post_list->pageUrl() ?>start=<?php echo $Live_Brief_Post_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($Live_Brief_Post_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $Live_Brief_Post_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($Live_Brief_Post_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Live_Brief_Post_list->pageUrl() ?>start=<?php echo $Live_Brief_Post_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($Live_Brief_Post_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Live_Brief_Post_list->pageUrl() ?>start=<?php echo $Live_Brief_Post_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($Live_Brief_Post_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $Live_Brief_Post_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $Live_Brief_Post_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $Live_Brief_Post_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Live_Brief_Post_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Live_Brief_Post_list->TotalRecs == 0 && !$Live_Brief_Post->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Live_Brief_Post_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Live_Brief_Post_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$Live_Brief_Post->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$Live_Brief_Post_list->terminate();
?>