<?php
namespace PHPMaker2019\LiveBrief;

/**
 * Table class for eventos_conf
 */
class eventos_conf extends DbTable
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
	public $genero;
	public $tipo;
	public $salas;
	public $clasificacion;
	public $auspiciantes;
	public $canalventa;
	public $comision;
	public $tipoclasi;
	public $estados;
	public $testado;
	public $redespromos;
	public $categoria;
	public $auspcategoria;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'eventos_conf';
		$this->TableName = 'eventos_conf';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`eventos_conf`";
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
		$this->Id = new DbField('eventos_conf', 'eventos_conf', 'x_Id', 'Id', '`Id`', '`Id`', 3, -1, FALSE, '`Id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->Id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->Id->IsPrimaryKey = TRUE; // Primary key field
		$this->Id->Sortable = TRUE; // Allow sort
		$this->Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Id'] = &$this->Id;

		// genero
		$this->genero = new DbField('eventos_conf', 'eventos_conf', 'x_genero', 'genero', '`genero`', '`genero`', 200, -1, FALSE, '`genero`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->genero->Sortable = TRUE; // Allow sort
		$this->fields['genero'] = &$this->genero;

		// tipo
		$this->tipo = new DbField('eventos_conf', 'eventos_conf', 'x_tipo', 'tipo', '`tipo`', '`tipo`', 200, -1, FALSE, '`tipo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tipo->Sortable = TRUE; // Allow sort
		$this->fields['tipo'] = &$this->tipo;

		// salas
		$this->salas = new DbField('eventos_conf', 'eventos_conf', 'x_salas', 'salas', '`salas`', '`salas`', 200, -1, FALSE, '`salas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->salas->Sortable = TRUE; // Allow sort
		$this->fields['salas'] = &$this->salas;

		// clasificacion
		$this->clasificacion = new DbField('eventos_conf', 'eventos_conf', 'x_clasificacion', 'clasificacion', '`clasificacion`', '`clasificacion`', 200, -1, FALSE, '`clasificacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->clasificacion->Sortable = TRUE; // Allow sort
		$this->fields['clasificacion'] = &$this->clasificacion;

		// auspiciantes
		$this->auspiciantes = new DbField('eventos_conf', 'eventos_conf', 'x_auspiciantes', 'auspiciantes', '`auspiciantes`', '`auspiciantes`', 200, -1, FALSE, '`auspiciantes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->auspiciantes->Sortable = TRUE; // Allow sort
		$this->fields['auspiciantes'] = &$this->auspiciantes;

		// canalventa
		$this->canalventa = new DbField('eventos_conf', 'eventos_conf', 'x_canalventa', 'canalventa', '`canalventa`', '`canalventa`', 200, -1, FALSE, '`canalventa`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->canalventa->Sortable = TRUE; // Allow sort
		$this->fields['canalventa'] = &$this->canalventa;

		// comision
		$this->comision = new DbField('eventos_conf', 'eventos_conf', 'x_comision', 'comision', '`comision`', '`comision`', 200, -1, FALSE, '`comision`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->comision->Sortable = TRUE; // Allow sort
		$this->fields['comision'] = &$this->comision;

		// tipoclasi
		$this->tipoclasi = new DbField('eventos_conf', 'eventos_conf', 'x_tipoclasi', 'tipoclasi', '`tipoclasi`', '`tipoclasi`', 200, -1, FALSE, '`tipoclasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tipoclasi->Sortable = TRUE; // Allow sort
		$this->fields['tipoclasi'] = &$this->tipoclasi;

		// estados
		$this->estados = new DbField('eventos_conf', 'eventos_conf', 'x_estados', 'estados', '`estados`', '`estados`', 200, -1, FALSE, '`estados`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->estados->Sortable = TRUE; // Allow sort
		$this->fields['estados'] = &$this->estados;

		// testado
		$this->testado = new DbField('eventos_conf', 'eventos_conf', 'x_testado', 'testado', '`testado`', '`testado`', 3, -1, FALSE, '`testado`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->testado->Sortable = TRUE; // Allow sort
		$this->testado->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['testado'] = &$this->testado;

		// redespromos
		$this->redespromos = new DbField('eventos_conf', 'eventos_conf', 'x_redespromos', 'redespromos', '`redespromos`', '`redespromos`', 200, -1, FALSE, '`redespromos`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->redespromos->Sortable = TRUE; // Allow sort
		$this->fields['redespromos'] = &$this->redespromos;

		// categoria
		$this->categoria = new DbField('eventos_conf', 'eventos_conf', 'x_categoria', 'categoria', '`categoria`', '`categoria`', 200, -1, FALSE, '`categoria`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->categoria->Sortable = TRUE; // Allow sort
		$this->fields['categoria'] = &$this->categoria;

		// auspcategoria
		$this->auspcategoria = new DbField('eventos_conf', 'eventos_conf', 'x_auspcategoria', 'auspcategoria', '`auspcategoria`', '`auspcategoria`', 201, -1, FALSE, '`auspcategoria`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->auspcategoria->Sortable = TRUE; // Allow sort
		$this->fields['auspcategoria'] = &$this->auspcategoria;
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
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`eventos_conf`";
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
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "";
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
		$this->genero->DbValue = $row['genero'];
		$this->tipo->DbValue = $row['tipo'];
		$this->salas->DbValue = $row['salas'];
		$this->clasificacion->DbValue = $row['clasificacion'];
		$this->auspiciantes->DbValue = $row['auspiciantes'];
		$this->canalventa->DbValue = $row['canalventa'];
		$this->comision->DbValue = $row['comision'];
		$this->tipoclasi->DbValue = $row['tipoclasi'];
		$this->estados->DbValue = $row['estados'];
		$this->testado->DbValue = $row['testado'];
		$this->redespromos->DbValue = $row['redespromos'];
		$this->categoria->DbValue = $row['categoria'];
		$this->auspcategoria->DbValue = $row['auspcategoria'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
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
			return "eventos_conflist.php";
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
		if ($pageName == "eventos_confview.php")
			return $Language->phrase("View");
		elseif ($pageName == "eventos_confedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "eventos_confadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "eventos_conflist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("eventos_confview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("eventos_confview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "eventos_confadd.php?" . $this->getUrlParm($parm);
		else
			$url = "eventos_confadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("eventos_confedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("eventos_confadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("eventos_confdelete.php", $this->getUrlParm());
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
		$this->genero->setDbValue($rs->fields('genero'));
		$this->tipo->setDbValue($rs->fields('tipo'));
		$this->salas->setDbValue($rs->fields('salas'));
		$this->clasificacion->setDbValue($rs->fields('clasificacion'));
		$this->auspiciantes->setDbValue($rs->fields('auspiciantes'));
		$this->canalventa->setDbValue($rs->fields('canalventa'));
		$this->comision->setDbValue($rs->fields('comision'));
		$this->tipoclasi->setDbValue($rs->fields('tipoclasi'));
		$this->estados->setDbValue($rs->fields('estados'));
		$this->testado->setDbValue($rs->fields('testado'));
		$this->redespromos->setDbValue($rs->fields('redespromos'));
		$this->categoria->setDbValue($rs->fields('categoria'));
		$this->auspcategoria->setDbValue($rs->fields('auspcategoria'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// Id
		// genero
		// tipo
		// salas
		// clasificacion
		// auspiciantes
		// canalventa
		// comision
		// tipoclasi
		// estados
		// testado
		// redespromos
		// categoria
		// auspcategoria
		// Id

		$this->Id->ViewValue = $this->Id->CurrentValue;
		$this->Id->ViewCustomAttributes = "";

		// genero
		$this->genero->ViewValue = $this->genero->CurrentValue;
		$this->genero->ViewCustomAttributes = "";

		// tipo
		$this->tipo->ViewValue = $this->tipo->CurrentValue;
		$this->tipo->ViewCustomAttributes = "";

		// salas
		$this->salas->ViewValue = $this->salas->CurrentValue;
		$this->salas->ViewCustomAttributes = "";

		// clasificacion
		$this->clasificacion->ViewValue = $this->clasificacion->CurrentValue;
		$this->clasificacion->ViewCustomAttributes = "";

		// auspiciantes
		$this->auspiciantes->ViewValue = $this->auspiciantes->CurrentValue;
		$this->auspiciantes->ViewCustomAttributes = "";

		// canalventa
		$this->canalventa->ViewValue = $this->canalventa->CurrentValue;
		$this->canalventa->ViewCustomAttributes = "";

		// comision
		$this->comision->ViewValue = $this->comision->CurrentValue;
		$this->comision->ViewCustomAttributes = "";

		// tipoclasi
		$this->tipoclasi->ViewValue = $this->tipoclasi->CurrentValue;
		$this->tipoclasi->ViewCustomAttributes = "";

		// estados
		$this->estados->ViewValue = $this->estados->CurrentValue;
		$this->estados->ViewCustomAttributes = "";

		// testado
		$this->testado->ViewValue = $this->testado->CurrentValue;
		$this->testado->ViewValue = FormatNumber($this->testado->ViewValue, 0, -2, -2, -2);
		$this->testado->ViewCustomAttributes = "";

		// redespromos
		$this->redespromos->ViewValue = $this->redespromos->CurrentValue;
		$this->redespromos->ViewCustomAttributes = "";

		// categoria
		$this->categoria->ViewValue = $this->categoria->CurrentValue;
		$this->categoria->ViewCustomAttributes = "";

		// auspcategoria
		$this->auspcategoria->ViewValue = $this->auspcategoria->CurrentValue;
		$this->auspcategoria->ViewCustomAttributes = "";

		// Id
		$this->Id->LinkCustomAttributes = "";
		$this->Id->HrefValue = "";
		$this->Id->TooltipValue = "";

		// genero
		$this->genero->LinkCustomAttributes = "";
		$this->genero->HrefValue = "";
		$this->genero->TooltipValue = "";

		// tipo
		$this->tipo->LinkCustomAttributes = "";
		$this->tipo->HrefValue = "";
		$this->tipo->TooltipValue = "";

		// salas
		$this->salas->LinkCustomAttributes = "";
		$this->salas->HrefValue = "";
		$this->salas->TooltipValue = "";

		// clasificacion
		$this->clasificacion->LinkCustomAttributes = "";
		$this->clasificacion->HrefValue = "";
		$this->clasificacion->TooltipValue = "";

		// auspiciantes
		$this->auspiciantes->LinkCustomAttributes = "";
		$this->auspiciantes->HrefValue = "";
		$this->auspiciantes->TooltipValue = "";

		// canalventa
		$this->canalventa->LinkCustomAttributes = "";
		$this->canalventa->HrefValue = "";
		$this->canalventa->TooltipValue = "";

		// comision
		$this->comision->LinkCustomAttributes = "";
		$this->comision->HrefValue = "";
		$this->comision->TooltipValue = "";

		// tipoclasi
		$this->tipoclasi->LinkCustomAttributes = "";
		$this->tipoclasi->HrefValue = "";
		$this->tipoclasi->TooltipValue = "";

		// estados
		$this->estados->LinkCustomAttributes = "";
		$this->estados->HrefValue = "";
		$this->estados->TooltipValue = "";

		// testado
		$this->testado->LinkCustomAttributes = "";
		$this->testado->HrefValue = "";
		$this->testado->TooltipValue = "";

		// redespromos
		$this->redespromos->LinkCustomAttributes = "";
		$this->redespromos->HrefValue = "";
		$this->redespromos->TooltipValue = "";

		// categoria
		$this->categoria->LinkCustomAttributes = "";
		$this->categoria->HrefValue = "";
		$this->categoria->TooltipValue = "";

		// auspcategoria
		$this->auspcategoria->LinkCustomAttributes = "";
		$this->auspcategoria->HrefValue = "";
		$this->auspcategoria->TooltipValue = "";

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

		// genero
		$this->genero->EditAttrs["class"] = "form-control";
		$this->genero->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->genero->CurrentValue = HtmlDecode($this->genero->CurrentValue);
		$this->genero->EditValue = $this->genero->CurrentValue;
		$this->genero->PlaceHolder = RemoveHtml($this->genero->caption());

		// tipo
		$this->tipo->EditAttrs["class"] = "form-control";
		$this->tipo->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->tipo->CurrentValue = HtmlDecode($this->tipo->CurrentValue);
		$this->tipo->EditValue = $this->tipo->CurrentValue;
		$this->tipo->PlaceHolder = RemoveHtml($this->tipo->caption());

		// salas
		$this->salas->EditAttrs["class"] = "form-control";
		$this->salas->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->salas->CurrentValue = HtmlDecode($this->salas->CurrentValue);
		$this->salas->EditValue = $this->salas->CurrentValue;
		$this->salas->PlaceHolder = RemoveHtml($this->salas->caption());

		// clasificacion
		$this->clasificacion->EditAttrs["class"] = "form-control";
		$this->clasificacion->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->clasificacion->CurrentValue = HtmlDecode($this->clasificacion->CurrentValue);
		$this->clasificacion->EditValue = $this->clasificacion->CurrentValue;
		$this->clasificacion->PlaceHolder = RemoveHtml($this->clasificacion->caption());

		// auspiciantes
		$this->auspiciantes->EditAttrs["class"] = "form-control";
		$this->auspiciantes->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->auspiciantes->CurrentValue = HtmlDecode($this->auspiciantes->CurrentValue);
		$this->auspiciantes->EditValue = $this->auspiciantes->CurrentValue;
		$this->auspiciantes->PlaceHolder = RemoveHtml($this->auspiciantes->caption());

		// canalventa
		$this->canalventa->EditAttrs["class"] = "form-control";
		$this->canalventa->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->canalventa->CurrentValue = HtmlDecode($this->canalventa->CurrentValue);
		$this->canalventa->EditValue = $this->canalventa->CurrentValue;
		$this->canalventa->PlaceHolder = RemoveHtml($this->canalventa->caption());

		// comision
		$this->comision->EditAttrs["class"] = "form-control";
		$this->comision->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->comision->CurrentValue = HtmlDecode($this->comision->CurrentValue);
		$this->comision->EditValue = $this->comision->CurrentValue;
		$this->comision->PlaceHolder = RemoveHtml($this->comision->caption());

		// tipoclasi
		$this->tipoclasi->EditAttrs["class"] = "form-control";
		$this->tipoclasi->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->tipoclasi->CurrentValue = HtmlDecode($this->tipoclasi->CurrentValue);
		$this->tipoclasi->EditValue = $this->tipoclasi->CurrentValue;
		$this->tipoclasi->PlaceHolder = RemoveHtml($this->tipoclasi->caption());

		// estados
		$this->estados->EditAttrs["class"] = "form-control";
		$this->estados->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->estados->CurrentValue = HtmlDecode($this->estados->CurrentValue);
		$this->estados->EditValue = $this->estados->CurrentValue;
		$this->estados->PlaceHolder = RemoveHtml($this->estados->caption());

		// testado
		$this->testado->EditAttrs["class"] = "form-control";
		$this->testado->EditCustomAttributes = "";
		$this->testado->EditValue = $this->testado->CurrentValue;
		$this->testado->PlaceHolder = RemoveHtml($this->testado->caption());

		// redespromos
		$this->redespromos->EditAttrs["class"] = "form-control";
		$this->redespromos->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->redespromos->CurrentValue = HtmlDecode($this->redespromos->CurrentValue);
		$this->redespromos->EditValue = $this->redespromos->CurrentValue;
		$this->redespromos->PlaceHolder = RemoveHtml($this->redespromos->caption());

		// categoria
		$this->categoria->EditAttrs["class"] = "form-control";
		$this->categoria->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->categoria->CurrentValue = HtmlDecode($this->categoria->CurrentValue);
		$this->categoria->EditValue = $this->categoria->CurrentValue;
		$this->categoria->PlaceHolder = RemoveHtml($this->categoria->caption());

		// auspcategoria
		$this->auspcategoria->EditAttrs["class"] = "form-control";
		$this->auspcategoria->EditCustomAttributes = "";
		$this->auspcategoria->EditValue = $this->auspcategoria->CurrentValue;
		$this->auspcategoria->PlaceHolder = RemoveHtml($this->auspcategoria->caption());

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
					$doc->exportCaption($this->genero);
					$doc->exportCaption($this->tipo);
					$doc->exportCaption($this->salas);
					$doc->exportCaption($this->clasificacion);
					$doc->exportCaption($this->auspiciantes);
					$doc->exportCaption($this->canalventa);
					$doc->exportCaption($this->comision);
					$doc->exportCaption($this->tipoclasi);
					$doc->exportCaption($this->estados);
					$doc->exportCaption($this->testado);
					$doc->exportCaption($this->redespromos);
					$doc->exportCaption($this->categoria);
					$doc->exportCaption($this->auspcategoria);
				} else {
					$doc->exportCaption($this->Id);
					$doc->exportCaption($this->genero);
					$doc->exportCaption($this->tipo);
					$doc->exportCaption($this->salas);
					$doc->exportCaption($this->clasificacion);
					$doc->exportCaption($this->auspiciantes);
					$doc->exportCaption($this->canalventa);
					$doc->exportCaption($this->comision);
					$doc->exportCaption($this->tipoclasi);
					$doc->exportCaption($this->estados);
					$doc->exportCaption($this->testado);
					$doc->exportCaption($this->redespromos);
					$doc->exportCaption($this->categoria);
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
						$doc->exportField($this->genero);
						$doc->exportField($this->tipo);
						$doc->exportField($this->salas);
						$doc->exportField($this->clasificacion);
						$doc->exportField($this->auspiciantes);
						$doc->exportField($this->canalventa);
						$doc->exportField($this->comision);
						$doc->exportField($this->tipoclasi);
						$doc->exportField($this->estados);
						$doc->exportField($this->testado);
						$doc->exportField($this->redespromos);
						$doc->exportField($this->categoria);
						$doc->exportField($this->auspcategoria);
					} else {
						$doc->exportField($this->Id);
						$doc->exportField($this->genero);
						$doc->exportField($this->tipo);
						$doc->exportField($this->salas);
						$doc->exportField($this->clasificacion);
						$doc->exportField($this->auspiciantes);
						$doc->exportField($this->canalventa);
						$doc->exportField($this->comision);
						$doc->exportField($this->tipoclasi);
						$doc->exportField($this->estados);
						$doc->exportField($this->testado);
						$doc->exportField($this->redespromos);
						$doc->exportField($this->categoria);
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

		// No binary fields
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