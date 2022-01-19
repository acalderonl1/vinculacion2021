<?php
namespace PHPMaker2019\LiveBrief;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 
?>
<?php
$RELATIVE_PATH = "./core/";
$ROOT_RELATIVE_PATH = "./core/";
?>
<?php include_once $RELATIVE_PATH . "autoload.php" ?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$main = new main();

// Run the page
$main->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include "header.php" ?>


<?php  if($_GET[tipo]==''){?>
<h3>¿Que tipo de evento desea agregar?</h3>
<table class="table table-border">
<tr><td>
<a href="Proceso.Agregar.Brief.php?tipo=1&retorno=OnDemand&paso=1GLOBAL" class="btn btn-default btn-block"> 
<span style="font-size: 60px;"><i class="fa fa-youtube-play" aria-hidden="true"></i></span>
<br> OnDemand
</a>
</td>
<td>
<a href="Proceso.Agregar.Brief.php?tipo=2&retorno=LiveStreaming&paso=1GLOBAL" class="btn btn-default btn-block"> 
<span style="font-size: 60px;">

<i class="fa fa-forumbee" aria-hidden="true"></i></span><br> Live Streaming
</a>
</td>
<td>Alquiler</td>
<td>oTRO tIRPO</td>
</tr></table>
<?php } else { ?>

<?php 
/*-------------------------------
FORMULARIO GLOBAL borrar
-----------------------------*/
# Leemos datos de la categoria
$row= ExecuteRow("SELECT
  `Live_Brief_categorias`.`Id`,
  `Live_Brief_categorias`.`titulo`,
  `Live_Brief_categorias`.`hora`,
  `Live_Brief_categorias`.`dia`,
  `Live_Brief_categorias`.`descripcion`,
  `Live_Brief_categorias`.`periodo`
FROM
  `Live_Brief_categorias`
WHERE
  `Live_Brief_categorias`.`Id` = '$_GET[categoria]'");

/**********************
Paso 1
/**************************/
if($_GET[paso]=='1GLOBAL'){

?>
<h3><?php echo $_GET[retorno];?> <small>Agregar evento como <?php echo CurrentUserInfo("nombre");?></small></h3>
<form method="POST" action="Proceso.Agregar.Brief.php">
<input type="hidden" name="paso" value="1G-GLOBAL">
<input type="hidden" name="cod" value="<?php echo date(ymdHms);?>">
<input type="hidden" name="UserId" value="<?php echo CurrentUserInfo("usuario");?>">
<input type="hidden" name="flog" value="<?php echo date("Y-m-d H:m:s");?>">

<input type="hidden" name="tipo" value="<?php echo $_GET[tipo];?>">

<input type="hidden" name="categoria" value="<?php echo $_GET[categoria];?>">
<input type="hidden" name="retorno" value="<?php echo $_GET[retorno];?>">


<table class="table table-bordered">
<tr>
<td>
<?php if($_GET[tipo]==1){?>
<div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Categorías <?php echo ExecuteScalar("SELECT
  `Live_Brief_categorias`.`titulo`
FROM
  `Live_Brief_categorias`
WHERE
  `Live_Brief_categorias`.`Id` = '$_GET[categoria]'"); ?>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <?php 
  $sql = "
SELECT
  `Live_Brief_categorias`.`Id`,
  `Live_Brief_categorias`.`tipo`,
  `Live_Brief_categorias`.`estado`,
  `Live_Brief_categorias`.`titulo`
FROM
  `Live_Brief_categorias`
WHERE
  `Live_Brief_categorias`.`tipo` != '4' AND
  
  `Live_Brief_categorias`.`estado` = '1'
  ORDER BY 
  `Live_Brief_categorias`.`titulo` ASC
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
    <a class="dropdown-item" href="Proceso.Agregar.Brief.php?tipo=<?php echo $_GET[tipo];?>&retorno=<?php echo $_GET[retorno];?>&paso=1GLOBAL&categoria=<?php echo $obj->Id;?>"><?php echo $obj->titulo;?></a>

<?php } ?>

  </div>
</div>


 
<?php }else{ ?>  
  <?php 
  $sql = "
SELECT
  `Live_Brief_categorias`.`Id`,
  `Live_Brief_categorias`.`tipo`,
  `Live_Brief_categorias`.`titulo`
FROM
  `Live_Brief_categorias`
WHERE
  `Live_Brief_categorias`.`Id` = '$_GET[categoria]'
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
<?php echo $obj->titulo;?>

<?php } ?>
<?php } ?>  





	</td>
	

<td>Estado<br>
    <select name="estado" class="form-control" required>
	  <?php if($_GET[tipo]!=99){?><option value="">Por favor selecciona</option>	
<option value="1">Confirmado</option><?php } ?>
<option value="2">Por confirmar</option>
	</select>
</td>


<td>
Modalidad<br>
    <select name="modalidad" class="form-control" required>
	
    <?php  if($_GET['tipo']=='99'){?>
      <option value="1">COPARTICIPACIÓN</option>
      <option value="4">ALQUILER</option><?php } ?>
<!--<option value="1">COPARTICIPACIÓN</option>
<option value="2">Co-Exhibición Tipo 1</option>
<option value="3">Co-Exhibición Tipo 2</option>
<option value="6">Co-Exhibición Tipo 3</option>
<option value="7">Co-Producción Presencial</option>
<option value="5">Talleres Escuelas</option>
-->
<?php  if($_GET['tipo']=='1'){?><option value="1">COPARTICIPACIÓN</option><?php } ?>
<?php  if($_GET['tipo']=='4'){?><option value="4">ALQUILER</option><?php } ?>



	</select>
</td>
<TD>
  Sala<br>
<select class="form-control" name="SalaEvento" >
		<option value="">Por favor selecciona</option>	
		<option value="1">TEATRO EXPERIMENTAL</option>
		<option value="2">TEATRO PRINCIPAL</option>
		<option value="3">SALA MULTIARTES</option>
		<option value="4">SALAS DE BALLET</option>
		<option value="5">BIBLIOTECA</option>
		<option value="6">4TO PISO </option>
		<option value="7">5TO PISO EXPOSICIONES</option>
		<option value="8">OTROS //  SIN SALA</option>
		<option value="10">ESCALINATAS</option>
		<option value="11">LA TERRAZA</option>
		</select>
</TD>
</tr></table>
	
<table class="table table-bordered">
<tr><td>Titulo del evento<br>
<input type="text" name="titulo"  style="width:100%" class="form-control" required>
</td>

<td>Fecha<br><input type="date" name="fecha"  class="form-control">
</td>
<td>Hora<br><input type="time" name="HoraEvento"  class="form-control">
</td>
<td>
<?php if($_GET[tipo]=='2' ){?>
Tipo Live<br> <select name="SubTipo" class="form-control" required>
<option value="">Por favor selecciona</option>	
<option value="0">Live Pregrabado</option>
<option value="1">Live Presencial</option>
</select>
<?php } ?>

<?php if($_GET[categoria]=='19' ){?>
Tipo Alquiler Digital<br> <select name="SubTipo" class="form-control" required>
<option value="">Por favor selecciona</option>	
<option value="0">Alquiler Digital sin publico</option>
<option value="1">Alquiler Digital con  publico</option>
</select>
<?php } ?> 
</td>
</tr></table>

<!--<table class="table table-bordered">
<tr><td>¿Existe algún recurso multimedia para este evento?<br>
 <select name="carpeta" class="form-control" required>
<option value="">Por favor selecciona</option>	
<option value="0">No hay Archivos</option>
<option value="1">Archivos subidos en Google Drive</option>
<option value="2">Link de descarga externo especificado en las observaciones</option>
</select>
	

</td><td>
<?php if($_GET[categoria]!='22'){?>

Tipo de Grabación que aplica<br>

 <select name="Grabar" class="form-control" required>
<option value="">Por favor selecciona</option>	
<option value="2">No aplica Grabación</option>
<option value="1">Grabación a domicilio </option>
<option value="4">Grabación en teatro </option>
<option value="5">GoogleMeet </option>
<option value="6">Personal Externo</option>
</select>
<?php } ?>
</td>
</tr></table>-->

<table class="table table-bordered">
 <tr><td>Detalles<br>    
<code>Ingrese datos de contacto del productor.</code>
<textarea name="descripcion" class="editor" rows="10" cols="80"></textarea>
</td></tr>

 <tr><td>Requerimientos, Rider técnico<br>     
   <textarea name="observaciones"  class="editor" rows="10" cols="80"></textarea>
   </td></tr>
   </table>
   

  <button type="submit" class="btn btn-primary">Grabar y continuar</button>
</form>
<?php }  // END PASO 1 GLOBAL ?>




<?php 
/**********************
Paso 2 GLOBAL
/**************************/
if($_GET[paso]=='2GLOBAL'){

//datos del evento	
function DiaNumero ($s)
{
$a['Sunday'] = "7";
$a['Monday'] = "1";
$a['Tuesday'] = "2";
$a['Wednesday'] = "3";
$a['Thursday'] = "4";
$a['Friday'] = "5";
$a['Saturday'] = "6";
return $a[date('l', strtotime($s))];
}

$sql = "
SELECT `Live_Brief`.`Id`, 
`Live_Brief`.`titulo`, 
`Live_Brief`.`cod`, 
`Live_Brief`.`fecha`, 
`Live_Brief`.`HoraEvento`, 
`Live_Brief`.`tipo`, 
`Live_Brief`.`SubTipo`, 
`Live_Brief`.`carpeta`, 
`Live_Brief_categorias`.`titulo` AS `lbltipo`,
 `Live_Brief_categorias`.`hora`, 
 `Live_Brief_categorias`.`dia`, 
 `Live_Brief_categorias`.`periodo`,
 `Live_Brief_categorias`.`descripcion`,
 `Live_Brief`.`Grabar` FROM `Live_Brief`
  INNER JOIN 
  `Live_Brief_categorias` ON `Live_Brief_categorias`.`Id` = `Live_Brief`.`categoria` 
  WHERE 
  `Live_Brief`.`cod` = '$_GET[cod]'
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){}

$dia = DiaNumero ($obj->fecha);

Execute("INSERT INTO  `Live_Brief_Fechas` (`IdEvento`,`fecha`,`hora`,`tipodato`,`cod`)VALUES('$obj->Id','$obj->fecha','$obj->HoraEvento','$_GET[tipo]','$obj->cod')");


$fecha= explode("-",$obj->fecha);

 ?>
	
<h3><?php echo $_GET[retorno];?> <small>Paso 2</small></h3>

Comprobando detalles
<hr>
<table class="table table-bordered">
<tr><td>Evento:</td><td><?php echo $obj->titulo;?></td><td></td></tr>
<tr><td>Tipo:</td><td><?php echo $obj->lbltipo;?></td><td>
 


</td></tr>
<tr><td>Fecha:</td><td><?php echo dame_el_dia($obj->fecha);?> <?php echo fechas($obj->fecha);?></td>

<Td></td></tr>


<tr><td>Hora:</td><td><?php echo $obj->HoraEvento;?></td><td><span class="text-success"><i class="fa fa-check-square" aria-hidden="true"></i> Definida por usuario</span></td></tr>


<tr><td>Archivos:</td><td><?php switch ( $obj->carpeta) {
    case 0:  echo "No hay Archivos"; break;
    case 1: echo "En Google Drive";  break;
    case 2: echo "Link de descarga"; break;
} ?></td><td><span class="text-success"><i class="fa fa-check-square" aria-hidden="true"></i> </span></td></tr>
<tr><td>Grabación:</td><td><?php switch ( $obj->Grabar) {
     case 1: echo "Grabacion a Domicilio";  break;
    case 2: echo "No requiere grabación"; break;
    case 3: echo "Virtual / Google Meet"; break;
    case 4: echo "Grabación en teatro"; break;
} ?></td><td><span class="text-success"><i class="fa fa-check-square" aria-hidden="true"></i> </span></td></tr>
<?php if($_GET[tipo]=='2'){?>
<tr><td>Tipo LiveStreaming:</td><td><?php switch ( $obj->SubTipo) {
     case 0: echo "Pregrabado";  break;
    case 1: echo "Presencial"; break;

} ?></td><td><span class="text-success"><i class="fa fa-check-square" aria-hidden="true"></i> </span></td></tr>
<?php } ?>


</table>

<div class="alert alert-success" role="alert">
  Datos  guardados correctamente
</div>


<meta http-equiv="refresh" content="1; url=https://www.tcagye.com/2020/main.php?m=<?php echo $fecha[1];?>&y=<?php echo $fecha[0];?>">




<!--  <div class="alert alert-success" role="alert">
  Datos  guardados correctamente
</div>
Por favor indicar los siguientes datos

<form method="POST" action="Proceso.Agregar.Brief.php">
<input type="hidden" name="paso" value="2G-GLOBAL">
<input type="hidden" name="cod" value="<?php echo $obj->cod;?>">
<input type="hidden" name="Id" value="<?php echo $obj->Id;?>">
<input type="hidden" name="FechaEvento" value="<?php echo $obj->fecha;?>">
<?php if($_GET[tipo]<3){?>
<input type="hidden" name="HoraEvento" value="<?php echo $obj->hora;?>">
<?php }else{?>
<input type="hidden" name="HoraEvento" value="<?php echo $obj->HoraEvento;?>">
<?php } ?>
<input type="hidden" name="tipo" value="<?php echo $_GET[tipo];?>">
<input type="hidden" name="categoria" value="<?php echo $_GET[categoria];?>">
<input type="hidden" name="retorno" value="<?php echo $_GET[retorno];?>">

<table class="table table-bordered">
 
<?php /*if($obj->Grabar!='2'){?>
 <tr><td>Responsable grabación<br>    
 <select name="UsuarioGrabar" class="form-control" required>
<option value="">Por favor selecciona</option>	
<!--<option value="">NO APLICA</option>-->
<!--<option value="DanielQuinde">Daniel Quinde</option>-->
<option value="DeepPro">DeppPro (NO DISPONIBLE LOS MIERCOLES)</option>
<option value="JavierCornejo">Javier Cornejo (UNA SOLA CAMARA)</option>
<option value="Externo">Externo</option>
</select>
</td>
<td>Fecha de Grabación<br><input type="date" name="fechaGrabacion" class="form-control" ></td>
<td>Hora de Grabación<br><input type="time" name="HoraGrabacion" class="form-control" ></td>
   </tr>-->
  <?php } */ ?> 
      <tr>
<td>Sala <br><span class="text-danger">Llenar solo si es requerido</span></td>
<td colspan="2">
<select class="form-control" name="SalaEvento" >
		<option value="">Por favor selecciona</option>	
		<option value="1">TEATRO EXPERIMENTAL</option>
		<option value="2">TEATRO PRINCIPAL</option>
		<option value="3">SALA MULTIARTES</option>
		<option value="4">SALAS DE BALLET</option>
		<option value="5">BIBLIOTECA</option>
		<option value="6">4TO PISO </option>
		<option value="7">5TO PISO EXPOSICIONES</option>
		<option value="8">OTROS //  SIN SALA</option>
		<option value="10">ESCALINATAS</option>
		<option value="11">LA TERRAZA</option>
		</select>

</td>

</tr>

<tr>
<td>Datos Montaje <br><span class="text-danger">Llenar solo si es requerido</span></td>
<td>Fecha Montaje<br><input type="date" name="FechaMontaje" class="form-control" ></td>
<td>Hora Montaje<br><input type="time" name="HoraMontaje" class="form-control" ></td>
</tr>
<tr>
<td>Datos Ensayo <br><span class="text-danger">Llenar solo si es requerido</span></td>
<td>Fecha Ensayo<br><input type="date" name="FechaEnsayo" class="form-control" ></td>
<td>Hora Ensayo<br><input type="time" name="HoraEnsayo" class="form-control" ></td>
</tr>
   </table>
   


  <button type="submit" class="btn btn-primary">Grabar y continuar</button>
</form>-->



<?php }  // END PASO 2 GLOBAL ?>

