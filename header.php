<?php include "systeatro2020.php" ?>
<?php /*-----------------False Key---------------------*/
function random_str(int $length = 23,    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
{
	if ($length < 1) {
		throw new \RangeException("Length must be a positive integer");
	}
	$pieces = [];
	$max = mb_strlen($keyspace, '8bit') - 1;
	for ($i = 0; $i < $length; ++$i) {
		$pieces[] = $keyspace[random_int(0, $max)];
	}
	return implode('', $pieces);
}
//$a = random_str(128);
$falsekey = random_str(128);
?>
<!DOCTYPE html>
<html>

<head>
	<title>BMP 2020 - Teatro Centro de Arte</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="http://localhost/VINCULACION/core/Favico.png">
	<link rel="apple-touch-icon-precomposed" href="http://localhost/VINCULACION/core/Favico.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://localhost/VINCULACION/core/Favico.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://localhost/VINCULACION/core/Favico.png">
	<link rel="stylesheet" type="text/css" href="core/adminlte3/css/adminlte.css">
	<link rel="stylesheet" type="text/css" href="core/plugins/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="core/phpcss/jquery.fileupload.css">
	<link rel="stylesheet" type="text/css" href="core/phpcss/jquery.fileupload-ui.css">
	<link rel="stylesheet" type="text/css" href="core/colorbox/colorbox.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="core/phpcss/LiveBrief.css">
	<script src="core/jquery/jquery-3.4.1.min.js"></script>
	<script src="core/jquery/jquery.ui.widget.js"></script>
	<script src="core/jquery/jquery.storageapi.min.js"></script>
	<script src="core/bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script src="core/adminlte3/js/adminlte.js"></script>
	<script src="core/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<script src="core/jquery/jquery.fileDownload.min.js"></script>
	<script src="core/jquery/load-image.all.min.js"></script>
	<script src="core/jquery/jqueryfileupload.min.js"></script>
	<script src="core/phpjs/typeahead.jquery.js"></script>
	<script src="core/colorbox/jquery.colorbox-min.js"></script>
	<script src="core/phpjs/mobile-detect.min.js"></script>
	<script src="core/moment/moment.min.js"></script>
	<script src="core/phpjs/jsrender.min.js"></script>
	<script src="core/phpjs/ewp15.js"></script>
	<!-- include summernote css/js -->
	<link href="http://localhost/VINCULACION/summernote/summernote.min.css" rel="stylesheet">
	<script src="http://localhost/VINCULACION/summernote/summernote.min.js"></script>

	<script>
		$(document).ready(function() {
			$('.editor').summernote();
		});
		jQuery.extend(ew, {
			LANGUAGE_ID: "es",
			DATE_SEPARATOR: "/", // Date separator
			TIME_SEPARATOR: ":", // Time separator
			DATE_FORMAT: "dd/mm/yy", // Default date format
			DATE_FORMAT_ID: 14, // Default date format ID
			DATETIME_WITHOUT_SECONDS: false, // Date/Time without seconds
			DECIMAL_POINT: ",",
			THOUSANDS_SEP: ".",
			SESSION_TIMEOUT: 0, // Session timeout time (seconds)
			SESSION_TIMEOUT_COUNTDOWN: 60, // Count down time to session timeout (seconds)
			SESSION_KEEP_ALIVE_INTERVAL: 0, // Keep alive interval (seconds)
			RELATIVE_PATH: "", // Relative path
			IS_LOGGEDIN: true, // Is logged in
			IS_SYS_ADMIN: false, // Is sys admin
			CURRENT_USER_NAME: "dquinde", // Current user name
			IS_AUTOLOGIN: false, // Is logged in with option "Auto login until I logout explicitly"
			TIMEOUT_URL: "logout.php", // Timeout URL
			API_URL: "api/index.php", // API file name
			API_ACTION_NAME: "action", // API action name
			API_OBJECT_NAME: "object", // API object name
			API_FIELD_NAME: "field", // API field name
			API_KEY_NAME: "key", // API key name
			API_LIST_ACTION: "list", // API list action
			API_VIEW_ACTION: "view", // API view action
			API_ADD_ACTION: "add", // API add action
			API_EDIT_ACTION: "edit", // API edit action
			API_DELETE_ACTION: "delete", // API delete action
			API_LOGIN_ACTION: "login", // API login action
			API_FILE_ACTION: "file", // API file action
			API_UPLOAD_ACTION: "upload", // API upload action
			API_JQUERY_UPLOAD_ACTION: "jupload", // API jQuery upload action
			API_SESSION_ACTION: "session", // API get session action
			API_LOOKUP_ACTION: "lookup", // API lookup action
			API_LOOKUP_TABLE: "linkTable", // API lookup table name
			API_PROGRESS_ACTION: "progress", // API progress action
			LOOKUP_FILTER_VALUE_SEPARATOR: ",", // Lookup filter value separator
			AUTO_SUGGEST_MAX_ENTRIES: 10, // Auto-Suggest max entries
			DISABLE_BUTTON_ON_SUBMIT: true,
			IMAGE_FOLDER: "http://localhost/VINCULACION/core/phpimages/", // Image folder
			SESSION_ID: "v8ioEPCUMlGzs1dsC9DbKUuxWZ0FnsLWbTZ9OkCOCm0ltMFh", // Session ID
			UPLOAD_URL: "api/index.php", // Upload URL
			UPLOAD_TYPE: "POST", // Upload type
			UPLOAD_THUMBNAIL_WIDTH: 200, // Upload thumbnail width
			UPLOAD_THUMBNAIL_HEIGHT: 0, // Upload thumbnail height
			MULTIPLE_UPLOAD_SEPARATOR: ",", // Upload multiple separator
			IMPORT_FILE_ALLOWED_EXT: "csv,xls,xlsx", // Import file allowed extensions
			USE_COLORBOX: true,
			USE_JAVASCRIPT_MESSAGE: false,
			PROJECT_STYLESHEET_FILENAME: "http://localhost/VINCULACION/core/phpcss/LiveBrief.css", // Project style sheet
			PDF_STYLESHEET_FILENAME: "", // PDF style sheet
			ANTIFORGERY_TOKEN: "TygNIMSUm8JQs9m65dT3WQ..",
			CSS_FLIP: false,
			LAZY_LOAD: true,
			RESET_HEIGHT: true,
			DEBUG_ENABLED: false,
			SEARCH_FILTER_OPTION: "Client",
			OPTION_HTML_TEMPLATE: "<span class=\"ew-option\">{value}</span>"
		});
	</script>
	<script>
		ew.language = new ew.Language({
			"addbtn": "Agregar",
			"cancelbtn": "Cancelar",
			"clickrecaptcha": "Por favor haz click reCAPTCHA",
			"closebtn": "Cerrar",
			"confirmbtn": "Confirmar",
			"confirmcancel": "Quieres cancelar?",
			"countselected": "%s seleccionados",
			"currentpassword": "Password actual: ",
			"deleteconfirmmsg": "Estas seguro que quieres borrarlo?",
			"deletefilterconfirm": "Eliminar filtro %s?",
			"editbtn": "Editar",
			"enterfiltername": "Ingrese el nombre del filtro",
			"enternewpassword": "Por favor ingrese una nueva contraseña",
			"enteroldpassword": "Por favor ingrese la contraseña anterior",
			"enterpassword": "Por favor, ingrese contraseña",
			"enterpwd": "Por favor, ingrese contraseña",
			"enterusername": "Por favor ingrese su nombre",
			"entervalidatecode": "Ingrese el código de validación que se muestra",
			"entersenderemail": "Por favor ingrese el correo del remitente",
			"enterpropersenderemail": "Exceder el recuento máximo de correos electrónicos del remitente o la dirección de correo electrónico incorrecta",
			"enterrecipientemail": "Ingrese el correo electrónico del destinatario",
			"enterproperrecipientemail": "Superación del recuento máximo de correo electrónico del destinatario o dirección de correo electrónico incorrecta",
			"enterproperccemail": "Superación del recuento máximo de correos electrónicos cc o dirección de correo electrónico incorrecta",
			"enterproperbccemail": "Superación del recuento máximo de correos electrónicos bcc o direcciones de correo electrónico incorrectas",
			"entersubject": "Por favor ingrese el asunto",
			"enteruid": "Ingrese la ID de usuario",
			"entervalidemail": "Ingrese una dirección de correo electrónico válida",
			"exporting": "Exportar, espere ...",
			"exporttoemailtext": "Email",
			"failedtoexport": "Error al exportar",
			"filtername": "Nombre del filtro",
			"importmessageerror1": "Importado %c de %t registros de %f (ok: %s, fallados: %e)",
			"importmessageerror2": ", error: %e",
			"importmessageerror3": "fila %i: %d",
			"importmessageerror4": "archivo log: %l",
			"importmessagemore": "(%s mas)",
			"importmessageprogress": "Importando %c de %t registros de %f...",
			"importmessageservererror": "Server error %s: %t",
			"importmessagesuccess": "Importado %c de %t registros de %f exitosamente",
			"importmessageuploaderror": "Error al subir %f: %s",
			"importmessageuploadcomplete": "Subida completada",
			"importmessageuploadprogress": "Subiendo...(p%)",
			"importmessagepleaseselect": "Por favor seleccione el archivo",
			"importmessageincorrectfiletype": "Tipo de archivo incorrecto",
			"importtext": "Importar",
			"incorrectemail": "Email incorrecto",
			"incorrectfield": "Campo incorrecto",
			"incorrectfloat": "Número de punto flotante incorrecto",
			"incorrectguid": "GUID Incorrecto",
			"incorrectinteger": "Entero incorrecto",
			"incorrectphone": "Número de teléfono incorrecto",
			"incorrectregexp": "La expresión regular no coincide",
			"incorrectrange": "El número debe estar entre %1 y %2",
			"incorrectssn": "Número de seguro social incorrecto",
			"incorrectzip": "Código postal incorrecto",
			"insertfailed": "Inserción fallida",
			"invalidrecord": "Registro inválido! Clave nula",
			"lightboxtitle": " ",
			"lightboxcurrent": "imagen {current} de {total}",
			"lightboxprevious": "anterior",
			"lightboxnext": "siguiente",
			"lightboxclose": "cerrar",
			"lightboxxhrerror": "Este contenido no se ha podido cargar.",
			"lightboximgerror": "Esta imagen no se pudo cargar.",
			"loading": "Cargando...",
			"maxfilesize": "Max. tamaño de archivo (%s bytes) excedido.",
			"messageok": "OK",
			"midnight": "medianoche",
			"mismatchpassword": "No coincide Password",
			"more": "More",
			"next": "Siguiente",
			"noaddrecord": "No hay registros para agregar",
			"nofieldselected": "Ningún campo seleccionado para la actualización",
			"norecord": "No se encontrarón archivos",
			"norecordselected": "No hay registros seleccionados",
			"of": "de",
			"overwritebtn": "Sobrescribir",
			"page": "Página",
			"passwordstrength": "Fortaleza: %p",
			"passwordtoosimple": "Su password es muy simple",
			"permissionaddcopy": "Agregar/Copiar",
			"permissionadmin": "Admin",
			"permissiondelete": "Eliminar",
			"permissionedit": "Editar",
			"permissionlistsearchview": "Listar/Buscar/Visualizar",
			"permissionlist": "Listar",
			"permissionsearch": "Buscar",
			"permissionview": "Vista",
			"pleaseselect": "Por favor selecciona",
			"pleasewait": "Por favor espere...",
			"prev": "Anterior",
			"quicksearchauto": "Auto",
			"quicksearchautoshort": "",
			"quicksearchall": "Todas las palabras clave",
			"quicksearchallshort": "Todas",
			"quicksearchany": "Cualquier palabra clave",
			"quicksearchanyshort": "Cualquiera",
			"quicksearchexact": "Coincidencia exacta",
			"quicksearchexactshort": "Exacta",
			"record": "Registros",
			"recordsperpage": "Tamaño de página",
			"reloadbtn": "Recargar",
			"savebtn": "Guardar",
			"search": "Buscar",
			"searchbtn": "Buscar",
			"selectbtn": "Seleccionar",
			"sendemailsuccess": "Correo electrónico enviado con éxito",
			"sessionwillexpire": "Su sesión expirará en %s segundos. Haga clic en Aceptar para continuar su sesión.",
			"sessionexpired": "Su sesión ha caducado.",
			"tableorview": "Tablas",
			"updatebtn": "Actualizar",
			"uploading": "Cargando...",
			"uploadstart": "Comenzar",
			"uploadcancel": "Cancelar",
			"uploaddelete": "Eliminar",
			"uploadoverwrite": "Sobrescribir archivo viejo?",
			"uploaderrmsgmaxfilesize": "El archivo es muy grande",
			"uploaderrmsgminfilesize": "El archivo es muy pequeño",
			"uploaderrmsgacceptfiletypes": "Tipo de archivo no permitido",
			"uploaderrmsgmaxnumberoffiles": "Número máximo de archivos excedido",
			"uploaderrmsgmaxfilelength": "La longitud total de los nombres de archivo excede la longitud del campo",
			"useradministrator": "Administrador",
			"useranonymous": "Anónimo",
			"userdefault": "Por defecto",
			"userleveladministratorname": "El nombre de nivel de usuario para el nivel de usuario -1 debe ser 'Administrador'",
			"userlevelanonymousname": "El nombre de nivel de usuario para el nivel de usuario -2 debe ser 'Anónimo'",
			"userlevelidinteger": "El ID de nivel de usuario debe ser entero",
			"userleveldefaultname": "El nombre de nivel de usuario para el nivel de usuario 0 debe ser 'Predeterminado'",
			"userlevelidincorrect": "ID de nivel de usuario definido por el usuario debe ser mayor que 0",
			"userlevelnameincorrect": "El nombre de nivel de usuario definido por el usuario no puede ser 'Administrador' o 'Predeterminado'",
			"valuenotexist": "El valor no existe",
			"wrongfiletype": "Tipo de archivo no permitido.",
			"am": "AM",
			"pm": "PM"
		});
		ew.vars = {
			"login": {
				"isLoggedIn": true,
				"currentUserName": "dquinde",
				"logoutUrl": "logout.php",
				"logoutText": "Logout",
				"loginUrl": "login.php",
				"loginText": "Login",
				"canLogin": false,
				"canLogout": true,
				"hasPersonalData": true,
				"personalDataUrl": "personaldata.php",
				"personalDataText": "Datos Personales"
			},
			"languages": {
				"languages": []
			}
		};
	</script>
	<script src="http://localhost/VINCULACION/core/ckeditor/ckeditor.js"></script>
	<script src="http://localhost/VINCULACION/core/phpjs/eweditor.js"></script>
	<link rel="stylesheet" type="text/css" href="http://localhost/VINCULACION/core/phpcss/bootstrap-datetimepicker.css">
	<script src="http://localhost/VINCULACION/core/phpjs/bootstrap-datetimepicker.js"></script>
	<script src="http://localhost/VINCULACION/core/phpjs/ewdatetimepicker.js"></script>
	<script src="http://localhost/VINCULACION/core/phpjs/userfn15.js"></script>
	<script>
		// Write your client script here, no need to add script tags.
	</script>

	<meta name="generator" content="PHPMaker v2019.0.10">
</head>

<body class="hold-transition" dir="ltr">
	<style>
		html,
		body,
		.wrapper {
			min-height: 100%;
			overflow-x: visible;
		}
	</style>


	<div class="card " style="width:100%; margin-left:auto; margin-right:auto; ">

		<table>
			<tr>
				<td>
					<nav class="navbar navbar-expand-lg navbar-light bg-light" style="z-index: 1000000;">
						<a class="navbar-brand" href="#"><b>BPM <small>2020</small></b> para <?php echo $UserData['nombre']; ?></a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>

						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav mr-auto">

								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Marketing
									</a>
									<div class="dropdown-menu" aria-labelledby="navbarDropdown">

										<a class="dropdown-item" href="http://localhost/VINCULACION/Reporte.OnDemand.php?PHPKEYID=<?php echo $falsekey; ?>">Reportes Eventos OnDemand</a>
										<a class="dropdown-item" href="http://localhost/VINCULACION/Reporte.Post.php?PHPKEYID=<?php echo $falsekey; ?>">Reportes Post en redes sociales</a>
										<a class="dropdown-item" href="http://localhost/VINCULACION/Reporte.LiveStream.php?PHPKEYID=<?php echo $falsekey; ?>">Reportes LiveStreaming</a>
										<a class="dropdown-item" href="http://localhost/VINCULACION/Escuela.Reporte.php?PHPKEYID=<?php echo $falsekey; ?>">Reportes Escuelas</a>
									</div>
								</li>

								<li class="nav-item">
									<a class="nav-link" href="http://localhost/VINCULACION/main.php?v=mes">Agenda eventos</a>

								</li>
								<li class="nav-item danger" style="    background: #f9afb6;">
									<a class="nav-link" href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=99&retorno=Pre-reserva&paso=1GLOBAL&categoria=32">PRE-RESERVA</a>

								</li>
								<?php if ($UserData['calendario'] == '1') { ?>
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Agregar Evento
										</a>
										<div class="dropdown-menu" aria-labelledby="navbarDropdown">

											<?php if ($UserData['auth'] == 'TODOS') { ?>
												<a class="dropdown-item" href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=1&paso=1GLOBAL">Co-Producción y/o Propio</a>


												<a class="dropdown-item" href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=4&retorno=Alquiler&paso=1GLOBAL&categoria=22">Alquiler</a>


											<?PHP } ?>

											<?php if ($UserData['auth'] == 'PROPIO') { ?>
												<a class="dropdown-item" href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=1&paso=1GLOBAL">Co-Producción y/o Propio</a>
											<?PHP } ?>
											<?php if ($UserData['auth'] == 'ALQUILER') { ?>

												<a class="dropdown-item" href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=4&retorno=Alquiler&paso=1GLOBAL&categoria=22">AAlquiler</a>
												<!--
	<a class="dropdown-item"    href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=4&retorno=Alquiler&paso=1GLOBAL&categoria=19">Agregar Alquiler Digital</a> 
	<a class="dropdown-item"    href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=4&retorno=Alquiler&paso=1GLOBAL&categoria=27">Agregar Alquiler Arena-TCA</a>-->

											<?PHP } ?>
											<!--<a class="dropdown-item"   href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=3&retorno=Otro-Tipo&paso=1GLOBAL&categoria=25">Otro Tipo</a>-->

											<!-- <a class="dropdown-item" href="Proceso.LlavesAcceso.php?PHPKEYID=<?php echo $falsekey; ?>">Llaves Donaciones</a>-->

										</div>
									</li>





									<!--<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Producción
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
     <h6 class="dropdown-header">Eventos Teatro Propios y Coproducción</h6>
	 <hr>
	 <a class="dropdown-item"  href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=1&retorno=On-Demand-BdP&paso=1GLOBAL">Agregar OnDemand BdP</a>
     <h6 class="dropdown-header">Eventos Live BdP 2020</h6>
	 <hr>
	
   
   <a class="dropdown-item"  href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=1&retorno=On-Demand-BdP&paso=1GLOBAL">Agregar OnDemand BdP</a>
<a class="dropdown-item"   href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=2&retorno=Live-Streaming-BdP&paso=1GLOBAL">Agregar LiveStreaming BdP</a>
<h6 class="dropdown-header">Eventos TCA</h6>
 <a class="dropdown-item"   href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=8&retorno=Live-Streaming-TCA&paso=1GLOBAL&categoria=18">Agregar LiveStreaming TCA</a>
<a class="dropdown-item"   href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=9&retorno=Presencial-TCA&paso=1GLOBAL&categoria=26">Agregar Presencial TCA</a>
<a class="dropdown-item"   href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=11&retorno=Arena-TCA&paso=1GLOBAL&categoria=28">Agregar Arena TCA</a>

<a class="dropdown-item"   href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=3&retorno=Otro-Tipo&paso=1GLOBAL&categoria=25">Otro Tipo</a>
 
  <a class="dropdown-item" href="Proceso.LlavesAcceso.php?PHPKEYID=<?php echo $falsekey; ?>">Llaves Donaciones</a>

        </div>
      </li>-->
								<?php } ?>

								<?php if ($UserData['calendario'] == '1') { ?>
									<!--  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Alquileres
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
<a class="dropdown-item"    href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=4&retorno=Alquiler&paso=1GLOBAL&categoria=19">Agregar Alquiler Digital</a>
<a class="dropdown-item"    href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=4&retorno=Alquiler&paso=1GLOBAL&categoria=22">Agregar Alquiler Tradicional</a>
<a class="dropdown-item"    href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=4&retorno=Alquiler&paso=1GLOBAL&categoria=27">Agregar Alquiler Arena-TCA</a>

        </div>
      </li>-->
								<?php } ?>


								<li class="nav-item">
									<a class="nav-link" href="http://localhost/VINCULACION/Proceso.Medios.php?PHPKEYID=<?php echo $falsekey; ?>">Directorio de medios</a>

								</li>


								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Contabilidad
									</a>
									<div class="dropdown-menu" aria-labelledby="navbarDropdown">


										<a class="dropdown-item" href="http://localhost/VINCULACION/Reporte.Paymentez.php?v=2">Informe Donaciones</a>
										<a class="dropdown-item" href="http://localhost/VINCULACION/Reporte.Paymentez.php?v=3">Informes Escuelas de Arte</a>
										<a class="dropdown-item" href="http://localhost/VINCULACION/Orden.Pago.php?paso=2">Ordenes de cobro</a>
										<a class="dropdown-item" href="http://localhost/VINCULACION/Proceso.DocumentosEmitidos.php?v=3">Facturas, Retenciones emitidas</a>

									</div>
								</li>

								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Escuelas de Arte
									</a>
									<div class="dropdown-menu" aria-labelledby="navbarDropdown">
										<?php if ($UserData['calendario'] == '1') { ?> <a class="dropdown-item" href="http://localhost/VINCULACION/Proceso.Agregar.Brief.php?tipo=3&retorno=EscuelasDeArte&paso=1GLOBAL&categoria=21">Agregar Curso o Taller a la agenda</a><?php } ?>
										<h6 class="dropdown-header">Reportes</h6>
										<a class="dropdown-item" href="http://localhost/VINCULACION/Escuela.Reporte.Pagos.php?v=3">Ingresos</a>
										<a class="dropdown-item" href="http://localhost/VINCULACION/Escuela.Reporte.php?PHPKEYID=<?php echo $falsekey; ?>">Beneficiados BdP</a>
										<a class="dropdown-item" href="http://localhost/VINCULACION/Escuela.Reporte.Alumnos.php?PHPKEYID=<?php echo $falsekey; ?>">Ficha Alumno Escuelas de Arte</a>
										<a class="dropdown-item" href="http://localhost/VINCULACION/Escuela.Reporte.Asistencia.php?PHPKEYID=<?php echo $falsekey; ?>">Asistencia Escuelas de Arte</a>
										<a class="dropdown-item" href="http://localhost/VINCULACION/Semilleros.Reporte.Asistencia.php?PHPKEYID=<?php echo $falsekey; ?>">Asistencia Semilleros</a>
										<a class="dropdown-item" href="http://localhost/VINCULACION/Semilleros.Reporte.Alumnos.php?PHPKEYID=<?php echo $falsekey; ?>">Ficha Alumno Semilleros</a>
									</div>
								</li>
								<li class="nav-item">
									<!--<a class="nav-link" href="http://localhost/VINCULACION/Financiera.main.php?v=mes">Financiera</a>-->
									<a class="nav-link" href="http://localhost/VINCULACION/Taquilla.php">Taquilla</a>

								</li>
								<li class="nav-item">
									<a class="nav-link" href="http://localhost/VINCULACION/PinacotecaVirtual.php?PHPKEYID=<?php echo $falsekey; ?>">Pinacoteca</a>

								</li>
								<li class="nav-item">
									<a class="nav-link" href="http://localhost/VINCULACION/core/logout.php">Salir</a>

								</li>

							</ul>

						</div>
					</nav>


				</td>
			</tr>
			<tr>
				<td>
					<div class="card-body">
						<table style="margin-left:auto; margin-right:auto">
							<TR>
								<td>