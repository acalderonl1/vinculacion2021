<?php
namespace PHPMaker2019\LiveBrief;

/**
 * Table class for Live_Brief
 */
class Live_Brief extends DbTable
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
	public $estado;
	public $tipo;
	public $SubTipo;
	public $categoria;
	public $Modalidad;
	public $titulo;
	public $fecha;
	public $descripcion;
	public $observaciones;
	public $carpeta;
	public $Grabar;
	public $fechaGrabacion;
	public $HoraGrabacion;
	public $UsuarioGrabar;
	public $FechaMontaje;
	public $HoraMontaje;
	public $FechaEnsayo;
	public $HoraEnsayo;
	public $FechaMercadeo;
	public $FechaEvento;
	public $HoraEvento;
	public $SalaEvento;
	public $Productor;
	public $procesos;
	public $cod;
	public $flog;
	public $_UserId;
	public $estadisticas;
	public $estadisticas2;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'Live_Brief';
		$this->TableName = 'Live_Brief';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`Live_Brief`";
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
		$this->Id = new DbField('Live_Brief', 'Live_Brief', 'x_Id', 'Id', '`Id`', '`Id`', 3, -1, FALSE, '`Id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->Id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->Id->IsPrimaryKey = TRUE; // Primary key field
		$this->Id->IsForeignKey = TRUE; // Foreign key field
		$this->Id->Sortable = TRUE; // Allow sort
		$this->Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Id'] = &$this->Id;

		// estado
		$this->estado = new DbField('Live_Brief', 'Live_Brief', 'x_estado', 'estado', '`estado`', '`estado`', 3, -1, FALSE, '`estado`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->estado->Required = TRUE; // Required field
		$this->estado->Sortable = TRUE; // Allow sort
		$this->estado->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->estado->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->estado->Lookup = new Lookup('estado', 'Live_Brief', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->estado->OptionCount = 3;
		$this->estado->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['estado'] = &$this->estado;

		// tipo
		$this->tipo = new DbField('Live_Brief', 'Live_Brief', 'x_tipo', 'tipo', '`tipo`', '`tipo`', 3, -1, FALSE, '`tipo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tipo->Required = TRUE; // Required field
		$this->tipo->Sortable = TRUE; // Allow sort
		$this->tipo->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->tipo->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->tipo->Lookup = new Lookup('tipo', 'Live_Brief', FALSE, '', ["","","",""], [], ["x_categoria"], [], [], [], [], '', '');
		$this->tipo->OptionCount = 4;
		$this->tipo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tipo'] = &$this->tipo;

		// SubTipo
		$this->SubTipo = new DbField('Live_Brief', 'Live_Brief', 'x_SubTipo', 'SubTipo', '`SubTipo`', '`SubTipo`', 3, -1, FALSE, '`SubTipo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->SubTipo->Sortable = TRUE; // Allow sort
		$this->SubTipo->Lookup = new Lookup('SubTipo', 'Live_Brief', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->SubTipo->OptionCount = 3;
		$this->SubTipo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SubTipo'] = &$this->SubTipo;

		// categoria
		$this->categoria = new DbField('Live_Brief', 'Live_Brief', 'x_categoria', 'categoria', '`categoria`', '`categoria`', 3, -1, FALSE, '`categoria`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->categoria->Required = TRUE; // Required field
		$this->categoria->Sortable = TRUE; // Allow sort
		$this->categoria->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->categoria->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->categoria->Lookup = new Lookup('categoria', 'Live_Brief_categorias', FALSE, 'Id', ["titulo","","",""], ["x_tipo"], [], ["tipo"], ["x_tipo"], [], [], '', '');
		$this->categoria->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['categoria'] = &$this->categoria;

		// Modalidad
		$this->Modalidad = new DbField('Live_Brief', 'Live_Brief', 'x_Modalidad', 'Modalidad', '`Modalidad`', '`Modalidad`', 3, -1, FALSE, '`Modalidad`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Modalidad->Required = TRUE; // Required field
		$this->Modalidad->Sortable = TRUE; // Allow sort
		$this->Modalidad->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Modalidad->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->Modalidad->Lookup = new Lookup('Modalidad', 'Live_Brief', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->Modalidad->OptionCount = 7;
		$this->Modalidad->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Modalidad'] = &$this->Modalidad;

		// titulo
		$this->titulo = new DbField('Live_Brief', 'Live_Brief', 'x_titulo', 'titulo', '`titulo`', '`titulo`', 200, -1, FALSE, '`titulo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->titulo->Required = TRUE; // Required field
		$this->titulo->Sortable = TRUE; // Allow sort
		$this->fields['titulo'] = &$this->titulo;

		// fecha
		$this->fecha = new DbField('Live_Brief', 'Live_Brief', 'x_fecha', 'fecha', '`fecha`', CastDateFieldForLike('`fecha`', 5, "DB"), 133, 5, FALSE, '`fecha`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fecha->Sortable = TRUE; // Allow sort
		$this->fecha->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateYMD"));
		$this->fields['fecha'] = &$this->fecha;

		// descripcion
		$this->descripcion = new DbField('Live_Brief', 'Live_Brief', 'x_descripcion', 'descripcion', '`descripcion`', '`descripcion`', 201, -1, FALSE, '`descripcion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->descripcion->Required = TRUE; // Required field
		$this->descripcion->Sortable = TRUE; // Allow sort
		$this->fields['descripcion'] = &$this->descripcion;

		// observaciones
		$this->observaciones = new DbField('Live_Brief', 'Live_Brief', 'x_observaciones', 'observaciones', '`observaciones`', '`observaciones`', 201, -1, FALSE, '`observaciones`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->observaciones->Sortable = TRUE; // Allow sort
		$this->fields['observaciones'] = &$this->observaciones;

		// carpeta
		$this->carpeta = new DbField('Live_Brief', 'Live_Brief', 'x_carpeta', 'carpeta', '`carpeta`', '`carpeta`', 3, -1, FALSE, '`carpeta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->carpeta->Required = TRUE; // Required field
		$this->carpeta->Sortable = TRUE; // Allow sort
		$this->carpeta->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->carpeta->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->carpeta->Lookup = new Lookup('carpeta', 'Live_Brief', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->carpeta->OptionCount = 3;
		$this->fields['carpeta'] = &$this->carpeta;

		// Grabar
		$this->Grabar = new DbField('Live_Brief', 'Live_Brief', 'x_Grabar', 'Grabar', '`Grabar`', '`Grabar`', 3, -1, FALSE, '`Grabar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Grabar->Required = TRUE; // Required field
		$this->Grabar->Sortable = TRUE; // Allow sort
		$this->Grabar->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Grabar->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->Grabar->Lookup = new Lookup('Grabar', 'Live_Brief', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->Grabar->OptionCount = 5;
		$this->Grabar->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Grabar'] = &$this->Grabar;

		// fechaGrabacion
		$this->fechaGrabacion = new DbField('Live_Brief', 'Live_Brief', 'x_fechaGrabacion', 'fechaGrabacion', '`fechaGrabacion`', CastDateFieldForLike('`fechaGrabacion`', 5, "DB"), 133, 5, FALSE, '`fechaGrabacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fechaGrabacion->Sortable = TRUE; // Allow sort
		$this->fechaGrabacion->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateYMD"));
		$this->fields['fechaGrabacion'] = &$this->fechaGrabacion;

		// HoraGrabacion
		$this->HoraGrabacion = new DbField('Live_Brief', 'Live_Brief', 'x_HoraGrabacion', 'HoraGrabacion', '`HoraGrabacion`', CastDateFieldForLike('`HoraGrabacion`', 4, "DB"), 134, 4, FALSE, '`HoraGrabacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->HoraGrabacion->Sortable = TRUE; // Allow sort
		$this->HoraGrabacion->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['HoraGrabacion'] = &$this->HoraGrabacion;

		// UsuarioGrabar
		$this->UsuarioGrabar = new DbField('Live_Brief', 'Live_Brief', 'x_UsuarioGrabar', 'UsuarioGrabar', '`UsuarioGrabar`', '`UsuarioGrabar`', 200, -1, FALSE, '`UsuarioGrabar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->UsuarioGrabar->Sortable = TRUE; // Allow sort
		$this->UsuarioGrabar->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->UsuarioGrabar->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->UsuarioGrabar->Lookup = new Lookup('UsuarioGrabar', 'Live_Brief', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->UsuarioGrabar->OptionCount = 4;
		$this->fields['UsuarioGrabar'] = &$this->UsuarioGrabar;

		// FechaMontaje
		$this->FechaMontaje = new DbField('Live_Brief', 'Live_Brief', 'x_FechaMontaje', 'FechaMontaje', '`FechaMontaje`', CastDateFieldForLike('`FechaMontaje`', 0, "DB"), 133, 0, FALSE, '`FechaMontaje`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FechaMontaje->Sortable = TRUE; // Allow sort
		$this->FechaMontaje->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['FechaMontaje'] = &$this->FechaMontaje;

		// HoraMontaje
		$this->HoraMontaje = new DbField('Live_Brief', 'Live_Brief', 'x_HoraMontaje', 'HoraMontaje', '`HoraMontaje`', CastDateFieldForLike('`HoraMontaje`', 4, "DB"), 134, 4, FALSE, '`HoraMontaje`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->HoraMontaje->Sortable = TRUE; // Allow sort
		$this->HoraMontaje->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['HoraMontaje'] = &$this->HoraMontaje;

		// FechaEnsayo
		$this->FechaEnsayo = new DbField('Live_Brief', 'Live_Brief', 'x_FechaEnsayo', 'FechaEnsayo', '`FechaEnsayo`', CastDateFieldForLike('`FechaEnsayo`', 0, "DB"), 133, 0, FALSE, '`FechaEnsayo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FechaEnsayo->Sortable = TRUE; // Allow sort
		$this->FechaEnsayo->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['FechaEnsayo'] = &$this->FechaEnsayo;

		// HoraEnsayo
		$this->HoraEnsayo = new DbField('Live_Brief', 'Live_Brief', 'x_HoraEnsayo', 'HoraEnsayo', '`HoraEnsayo`', CastDateFieldForLike('`HoraEnsayo`', 4, "DB"), 134, 4, FALSE, '`HoraEnsayo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->HoraEnsayo->Sortable = TRUE; // Allow sort
		$this->HoraEnsayo->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['HoraEnsayo'] = &$this->HoraEnsayo;

		// FechaMercadeo
		$this->FechaMercadeo = new DbField('Live_Brief', 'Live_Brief', 'x_FechaMercadeo', 'FechaMercadeo', '`FechaMercadeo`', CastDateFieldForLike('`FechaMercadeo`', 0, "DB"), 133, 0, FALSE, '`FechaMercadeo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FechaMercadeo->Sortable = TRUE; // Allow sort
		$this->FechaMercadeo->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['FechaMercadeo'] = &$this->FechaMercadeo;

		// FechaEvento
		$this->FechaEvento = new DbField('Live_Brief', 'Live_Brief', 'x_FechaEvento', 'FechaEvento', '`FechaEvento`', CastDateFieldForLike('`FechaEvento`', 5, "DB"), 133, 5, FALSE, '`FechaEvento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FechaEvento->Sortable = TRUE; // Allow sort
		$this->FechaEvento->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateYMD"));
		$this->fields['FechaEvento'] = &$this->FechaEvento;

		// HoraEvento
		$this->HoraEvento = new DbField('Live_Brief', 'Live_Brief', 'x_HoraEvento', 'HoraEvento', '`HoraEvento`', CastDateFieldForLike('`HoraEvento`', 4, "DB"), 134, 4, FALSE, '`HoraEvento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->HoraEvento->Sortable = TRUE; // Allow sort
		$this->HoraEvento->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['HoraEvento'] = &$this->HoraEvento;

		// SalaEvento
		$this->SalaEvento = new DbField('Live_Brief', 'Live_Brief', 'x_SalaEvento', 'SalaEvento', '`SalaEvento`', '`SalaEvento`', 3, -1, FALSE, '`SalaEvento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SalaEvento->Sortable = TRUE; // Allow sort
		$this->SalaEvento->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SalaEvento->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->SalaEvento->Lookup = new Lookup('SalaEvento', 'eventos_conf', FALSE, 'Id', ["salas","","",""], [], [], [], [], [], [], '', '');
		$this->SalaEvento->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SalaEvento'] = &$this->SalaEvento;

		// Productor
		$this->Productor = new DbField('Live_Brief', 'Live_Brief', 'x_Productor', 'Productor', '`Productor`', '`Productor`', 3, -1, FALSE, '`Productor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Productor->Required = TRUE; // Required field
		$this->Productor->Sortable = TRUE; // Allow sort
		$this->Productor->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Productor->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->Productor->Lookup = new Lookup('Productor', 'Live_Productor', FALSE, 'Id', ["Nombres","Telefono","",""], [], [], [], [], [], [], '', '');
		$this->Productor->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Productor'] = &$this->Productor;

		// procesos
		$this->procesos = new DbField('Live_Brief', 'Live_Brief', 'x_procesos', 'procesos', '`procesos`', '`procesos`', 200, -1, FALSE, '`procesos`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->procesos->Sortable = TRUE; // Allow sort
		$this->procesos->Lookup = new Lookup('procesos', 'Live_Brief', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->procesos->OptionCount = 3;
		$this->fields['procesos'] = &$this->procesos;

		// cod
		$this->cod = new DbField('Live_Brief', 'Live_Brief', 'x_cod', 'cod', '`cod`', '`cod`', 200, -1, FALSE, '`cod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->cod->Sortable = TRUE; // Allow sort
		$this->fields['cod'] = &$this->cod;

		// flog
		$this->flog = new DbField('Live_Brief', 'Live_Brief', 'x_flog', 'flog', '`flog`', '`flog`', 200, -1, FALSE, '`flog`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->flog->Sortable = TRUE; // Allow sort
		$this->fields['flog'] = &$this->flog;

		// UserId
		$this->_UserId = new DbField('Live_Brief', 'Live_Brief', 'x__UserId', 'UserId', '`UserId`', '`UserId`', 200, -1, FALSE, '`UserId`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->_UserId->Sortable = TRUE; // Allow sort
		$this->fields['UserId'] = &$this->_UserId;

		// estadisticas
		$this->estadisticas = new DbField('Live_Brief', 'Live_Brief', 'x_estadisticas', 'estadisticas', '`estadisticas`', '`estadisticas`', 200, -1, FALSE, '`estadisticas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->estadisticas->Sortable = TRUE; // Allow sort
		$this->fields['estadisticas'] = &$this->estadisticas;

		// estadisticas2
		$this->estadisticas2 = new DbField('Live_Brief', 'Live_Brief', 'x_estadisticas2', 'estadisticas2', '`estadisticas2`', '`estadisticas2`', 200, -1, FALSE, '`estadisticas2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->estadisticas2->Sortable = TRUE; // Allow sort
		$this->fields['estadisticas2'] = &$this->estadisticas2;
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
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`Live_Brief`";
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
		$this->estado->DbValue = $row['estado'];
		$this->tipo->DbValue = $row['tipo'];
		$this->SubTipo->DbValue = $row['SubTipo'];
		$this->categoria->DbValue = $row['categoria'];
		$this->Modalidad->DbValue = $row['Modalidad'];
		$this->titulo->DbValue = $row['titulo'];
		$this->fecha->DbValue = $row['fecha'];
		$this->descripcion->DbValue = $row['descripcion'];
		$this->observaciones->DbValue = $row['observaciones'];
		$this->carpeta->DbValue = $row['carpeta'];
		$this->Grabar->DbValue = $row['Grabar'];
		$this->fechaGrabacion->DbValue = $row['fechaGrabacion'];
		$this->HoraGrabacion->DbValue = $row['HoraGrabacion'];
		$this->UsuarioGrabar->DbValue = $row['UsuarioGrabar'];
		$this->FechaMontaje->DbValue = $row['FechaMontaje'];
		$this->HoraMontaje->DbValue = $row['HoraMontaje'];
		$this->FechaEnsayo->DbValue = $row['FechaEnsayo'];
		$this->HoraEnsayo->DbValue = $row['HoraEnsayo'];
		$this->FechaMercadeo->DbValue = $row['FechaMercadeo'];
		$this->FechaEvento->DbValue = $row['FechaEvento'];
		$this->HoraEvento->DbValue = $row['HoraEvento'];
		$this->SalaEvento->DbValue = $row['SalaEvento'];
		$this->Productor->DbValue = $row['Productor'];
		$this->procesos->DbValue = $row['procesos'];
		$this->cod->DbValue = $row['cod'];
		$this->flog->DbValue = $row['flog'];
		$this->_UserId->DbValue = $row['UserId'];
		$this->estadisticas->DbValue = $row['estadisticas'];
		$this->estadisticas2->DbValue = $row['estadisticas2'];
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
			return "Live_Brieflist.php";
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
		if ($pageName == "Live_Briefview.php")
			return $Language->phrase("View");
		elseif ($pageName == "Live_Briefedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "Live_Briefadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "Live_Brieflist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("Live_Briefview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("Live_Briefview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "Live_Briefadd.php?" . $this->getUrlParm($parm);
		else
			$url = "Live_Briefadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("Live_Briefedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("Live_Briefadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("Live_Briefdelete.php", $this->getUrlParm());
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
		$this->estado->setDbValue($rs->fields('estado'));
		$this->tipo->setDbValue($rs->fields('tipo'));
		$this->SubTipo->setDbValue($rs->fields('SubTipo'));
		$this->categoria->setDbValue($rs->fields('categoria'));
		$this->Modalidad->setDbValue($rs->fields('Modalidad'));
		$this->titulo->setDbValue($rs->fields('titulo'));
		$this->fecha->setDbValue($rs->fields('fecha'));
		$this->descripcion->setDbValue($rs->fields('descripcion'));
		$this->observaciones->setDbValue($rs->fields('observaciones'));
		$this->carpeta->setDbValue($rs->fields('carpeta'));
		$this->Grabar->setDbValue($rs->fields('Grabar'));
		$this->fechaGrabacion->setDbValue($rs->fields('fechaGrabacion'));
		$this->HoraGrabacion->setDbValue($rs->fields('HoraGrabacion'));
		$this->UsuarioGrabar->setDbValue($rs->fields('UsuarioGrabar'));
		$this->FechaMontaje->setDbValue($rs->fields('FechaMontaje'));
		$this->HoraMontaje->setDbValue($rs->fields('HoraMontaje'));
		$this->FechaEnsayo->setDbValue($rs->fields('FechaEnsayo'));
		$this->HoraEnsayo->setDbValue($rs->fields('HoraEnsayo'));
		$this->FechaMercadeo->setDbValue($rs->fields('FechaMercadeo'));
		$this->FechaEvento->setDbValue($rs->fields('FechaEvento'));
		$this->HoraEvento->setDbValue($rs->fields('HoraEvento'));
		$this->SalaEvento->setDbValue($rs->fields('SalaEvento'));
		$this->Productor->setDbValue($rs->fields('Productor'));
		$this->procesos->setDbValue($rs->fields('procesos'));
		$this->cod->setDbValue($rs->fields('cod'));
		$this->flog->setDbValue($rs->fields('flog'));
		$this->_UserId->setDbValue($rs->fields('UserId'));
		$this->estadisticas->setDbValue($rs->fields('estadisticas'));
		$this->estadisticas2->setDbValue($rs->fields('estadisticas2'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// Id
		// estado
		// tipo
		// SubTipo
		// categoria
		// Modalidad
		// titulo
		// fecha
		// descripcion
		// observaciones
		// carpeta
		// Grabar
		// fechaGrabacion
		// HoraGrabacion
		// UsuarioGrabar
		// FechaMontaje
		// HoraMontaje
		// FechaEnsayo
		// HoraEnsayo
		// FechaMercadeo
		// FechaEvento
		// HoraEvento
		// SalaEvento
		// Productor
		// procesos
		// cod
		// flog
		// UserId
		// estadisticas
		// estadisticas2
		// Id

		$this->Id->ViewValue = $this->Id->CurrentValue;
		$this->Id->ViewCustomAttributes = "";

		// estado
		if (strval($this->estado->CurrentValue) <> "") {
			$this->estado->ViewValue = $this->estado->optionCaption($this->estado->CurrentValue);
		} else {
			$this->estado->ViewValue = NULL;
		}
		$this->estado->ViewCustomAttributes = "";

		// tipo
		if (strval($this->tipo->CurrentValue) <> "") {
			$this->tipo->ViewValue = $this->tipo->optionCaption($this->tipo->CurrentValue);
		} else {
			$this->tipo->ViewValue = NULL;
		}
		$this->tipo->ViewCustomAttributes = "";

		// SubTipo
		if (strval($this->SubTipo->CurrentValue) <> "") {
			$this->SubTipo->ViewValue = $this->SubTipo->optionCaption($this->SubTipo->CurrentValue);
		} else {
			$this->SubTipo->ViewValue = NULL;
		}
		$this->SubTipo->ViewCustomAttributes = "";

		// categoria
		$curVal = strval($this->categoria->CurrentValue);
		if ($curVal <> "") {
			$this->categoria->ViewValue = $this->categoria->lookupCacheOption($curVal);
			if ($this->categoria->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->categoria->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$this->categoria->ViewValue = $this->categoria->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->categoria->ViewValue = $this->categoria->CurrentValue;
				}
			}
		} else {
			$this->categoria->ViewValue = NULL;
		}
		$this->categoria->ViewCustomAttributes = "";

		// Modalidad
		if (strval($this->Modalidad->CurrentValue) <> "") {
			$this->Modalidad->ViewValue = $this->Modalidad->optionCaption($this->Modalidad->CurrentValue);
		} else {
			$this->Modalidad->ViewValue = NULL;
		}
		$this->Modalidad->ViewCustomAttributes = "";

		// titulo
		$this->titulo->ViewValue = $this->titulo->CurrentValue;
		$this->titulo->ViewCustomAttributes = "";

		// fecha
		$this->fecha->ViewValue = $this->fecha->CurrentValue;
		$this->fecha->ViewValue = FormatDateTime($this->fecha->ViewValue, 5);
		$this->fecha->ViewCustomAttributes = "";

		// descripcion
		$this->descripcion->ViewValue = $this->descripcion->CurrentValue;
		$this->descripcion->ViewCustomAttributes = "";

		// observaciones
		$this->observaciones->ViewValue = $this->observaciones->CurrentValue;
		$this->observaciones->ViewCustomAttributes = "";

		// carpeta
		if (strval($this->carpeta->CurrentValue) <> "") {
			$this->carpeta->ViewValue = $this->carpeta->optionCaption($this->carpeta->CurrentValue);
		} else {
			$this->carpeta->ViewValue = NULL;
		}
		$this->carpeta->ViewCustomAttributes = "";

		// Grabar
		if (strval($this->Grabar->CurrentValue) <> "") {
			$this->Grabar->ViewValue = $this->Grabar->optionCaption($this->Grabar->CurrentValue);
		} else {
			$this->Grabar->ViewValue = NULL;
		}
		$this->Grabar->ViewCustomAttributes = "";

		// fechaGrabacion
		$this->fechaGrabacion->ViewValue = $this->fechaGrabacion->CurrentValue;
		$this->fechaGrabacion->ViewValue = FormatDateTime($this->fechaGrabacion->ViewValue, 5);
		$this->fechaGrabacion->ViewCustomAttributes = "";

		// HoraGrabacion
		$this->HoraGrabacion->ViewValue = $this->HoraGrabacion->CurrentValue;
		$this->HoraGrabacion->ViewValue = FormatDateTime($this->HoraGrabacion->ViewValue, 4);
		$this->HoraGrabacion->ViewCustomAttributes = "";

		// UsuarioGrabar
		if (strval($this->UsuarioGrabar->CurrentValue) <> "") {
			$this->UsuarioGrabar->ViewValue = $this->UsuarioGrabar->optionCaption($this->UsuarioGrabar->CurrentValue);
		} else {
			$this->UsuarioGrabar->ViewValue = NULL;
		}
		$this->UsuarioGrabar->ViewCustomAttributes = "";

		// FechaMontaje
		$this->FechaMontaje->ViewValue = $this->FechaMontaje->CurrentValue;
		$this->FechaMontaje->ViewValue = FormatDateTime($this->FechaMontaje->ViewValue, 0);
		$this->FechaMontaje->ViewCustomAttributes = "";

		// HoraMontaje
		$this->HoraMontaje->ViewValue = $this->HoraMontaje->CurrentValue;
		$this->HoraMontaje->ViewValue = FormatDateTime($this->HoraMontaje->ViewValue, 4);
		$this->HoraMontaje->ViewCustomAttributes = "";

		// FechaEnsayo
		$this->FechaEnsayo->ViewValue = $this->FechaEnsayo->CurrentValue;
		$this->FechaEnsayo->ViewValue = FormatDateTime($this->FechaEnsayo->ViewValue, 0);
		$this->FechaEnsayo->ViewCustomAttributes = "";

		// HoraEnsayo
		$this->HoraEnsayo->ViewValue = $this->HoraEnsayo->CurrentValue;
		$this->HoraEnsayo->ViewValue = FormatDateTime($this->HoraEnsayo->ViewValue, 4);
		$this->HoraEnsayo->ViewCustomAttributes = "";

		// FechaMercadeo
		$this->FechaMercadeo->ViewValue = $this->FechaMercadeo->CurrentValue;
		$this->FechaMercadeo->ViewValue = FormatDateTime($this->FechaMercadeo->ViewValue, 0);
		$this->FechaMercadeo->ViewCustomAttributes = "";

		// FechaEvento
		$this->FechaEvento->ViewValue = $this->FechaEvento->CurrentValue;
		$this->FechaEvento->ViewValue = FormatDateTime($this->FechaEvento->ViewValue, 5);
		$this->FechaEvento->ViewCustomAttributes = "";

		// HoraEvento
		$this->HoraEvento->ViewValue = $this->HoraEvento->CurrentValue;
		$this->HoraEvento->ViewValue = FormatDateTime($this->HoraEvento->ViewValue, 4);
		$this->HoraEvento->ViewCustomAttributes = "";

		// SalaEvento
		$curVal = strval($this->SalaEvento->CurrentValue);
		if ($curVal <> "") {
			$this->SalaEvento->ViewValue = $this->SalaEvento->lookupCacheOption($curVal);
			if ($this->SalaEvento->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`salas`!=''";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->SalaEvento->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$this->SalaEvento->ViewValue = $this->SalaEvento->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->SalaEvento->ViewValue = $this->SalaEvento->CurrentValue;
				}
			}
		} else {
			$this->SalaEvento->ViewValue = NULL;
		}
		$this->SalaEvento->ViewCustomAttributes = "";

		// Productor
		$curVal = strval($this->Productor->CurrentValue);
		if ($curVal <> "") {
			$this->Productor->ViewValue = $this->Productor->lookupCacheOption($curVal);
			if ($this->Productor->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Productor->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->Productor->ViewValue = $this->Productor->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Productor->ViewValue = $this->Productor->CurrentValue;
				}
			}
		} else {
			$this->Productor->ViewValue = NULL;
		}
		$this->Productor->ViewCustomAttributes = "";

		// procesos
		if (strval($this->procesos->CurrentValue) <> "") {
			$this->procesos->ViewValue = new OptionValues();
			$arwrk = explode(",", strval($this->procesos->CurrentValue));
			$cnt = count($arwrk);
			for ($ari = 0; $ari < $cnt; $ari++)
				$this->procesos->ViewValue->add($this->procesos->optionCaption(trim($arwrk[$ari])));
		} else {
			$this->procesos->ViewValue = NULL;
		}
		$this->procesos->ViewCustomAttributes = "";

		// cod
		$this->cod->ViewValue = $this->cod->CurrentValue;
		$this->cod->ViewCustomAttributes = "";

		// flog
		$this->flog->ViewValue = $this->flog->CurrentValue;
		$this->flog->ViewCustomAttributes = "";

		// UserId
		$this->_UserId->ViewValue = $this->_UserId->CurrentValue;
		$this->_UserId->ViewCustomAttributes = "";

		// estadisticas
		$this->estadisticas->ViewValue = $this->estadisticas->CurrentValue;
		$this->estadisticas->ViewCustomAttributes = "";

		// estadisticas2
		$this->estadisticas2->ViewValue = $this->estadisticas2->CurrentValue;
		$this->estadisticas2->ViewCustomAttributes = "";

		// Id
		$this->Id->LinkCustomAttributes = "";
		$this->Id->HrefValue = "";
		$this->Id->TooltipValue = "";

		// estado
		$this->estado->LinkCustomAttributes = "";
		$this->estado->HrefValue = "";
		$this->estado->TooltipValue = "";

		// tipo
		$this->tipo->LinkCustomAttributes = "";
		$this->tipo->HrefValue = "";
		$this->tipo->TooltipValue = "";

		// SubTipo
		$this->SubTipo->LinkCustomAttributes = "";
		$this->SubTipo->HrefValue = "";
		$this->SubTipo->TooltipValue = "";

		// categoria
		$this->categoria->LinkCustomAttributes = "";
		$this->categoria->HrefValue = "";
		$this->categoria->TooltipValue = "";

		// Modalidad
		$this->Modalidad->LinkCustomAttributes = "";
		$this->Modalidad->HrefValue = "";
		$this->Modalidad->TooltipValue = "";

		// titulo
		$this->titulo->LinkCustomAttributes = "";
		$this->titulo->HrefValue = "";
		$this->titulo->TooltipValue = "";

		// fecha
		$this->fecha->LinkCustomAttributes = "";
		$this->fecha->HrefValue = "";
		$this->fecha->TooltipValue = "";

		// descripcion
		$this->descripcion->LinkCustomAttributes = "";
		$this->descripcion->HrefValue = "";
		$this->descripcion->TooltipValue = "";

		// observaciones
		$this->observaciones->LinkCustomAttributes = "";
		$this->observaciones->HrefValue = "";
		$this->observaciones->TooltipValue = "";

		// carpeta
		$this->carpeta->LinkCustomAttributes = "";
		$this->carpeta->HrefValue = "";
		$this->carpeta->TooltipValue = "";

		// Grabar
		$this->Grabar->LinkCustomAttributes = "";
		$this->Grabar->HrefValue = "";
		$this->Grabar->TooltipValue = "";

		// fechaGrabacion
		$this->fechaGrabacion->LinkCustomAttributes = "";
		$this->fechaGrabacion->HrefValue = "";
		$this->fechaGrabacion->TooltipValue = "";

		// HoraGrabacion
		$this->HoraGrabacion->LinkCustomAttributes = "";
		$this->HoraGrabacion->HrefValue = "";
		$this->HoraGrabacion->TooltipValue = "";

		// UsuarioGrabar
		$this->UsuarioGrabar->LinkCustomAttributes = "";
		$this->UsuarioGrabar->HrefValue = "";
		$this->UsuarioGrabar->TooltipValue = "";

		// FechaMontaje
		$this->FechaMontaje->LinkCustomAttributes = "";
		$this->FechaMontaje->HrefValue = "";
		$this->FechaMontaje->TooltipValue = "";

		// HoraMontaje
		$this->HoraMontaje->LinkCustomAttributes = "";
		$this->HoraMontaje->HrefValue = "";
		$this->HoraMontaje->TooltipValue = "";

		// FechaEnsayo
		$this->FechaEnsayo->LinkCustomAttributes = "";
		$this->FechaEnsayo->HrefValue = "";
		$this->FechaEnsayo->TooltipValue = "";

		// HoraEnsayo
		$this->HoraEnsayo->LinkCustomAttributes = "";
		$this->HoraEnsayo->HrefValue = "";
		$this->HoraEnsayo->TooltipValue = "";

		// FechaMercadeo
		$this->FechaMercadeo->LinkCustomAttributes = "";
		$this->FechaMercadeo->HrefValue = "";
		$this->FechaMercadeo->TooltipValue = "";

		// FechaEvento
		$this->FechaEvento->LinkCustomAttributes = "";
		$this->FechaEvento->HrefValue = "";
		$this->FechaEvento->TooltipValue = "";

		// HoraEvento
		$this->HoraEvento->LinkCustomAttributes = "";
		$this->HoraEvento->HrefValue = "";
		$this->HoraEvento->TooltipValue = "";

		// SalaEvento
		$this->SalaEvento->LinkCustomAttributes = "";
		$this->SalaEvento->HrefValue = "";
		$this->SalaEvento->TooltipValue = "";

		// Productor
		$this->Productor->LinkCustomAttributes = "";
		$this->Productor->HrefValue = "";
		$this->Productor->TooltipValue = "";

		// procesos
		$this->procesos->LinkCustomAttributes = "";
		$this->procesos->HrefValue = "";
		$this->procesos->TooltipValue = "";

		// cod
		$this->cod->LinkCustomAttributes = "";
		$this->cod->HrefValue = "";
		$this->cod->TooltipValue = "";

		// flog
		$this->flog->LinkCustomAttributes = "";
		$this->flog->HrefValue = "";
		$this->flog->TooltipValue = "";

		// UserId
		$this->_UserId->LinkCustomAttributes = "";
		$this->_UserId->HrefValue = "";
		$this->_UserId->TooltipValue = "";

		// estadisticas
		$this->estadisticas->LinkCustomAttributes = "";
		$this->estadisticas->HrefValue = "";
		$this->estadisticas->TooltipValue = "";

		// estadisticas2
		$this->estadisticas2->LinkCustomAttributes = "";
		$this->estadisticas2->HrefValue = "";
		$this->estadisticas2->TooltipValue = "";

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

		// estado
		$this->estado->EditAttrs["class"] = "form-control";
		$this->estado->EditCustomAttributes = "";
		$this->estado->EditValue = $this->estado->options(TRUE);

		// tipo
		$this->tipo->EditAttrs["class"] = "form-control";
		$this->tipo->EditCustomAttributes = "";
		$this->tipo->EditValue = $this->tipo->options(TRUE);

		// SubTipo
		$this->SubTipo->EditCustomAttributes = "";
		$this->SubTipo->EditValue = $this->SubTipo->options(FALSE);

		// categoria
		$this->categoria->EditAttrs["class"] = "form-control";
		$this->categoria->EditCustomAttributes = "";

		// Modalidad
		$this->Modalidad->EditAttrs["class"] = "form-control";
		$this->Modalidad->EditCustomAttributes = "";
		$this->Modalidad->EditValue = $this->Modalidad->options(TRUE);

		// titulo
		$this->titulo->EditAttrs["class"] = "form-control";
		$this->titulo->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->titulo->CurrentValue = HtmlDecode($this->titulo->CurrentValue);
		$this->titulo->EditValue = $this->titulo->CurrentValue;
		$this->titulo->PlaceHolder = RemoveHtml($this->titulo->caption());

		// fecha
		$this->fecha->EditAttrs["class"] = "form-control";
		$this->fecha->EditCustomAttributes = "";
		$this->fecha->EditValue = FormatDateTime($this->fecha->CurrentValue, 5);
		$this->fecha->PlaceHolder = RemoveHtml($this->fecha->caption());

		// descripcion
		$this->descripcion->EditAttrs["class"] = "form-control";
		$this->descripcion->EditCustomAttributes = "";
		$this->descripcion->EditValue = $this->descripcion->CurrentValue;
		$this->descripcion->PlaceHolder = RemoveHtml($this->descripcion->caption());

		// observaciones
		$this->observaciones->EditAttrs["class"] = "form-control";
		$this->observaciones->EditCustomAttributes = "";
		$this->observaciones->EditValue = $this->observaciones->CurrentValue;
		$this->observaciones->PlaceHolder = RemoveHtml($this->observaciones->caption());

		// carpeta
		$this->carpeta->EditAttrs["class"] = "form-control";
		$this->carpeta->EditCustomAttributes = "";
		$this->carpeta->EditValue = $this->carpeta->options(TRUE);

		// Grabar
		$this->Grabar->EditAttrs["class"] = "form-control";
		$this->Grabar->EditCustomAttributes = "";
		$this->Grabar->EditValue = $this->Grabar->options(TRUE);

		// fechaGrabacion
		$this->fechaGrabacion->EditAttrs["class"] = "form-control";
		$this->fechaGrabacion->EditCustomAttributes = "";
		$this->fechaGrabacion->EditValue = FormatDateTime($this->fechaGrabacion->CurrentValue, 5);
		$this->fechaGrabacion->PlaceHolder = RemoveHtml($this->fechaGrabacion->caption());

		// HoraGrabacion
		$this->HoraGrabacion->EditAttrs["class"] = "form-control";
		$this->HoraGrabacion->EditCustomAttributes = "";
		$this->HoraGrabacion->EditValue = $this->HoraGrabacion->CurrentValue;
		$this->HoraGrabacion->PlaceHolder = RemoveHtml($this->HoraGrabacion->caption());

		// UsuarioGrabar
		$this->UsuarioGrabar->EditAttrs["class"] = "form-control";
		$this->UsuarioGrabar->EditCustomAttributes = "";
		$this->UsuarioGrabar->EditValue = $this->UsuarioGrabar->options(TRUE);

		// FechaMontaje
		$this->FechaMontaje->EditAttrs["class"] = "form-control";
		$this->FechaMontaje->EditCustomAttributes = "";
		$this->FechaMontaje->EditValue = FormatDateTime($this->FechaMontaje->CurrentValue, 8);
		$this->FechaMontaje->PlaceHolder = RemoveHtml($this->FechaMontaje->caption());

		// HoraMontaje
		$this->HoraMontaje->EditAttrs["class"] = "form-control";
		$this->HoraMontaje->EditCustomAttributes = "";
		$this->HoraMontaje->EditValue = $this->HoraMontaje->CurrentValue;
		$this->HoraMontaje->PlaceHolder = RemoveHtml($this->HoraMontaje->caption());

		// FechaEnsayo
		$this->FechaEnsayo->EditAttrs["class"] = "form-control";
		$this->FechaEnsayo->EditCustomAttributes = "";
		$this->FechaEnsayo->EditValue = FormatDateTime($this->FechaEnsayo->CurrentValue, 8);
		$this->FechaEnsayo->PlaceHolder = RemoveHtml($this->FechaEnsayo->caption());

		// HoraEnsayo
		$this->HoraEnsayo->EditAttrs["class"] = "form-control";
		$this->HoraEnsayo->EditCustomAttributes = "";
		$this->HoraEnsayo->EditValue = $this->HoraEnsayo->CurrentValue;
		$this->HoraEnsayo->PlaceHolder = RemoveHtml($this->HoraEnsayo->caption());

		// FechaMercadeo
		$this->FechaMercadeo->EditAttrs["class"] = "form-control";
		$this->FechaMercadeo->EditCustomAttributes = "";
		$this->FechaMercadeo->EditValue = FormatDateTime($this->FechaMercadeo->CurrentValue, 8);
		$this->FechaMercadeo->PlaceHolder = RemoveHtml($this->FechaMercadeo->caption());

		// FechaEvento
		$this->FechaEvento->EditAttrs["class"] = "form-control";
		$this->FechaEvento->EditCustomAttributes = "";
		$this->FechaEvento->EditValue = FormatDateTime($this->FechaEvento->CurrentValue, 5);
		$this->FechaEvento->PlaceHolder = RemoveHtml($this->FechaEvento->caption());

		// HoraEvento
		$this->HoraEvento->EditAttrs["class"] = "form-control";
		$this->HoraEvento->EditCustomAttributes = "";
		$this->HoraEvento->EditValue = $this->HoraEvento->CurrentValue;
		$this->HoraEvento->PlaceHolder = RemoveHtml($this->HoraEvento->caption());

		// SalaEvento
		$this->SalaEvento->EditAttrs["class"] = "form-control";
		$this->SalaEvento->EditCustomAttributes = "";

		// Productor
		$this->Productor->EditAttrs["class"] = "form-control";
		$this->Productor->EditCustomAttributes = "";

		// procesos
		$this->procesos->EditCustomAttributes = "";
		$this->procesos->EditValue = $this->procesos->options(FALSE);

		// cod
		// flog
		// UserId
		// estadisticas

		$this->estadisticas->EditAttrs["class"] = "form-control";
		$this->estadisticas->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->estadisticas->CurrentValue = HtmlDecode($this->estadisticas->CurrentValue);
		$this->estadisticas->EditValue = $this->estadisticas->CurrentValue;
		$this->estadisticas->PlaceHolder = RemoveHtml($this->estadisticas->caption());

		// estadisticas2
		$this->estadisticas2->EditAttrs["class"] = "form-control";
		$this->estadisticas2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->estadisticas2->CurrentValue = HtmlDecode($this->estadisticas2->CurrentValue);
		$this->estadisticas2->EditValue = $this->estadisticas2->CurrentValue;
		$this->estadisticas2->PlaceHolder = RemoveHtml($this->estadisticas2->caption());

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
					$doc->exportCaption($this->estado);
					$doc->exportCaption($this->Modalidad);
					$doc->exportCaption($this->titulo);
					$doc->exportCaption($this->descripcion);
					$doc->exportCaption($this->observaciones);
					$doc->exportCaption($this->carpeta);
					$doc->exportCaption($this->Grabar);
					$doc->exportCaption($this->UsuarioGrabar);
					$doc->exportCaption($this->SalaEvento);
					$doc->exportCaption($this->procesos);
					$doc->exportCaption($this->estadisticas);
					$doc->exportCaption($this->estadisticas2);
				} else {
					$doc->exportCaption($this->Id);
					$doc->exportCaption($this->estado);
					$doc->exportCaption($this->tipo);
					$doc->exportCaption($this->SubTipo);
					$doc->exportCaption($this->categoria);
					$doc->exportCaption($this->Modalidad);
					$doc->exportCaption($this->titulo);
					$doc->exportCaption($this->fecha);
					$doc->exportCaption($this->carpeta);
					$doc->exportCaption($this->Grabar);
					$doc->exportCaption($this->fechaGrabacion);
					$doc->exportCaption($this->HoraGrabacion);
					$doc->exportCaption($this->UsuarioGrabar);
					$doc->exportCaption($this->FechaMontaje);
					$doc->exportCaption($this->HoraMontaje);
					$doc->exportCaption($this->FechaEnsayo);
					$doc->exportCaption($this->HoraEnsayo);
					$doc->exportCaption($this->FechaMercadeo);
					$doc->exportCaption($this->FechaEvento);
					$doc->exportCaption($this->HoraEvento);
					$doc->exportCaption($this->SalaEvento);
					$doc->exportCaption($this->Productor);
					$doc->exportCaption($this->procesos);
					$doc->exportCaption($this->cod);
					$doc->exportCaption($this->flog);
					$doc->exportCaption($this->_UserId);
					$doc->exportCaption($this->estadisticas);
					$doc->exportCaption($this->estadisticas2);
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
						$doc->exportField($this->estado);
						$doc->exportField($this->Modalidad);
						$doc->exportField($this->titulo);
						$doc->exportField($this->descripcion);
						$doc->exportField($this->observaciones);
						$doc->exportField($this->carpeta);
						$doc->exportField($this->Grabar);
						$doc->exportField($this->UsuarioGrabar);
						$doc->exportField($this->SalaEvento);
						$doc->exportField($this->procesos);
						$doc->exportField($this->estadisticas);
						$doc->exportField($this->estadisticas2);
					} else {
						$doc->exportField($this->Id);
						$doc->exportField($this->estado);
						$doc->exportField($this->tipo);
						$doc->exportField($this->SubTipo);
						$doc->exportField($this->categoria);
						$doc->exportField($this->Modalidad);
						$doc->exportField($this->titulo);
						$doc->exportField($this->fecha);
						$doc->exportField($this->carpeta);
						$doc->exportField($this->Grabar);
						$doc->exportField($this->fechaGrabacion);
						$doc->exportField($this->HoraGrabacion);
						$doc->exportField($this->UsuarioGrabar);
						$doc->exportField($this->FechaMontaje);
						$doc->exportField($this->HoraMontaje);
						$doc->exportField($this->FechaEnsayo);
						$doc->exportField($this->HoraEnsayo);
						$doc->exportField($this->FechaMercadeo);
						$doc->exportField($this->FechaEvento);
						$doc->exportField($this->HoraEvento);
						$doc->exportField($this->SalaEvento);
						$doc->exportField($this->Productor);
						$doc->exportField($this->procesos);
						$doc->exportField($this->cod);
						$doc->exportField($this->flog);
						$doc->exportField($this->_UserId);
						$doc->exportField($this->estadisticas);
						$doc->exportField($this->estadisticas2);
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