<?php } // END ELSE ?>


<?php 
/**********************
Paso 3 GLOBAL
/**************************/
if($_GET[paso]=='3GLOBAL'){?>
<div class="alert alert-success" role="alert">
  Datos  guardados correctamente
</div>
<table class="table table-bordered">
<tr><td>
<a href="https://www.tcagye.com/2020/main.php" class="btn btn-default"><i class="fa fa-calendar" aria-hidden="true" style="font-size: 60px;"></i><br>Regresar a la Agenda</a>
</td>
<td>
<a href="https://www.tcagye.com/2020/Proceso.Imprimir.Brief.php?Id=<?php echo $_GET[Id];?>" target="_blank" class="btn btn-default"><i style="font-size: 60px;" class="fa fa-print" aria-hidden="true"></i><br>Imprimir / Ver Brief</a>
</td>
</tr></table>

<?php } ?>



<?php 

/*-------------------------------
GUARDAR PASO 1G-GLOBAL
-----------------------------*/
if($_POST[paso]=='1G-GLOBAL'){



//TRABAJAMOS LOS DATOS
 $usuario =  CurrentUserInfo("usuario");
 $descripcion = htmlentities($_POST[descripcion]);
 $observaciones = htmlentities($_POST[observaciones]);
 
 Execute("INSERT INTO  `Live_Brief` (`SalaEvento`,`tipo`,`SubTipo`,`categoria`,`titulo`,`Modalidad`,`estado`,`fecha`,`HoraEvento`,`descripcion`,`observaciones`,`carpeta`,`Grabar`,`cod`,`flog`,`UserId`) 
 VALUES ('$_POST[SalaEvento]','$_POST[tipo]','$_POST[SubTipo]','$_POST[categoria]','$_POST[titulo]','$_POST[modalidad]','$_POST[estado]','$_POST[fecha]','$_POST[HoraEvento]','$descripcion','$observaciones','$_POST[carpeta]','$_POST[Grabar]','$_POST[cod]','$_POST[flog]','$usuario')");
 


 // Redireccionar
 
   echo '<meta http-equiv="refresh" content="0; url=https://www.tcagye.com/2020/Proceso.Agregar.Brief.php?tipo='.$_POST[tipo].'&retorno='.$_POST[retorno].'&paso=2GLOBAL&cod='.$_POST[cod].'">';

} 


/*-------------------------------
GUARDAR PASO 2G-GLOBAL
-----------------------------*/
if($_POST[paso]=='2G-GLOBAL'){
	
	// Ingresando fechas
	
Execute("INSERT INTO  `Live_Brief_Fechas` (`IdEvento`,`fecha`,`hora`,`tipodato`,`cod`)VALUES('$_POST[Id]','$_POST[FechaEvento]','$_POST[HoraEvento]','$_POST[modalidad]','$_POST[cod]')");

if($_POST[fechaGrabacion]!=''){
Execute("INSERT INTO  `Live_Brief_Fechas` (`IdEvento`,`fecha`,`hora`,`tipodato`,`cod`)VALUES('$_POST[Id]','$_POST[fechaGrabacion]','$_POST[HoraGrabacion]','5','$_POST[cod]')");
}

if($_POST[FechaMontaje]!=''){
Execute("INSERT INTO  `Live_Brief_Fechas` (`IdEvento`,`fecha`,`hora`,`tipodato`,`cod`)VALUES('$_POST[Id]','$_POST[FechaMontaje]','$_POST[HoraMontaje]','6','$_POST[cod]')");
}

if($_POST[FechaEnsayo]!=''){
Execute("INSERT INTO  `Live_Brief_Fechas` (`IdEvento`,`fecha`,`hora`,`tipodato`,`cod`)VALUES('$_POST[Id]','$_POST[FechaEnsayo]','$_POST[HoraEnsayo]','7','$_POST[cod]')");
}
  

Execute("UPDATE `Live_Brief` 
 SET 
 `UsuarioGrabar`='$_POST[UsuarioGrabar]',`Productor`='1',`SalaEvento`='$_POST[SalaEvento]'
  WHERE `cod`='$_POST[cod]'");
// Redireccionar
 
   echo '<meta http-equiv="refresh" content="0; url=https://www.tcagye.com/2020/Proceso.Agregar.Brief.php?tipo='.$_POST[retorna].'&paso=3GLOBAL&cod='.$_POST[cod].'&Id='.$_POST[Id].'">';

}

?>

<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$main->terminate();
?>