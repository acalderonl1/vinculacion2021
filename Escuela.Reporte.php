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

if($_GET[m]==''){$m= '0';}else{$m=$_GET[m];}
if($_GET[y]==''){$y= date(Y);}else{$y=$_GET[y];}

?>


<table class="table d-print-none"><tr>
<td>
<form class="form-inline">
 
  <div class="form-group mx-sm-3 mb-2">
<select name="m" class="form-control">
<option value="0" <?php if($m=='0'){echo 'selected';}?>>Todos</option>
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

<h3>Reporte Programa Social Semilleros</h3>

<table class="table table-bordered" style="width:20cm">
<tr><td>MODALIDAD</td><td>ALUMNOS BENEFICIADOS</td></tr>

 <?php 
/**************************
REPORTE DE ESCUELAS
/**************************/

if($m=='0'){
	$query= " ";
}else{
$query= "AND `teatro13_temporada`.`sem_matriculas`.`flog`   LIKE '$y-$m-%'";
  }
  
  
$t=0;
 $sql = "
SELECT
  `teatro13_temporada`.`sem_modalidades`.`Id`,
  `teatro13_temporada`.`sem_modalidades`.`modalidad`,
  Count(`teatro13_temporada`.`sem_matriculas`.`modalidad`) AS `totales`
FROM
  `teatro13_temporada`.`sem_modalidades`
  INNER JOIN `teatro13_temporada`.`sem_matriculas` ON`teatro13_temporada`. `sem_matriculas`.`modalidad` =
   `teatro13_temporada`. `sem_modalidades`.`Id`
WHERE
  `teatro13_temporada`.`sem_matriculas`.`estado` = 1
  $query
GROUP BY
 `teatro13_temporada`. `sem_modalidades`.`Id`,
  `teatro13_temporada`.`sem_modalidades`.`modalidad`,
 `teatro13_temporada`. `sem_matriculas`.`estado`

";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
<tr><td><?php echo $obj->modalidad;?></td><td><?php $t = $t+$obj->totales; echo $obj->totales;?></td></tr>
<?php } ?>
<tr><td>Total</td><td><?php echo $t;?></td></tr>
</table>

<h3>Reporte Escuelas de Arte On Line</h3>
<h4>Descuento Pacificard aplicado</h4>
<table class="table table-bordered" style="width:20cm">
<tr>
<td></td>
<td>TARJETA</td><td>VALOR</td>
<td>FECHA</td><td>HORA</td>
</tr>
 <?php 
 $count=1;
 $t=0;
/**************************
LISTADO DE TODAS LAS CLASES
Comprobamos que el alumno este matriculado
/**************************/


if($m=='0'){
	$query= " ";
}else{
$query= "AND
  `teatro13_temporada`. `esc_pagos`.`flog` LIKE '$y-$m-%'";
  }
  
  
  $sql = "
SELECT
  `teatro13_temporada`.`esc_pagos`.`Id`,
  `teatro13_temporada`.`esc_pagos`.`FormaPago`,
  `teatro13_temporada`.`esc_pagos`.`statuspaymentez`,
  `teatro13_temporada`.`esc_pagos`.`valor`,
  `teatro13_temporada`.`esc_pagos`.`banco`,
 `teatro13_temporada`. `esc_pagos`.`flog`,
 `teatro13_temporada`. `esc_pagos`.`hlog`,
 `teatro13_temporada`. `esc_pagos`.`tarjeta`
FROM
  `teatro13_temporada`.`esc_pagos`
WHERE
  `teatro13_temporada`.`esc_pagos`.`FormaPago` = 'PAYMENTEZ' AND
  `teatro13_temporada`.`esc_pagos`.`statuspaymentez` = '3' AND
 `teatro13_temporada`. `esc_pagos`.`banco` = 'BDP' 
 $query
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
<tr>
<td><?php echo $count;?></td>
<td><?php echo $obj->tarjeta;?></td><td><?php $t= $t+$obj->valor; echo $obj->valor;?></td>
<td><?php echo $obj->flog;?></td><td><?php echo $obj->hlog;?></td>
</tr>
<?php ++$count; } ?>
<tr>
<td></td><td></td><td><?php echo $t;?></td>
<td></td><td></td>
</tr>
</table>
<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$Reporte_Escuelas->terminate();
?>