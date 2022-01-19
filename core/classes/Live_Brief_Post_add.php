<?php
namespace PHPMaker2019\LiveBrief;

/**
 * Page class
 */
class Live_Brief_Post_add extends Live_Brief_Post
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E325E099-3A39-45D1-AB29-9A0F13A19286}";

	// Table name
	public $TableName = 'Live_Brief_Post';

	// Page object name
	public $PageObjName = "Live_Brief_Post_add";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken = CHECK_TOKEN;

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Page URL
	private $_pageUrl = "";

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		if ($this->_pageUrl == "") {
			$this->_pageUrl = CurrentPageName() . "?";
			if ($this->UseTokenInUrl)
				$this->_pageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		}
		return $this->_pageUrl;
	}

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message <> "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fa fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fa fa-warning"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage <> "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fa fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fa fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = array();

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message <> "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage <> "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage <> "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage <> "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header <> "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer <> "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(TOKEN_NAME) === NULL)
			return FALSE;
		$fn = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
		if (is_callable($fn))
			return $fn(Post(TOKEN_NAME), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = PROJECT_NAMESPACE . CREATE_TOKEN_FUNC; // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $COMPOSITE_KEY_SEPARATOR;
		global $UserTable, $UserTableConn;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (Live_Brief_Post)
		if (!isset($GLOBALS["Live_Brief_Post"]) || get_class($GLOBALS["Live_Brief_Post"]) == PROJECT_NAMESPACE . "Live_Brief_Post") {
			$GLOBALS["Live_Brief_Post"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Live_Brief_Post"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (usuario)
		if (!isset($GLOBALS['usuario']))
			$GLOBALS['usuario'] = new usuario();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'Live_Brief_Post');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = &$this->getConnection();

		// User table object (usuario)
		if (!isset($UserTable)) {
			$UserTable = new usuario();
			$UserTableConn = Conn($UserTable->Dbid);
		}
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EXPORT, $Live_Brief_Post;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($Live_Brief_Post);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url <> "") {
			if (!DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "Live_Brief_Postview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = array();
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = array();
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {

								//$url = FullUrl($fld->TableVar . "/" . API_FILE_ACTION . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))); // URL rewrite format
								$url = FullUrl(GetPageName(API_URL) . "?" . API_OBJECT_NAME . "=" . $fld->TableVar . "&" . API_ACTION_NAME . "=" . API_FILE_ACTION . "&" . API_FIELD_NAME . "=" . $fld->Param . "&" . API_KEY_NAME . "=" . rawurlencode($this->getRecordKeyValue($ar))); // Query string format
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, MULTIPLE_UPLOAD_SEPARATOR)) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['Id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->Id->Visible = FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRec;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		$Security = new AdvancedSecurity();
		$validRequest = FALSE;

		// Check security for API request
		If (IsApi()) {

			// Check token first
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Post(TOKEN_NAME) !== NULL)
				$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			elseif (is_array($RequestSecurity) && @$RequestSecurity["username"] <> "") // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
		}
		if (!$validRequest) {
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("Live_Brief_Postlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->Id->Visible = FALSE;
		$this->tipo->setVisibility();
		$this->tipoEvento->setVisibility();
		$this->CategoriaEvento->setVisibility();
		$this->evento->setVisibility();
		$this->imagen->setVisibility();
		$this->__post->setVisibility();
		$this->fecha->setVisibility();
		$this->captura->setVisibility();
		$this->urlIG->setVisibility();
		$this->urlFB->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->CategoriaEvento);
		$this->setupLookupOptions($this->evento);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("Id") !== NULL) {
				$this->Id->setQueryStringValue(Get("Id"));
				$this->setKey("Id", $this->Id->CurrentValue); // Set up key
			} else {
				$this->setKey("Id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("Live_Brief_Postlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->GetViewUrl();
					if (GetPageName($returnUrl) == "Live_Brief_Postlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "Live_Brief_Postview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
		$this->imagen->Upload->Index = $CurrentForm->Index;
		$this->imagen->Upload->uploadFile();
		$this->imagen->CurrentValue = $this->imagen->Upload->FileName;
		$this->captura->Upload->Index = $CurrentForm->Index;
		$this->captura->Upload->uploadFile();
		$this->captura->CurrentValue = $this->captura->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->Id->CurrentValue = NULL;
		$this->Id->OldValue = $this->Id->CurrentValue;
		$this->tipo->CurrentValue = NULL;
		$this->tipo->OldValue = $this->tipo->CurrentValue;
		$this->tipoEvento->CurrentValue = NULL;
		$this->tipoEvento->OldValue = $this->tipoEvento->CurrentValue;
		$this->CategoriaEvento->CurrentValue = NULL;
		$this->CategoriaEvento->OldValue = $this->CategoriaEvento->CurrentValue;
		$this->evento->CurrentValue = NULL;
		$this->evento->OldValue = $this->evento->CurrentValue;
		$this->imagen->Upload->DbValue = NULL;
		$this->imagen->OldValue = $this->imagen->Upload->DbValue;
		$this->imagen->CurrentValue = NULL; // Clear file related field
		$this->__post->CurrentValue = NULL;
		$this->__post->OldValue = $this->__post->CurrentValue;
		$this->fecha->CurrentValue = NULL;
		$this->fecha->OldValue = $this->fecha->CurrentValue;
		$this->captura->Upload->DbValue = NULL;
		$this->captura->OldValue = $this->captura->Upload->DbValue;
		$this->captura->CurrentValue = NULL; // Clear file related field
		$this->urlIG->CurrentValue = NULL;
		$this->urlIG->OldValue = $this->urlIG->CurrentValue;
		$this->urlFB->CurrentValue = NULL;
		$this->urlFB->OldValue = $this->urlFB->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'tipo' first before field var 'x_tipo'
		$val = $CurrentForm->hasValue("tipo") ? $CurrentForm->getValue("tipo") : $CurrentForm->getValue("x_tipo");
		if (!$this->tipo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tipo->Visible = FALSE; // Disable update for API request
			else
				$this->tipo->setFormValue($val);
		}

		// Check field name 'tipoEvento' first before field var 'x_tipoEvento'
		$val = $CurrentForm->hasValue("tipoEvento") ? $CurrentForm->getValue("tipoEvento") : $CurrentForm->getValue("x_tipoEvento");
		if (!$this->tipoEvento->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tipoEvento->Visible = FALSE; // Disable update for API request
			else
				$this->tipoEvento->setFormValue($val);
		}

		// Check field name 'CategoriaEvento' first before field var 'x_CategoriaEvento'
		$val = $CurrentForm->hasValue("CategoriaEvento") ? $CurrentForm->getValue("CategoriaEvento") : $CurrentForm->getValue("x_CategoriaEvento");
		if (!$this->CategoriaEvento->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CategoriaEvento->Visible = FALSE; // Disable update for API request
			else
				$this->CategoriaEvento->setFormValue($val);
		}

		// Check field name 'evento' first before field var 'x_evento'
		$val = $CurrentForm->hasValue("evento") ? $CurrentForm->getValue("evento") : $CurrentForm->getValue("x_evento");
		if (!$this->evento->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->evento->Visible = FALSE; // Disable update for API request
			else
				$this->evento->setFormValue($val);
		}

		// Check field name 'post' first before field var 'x___post'
		$val = $CurrentForm->hasValue("post") ? $CurrentForm->getValue("post") : $CurrentForm->getValue("x___post");
		if (!$this->__post->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->__post->Visible = FALSE; // Disable update for API request
			else
				$this->__post->setFormValue($val);
		}

		// Check field name 'fecha' first before field var 'x_fecha'
		$val = $CurrentForm->hasValue("fecha") ? $CurrentForm->getValue("fecha") : $CurrentForm->getValue("x_fecha");
		if (!$this->fecha->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->fecha->Visible = FALSE; // Disable update for API request
			else
				$this->fecha->setFormValue($val);
			$this->fecha->CurrentValue = UnFormatDateTime($this->fecha->CurrentValue, 5);
		}

		// Check field name 'urlIG' first before field var 'x_urlIG'
		$val = $CurrentForm->hasValue("urlIG") ? $CurrentForm->getValue("urlIG") : $CurrentForm->getValue("x_urlIG");
		if (!$this->urlIG->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->urlIG->Visible = FALSE; // Disable update for API request
			else
				$this->urlIG->setFormValue($val);
		}

		// Check field name 'urlFB' first before field var 'x_urlFB'
		$val = $CurrentForm->hasValue("urlFB") ? $CurrentForm->getValue("urlFB") : $CurrentForm->getValue("x_urlFB");
		if (!$this->urlFB->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->urlFB->Visible = FALSE; // Disable update for API request
			else
				$this->urlFB->setFormValue($val);
		}

		// Check field name 'Id' first before field var 'x_Id'
		$val = $CurrentForm->hasValue("Id") ? $CurrentForm->getValue("Id") : $CurrentForm->getValue("x_Id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->tipo->CurrentValue = $this->tipo->FormValue;
		$this->tipoEvento->CurrentValue = $this->tipoEvento->FormValue;
		$this->CategoriaEvento->CurrentValue = $this->CategoriaEvento->FormValue;
		$this->evento->CurrentValue = $this->evento->FormValue;
		$this->__post->CurrentValue = $this->__post->FormValue;
		$this->fecha->CurrentValue = $this->fecha->FormValue;
		$this->fecha->CurrentValue = UnFormatDateTime($this->fecha->CurrentValue, 5);
		$this->urlIG->CurrentValue = $this->urlIG->FormValue;
		$this->urlFB->CurrentValue = $this->urlFB->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->Id->setDbValue($row['Id']);
		$this->tipo->setDbValue($row['tipo']);
		$this->tipoEvento->setDbValue($row['tipoEvento']);
		$this->CategoriaEvento->setDbValue($row['CategoriaEvento']);
		$this->evento->setDbValue($row['evento']);
		$this->imagen->Upload->DbValue = $row['imagen'];
		$this->imagen->setDbValue($this->imagen->Upload->DbValue);
		$this->__post->setDbValue($row['post']);
		$this->fecha->setDbValue($row['fecha']);
		$this->captura->Upload->DbValue = $row['captura'];
		$this->captura->setDbValue($this->captura->Upload->DbValue);
		$this->urlIG->setDbValue($row['urlIG']);
		$this->urlFB->setDbValue($row['urlFB']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['Id'] = $this->Id->CurrentValue;
		$row['tipo'] = $this->tipo->CurrentValue;
		$row['tipoEvento'] = $this->tipoEvento->CurrentValue;
		$row['CategoriaEvento'] = $this->CategoriaEvento->CurrentValue;
		$row['evento'] = $this->evento->CurrentValue;
		$row['imagen'] = $this->imagen->Upload->DbValue;
		$row['post'] = $this->__post->CurrentValue;
		$row['fecha'] = $this->fecha->CurrentValue;
		$row['captura'] = $this->captura->Upload->DbValue;
		$row['urlIG'] = $this->urlIG->CurrentValue;
		$row['urlFB'] = $this->urlFB->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("Id")) <> "")
			$this->Id->CurrentValue = $this->getKey("Id"); // Id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

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
			$curVal = trim(strval($this->CategoriaEvento->CurrentValue));
			if ($curVal <> "")
				$this->CategoriaEvento->ViewValue = $this->CategoriaEvento->lookupCacheOption($curVal);
			else
				$this->CategoriaEvento->ViewValue = $this->CategoriaEvento->Lookup !== NULL && is_array($this->CategoriaEvento->Lookup->Options) ? $curVal : NULL;
			if ($this->CategoriaEvento->ViewValue !== NULL) { // Load from cache
				$this->CategoriaEvento->EditValue = array_values($this->CategoriaEvento->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Id`" . SearchString("=", $this->CategoriaEvento->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->CategoriaEvento->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->CategoriaEvento->EditValue = $arwrk;
			}

			// evento
			$this->evento->EditAttrs["class"] = "form-control";
			$this->evento->EditCustomAttributes = "";
			$curVal = trim(strval($this->evento->CurrentValue));
			if ($curVal <> "")
				$this->evento->ViewValue = $this->evento->lookupCacheOption($curVal);
			else
				$this->evento->ViewValue = $this->evento->Lookup !== NULL && is_array($this->evento->Lookup->Options) ? $curVal : NULL;
			if ($this->evento->ViewValue !== NULL) { // Load from cache
				$this->evento->EditValue = array_values($this->evento->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Id`" . SearchString("=", $this->evento->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->evento->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][1] = FormatDateTime($arwrk[$i][1], 5);
				}
				$this->evento->EditValue = $arwrk;
			}

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
			if (($this->isShow() || $this->isCopy()) && !$this->EventCancelled)
				RenderUploadField($this->imagen);

			// post
			$this->__post->EditAttrs["class"] = "form-control";
			$this->__post->EditCustomAttributes = "";
			$this->__post->EditValue = HtmlEncode($this->__post->CurrentValue);
			$this->__post->PlaceHolder = RemoveHtml($this->__post->caption());

			// fecha
			$this->fecha->EditAttrs["class"] = "form-control";
			$this->fecha->EditCustomAttributes = "";
			$this->fecha->EditValue = HtmlEncode(FormatDateTime($this->fecha->CurrentValue, 5));
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
			if (($this->isShow() || $this->isCopy()) && !$this->EventCancelled)
				RenderUploadField($this->captura);

			// urlIG
			$this->urlIG->EditAttrs["class"] = "form-control";
			$this->urlIG->EditCustomAttributes = "";
			$this->urlIG->EditValue = HtmlEncode($this->urlIG->CurrentValue);
			$this->urlIG->PlaceHolder = RemoveHtml($this->urlIG->caption());

			// urlFB
			$this->urlFB->EditAttrs["class"] = "form-control";
			$this->urlFB->EditCustomAttributes = "";
			$this->urlFB->EditValue = HtmlEncode($this->urlFB->CurrentValue);
			$this->urlFB->PlaceHolder = RemoveHtml($this->urlFB->caption());

			// Add refer script
			// tipo

			$this->tipo->LinkCustomAttributes = "";
			$this->tipo->HrefValue = "";

			// tipoEvento
			$this->tipoEvento->LinkCustomAttributes = "";
			$this->tipoEvento->HrefValue = "";

			// CategoriaEvento
			$this->CategoriaEvento->LinkCustomAttributes = "";
			$this->CategoriaEvento->HrefValue = "";

			// evento
			$this->evento->LinkCustomAttributes = "";
			$this->evento->HrefValue = "";

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

			// post
			$this->__post->LinkCustomAttributes = "";
			$this->__post->HrefValue = "";

			// fecha
			$this->fecha->LinkCustomAttributes = "";
			$this->fecha->HrefValue = "";

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

			// urlIG
			$this->urlIG->LinkCustomAttributes = "";
			$this->urlIG->HrefValue = "";

			// urlFB
			$this->urlFB->LinkCustomAttributes = "";
			$this->urlFB->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->Id->Required) {
			if (!$this->Id->IsDetailKey && $this->Id->FormValue != NULL && $this->Id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Id->caption(), $this->Id->RequiredErrorMessage));
			}
		}
		if ($this->tipo->Required) {
			if (!$this->tipo->IsDetailKey && $this->tipo->FormValue != NULL && $this->tipo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tipo->caption(), $this->tipo->RequiredErrorMessage));
			}
		}
		if ($this->tipoEvento->Required) {
			if (!$this->tipoEvento->IsDetailKey && $this->tipoEvento->FormValue != NULL && $this->tipoEvento->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tipoEvento->caption(), $this->tipoEvento->RequiredErrorMessage));
			}
		}
		if ($this->CategoriaEvento->Required) {
			if (!$this->CategoriaEvento->IsDetailKey && $this->CategoriaEvento->FormValue != NULL && $this->CategoriaEvento->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CategoriaEvento->caption(), $this->CategoriaEvento->RequiredErrorMessage));
			}
		}
		if ($this->evento->Required) {
			if (!$this->evento->IsDetailKey && $this->evento->FormValue != NULL && $this->evento->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->evento->caption(), $this->evento->RequiredErrorMessage));
			}
		}
		if ($this->imagen->Required) {
			if ($this->imagen->Upload->FileName == "" && !$this->imagen->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->imagen->caption(), $this->imagen->RequiredErrorMessage));
			}
		}
		if ($this->__post->Required) {
			if (!$this->__post->IsDetailKey && $this->__post->FormValue != NULL && $this->__post->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->__post->caption(), $this->__post->RequiredErrorMessage));
			}
		}
		if ($this->fecha->Required) {
			if (!$this->fecha->IsDetailKey && $this->fecha->FormValue != NULL && $this->fecha->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fecha->caption(), $this->fecha->RequiredErrorMessage));
			}
		}
		if (!CheckStdDate($this->fecha->FormValue)) {
			AddMessage($FormError, $this->fecha->errorMessage());
		}
		if ($this->captura->Required) {
			if ($this->captura->Upload->FileName == "" && !$this->captura->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->captura->caption(), $this->captura->RequiredErrorMessage));
			}
		}
		if ($this->urlIG->Required) {
			if (!$this->urlIG->IsDetailKey && $this->urlIG->FormValue != NULL && $this->urlIG->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->urlIG->caption(), $this->urlIG->RequiredErrorMessage));
			}
		}
		if ($this->urlFB->Required) {
			if (!$this->urlFB->IsDetailKey && $this->urlFB->FormValue != NULL && $this->urlFB->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->urlFB->caption(), $this->urlFB->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
			$this->imagen->OldUploadPath = '../../data/images/';
			$this->imagen->UploadPath = $this->imagen->OldUploadPath;
			$this->captura->OldUploadPath = '../../data/images/';
			$this->captura->UploadPath = $this->captura->OldUploadPath;
		}
		$rsnew = [];

		// tipo
		$this->tipo->setDbValueDef($rsnew, $this->tipo->CurrentValue, NULL, FALSE);

		// tipoEvento
		$this->tipoEvento->setDbValueDef($rsnew, $this->tipoEvento->CurrentValue, NULL, FALSE);

		// CategoriaEvento
		$this->CategoriaEvento->setDbValueDef($rsnew, $this->CategoriaEvento->CurrentValue, NULL, FALSE);

		// evento
		$this->evento->setDbValueDef($rsnew, $this->evento->CurrentValue, NULL, FALSE);

		// imagen
		if ($this->imagen->Visible && !$this->imagen->Upload->KeepFile) {
			$this->imagen->Upload->DbValue = ""; // No need to delete old file
			if ($this->imagen->Upload->FileName == "") {
				$rsnew['imagen'] = NULL;
			} else {
				$rsnew['imagen'] = $this->imagen->Upload->FileName;
			}
		}

		// post
		$this->__post->setDbValueDef($rsnew, $this->__post->CurrentValue, NULL, FALSE);

		// fecha
		$this->fecha->setDbValueDef($rsnew, UnFormatDateTime($this->fecha->CurrentValue, 5), NULL, FALSE);

		// captura
		if ($this->captura->Visible && !$this->captura->Upload->KeepFile) {
			$this->captura->Upload->DbValue = ""; // No need to delete old file
			if ($this->captura->Upload->FileName == "") {
				$rsnew['captura'] = NULL;
			} else {
				$rsnew['captura'] = $this->captura->Upload->FileName;
			}
		}

		// urlIG
		$this->urlIG->setDbValueDef($rsnew, $this->urlIG->CurrentValue, NULL, FALSE);

		// urlFB
		$this->urlFB->setDbValueDef($rsnew, $this->urlFB->CurrentValue, NULL, FALSE);
		if ($this->imagen->Visible && !$this->imagen->Upload->KeepFile) {
			$this->imagen->UploadPath = '../../data/images/';
			$oldFiles = EmptyValue($this->imagen->Upload->DbValue) ? array() : array($this->imagen->Upload->DbValue);
			if (!EmptyValue($this->imagen->Upload->FileName)) {
				$newFiles = array($this->imagen->Upload->FileName);
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] <> "") {
						$file = $newFiles[$i];
						if (file_exists(UploadTempPath($this->imagen, $this->imagen->Upload->Index) . $file)) {
							if (DELETE_UPLOADED_FILES) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										unset($oldFiles[$j]);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->imagen->physicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(UploadTempPath($this->imagen, $this->imagen->Upload->Index) . $file1) || file_exists($this->imagen->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->imagen->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(UploadTempPath($this->imagen, $this->imagen->Upload->Index) . $file, UploadTempPath($this->imagen, $this->imagen->Upload->Index) . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->imagen->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
				$this->imagen->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
				$this->imagen->setDbValueDef($rsnew, $this->imagen->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->captura->Visible && !$this->captura->Upload->KeepFile) {
			$this->captura->UploadPath = '../../data/images/';
			$oldFiles = EmptyValue($this->captura->Upload->DbValue) ? array() : array($this->captura->Upload->DbValue);
			if (!EmptyValue($this->captura->Upload->FileName)) {
				$newFiles = array($this->captura->Upload->FileName);
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] <> "") {
						$file = $newFiles[$i];
						if (file_exists(UploadTempPath($this->captura, $this->captura->Upload->Index) . $file)) {
							if (DELETE_UPLOADED_FILES) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										unset($oldFiles[$j]);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->captura->physicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(UploadTempPath($this->captura, $this->captura->Upload->Index) . $file1) || file_exists($this->captura->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->captura->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(UploadTempPath($this->captura, $this->captura->Upload->Index) . $file, UploadTempPath($this->captura, $this->captura->Upload->Index) . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->captura->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
				$this->captura->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
				$this->captura->setDbValueDef($rsnew, $this->captura->Upload->FileName, NULL, FALSE);
			}
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($addRow) {
				if ($this->imagen->Visible && !$this->imagen->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->imagen->Upload->DbValue) ? array() : array($this->imagen->Upload->DbValue);
					if (!EmptyValue($this->imagen->Upload->FileName)) {
						$newFiles = array($this->imagen->Upload->FileName);
						$newFiles2 = array($rsnew['imagen']);
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] <> "") {
								$file = UploadTempPath($this->imagen, $this->imagen->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] <> "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->imagen->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = array();
					}
					if (DELETE_UPLOADED_FILES) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile <> "" && !in_array($oldFile, $newFiles))
								@unlink($this->imagen->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->captura->Visible && !$this->captura->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->captura->Upload->DbValue) ? array() : array($this->captura->Upload->DbValue);
					if (!EmptyValue($this->captura->Upload->FileName)) {
						$newFiles = array($this->captura->Upload->FileName);
						$newFiles2 = array($rsnew['captura']);
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] <> "") {
								$file = UploadTempPath($this->captura, $this->captura->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] <> "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->captura->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = array();
					}
					if (DELETE_UPLOADED_FILES) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile <> "" && !in_array($oldFile, $newFiles))
								@unlink($this->captura->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// imagen
		if ($this->imagen->Upload->FileToken <> "")
			CleanUploadTempPath($this->imagen->Upload->FileToken, $this->imagen->Upload->Index);
		else
			CleanUploadTempPath($this->imagen, $this->imagen->Upload->Index);

		// captura
		if ($this->captura->Upload->FileToken <> "")
			CleanUploadTempPath($this->captura->Upload->FileToken, $this->captura->Upload->Index);
		else
			CleanUploadTempPath($this->captura, $this->captura->Upload->Index);

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("Live_Brief_Postlist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->ParentFields) == 0 && count($fld->Lookup->Options) == 0) {
				$conn = &$this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_CategoriaEvento":
							break;
						case "x_evento":
							$row[1] = FormatDateTime($row[1], 5);
							$row['df'] = $row[1];
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>