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






<?php 


if($_GET[IdEvento]!=''){
Execute("UPDATE `Live_Brief` SET   `Live_Brief`.`estadisticas` = '$_GET[cantidad]', `Live_Brief`.`estadisticas2` = '$_GET[cantidad2]' WHERE  `Live_Brief`.`Id` ='$_GET[IdEvento]'");
echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
 Estadisticas actualizadas correctamente
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>


<script>
//alert("SISTEMA EN MANTENIMIENTO, SE PUEDE AGREGAR NUEVOS, NO SE PUEDE EDITAR O ELIMINAR");
</script>
<?php 


/***************************************************
			SABER DIA DE LA SEMANA
/***************************************************/


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

function textoDia ($s)
{
$a['Sunday'] = "Domingo";
$a['Monday'] = "Lunes";
$a['Tuesday'] = "Martes";
$a['Wednesday'] = "Miercoles";
$a['Thursday'] = "Jueves";
$a['Friday'] = "Viernes";
$a['Saturday'] = "Sabado";
return $a[date('l', strtotime($s))];
}


 $sql = "SELECT
  `Live_Brief_categorias`.`Id`,
  `Live_Brief_categorias`.`tipo`,
  `Live_Brief_categorias`.`titulo`,
  `Live_Brief_categorias`.`hora`,
  `Live_Brief_categorias`.`periodo`,
  
  `Live_Brief_categorias`.`dia`
FROM
  `Live_Brief_categorias`
WHERE

 `Live_Brief_categorias`.`tipo` = '2'
  ;";
$a = ExecuteRows($sql);
$b = json_encode( $a );
$c = json_decode($b);

foreach($c as $tmp){ } 



/***************************************************
			PARAMETROS DE INICIALIZAR EL CALENDARIO
/***************************************************/

if($_GET[m]==''){$m= date(m);}else{$m=$_GET[m];}
if($_GET[y]==''){$y= date(Y);}else{$y=$_GET[y];}




?>
<form class="form-inline sticky-top" style="background:#fff">
<input type="hidden" name="PHPKEYID" value="<?php echo $falsekey;?>">


<table class="table d-print-none"><tr>
<td>

DESDE:
   
   
<select name="m" class="form-control">
<option value="01" <?php if($m=='01'){echo 'selected';}?>>ENERO</option>
<option value="02" <?php if($m=='02'){echo 'selected';}?>>FEBRERO</option>
<option value="03" <?php if($m=='03'){echo 'selected';}?>>MARZO</option>
<option value="04" <?php if($m=='04'){echo 'selected';}?>>ABRIL</option>
<option value="05" <?php if($m=='05'){echo 'selected';}?>>MAYO</option>
<option value="06" <?php if($m=='06'){echo 'selected';}?>>JUNIO</option>
<option value="07" <?php if($m=='07'){echo 'selected';}?>>JULIO</option>
<option value="08" <?php if($m=='08'){echo 'selected';}?>>AGOSTO</option>
<option value="09" <?php if($m=='09'){echo 'selected';}?>>SEPTIEMBRE</option>
<option value="10" <?php if($m=='10'){echo 'selected';}?>>OCTUBRE</option>
<option value="11" <?php if($m=='11'){echo 'selected';}?>>NOVIEMBRE</option>
<option value="12" <?php if($m=='12'){echo 'selected';}?>>DICIEMBRE</option>
</select>
<input type="number" class="form-control" name="y" value="<?php echo $y;?>" style="width:80px;">


 <button type="submit" class="btn btn-default">Generar</button>
 





</td>

</tr>
</table>
</form>

<table class="table table-bordered table-sm" style="text-transform:uppercase">
<tr>
<td></td>
<td>Evento</td>
<td>Fecha</td>
<td>Hora</td>
<td>Sala</td>
<td>Tipo</td>

</tr>



<?php
$finicial = $_GET['y'].'-'.$_GET['m'].'-01';
/**************************************
 NUEVO CALENDARIO 2020 LIVE
/**************************************/

 $sql = "
SELECT
  `Live_Brief_Fechas`.`IdEvento`,
  `Live_Brief_Fechas`.`fecha`,
  `Live_Brief_Fechas`.`hora`,
  `Live_Brief_Fechas`.`tipodato`,
  `Live_Brief_Fechas`.`titulo`,
  `Live_Brief`.`Id`,
  `Live_Brief`.`tipo`,
  `Live_Brief`.`SubTipo`,
  `Live_Brief`.`categoria`,
  `Live_Brief`.`titulo`,
  `Live_Brief`.`estado`,
  `Live_Brief`.`estadisticas`,
  `Live_Brief`.`estadisticas2`,
  `Live_Brief`.`SalaEvento`,
  `Live_Brief`.`UsuarioGrabar`,
  `Live_Brief`.`Grabar`,
  `Live_Brief`.`Modalidad`,
  `Live_Brief`.`UserId`,
  `Live_Brief_categorias`.`titulo` AS `lblcategoria`,
  `Live_Brief_Fechas`.`titulo` AS `ObservacionFecha`,
  `Live_Brief_categorias`.`dia`,
  `Live_Brief_categorias`.`periodo`,
  `Live_Brief_Fechas`.`Id` AS `FechaId`
FROM
  `Live_Brief_Fechas`
  INNER JOIN `Live_Brief` ON `Live_Brief`.`Id` = `Live_Brief_Fechas`.`IdEvento`
  INNER JOIN `Live_Brief_categorias` ON `Live_Brief_categorias`.`Id` =
    `Live_Brief`.`categoria`
WHERE
`Live_Brief_Fechas`.`fecha` BETWEEN '$finicial' AND '2021-12-31'
ORDER BY
`Live_Brief_Fechas`.`fecha` ASC

;";
$a = ExecuteRows($sql);
$b = json_encode( $a );
$c = json_decode($b);

foreach($c as $tmp){
?>

<?php  #-------- OTRO TIPO 
if($tmp->tipodato =='3'&& $tmp->categoria!='21'){?>
<tr>
<td></td>
<td><?php echo $tmp->titulo;?>
<br>
<?php echo $tmp->lblcategoria;?>
</td>
<td><?php echo dame_el_dia($tmp->fecha);?> <?php echo fechas($tmp->fecha);?></td>
<td><?php echo $tmp->hora;?></td>
<td><?php echo sala($tmp->SalaEvento);?></td>
<td>NO DEFINIDO</td>


</tr>

<?php } ?>

<?php  #-------- LALQUILER

if($tmp->tipodato =='4'){?>
<tr>
<td></td>
<td><?php echo $tmp->titulo;?>
<br>
<?php echo $tmp->lblcategoria;?>
</td>
<td><?php echo dame_el_dia($tmp->fecha);?> <?php echo fechas($tmp->fecha);?></td>
<td><?php echo $tmp->hora;?></td>
<td><?php echo sala($tmp->SalaEvento);?></td>
<td>ALQUILER</td>


</tr>

<?php } ?>
<?php  # -- EVENTOS DEL TEATRO
 $Activo = 1;
if($tmp->tipodato =='5'){$Activo = 0;}
if($tmp->tipodato =='6'){$Activo = 0;}
if($tmp->tipodato =='7'){$Activo = 0;}

if($tmp->tipo !='4' && $Activo ==1){?>
<tr>
<td></td>
<td><?php echo $tmp->titulo;?>
<br>
<?php echo $tmp->lblcategoria;?>
</td>
<td><?php echo dame_el_dia($tmp->fecha);?> <?php echo fechas($tmp->fecha);?></td>
<td><?php echo $tmp->hora;?></td>
<td><?php echo sala($tmp->SalaEvento);?></td>
<td>PROPIO / CO-PRODUCCION</td>


</tr>

<?php } ?>
<?php } ?>

</table>

  



</td></tr></table>
<p>Datos impresos el <?php echo $hoy;?></p>
<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$main->terminate();
?>