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
<?php include "header.php";


if($_GET[AddTipoDato]=='5'){ 

//Execute("UPDATE `Live_Brief` SET   `Live_Brief`.`Grabar` = '2' WHERE  `Live_Brief`.`Id` ='$_GET[Id]'");

echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
Agrego un registro de grabación. Por favor debe editar los  campos
  <br>
  <br>Tipo de Grabación que aplica
  <br>Responsable grabación
  <br> en la pestaña Datos del evento, caso contrario su registro sera considerado incompleto / error
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>


';}




if($_GET[borra]!=''){
Execute("DELETE FROM `Live_Brief_Fechas` WHERE  `Live_Brief_Fechas`.`Id` = '$_GET[borra]'");
echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Registro borrado correctamente. 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
if($_GET[TipoDato]=='5'){ 

Execute("UPDATE `Live_Brief` SET   `Live_Brief`.`Grabar` = '2', `Live_Brief`.`UsuarioGrabar` = ' ' WHERE  `Live_Brief`.`Id` ='$_GET[Id]'");

echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
  Se borro un registro de grabación se ha editado automaticamente el evento  en los siguientes campos
  <br>
  <br>Tipo de Grabación que aplica: NO APLICA
  <br>Responsable grabación: NO APLICA
  
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>


';}


}

?>


 <?php
/*****************
DATOS DEL Evento
******************/
 $sql = "
SELECT
  `Live_Brief`.`Id`,
  `Live_Brief`.`tipo`,
  `Live_Brief`.`SubTipo`,
  `Live_Brief`.`categoria`,
  `Live_Brief`.`titulo`,
  `Live_Brief`.`estado`,
  `Live_Brief`.`descripcion`,
  `Live_Brief`.`observaciones`,
  `Live_Brief`.`carpeta`,
  `Live_Brief`.`UsuarioGrabar`,
  `Live_Brief`.`SalaEvento`,
  `Live_Brief`.`Grabar`,
  `Live_Brief`.`Modalidad`,
  `Live_Brief`.`Productor`,
  `Live_Brief`.`UserId`,
  `Live_Brief`.`cod`,
  `Live_Brief_categorias`.`titulo` AS `lblcategoria`,
  `Live_Brief_categorias`.`dia`,
  `Live_Brief_categorias`.`periodo`,
  `Live_Brief_categorias`.`descripcion` AS `CatDescripcion`
FROM
  `Live_Brief`
  INNER JOIN `Live_Brief_categorias` ON `Live_Brief_categorias`.`Id` =
    `Live_Brief`.`categoria`
WHERE
  `Live_Brief`.`Id` = '$_GET[Id]'
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){}
	

?>



<?php 
/*-------------------------------
FORMULARIO GLOBAL
-----------------------------*/
# Leemos datos de la categoria


?>
<h3>Editar evento: <?php echo $obj->titulo;?></small></h3>


<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link <?php if($_GET[tab]=='data'){ echo 'active';}?>" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Datos del evento</a>
  </li>
  
  <li class="nav-item" role="presentation">
    <a class="nav-link <?php if($_GET[tab]=='fecha'){ echo 'active';}?>" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Fechas</a>
  </li>

</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade <?php if($_GET[tab]=='data'){ echo 'show active';}?>" id="home" role="tabpanel" aria-labelledby="home-tab">
  <!---- DATOS DEL EVENTO --->
 

<form method="POST" action="Proceso.Editar.Brief.php" name="datosGenerales">
<input type="hidden" name="paso" value="DatosActualizar">
<input type="hidden" name="IdEvento" value="<?php echo $_GET[Id];?>">
<input type="hidden" name="tipo" value="<?php echo $_GET['tipo'];?>">

<?php if($_GET['tipo']=='reserva'){ ?>
<table class="table table-bordered">
<tr>
<td>

<div class="dropdown">
  
    Categoría: 
    <select name="categoria" class="form-control" required>
    <option value="32" selected="">PRERESERVA</option>
	</select> 


</div>

 

	</td>
	

<td>Estado <br>
    <select name="estado" class="form-control" required>
		
  <option value="2" selected="">Por confirmar</option>
	</select>
</td>


<td>
Modalidad<?php echo $obj->modalidad;?><br>
    <select name="Modalidad" class="form-control" required>
<option value="">Por favor selecciona</option>	
<option value="1" <?php echo ChekSelect($obj->Modalidad,1);?>>Colaborativo</option>
<option value="2" <?php echo ChekSelect($obj->Modalidad,2);?> >Co-Exhibición Tipo 1</option>
<option value="3" <?php echo ChekSelect($obj->Modalidad,3);?>>Co-Exhibición Tipo 2</option>
<option value="6" <?php echo ChekSelect($obj->Modalidad,6);?>>Co-Exhibición Tipo 3</option>
<option value="7" <?php echo ChekSelect($obj->Modalidad,7);?>>Co-Producción Presencial</option>
<option value="4" <?php echo ChekSelect($obj->Modalidad,4);?>>Alquiler</option>
<option value="5" <?php echo ChekSelect($obj->Modalidad,5);?>>Talleres Escuelas</option>

	</select>
</td>
</tr></table>
<?php } ?>



<?php if($_GET['tipo']==''){ ?>
<table class="table table-bordered">
<tr>
<td>

<div class="dropdown">
  
    Categoría: 
    <select name="categoria" class="form-control" required>
	<option value="">Por favor selecciona</option>	
<?php 
  $sql2 = "
SELECT
  `Live_Brief_categorias`.`Id`,
  `Live_Brief_categorias`.`tipo`,
  `Live_Brief_categorias`.`estado`,
  `Live_Brief_categorias`.`titulo`
FROM
  `Live_Brief_categorias`
WHERE

  `Live_Brief_categorias`.`estado` = '1'
  ORDER BY 
  `Live_Brief_categorias`.`titulo` ASC
";
$a2 = ExecuteRows($sql2);$b2 = json_encode($a2);$c2 = json_decode($b2);
foreach($c2 as $obj2){ ?>
<option value="<?php echo $obj2->Id;?>" <?php echo ChekSelect($obj2->Id, $obj->categoria);?> ><?php echo $obj2->titulo;?></option>
    

<?php } ?>
	</select> 


</div>

 

	</td>
	

<td>Estado <br>
    <select name="estado" class="form-control" required>
	<option value="">Por favor selecciona</option>	
<option value="1" <?php echo ChekSelect($obj->estado,1);?> >Confirmado</option>
<option value="2" <?php echo ChekSelect($obj->estado,2);?> >Por confirmar</option>
	</select>
</td>


<td>
Modalidad<?php echo $obj->modalidad;?><br>
    <select name="Modalidad" class="form-control" required>
<option value="">Por favor selecciona</option>	
<option value="1" <?php echo ChekSelect($obj->Modalidad,1);?>>Colaborativo</option>
<option value="2" <?php echo ChekSelect($obj->Modalidad,2);?> >Co-Exhibición Tipo 1</option>
<option value="3" <?php echo ChekSelect($obj->Modalidad,3);?>>Co-Exhibición Tipo 2</option>
<option value="6" <?php echo ChekSelect($obj->Modalidad,6);?>>Co-Exhibición Tipo 3</option>
<option value="7" <?php echo ChekSelect($obj->Modalidad,7);?>>Co-Producción Presencial</option>
<option value="4" <?php echo ChekSelect($obj->Modalidad,4);?>>Alquiler</option>
<option value="5" <?php echo ChekSelect($obj->Modalidad,5);?>>Talleres Escuelas</option>

	</select>
</td>
</tr></table>
<?php } ?>
	
<table class="table table-bordered">
<tr><td>Titulo del evento<br>
<input type="text" name="titulo"  style="width:100%" class="form-control" value="<?php echo $obj->titulo;?>" required>
</td>
<tr></table>
<table class="table table-bordered">
<tr>
<td>
<?php if($obj->tipo=='2' ){?>
Tipo Live<br> <select name="SubTipo" class="form-control" required>
<option value="">Por favor selecciona</option>	
<option value="0" <?php echo ChekSelect($obj->SubTipo,0);?>>Live Pregrabado</option>
<option value="1" <?php echo ChekSelect($obj->SubTipo,1);?>>Live Presencial</option>
</select>
<?php } ?>

<?php if($obj->categoria=='19' ){?>
Tipo Alquiler Digital<br> <select name="SubTipo" class="form-control" required>
<option value="">Por favor selecciona</option>	
<option value="0" <?php echo ChekSelect($obj->SubTipo,0);?>>Alquiler Digital sin publico</option>
<option value="1" <?php echo ChekSelect($obj->SubTipo,0);?>>Alquiler Digital con  publico</option>
</select>
<?php } ?> 
</td>
</tr></table>
<!--
<table class="table table-bordered">
<tr><td>¿Existe algún recurso multimedia para este evento?<br>
 <select name="carpeta" class="form-control" required>
<option value="">Por favor selecciona</option>	
<option value="0" <?php echo ChekSelect($obj->carpeta,0);?>>No hay Archivos</option>
<option value="1" <?php echo ChekSelect($obj->carpeta,1);?>>Archivos subidos en Google Drive</option>
<option value="2" <?php echo ChekSelect($obj->carpeta,2);?>>Link de descarga externo especificado en las observaciones</option>
</select>
	

</td><td>


Tipo de Grabación que aplica<br>

 <select name="Grabar" class="form-control" required>

<option value="2" <?php echo ChekSelect($obj->Grabar,2);?>>No aplica Grabación</option>
<option value="1" <?php echo ChekSelect($obj->Grabar,1);?>>Grabación a domicilio </option>
<option value="4" <?php echo ChekSelect($obj->Grabar,4);?>>Grabación en teatro </option>
<option value="5" <?php echo ChekSelect($obj->Grabar,5);?>>GoogleMeet </option>
<option value="6" <?php echo ChekSelect($obj->Grabar,6);?>>Personal Externo</option>
</select>

</td>
</tr>

</table>
-->
<table class="table table-bordered">
<!--
 <tr><td>Responsable grabación<br>    </td><td>
 <select name="UsuarioGrabar" class="form-control" required>
<option value=" " <?php echo ChekSelect($obj->UsuarioGrabar,' ');?>>NO APLICA</option>
<option value="DanielQuinde" <?php echo ChekSelect($obj->UsuarioGrabar,'DanielQuinde');?>>Daniel Quinde</option
<option value="DeepPro"<?php echo ChekSelect($obj->UsuarioGrabar,'DeepPro');?>>DeppPro</optio>
<option value="JavierCornejo" <?php echo ChekSelect($obj->UsuarioGrabar,'JavierCornejo');?>>JavierCornejo</option>
<option value="Externo" <?php echo ChekSelect($obj->UsuarioGrabar,'Externo');?>>Externo</option>
</select>
</td>

   </tr>--->

      <tr>
<td>Sala <br></td>
<td colspan="2">
<select class="form-control" name="SalaEvento" >
		
		<option value="1" <?php echo ChekSelect($obj->SalaEvento,1);?>>TEATRO EXPERIMENTAL</option>
		<option value="2" <?php echo ChekSelect($obj->SalaEvento,2);?>>TEATRO PRINCIPAL</option>
		<option value="3" <?php echo ChekSelect($obj->SalaEvento,3);?>>SALA MULTIARTES</option>
		<option value="4" <?php echo ChekSelect($obj->SalaEvento,4);?>>SALAS DE BALLET</option>
		<option value="5" <?php echo ChekSelect($obj->SalaEvento,5);?>>BIBLIOTECA</option>
		<option value="6" <?php echo ChekSelect($obj->SalaEvento,6);?>>4TO PISO </option>
		<option value="7" <?php echo ChekSelect($obj->SalaEvento,7);?>>5TO PISO EXPOSICIONES</option>
		<option value="8" <?php echo ChekSelect($obj->SalaEvento,8);?>>OTROS //  SIN SALA</option>
		<option value="10" <?php echo ChekSelect($obj->SalaEvento,10);?>>ESCALINATA</option>
    <option value="11" <?php echo ChekSelect($obj->SalaEvento,11);?>>LA TERRAZA</option>
		</select>

</td>

</tr>
</table>


<table class="table table-bordered">
 <tr><td>Descripcion del evento<br>    
<textarea name="descripcion" class="editor" rows="10" cols="80"><?php echo $obj->descripcion; ?></textarea>
</td></tr>
 <tr><td>Rider Tecnico /Observaciones<br>     
   <textarea name="observaciones"  class="editor" rows="10" cols="80"><?php echo $obj->observaciones; ?></textarea>
   </td></tr>
   </table>
   

  <button type="submit" class="btn btn-primary">Actualizar Datos Principales del Evento</button>
  <!--<a href="#" class="btn btn-danger">Borrar evento por completo</a>-->
</form>


<?php

/*-------------------------------
GUARDAR PASO ACTUALIZAR DATOS
-----------------------------*/
if($_POST[paso]=='DatosActualizar'){


 $descripcion = htmlentities($_POST[descripcion]);
 $observaciones = htmlentities($_POST[observaciones]);
 
Execute("UPDATE `Live_Brief` 

 SET 
   `Live_Brief`.`categoria` = '$_POST[categoria]',
   `Live_Brief`.`SubTipo` = '$_POST[SubTipo]',
    `Live_Brief`.`titulo` = '$_POST[titulo]',
  `Live_Brief`.`estado` = '$_POST[estado]',
  `Live_Brief`.`descripcion` = '$descripcion',
  `Live_Brief`.`observaciones` = '$observaciones',
  `Live_Brief`.`carpeta` = '$_POST[carpeta]',
  `Live_Brief`.`SalaEvento` = '$_POST[SalaEvento]',
  `Live_Brief`.`UsuarioGrabar` = '$_POST[UsuarioGrabar]',
  `Live_Brief`.`Grabar` = '$_POST[Grabar]',
  `Live_Brief`.`Modalidad` = '$_POST[Modalidad]'


  WHERE 
  
  `Live_Brief`.`Id`='$_POST[IdEvento]'");


// Redireccionar
 
 echo '<meta http-equiv="refresh" content="0; url=http://localhost/VINCULACION/Proceso.Editar.Brief.php?PHPKEYID='.$falsekey.'&Id='.$_POST[IdEvento].'&tab=data&tipo='.$_POST[tipo].'">';

}

?>


  <!--- END DATOS DEL EVENTO --->
  
  
  </div>
  
  
  
  <div class="tab-pane fade <?php if($_GET[tab]=='fecha'){ echo 'show active';}?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
 <!--- FECHAS DEL EVENTO --->



<div class="collapse" id="collapseExample">
  <div class="card card-body">
  
  <form method="POST" action="Proceso.Editar.Brief.php" name="AgregarFecha">
<input type="hidden" name="paso" value="ADD-FECHA">
<input type="hidden" name="IdEvento" value="<?php echo $obj->Id;?>">
<input type="hidden" name="tipo" value="<?php echo $_GET['tipo'];?>">
<table class="table table-bordered">
<tr>
<td>
<select class="form-control"  name="tipodato">
<?php if($_GET['tipo']==''){?>		
<option value="1" >Fecha del evento</option>
<option value="3" >Otra Categoria</option>
		<option value="10"  >Escuelas de Arte</option>
		<option value="4" >Alquiler</option>
		<option value="5" >Grabacion</option>
		<option value="6" >Montaje</option>
		<option value="7" >Ensayo</option>
    <option value="99" >PRE-RESERVA</option>
    <?php } ?>
    <?php if($_GET['tipo']=='reserva'){?>
		<option value="99" >PRE-RESERVA</option>
    <?php } ?>
		</select>
</td>
<td><input class="form-control" name="fecha" type="date"></td>
<td><input class="form-control" name="hora" type="time" ></td>
<td><input class="form-control" name="titulo" type="text"></td>
<td><button type="submit" class="btn btn-primary">Agregar</button></td>
</tr>
</table>
</form>
  </div>
</div>

	<?php
/*-------------------------------
GUARDAR PASO AGREGAR NUEVA  FECHAS
-----------------------------*/
if($_POST[paso]=='ADD-FECHA'){
 	
Execute("INSERT INTO  `Live_Brief_Fechas` (`IdEvento`,`fecha`,`hora`,`tipodato`,`titulo`) VALUES('$_POST[IdEvento]','$_POST[fecha]','$_POST[hora]','$_POST[tipodato]','$_POST[titulo]')");



// Redireccionar
 
echo '<meta http-equiv="refresh" content="0; url=http://localhost/VINCULACION/Proceso.Editar.Brief.php?PHPKEYID='.$falsekey.'&Id='.$_POST[IdEvento].'&AddTipoDato='.$_POST[tipodato].'&tab=fecha&tipo='.$_POST[tipo].'">';

}

?>

<table class="table table-bordered table-striped ">
<tr><td>Tipo</td><td>Fecha</td><td>Hora</td><td>Descripcion</td><td>  
<a class="btn btn-default" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
  <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
  </a></td></tr>
<?php

$tipo = $obj->tipo;

/*****************
DATOS DEL Evento
******************/
 $sql = "
SELECT
  `Live_Brief_Fechas`.`Id`,
  `Live_Brief_Fechas`.`IdEvento`,
  `Live_Brief_Fechas`.`fecha`,
  `Live_Brief_Fechas`.`hora`,
  `Live_Brief_Fechas`.`tipodato`,
  `Live_Brief_Fechas`.`cod`,
  `Live_Brief_Fechas`.`titulo`
FROM
  `Live_Brief_Fechas`
WHERE
  `Live_Brief_Fechas`.`IdEvento` =  '$_GET[Id]'
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){
	
?>
<form method="POST" action="Proceso.Editar.Brief.php" name="fecha<?php echo $obj->Id;?>">
<input type="hidden" name="paso" value="FechaActualizar">
<input type="hidden" name="IdFecha" value="<?php echo $obj->Id;?>">
<input type="hidden" name="IdEvento" value="<?php echo $obj->IdEvento;?>">
<input type="hidden" name="tipo" value="<?php echo $_GET['tipo'];?>">
<tr>
<td>
<select class="form-control"  name="tipodato">
		<option value="">Por favor selecciona</option>	
<?php 

/*Opciones para Alquiler */
if($tipo =='4'){

?>

		<option value="4" <?php echo ChekSelect($obj->tipodato,4);?>>Fecha Alquiler del Evento</option>
		<option value="5" <?php echo ChekSelect($obj->tipodato,5);?>>Grabacion</option>
		<option value="6" <?php echo ChekSelect($obj->tipodato,6);?>>Montaje</option>
		<option value="7" <?php echo ChekSelect($obj->tipodato,7);?>>Ensayo</option>
		
		
<?php }
if($_GET[tipo] !='reserva'){
?>		
		
		<option value="1" <?php echo ChekSelect($obj->tipodato,1);?>>Fecha del Evento</option>
		<option value="4" <?php echo ChekSelect($obj->tipodato,4);?>>Fecha Alquiler del Evento</option>
		<option value="3" <?php echo ChekSelect($obj->tipodato,3);?>>Otra Categoria</option>
		<!--<option value="10" <?php echo ChekSelect($obj->tipodato,10);?> >Escuelas de Arte</option>-->
				<option value="5" <?php echo ChekSelect($obj->tipodato,5);?>>Grabacion</option>
		<option value="6" <?php echo ChekSelect($obj->tipodato,6);?>>Montaje</option>
		<option value="7" <?php echo ChekSelect($obj->tipodato,7);?>>Ensayo</option>
    <option value="99" <?php echo ChekSelect($obj->tipodato,99);?>>Fecha Pre-Reserva</option>
		
<?php }else{?>
  <option value="99" <?php echo ChekSelect($obj->tipodato,99);?>>Fecha Pre-Reserva</option>
<?php } ?>
		</select>
</td>


<td><input class="form-control" name="fecha" type="date" value="<?php echo $obj->fecha;?>"></td>
<td><input class="form-control" name="hora" type="time" value="<?php echo $obj->hora;?>"></td>
<td><input class="form-control" name="titulo" type="text" value="<?php echo $obj->titulo;?>"></td>
<td><button type="submit" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i></button>
<a href="Proceso.Editar.Brief.php?PHPKEYID=<?php echo $falsekey;?>&Id=<?php echo $obj->IdEvento;?>&borra=<?php echo $obj->Id;?>&tab=fecha&TipoDato=<?php echo $obj->tipodato;?>&tipo=<?php echo $_GET[tipo];?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
</td>
</tr>
</form>

<?php } ?>
</table>
<!-- END FECHAS DEL EVENTO --> 
  
  
  <?php
/*-------------------------------
GUARDAR PASO ACTUALIZAR FECHAS
-----------------------------*/
if($_POST[paso]=='FechaActualizar'){

 
Execute("UPDATE `Live_Brief_Fechas`

 SET 
   
  `Live_Brief_Fechas`.`fecha` = '$_POST[fecha]',
  `Live_Brief_Fechas`.`hora` = '$_POST[hora]',
  `Live_Brief_Fechas`.`tipodato` = '$_POST[tipodato]',
  `Live_Brief_Fechas`.`titulo` = '$_POST[titulo]'
  WHERE 
   `Live_Brief_Fechas`.`Id` = '$_POST[IdFecha]'");
// Redireccionar
 
  echo '<meta http-equiv="refresh" content="0; url=http://localhost/VINCULACION/Proceso.Editar.Brief.php?PHPKEYID='.$falsekey.'&Id='.$_POST[IdEvento].'&AddTipoDato='.$_POST[tipodato].'&tab=fecha&tipo='.$_POST[tipo].'">';

}

?>
    
	

  
  </div>
  
</div>





