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
<?php include_once "header.php";
/***************************************************
			PARAMETROS DE INICIALIZAR EL CALENDARIO
/***************************************************/

if($_GET[m]==''){$m= date(m);}else{$m=$_GET[m];}
if($_GET[y]==''){$y= date(Y);}else{$y=$_GET[y];}

?>



<table class="table d-print-none"><tr>
<td>
<form class="form-inline">
 
  <div class="form-group mx-sm-3 mb-2">
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
  </div>
  
    <div class="form-group mx-sm-3 mb-2">
    
    <input type="number" class="form-control" name="y" value="<?php echo $y;?>" style="width:80px;">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Generar</button>
</form></td>




</tr>
</table>


<table class="table table-bordered" style="width:20cm">
<tr><td>CATEGORIA</td>
<td>TITULO DEL EVENTO</td>
<td>FECHA DE TRANSMICIÓN</td>
<td>USUARIOS VIRTUALES</td>
<td>USUARIOS PRESENCIALES</td>
</tr>
 <?php 
/**************************
LISTADO DE TODAS LAS CLASES
Comprobamos que el alumno este matriculado
/**************************/
  $sql = "
SELECT
  `Live_Brief`.`Id`,
  `Live_Brief`.`tipo`,
  `Live_Brief`.`titulo`,
  `Live_Brief`.`categoria`,
  `Live_Brief_Fechas`.`tipodato`,
  `Live_Brief_Fechas`.`fecha`,
  `Live_Brief_categorias`.`titulo` AS `titulo1`,
  `Live_Brief`.`estadisticas`,
  `Live_Brief`.`estadisticas2`
FROM
  `Live_Brief`
  INNER JOIN `Live_Brief_Fechas` ON `Live_Brief_Fechas`.`IdEvento` =
    `Live_Brief`.`Id`
  INNER JOIN `Live_Brief_categorias` ON `Live_Brief_categorias`.`Id` =
    `Live_Brief`.`categoria`
WHERE
  `Live_Brief`.`tipo` = 2 AND
  `Live_Brief_Fechas`.`tipodato` = 2 AND
  `Live_Brief_Fechas`.`fecha` LIKE '$y-$m-%'
ORDER BY
  `Live_Brief_Fechas`.`fecha`
 

";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
<tr><td><?php echo $obj->titulo1; ?></td>
<td><?php echo $obj->titulo; ?></td>
<td><?php echo $obj->fecha; ?></td>
<td><?php echo $obj->estadisticas; ?></td>
<td><?php echo $obj->estadisticas2; ?></td>
</tr>
<?php } ?>
</table>
<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$Reporte_LiveStream->terminate();
?>