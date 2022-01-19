<?php
namespace PHPMaker2019\LiveBrief;

/**
 * Table class for Live_Brief_Post
 */
class Live_Brief_Post extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $Id;
	public $tipo;
	public $tipoEvento;
	public $CategoriaEvento;
	public $evento;
	public $imagen;
	public $__post;
	public $fecha;
	public $captura;
	public $urlIG;
	public $urlFB;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'Live_Brief_Post';
		$this->TableName = 'Live_Brief_Post';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`Live_Brief_Post`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// Id
		$this->Id = new DbField('Live_Brief_Post', 'Live_Brief_Post', 'x_Id', 'Id', '`Id`', '`Id`', 3, -1, FALSE, '`Id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->Id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->Id->IsPrimaryKey = TRUE; // Primary key field
		$this->Id->Sortable = TRUE; // Allow sort
		$this->Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Id'] = &$this->Id;

		// tipo
		$this->tipo = new DbField('Live_Brief_Post', 'Live_Brief_Post', 'x_tipo', 'tipo', '`tipo`', '`tipo`', 3, -1, FALSE, '`tipo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tipo->Sortable = TRUE; // Allow sort
		$this->tipo->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->tipo->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->tipo->Lookup = new Lookup('tipo', 'Live_Brief_Post', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->tipo->OptionCount = 2;
		$this->tipo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tipo'] = &$this->tipo;

		// tipoEvento
		$this->tipoEvento = new DbField('Live_Brief_Post', 'Live_Brief_Post', 'x_tipoEvento', 'tipoEvento', '`tipoEvento`', '`tipoEvento`', 3, -1, FALSE, '`tipoEvento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tipoEvento->Sortable = TRUE; // Allow sort
		$this->tipoEvento->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->tipoEvento->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->tipoEvento->Lookup = new Lookup('tipoEvento', 'Live_Brief_Post', FALSE, '', ["","","",""], [], ["x_CategoriaEvento","x_evento"], [], [], [], [], '', '');
		$this->tipoEvento->OptionCount = 6;
		$this->tipoEvento->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tipoEvento'] = &$this->tipoEvento;

		// CategoriaEvento
		$this->CategoriaEvento = new DbField('Live_Brief_Post', 'Live_Brief_Post', 'x_CategoriaEvento', 'CategoriaEvento', '`CategoriaEvento`', '`CategoriaEvento`', 3, -1, FALSE, '`CategoriaEvento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->CategoriaEvento->Sortable = TRUE; // Allow sort
		$this->CategoriaEvento->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->CategoriaEvento->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->CategoriaEvento->Lookup = new Lookup('CategoriaEvento', 'Live_Brief_categorias', FALSE, 'Id', ["titulo","","",""], ["x_tipoEvento"], ["x_evento"], ["tipo"], ["x_tipo"], [], [], '', '');
		$this->CategoriaEvento->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['CategoriaEvento'] = &$this->CategoriaEvento;

		// evento
		$this->evento = new DbField('Live_Brief_Post', 'Live_Brief_Post', 'x_evento', 'evento', '`evento`', '`evento`', 3, -1, FALSE, '`evento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->evento->Sortable = TRUE; // Allow sort
		$this->evento->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->evento->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->evento->Lookup = new Lookup('evento', 'Live_Brief', FALSE, 'Id', ["fecha","titulo","",""], ["x_tipoEvento","x_CategoriaEvento"], [], ["tipo","categoria"], ["x_tipo","x_categoria"], [], [], '`fecha` DESC', '');
		$this->evento->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['evento'] = &$this->evento;

		// imagen
		$this->imagen = new DbField('Live_Brief_Post', 'Live_Brief_Post', 'x_imagen', 'imagen', '`imagen`', '`imagen`', 200, -1, TRUE, '`imagen`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->imagen->Sortable = TRUE; // Allow sort
		$this->fields['imagen'] = &$this->imagen;

		// post
		$this->__post = new DbField('Live_Brief_Post', 'Live_Brief_Post', 'x___post', 'post', '`post`', '`post`', 201, -1, FALSE, '`post`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->__post->Sortable = TRUE; // Allow sort
		$this->fields['post'] = &$this->__post;

		// fecha
		$this->fecha = new DbField('Live_Brief_Post', 'Live_Brief_Post', 'x_fecha', 'fecha', '`fecha`', CastDateFieldForLike('`fecha`', 5, "DB"), 133, 5, FALSE, '`fecha`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fecha->Sortable = TRUE; // Allow sort
		$this->fecha->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateYMD"));
		$this->fields['fecha'] = &$this->fecha;

		// captura
		$this->captura = new DbField('Live_Brief_Post', 'Live_Brief_Post', 'x_captura', 'captura', '`captura`', '`captura`', 200, -1, TRUE, '`captura`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->captura->Sortable = TRUE; // Allow sort
		$this->fields['captura'] = &$this->captura;

		// urlIG
		$this->urlIG = new DbField('Live_Brief_Post', 'Live_Brief_Post', 'x_urlIG', 'urlIG', '`urlIG`', '`urlIG`', 201, -1, FALSE, '`urlIG`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->urlIG->Sortable = TRUE; // Allow sort
		$this->fields['urlIG'] = &$this->urlIG;

		// urlFB
		$this->urlFB = new DbField('Live_Brief_Post', 'Live_Brief_Post', 'x_urlFB', 'urlFB', '`urlFB`', '`urlFB`', 201, -1, FALSE, '`urlFB`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->urlFB->Sortable = TRUE; // Allow sort
		$this->fields['urlFB'] = &$this->urlFB;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`Live_Brief_Post`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect <> "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere <> "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy <> "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving <> "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "`Id` DESC";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->Id->setDbValue($conn->insert_ID());
			$rs['Id'] = $this->Id->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsPrimaryKey)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('Id', $rs))
				AddFilter($where, QuotedName('Id', $this->Dbid) . '=' . QuotedValue($rs['Id'], $this->Id->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = &$this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->Id->DbValue = $row['Id'];
		$this->tipo->DbValue = $row['tipo'];
		$this->tipoEvento->DbValue = $row['tipoEvento'];
		$this->CategoriaEvento->DbValue = $row['CategoriaEvento'];
		$this->evento->DbValue = $row['evento'];
		$this->imagen->Upload->DbValue = $row['imagen'];
		$this->__post->DbValue = $row['post'];
		$this->fecha->DbValue = $row['fecha'];
		$this->captura->Upload->DbValue = $row['captura'];
		$this->urlIG->DbValue = $row['urlIG'];
		$this->urlFB->DbValue = $row['urlFB'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$this->imagen->OldUploadPath = '../../data/images/';
		$oldFiles = EmptyValue($row['imagen']) ? [] : [$row['imagen']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->imagen->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->imagen->oldPhysicalUploadPath() . $oldFile);
		}
		$this->captura->OldUploadPath = '../../data/images/';
		$oldFiles = EmptyValue($row['captura']) ? [] : [$row['captura']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->captura->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->captura->oldPhysicalUploadPath() . $oldFile);
		}
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`Id` = @Id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('Id', $row) ? $row['Id'] : NULL) : $this->Id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@Id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") <> "" && ReferPageName() <> CurrentPageName() && ReferPageName() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "Live_Brief_Postlist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "Live_Brief_Postview.php")
			return $Language->phrase("View");
		elseif ($pageName == "Live_Brief_Postedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "Live_Brief_Postadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "Live_Brief_Postlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("Live_Brief_Postview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("Live_Brief_Postview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "Live_Brief_Postadd.php?" . $this->getUrlParm($parm);
		else
			$url = "Live_Brief_Postadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("Live_Brief_Postedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("Live_Brief_Postadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("Live_Brief_Postdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "Id:" . JsonEncode($this->Id->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm <> "")
			$url .= $parm . "&";
		if ($this->Id->CurrentValue != NULL) {
			$url .= "Id=" . urlencode($this->Id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("Id") !== NULL)
				$arKeys[] = Param("Id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys()
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter <> "") $keyFilter .= " OR ";
			$this->Id->CurrentValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = &$this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->Id->setDbValue($rs->fields('Id'));
		$this->tipo->setDbValue($rs->fields('tipo'));
		$this->tipoEvento->setDbValue($rs->fields('tipoEvento'));
		$this->CategoriaEvento->setDbValue($rs->fields('CategoriaEvento'));
		$this->evento->setDbValue($rs->fields('evento'));
		$this->imagen->Upload->DbValue = $rs->fields('imagen');
		$this->__post->setDbValue($rs->fields('post'));
		$this->fecha->setDbValue($rs->fields('fecha'));
		$this->captura->Upload->DbValue = $rs->fields('captura');
		$this->urlIG->setDbValue($rs->fields('urlIG'));
		$this->urlFB->setDbValue($rs->fields('urlFB'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// Id
		// tipo
		// tipoEvento
		// CategoriaEvento
		// evento
		// imagen
		// post
		// fecha
		// captura
		// urlIG
		// urlFB
		// Id

		$this->Id->ViewValue = $this->Id->CurrentValue;
		$this->Id->ViewCustomAttributes = "";

		// tipo
		if (strval($this->tipo->CurrentValue) <> "") {
			$this->tipo->ViewValue = $this->tipo->optionCaption($this->tipo->CurrentValue);
		} else {
			$this->tipo->ViewValue = NULL;
		}
		$this->tipo->ViewCustomAttributes = "";

		// tipoEvento
		if (strval($this->tipoEvento->CurrentValue) <> "") {
			$this->tipoEvento->ViewValue = $this->tipoEvento->optionCaption($this->tipoEvento->CurrentValue);
		} else {
			$this->tipoEvento->ViewValue = NULL;
		}
		$this->tipoEvento->ViewCustomAttributes = "";

		// CategoriaEvento
		$curVal = strval($this->CategoriaEvento->CurrentValue);
		if ($curVal <> "") {
			$this->CategoriaEvento->ViewValue = $this->CategoriaEvento->lookupCacheOption($curVal);
			if ($this->CategoriaEvento->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->CategoriaEvento->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$this->CategoriaEvento->ViewValue = $this->CategoriaEvento->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->CategoriaEvento->ViewValue = $this->CategoriaEvento->CurrentValue;
				}
			}
		} else {
			$this->CategoriaEvento->ViewValue = NULL;
		}
		$this->CategoriaEvento->ViewCustomAttributes = "";

		// evento
		$curVal = strval($this->evento->CurrentValue);
		if ($curVal <> "") {
			$this->evento->ViewValue = $this->evento->lookupCacheOption($curVal);
			if ($this->evento->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->evento->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = FormatDateTime($rswrk->fields('df'), 5);
					$arwrk[2] = $rswrk->fields('df2');
					$this->evento->ViewValue = $this->evento->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->evento->ViewValue = $this->evento->CurrentValue;
				}
			}
		} else {
			$this->evento->ViewValue = NULL;
		}
		$this->evento->ViewCustomAttributes = "";

		// imagen
		$this->imagen->UploadPath = '../../data/images/';
		if (!EmptyValue($this->imagen->Upload->DbValue)) {
			$this->imagen->ImageWidth = 0;
			$this->imagen->ImageHeight = 120;
			$this->imagen->ImageAlt = $this->imagen->alt();
			$this->imagen->ViewValue = $this->imagen->Upload->DbValue;
		} else {
			$this->imagen->ViewValue = "";
		}
		$this->imagen->ViewCustomAttributes = "";

		// post
		$this->__post->ViewValue = $this->__post->CurrentValue;
		$this->__post->ViewCustomAttributes = "";

		// fecha
		$this->fecha->ViewValue = $this->fecha->CurrentValue;
		$this->fecha->ViewValue = FormatDateTime($this->fecha->ViewValue, 5);
		$this->fecha->ViewCustomAttributes = "";

		// captura
		$this->captura->UploadPath = '../../data/images/';
		if (!EmptyValue($this->captura->Upload->DbValue)) {
			$this->captura->ImageWidth = 0;
			$this->captura->ImageHeight = 200;
			$this->captura->ImageAlt = $this->captura->alt();
			$this->captura->ViewValue = $this->captura->Upload->DbValue;
		} else {
			$this->captura->ViewValue = "";
		}
		$this->captura->ViewCustomAttributes = "";

		// urlIG
		$this->urlIG->ViewValue = $this->urlIG->CurrentValue;
		$this->urlIG->ViewCustomAttributes = "";

		// urlFB
		$this->urlFB->ViewValue = $this->urlFB->CurrentValue;
		$this->urlFB->ViewCustomAttributes = "";

		// Id
		$this->Id->LinkCustomAttributes = "";
		$this->Id->HrefValue = "";
		$this->Id->TooltipValue = "";

		// tipo
		$this->tipo->LinkCustomAttributes = "";
		$this->tipo->HrefValue = "";
		$this->tipo->TooltipValue = "";

		// tipoEvento
		$this->tipoEvento->LinkCustomAttributes = "";
		$this->tipoEvento->HrefValue = "";
		$this->tipoEvento->TooltipValue = "";

		// CategoriaEvento
		$this->CategoriaEvento->LinkCustomAttributes = "";
		$this->CategoriaEvento->HrefValue = "";
		$this->CategoriaEvento->TooltipValue = "";

		// evento
		$this->evento->LinkCustomAttributes = "";
		$this->evento->HrefValue = "";
		$this->evento->TooltipValue = "";

		// imagen
		$this->imagen->LinkCustomAttributes = "";
		$this->imagen->UploadPath = '../../data/images/';
		if (!EmptyValue($this->imagen->Upload->DbValue)) {
			$this->imagen->HrefValue = GetFileUploadUrl($this->imagen, $this->imagen->Upload->DbValue); // Add prefix/suffix
			$this->imagen->LinkAttrs["target"] = ""; // Add target
			if ($this->isExport()) $this->imagen->HrefValue = FullUrl($this->imagen->HrefValue, "href");
		} else {
			$this->imagen->HrefValue = "";
		}
		$this->imagen->ExportHrefValue = $this->imagen->UploadPath . $this->imagen->Upload->DbValue;
		$this->imagen->TooltipValue = "";
		if ($this->imagen->UseColorbox) {
			if (EmptyValue($this->imagen->TooltipValue))
				$this->imagen->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
			$this->imagen->LinkAttrs["data-rel"] = "Live_Brief_Post_x_imagen";
			AppendClass($this->imagen->LinkAttrs["class"], "ew-lightbox");
		}

		// post
		$this->__post->LinkCustomAttributes = "";
		$this->__post->HrefValue = "";
		$this->__post->TooltipValue = "";

		// fecha
		$this->fecha->LinkCustomAttributes = "";
		$this->fecha->HrefValue = "";
		$this->fecha->TooltipValue = "";

		// captura
		$this->captura->LinkCustomAttributes = "";
		$this->captura->UploadPath = '../../data/images/';
		if (!EmptyValue($this->captura->Upload->DbValue)) {
			$this->captura->HrefValue = GetFileUploadUrl($this->captura, $this->captura->Upload->DbValue); // Add prefix/suffix
			$this->captura->LinkAttrs["target"] = ""; // Add target
			if ($this->isExport()) $this->captura->HrefValue = FullUrl($this->captura->HrefValue, "href");
		} else {
			$this->captura->HrefValue = "";
		}
		$this->captura->ExportHrefValue = $this->captura->UploadPath . $this->captura->Upload->DbValue;
		$this->captura->TooltipValue = "";
		if ($this->captura->UseColorbox) {
			if (EmptyValue($this->captura->TooltipValue))
				$this->captura->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
			$this->captura->LinkAttrs["data-rel"] = "Live_Brief_Post_x_captura";
			AppendClass($this->captura->LinkAttrs["class"], "ew-lightbox");
		}

		// urlIG
		$this->urlIG->LinkCustomAttributes = "";
		$this->urlIG->HrefValue = "";
		$this->urlIG->TooltipValue = "";

		// urlFB
		$this->urlFB->LinkCustomAttributes = "";
		$this->urlFB->HrefValue = "";
		$this->urlFB->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Id
		$this->Id->EditAttrs["class"] = "form-control";
		$this->Id->EditCustomAttributes = "";
		$this->Id->EditValue = $this->Id->CurrentValue;
		$this->Id->ViewCustomAttributes = "";

		// tipo
		$this->tipo->EditAttrs["class"] = "form-control";
		$this->tipo->EditCustomAttributes = "";
		$this->tipo->EditValue = $this->tipo->options(TRUE);

		// tipoEvento
		$this->tipoEvento->EditAttrs["class"] = "form-control";
		$this->tipoEvento->EditCustomAttributes = "";
		$this->tipoEvento->EditValue = $this->tipoEvento->options(TRUE);

		// CategoriaEvento
		$this->CategoriaEvento->EditAttrs["class"] = "form-control";
		$this->CategoriaEvento->EditCustomAttributes = "";

		// evento
		$this->evento->EditAttrs["class"] = "form-control";
		$this->evento->EditCustomAttributes = "";

		// imagen
		$this->imagen->EditAttrs["class"] = "form-control";
		$this->imagen->EditCustomAttributes = "";
		$this->imagen->UploadPath = '../../data/images/';
		if (!EmptyValue($this->imagen->Upload->DbValue)) {
			$this->imagen->ImageWidth = 0;
			$this->imagen->ImageHeight = 120;
			$this->imagen->ImageAlt = $this->imagen->alt();
			$this->imagen->EditValue = $this->imagen->Upload->DbValue;
		} else {
			$this->imagen->EditValue = "";
		}
		if (!EmptyValue($this->imagen->CurrentValue))
				$this->imagen->Upload->FileName = $this->imagen->CurrentValue;

		// post
		$this->__post->EditAttrs["class"] = "form-control";
		$this->__post->EditCustomAttributes = "";
		$this->__post->EditValue = $this->__post->CurrentValue;
		$this->__post->PlaceHolder = RemoveHtml($this->__post->caption());

		// fecha
		$this->fecha->EditAttrs["class"] = "form-control";
		$this->fecha->EditCustomAttributes = "";
		$this->fecha->EditValue = FormatDateTime($this->fecha->CurrentValue, 5);
		$this->fecha->PlaceHolder = RemoveHtml($this->fecha->caption());

		// captura
		$this->captura->EditAttrs["class"] = "form-control";
		$this->captura->EditCustomAttributes = "";
		$this->captura->UploadPath = '../../data/images/';
		if (!EmptyValue($this->captura->Upload->DbValue)) {
			$this->captura->ImageWidth = 0;
			$this->captura->ImageHeight = 200;
			$this->captura->ImageAlt = $this->captura->alt();
			$this->captura->EditValue = $this->captura->Upload->DbValue;
		} else {
			$this->captura->EditValue = "";
		}
		if (!EmptyValue($this->captura->CurrentValue))
				$this->captura->Upload->FileName = $this->captura->CurrentValue;

		// urlIG
		$this->urlIG->EditAttrs["class"] = "form-control";
		$this->urlIG->EditCustomAttributes = "";
		$this->urlIG->EditValue = $this->urlIG->CurrentValue;
		$this->urlIG->PlaceHolder = RemoveHtml($this->urlIG->caption());

		// urlFB
		$this->urlFB->EditAttrs["class"] = "form-control";
		$this->urlFB->EditCustomAttributes = "";
		$this->urlFB->EditValue = $this->urlFB->CurrentValue;
		$this->urlFB->PlaceHolder = RemoveHtml($this->urlFB->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->Id);
					$doc->exportCaption($this->tipo);
					$doc->exportCaption($this->tipoEvento);
					$doc->exportCaption($this->CategoriaEvento);
					$doc->exportCaption($this->evento);
					$doc->exportCaption($this->imagen);
					$doc->exportCaption($this->__post);
					$doc->exportCaption($this->fecha);
					$doc->exportCaption($this->captura);
					$doc->exportCaption($this->urlIG);
					$doc->exportCaption($this->urlFB);
				} else {
					$doc->exportCaption($this->Id);
					$doc->exportCaption($this->tipo);
					$doc->exportCaption($this->tipoEvento);
					$doc->exportCaption($this->CategoriaEvento);
					$doc->exportCaption($this->evento);
					$doc->exportCaption($this->imagen);
					$doc->exportCaption($this->fecha);
					$doc->exportCaption($this->captura);
					$doc->exportCaption($this->urlIG);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->Id);
						$doc->exportField($this->tipo);
						$doc->exportField($this->tipoEvento);
						$doc->exportField($this->CategoriaEvento);
						$doc->exportField($this->evento);
						$doc->exportField($this->imagen);
						$doc->exportField($this->__post);
						$doc->exportField($this->fecha);
						$doc->exportField($this->captura);
						$doc->exportField($this->urlIG);
						$doc->exportField($this->urlFB);
					} else {
						$doc->exportField($this->Id);
						$doc->exportField($this->tipo);
						$doc->exportField($this->tipoEvento);
						$doc->exportField($this->CategoriaEvento);
						$doc->exportField($this->evento);
						$doc->exportField($this->imagen);
						$doc->exportField($this->fecha);
						$doc->exportField($this->captura);
						$doc->exportField($this->urlIG);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Lookup data from table
	public function lookup()
	{
		global $Language, $LANGUAGE_FOLDER, $PROJECT_ID;
		if (!isset($Language))
			$Language = new Language($LANGUAGE_FOLDER, Post("language", ""));
		global $Security, $RequestSecurity;

		// Check token first
		$func = PROJECT_NAMESPACE . "CheckToken";
		$validRequest = FALSE;
		if (is_callable($func) && Post(TOKEN_NAME) !== NULL) {
			$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			if ($validRequest) {
				if (!isset($Security)) {
					if (session_status() !== PHP_SESSION_ACTIVE)
						session_start(); // Init session data
					$Security = new AdvancedSecurity();
					$validRequest = $Security->isLoggedIn(); // Logged in
				}
			}
		} else {

			// User profile
			$UserProfile = new UserProfile();

			// Security
			$Security = new AdvancedSecurity();
			if (is_array($RequestSecurity)) // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
			$validRequest = $Security->isLoggedIn(); // Logged in
		}

		// Reject invalid request
		if (!$validRequest)
			return FALSE;

		// Load lookup parameters
		$distinct = ConvertToBool(Post("distinct"));
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterFieldVars = Post("filterFieldVars");
		if (!is_array($filterFieldVars))
			$filterFieldVars = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");

		// Selected records from modal, skip parent/filter fields and show all records
		if ($keys !== NULL) {
			$parentFields = [];
			$filterFields = [];
			$filterFieldVars = [];
			$offset = 0;
			$pageSize = 0;
		}

		// Create lookup object and output JSON
		$lookup = new Lookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $filterFieldVars, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(LOOKUP_FILTER_VALUE_SEPARATOR, $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{
		global $COMPOSITE_KEY_SEPARATOR;

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'imagen') {
			$fldName = "imagen";
			$fileNameFld = "imagen";
		} elseif ($fldparm == 'captura') {
			$fldName = "captura";
			$fileNameFld = "captura";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode($COMPOSITE_KEY_SEPARATOR, $key);
		if (count($ar) == 1) {
			$this->Id->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype <> "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld <> "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						AddHeader("Content-type", ContentType($val));
					}

					// Write file name
					if ($fileNameFld <> "" && !EmptyValue($rs->fields($fileNameFld)))
						AddHeader("Content-Disposition", "attachment; filename=\"" . $rs->fields($fileNameFld) . "\"");

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0", $val)) // Not ends with 3 or 4 \0
							$val .= "\0\0\0\0";
					}

					// Clear output buffer
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>