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
$Finanzas_Archivos_list = new Finanzas_Archivos_list();

// Run the page
$Finanzas_Archivos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Finanzas_Archivos_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$Finanzas_Archivos->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fFinanzas_Archivoslist = currentForm = new ew.Form("fFinanzas_Archivoslist", "list");
fFinanzas_Archivoslist.formKeyCountName = '<?php echo $Finanzas_Archivos_list->FormKeyCountName ?>';

// Form_CustomValidate event
fFinanzas_Archivoslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fFinanzas_Archivoslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

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
<?php if (!$Finanzas_Archivos->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Finanzas_Archivos_list->TotalRecs > 0 && $Finanzas_Archivos_list->ExportOptions->visible()) { ?>
<?php $Finanzas_Archivos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Finanzas_Archivos_list->ImportOptions->visible()) { ?>
<?php $Finanzas_Archivos_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Finanzas_Archivos_list->renderOtherOptions();
?>
<?php $Finanzas_Archivos_list->showPageHeader(); ?>
<?php
$Finanzas_Archivos_list->showMessage();
?>
<?php if ($Finanzas_Archivos_list->TotalRecs > 0 || $Finanzas_Archivos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Finanzas_Archivos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Finanzas_Archivos">
<?php if (!$Finanzas_Archivos->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Finanzas_Archivos->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($Finanzas_Archivos_list->Pager)) $Finanzas_Archivos_list->Pager = new NumericPager($Finanzas_Archivos_list->StartRec, $Finanzas_Archivos_list->DisplayRecs, $Finanzas_Archivos_list->TotalRecs, $Finanzas_Archivos_list->RecRange, $Finanzas_Archivos_list->AutoHidePager) ?>
<?php if ($Finanzas_Archivos_list->Pager->RecordCount > 0 && $Finanzas_Archivos_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($Finanzas_Archivos_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Finanzas_Archivos_list->pageUrl() ?>start=<?php echo $Finanzas_Archivos_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($Finanzas_Archivos_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Finanzas_Archivos_list->pageUrl() ?>start=<?php echo $Finanzas_Archivos_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($Finanzas_Archivos_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $Finanzas_Archivos_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($Finanzas_Archivos_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Finanzas_Archivos_list->pageUrl() ?>start=<?php echo $Finanzas_Archivos_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($Finanzas_Archivos_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Finanzas_Archivos_list->pageUrl() ?>start=<?php echo $Finanzas_Archivos_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($Finanzas_Archivos_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $Finanzas_Archivos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $Finanzas_Archivos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $Finanzas_Archivos_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Finanzas_Archivos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fFinanzas_Archivoslist" id="fFinanzas_Archivoslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Finanzas_Archivos_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $Finanzas_Archivos_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Finanzas_Archivos">
<div id="gmp_Finanzas_Archivos" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($Finanzas_Archivos_list->TotalRecs > 0 || $Finanzas_Archivos->isGridEdit()) { ?>
<table id="tbl_Finanzas_Archivoslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Finanzas_Archivos_list->RowType = ROWTYPE_HEADER;

// Render list options
$Finanzas_Archivos_list->renderListOptions();

// Render list options (header, left)
$Finanzas_Archivos_list->ListOptions->render("header", "left");
?>
<?php if ($Finanzas_Archivos->Id->Visible) { // Id ?>
	<?php if ($Finanzas_Archivos->sortUrl($Finanzas_Archivos->Id) == "") { ?>
		<th data-name="Id" class="<?php echo $Finanzas_Archivos->Id->headerCellClass() ?>"><div id="elh_Finanzas_Archivos_Id" class="Finanzas_Archivos_Id"><div class="ew-table-header-caption"><?php echo $Finanzas_Archivos->Id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Id" class="<?php echo $Finanzas_Archivos->Id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Finanzas_Archivos->SortUrl($Finanzas_Archivos->Id) ?>',1);"><div id="elh_Finanzas_Archivos_Id" class="Finanzas_Archivos_Id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Finanzas_Archivos->Id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Finanzas_Archivos->Id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Finanzas_Archivos->Id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Finanzas_Archivos->archivo->Visible) { // archivo ?>
	<?php if ($Finanzas_Archivos->sortUrl($Finanzas_Archivos->archivo) == "") { ?>
		<th data-name="archivo" class="<?php echo $Finanzas_Archivos->archivo->headerCellClass() ?>"><div id="elh_Finanzas_Archivos_archivo" class="Finanzas_Archivos_archivo"><div class="ew-table-header-caption"><?php echo $Finanzas_Archivos->archivo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="archivo" class="<?php echo $Finanzas_Archivos->archivo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Finanzas_Archivos->SortUrl($Finanzas_Archivos->archivo) ?>',1);"><div id="elh_Finanzas_Archivos_archivo" class="Finanzas_Archivos_archivo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Finanzas_Archivos->archivo->caption() ?></span><span class="ew-table-header-sort"><?php if ($Finanzas_Archivos->archivo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Finanzas_Archivos->archivo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Finanzas_Archivos->fecha->Visible) { // fecha ?>
	<?php if ($Finanzas_Archivos->sortUrl($Finanzas_Archivos->fecha) == "") { ?>
		<th data-name="fecha" class="<?php echo $Finanzas_Archivos->fecha->headerCellClass() ?>"><div id="elh_Finanzas_Archivos_fecha" class="Finanzas_Archivos_fecha"><div class="ew-table-header-caption"><?php echo $Finanzas_Archivos->fecha->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha" class="<?php echo $Finanzas_Archivos->fecha->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Finanzas_Archivos->SortUrl($Finanzas_Archivos->fecha) ?>',1);"><div id="elh_Finanzas_Archivos_fecha" class="Finanzas_Archivos_fecha">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Finanzas_Archivos->fecha->caption() ?></span><span class="ew-table-header-sort"><?php if ($Finanzas_Archivos->fecha->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Finanzas_Archivos->fecha->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Finanzas_Archivos->Saldo->Visible) { // Saldo ?>
	<?php if ($Finanzas_Archivos->sortUrl($Finanzas_Archivos->Saldo) == "") { ?>
		<th data-name="Saldo" class="<?php echo $Finanzas_Archivos->Saldo->headerCellClass() ?>"><div id="elh_Finanzas_Archivos_Saldo" class="Finanzas_Archivos_Saldo"><div class="ew-table-header-caption"><?php echo $Finanzas_Archivos->Saldo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Saldo" class="<?php echo $Finanzas_Archivos->Saldo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Finanzas_Archivos->SortUrl($Finanzas_Archivos->Saldo) ?>',1);"><div id="elh_Finanzas_Archivos_Saldo" class="Finanzas_Archivos_Saldo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Finanzas_Archivos->Saldo->caption() ?></span><span class="ew-table-header-sort"><?php if ($Finanzas_Archivos->Saldo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Finanzas_Archivos->Saldo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Finanzas_Archivos->Estado->Visible) { // Estado ?>
	<?php if ($Finanzas_Archivos->sortUrl($Finanzas_Archivos->Estado) == "") { ?>
		<th data-name="Estado" class="<?php echo $Finanzas_Archivos->Estado->headerCellClass() ?>"><div id="elh_Finanzas_Archivos_Estado" class="Finanzas_Archivos_Estado"><div class="ew-table-header-caption"><?php echo $Finanzas_Archivos->Estado->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Estado" class="<?php echo $Finanzas_Archivos->Estado->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Finanzas_Archivos->SortUrl($Finanzas_Archivos->Estado) ?>',1);"><div id="elh_Finanzas_Archivos_Estado" class="Finanzas_Archivos_Estado">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Finanzas_Archivos->Estado->caption() ?></span><span class="ew-table-header-sort"><?php if ($Finanzas_Archivos->Estado->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Finanzas_Archivos->Estado->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Finanzas_Archivos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($Finanzas_Archivos->ExportAll && $Finanzas_Archivos->isExport()) {
	$Finanzas_Archivos_list->StopRec = $Finanzas_Archivos_list->TotalRecs;
} else {

	// Set the last record to display
	if ($Finanzas_Archivos_list->TotalRecs > $Finanzas_Archivos_list->StartRec + $Finanzas_Archivos_list->DisplayRecs - 1)
		$Finanzas_Archivos_list->StopRec = $Finanzas_Archivos_list->StartRec + $Finanzas_Archivos_list->DisplayRecs - 1;
	else
		$Finanzas_Archivos_list->StopRec = $Finanzas_Archivos_list->TotalRecs;
}
$Finanzas_Archivos_list->RecCnt = $Finanzas_Archivos_list->StartRec - 1;
if ($Finanzas_Archivos_list->Recordset && !$Finanzas_Archivos_list->Recordset->EOF) {
	$Finanzas_Archivos_list->Recordset->moveFirst();
	$selectLimit = $Finanzas_Archivos_list->UseSelectLimit;
	if (!$selectLimit && $Finanzas_Archivos_list->StartRec > 1)
		$Finanzas_Archivos_list->Recordset->move($Finanzas_Archivos_list->StartRec - 1);
} elseif (!$Finanzas_Archivos->AllowAddDeleteRow && $Finanzas_Archivos_list->StopRec == 0) {
	$Finanzas_Archivos_list->StopRec = $Finanzas_Archivos->GridAddRowCount;
}

// Initialize aggregate
$Finanzas_Archivos->RowType = ROWTYPE_AGGREGATEINIT;
$Finanzas_Archivos->resetAttributes();
$Finanzas_Archivos_list->renderRow();
while ($Finanzas_Archivos_list->RecCnt < $Finanzas_Archivos_list->StopRec) {
	$Finanzas_Archivos_list->RecCnt++;
	if ($Finanzas_Archivos_list->RecCnt >= $Finanzas_Archivos_list->StartRec) {
		$Finanzas_Archivos_list->RowCnt++;

		// Set up key count
		$Finanzas_Archivos_list->KeyCount = $Finanzas_Archivos_list->RowIndex;

		// Init row class and style
		$Finanzas_Archivos->resetAttributes();
		$Finanzas_Archivos->CssClass = "";
		if ($Finanzas_Archivos->isGridAdd()) {
		} else {
			$Finanzas_Archivos_list->loadRowValues($Finanzas_Archivos_list->Recordset); // Load row values
		}
		$Finanzas_Archivos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$Finanzas_Archivos->RowAttrs = array_merge($Finanzas_Archivos->RowAttrs, array('data-rowindex'=>$Finanzas_Archivos_list->RowCnt, 'id'=>'r' . $Finanzas_Archivos_list->RowCnt . '_Finanzas_Archivos', 'data-rowtype'=>$Finanzas_Archivos->RowType));

		// Render row
		$Finanzas_Archivos_list->renderRow();

		// Render list options
		$Finanzas_Archivos_list->renderListOptions();
?>
	<tr<?php echo $Finanzas_Archivos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Finanzas_Archivos_list->ListOptions->render("body", "left", $Finanzas_Archivos_list->RowCnt);
?>
	<?php if ($Finanzas_Archivos->Id->Visible) { // Id ?>
		<td data-name="Id"<?php echo $Finanzas_Archivos->Id->cellAttributes() ?>>
<span id="el<?php echo $Finanzas_Archivos_list->RowCnt ?>_Finanzas_Archivos_Id" class="Finanzas_Archivos_Id">
<span<?php echo $Finanzas_Archivos->Id->viewAttributes() ?>>
<?php echo $Finanzas_Archivos->Id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Finanzas_Archivos->archivo->Visible) { // archivo ?>
		<td data-name="archivo"<?php echo $Finanzas_Archivos->archivo->cellAttributes() ?>>
<span id="el<?php echo $Finanzas_Archivos_list->RowCnt ?>_Finanzas_Archivos_archivo" class="Finanzas_Archivos_archivo">
<span<?php echo $Finanzas_Archivos->archivo->viewAttributes() ?>>
<?php echo GetFileViewTag($Finanzas_Archivos->archivo, $Finanzas_Archivos->archivo->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($Finanzas_Archivos->fecha->Visible) { // fecha ?>
		<td data-name="fecha"<?php echo $Finanzas_Archivos->fecha->cellAttributes() ?>>
<span id="el<?php echo $Finanzas_Archivos_list->RowCnt ?>_Finanzas_Archivos_fecha" class="Finanzas_Archivos_fecha">
<span<?php echo $Finanzas_Archivos->fecha->viewAttributes() ?>>
<?php echo $Finanzas_Archivos->fecha->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Finanzas_Archivos->Saldo->Visible) { // Saldo ?>
		<td data-name="Saldo"<?php echo $Finanzas_Archivos->Saldo->cellAttributes() ?>>
<span id="el<?php echo $Finanzas_Archivos_list->RowCnt ?>_Finanzas_Archivos_Saldo" class="Finanzas_Archivos_Saldo">
<span<?php echo $Finanzas_Archivos->Saldo->viewAttributes() ?>>
<?php echo $Finanzas_Archivos->Saldo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Finanzas_Archivos->Estado->Visible) { // Estado ?>
		<td data-name="Estado"<?php echo $Finanzas_Archivos->Estado->cellAttributes() ?>>
<span id="el<?php echo $Finanzas_Archivos_list->RowCnt ?>_Finanzas_Archivos_Estado" class="Finanzas_Archivos_Estado">
<span<?php echo $Finanzas_Archivos->Estado->viewAttributes() ?>>
<?php echo $Finanzas_Archivos->Estado->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Finanzas_Archivos_list->ListOptions->render("body", "right", $Finanzas_Archivos_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$Finanzas_Archivos->isGridAdd())
		$Finanzas_Archivos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$Finanzas_Archivos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Finanzas_Archivos_list->Recordset)
	$Finanzas_Archivos_list->Recordset->Close();
?>
<?php if (!$Finanzas_Archivos->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Finanzas_Archivos->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($Finanzas_Archivos_list->Pager)) $Finanzas_Archivos_list->Pager = new NumericPager($Finanzas_Archivos_list->StartRec, $Finanzas_Archivos_list->DisplayRecs, $Finanzas_Archivos_list->TotalRecs, $Finanzas_Archivos_list->RecRange, $Finanzas_Archivos_list->AutoHidePager) ?>
<?php if ($Finanzas_Archivos_list->Pager->RecordCount > 0 && $Finanzas_Archivos_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($Finanzas_Archivos_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Finanzas_Archivos_list->pageUrl() ?>start=<?php echo $Finanzas_Archivos_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($Finanzas_Archivos_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Finanzas_Archivos_list->pageUrl() ?>start=<?php echo $Finanzas_Archivos_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($Finanzas_Archivos_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $Finanzas_Archivos_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($Finanzas_Archivos_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Finanzas_Archivos_list->pageUrl() ?>start=<?php echo $Finanzas_Archivos_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($Finanzas_Archivos_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Finanzas_Archivos_list->pageUrl() ?>start=<?php echo $Finanzas_Archivos_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($Finanzas_Archivos_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $Finanzas_Archivos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $Finanzas_Archivos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $Finanzas_Archivos_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Finanzas_Archivos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Finanzas_Archivos_list->TotalRecs == 0 && !$Finanzas_Archivos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Finanzas_Archivos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Finanzas_Archivos_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$Finanzas_Archivos->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$Finanzas_Archivos_list->terminate();
?>