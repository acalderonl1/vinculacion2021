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
<?php include_once "header.php" ?>

<?php

/***************************************************
			PARAMETROS DE INICIALIZAR reporte
/***************************************************/

if($_GET[m]==''){$m= date(m);}else{$m=$_GET[m];}
if($_GET[y]==''){$y= date(Y);}else{$y=$_GET[y];}
if($_GET[v]==''){$v= '1';}else{$v=$_GET[v];}
if($_GET[filtro]==''){$filtro = '0';}else{$filtro=$_GET[filtro];}
?>
<h3>Reporte de Ingresos</h3>
<h6>Escuelas de Arte, Cursos, Talleres y Master Class</h6>



<table class="table d-print-none"><tr>

<td>
<form class="form-inline">
<input type="hidden" name="PHPKEYID" value="<?php echo $falsekey;?>">
  <div class="form-group mx-sm-3 mb-2">
<select name="filtro" class="form-control">
<option value="0" <?php if($filtro=='0'){echo 'selected';}?>> Todos los Cursos, Talleres y/o MasterClass</option>
<option value="0" >-------------------</option>
<?php
/**************************
LISTADO FILTRO ESCUELAS
/**************************/

 $sql = "
SELECT
  `teatro13_temporada`.`esc_modalidades`.`Id`,
  `teatro13_temporada`.`esc_modalidades`.`modalidad`,
  `teatro13_temporada`.`esc_modalidades`.`conjunto`
FROM
  `teatro13_temporada`.`esc_modalidades`
ORDER BY
  `teatro13_temporada`.`esc_modalidades`.`conjunto` ASC
  
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
<option value="<?php echo $obj->Id;?>" <?php if($filtro == $obj->Id){echo 'selected';}?>> <?php echo $obj->Id?> <?php echo $obj->conjunto?> - <?php echo $obj->modalidad;?></option>
<?php } ?>
</select>
  </div>
 
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
    
    <input type="number" class="form-control" name="y" value="<?php echo $y;?>">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Generar</button>
</form></td>



</tr>
</table>




<div class="alert alert-warning" role="alert">
  Se muestran todas las transacciones realizadas.<br>
  STATUS 3 = Éxito/ Correctamente acreditado<br>
  STATUS 9 = Error / Transacción bloqueada</div>
<table class="table table-bordered" >
<tr>
<td>CODIGO DF</td>
<td>STATUS</td>
<td>CONCEPTO BENEFICIARIO</td>
<td>VALOR<BR>COBRADO</td>
<td>VALOR<BR>CURSO</td>
<td>FECHA</td>
<td>DATOS FACTURACIÓN</td>
<td>DONACIONES<BR>PAYMENTEZ</td>
</tr>

 


 <?php 
 

/**************************
REPORTE ESCUELAS
/**************************/
if($filtro>0){$sql2 ="AND `teatro13_temporada`.`esc_pagos`.`IdCurso` = '$filtro'";}else{$sql2='';}
$t=0;
   $sql = "
SELECT
  `teatro13_temporada`.`esc_pagos`.`Id`,
  `teatro13_temporada`.`esc_pagos`.`nombres`,
  `teatro13_temporada`.`esc_pagos`.`razonsocial`,
  `teatro13_temporada`.`esc_pagos`.`ruc`,
  `teatro13_temporada`.`esc_pagos`.`telefono`,
  `teatro13_temporada`.`esc_pagos`.`email`,
  `teatro13_temporada`.`esc_pagos`.`direccion`,
  `teatro13_temporada`.`esc_pagos`.`valor`,
  `teatro13_temporada`.`esc_pagos`.`flog`,
  `teatro13_temporada`.`esc_pagos`.`hlog`,
  `teatro13_temporada`.`esc_pagos`.`IdCurso`,
  `teatro13_temporada`.`esc_pagos`.`idpaymentez`,
  `teatro13_temporada`.`esc_pagos`.`reembolso`,
  `teatro13_temporada`.`esc_pagos`.`statuspaymentez`,
  `teatro13_temporada`.`esc_pagos`.`curso`,
  `teatro13_temporada`.`esc_pagos`.`mes`,
  `teatro13_temporada`.`esc_pagos`.`FormaPago`,
  `teatro13_temporada`.`esc_pagos`.`ConstanciaPago`,
  `teatro13_temporada`.`esc_pagos`.`banco`,
  `teatro13_temporada`.`esc_modalidades_precios`.`valor` AS `ValorReal`
FROM
  `teatro13_temporada`.`esc_pagos`
  INNER JOIN `teatro13_temporada`.`esc_modalidades_precios` ON
    `teatro13_temporada`.`esc_modalidades_precios`.`Id` =
    `teatro13_temporada`.`esc_pagos`.`IdValor`
WHERE
  `teatro13_temporada`.`esc_pagos`.`flog` LIKE '$y-$m-%' 
  $sql2
  
    
  
  
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
<tr>
<td><?php echo $obj->FormaPago; ?><BR>
<?php echo $obj->idpaymentez;?></td>
<td><?php echo $obj->statuspaymentez;?></td>
<td style="text-transform:uppercase">ESCUELAS DE ARTE <BR><?php echo $obj->curso;?></td>
<td><?php echo $obj->valor;?></td>
<td><span class="text-danger"><?php echo $obj->ValorReal?><br><?php echo $obj->banco;?></span></td>
<td><?php echo $obj->flog;?><br><?php echo $obj->hlog;?></td>
<td>
<table class="table table-bordered table-sm">
<tr><td>Cliente:</td><td><?php echo $obj->nombres;?></td></tr>
<tr><td>Razón Social:</td><tD><?php echo $obj->razonsocial;?></td></tr>
<tr><td>Ruc/DNI:</td><td><?php echo $obj->ruc;?></td></tr>
<tr><td>Email:</td><td><?php echo $obj->email;?></td></tr>
<tr><td>Teléfono:</td><td><?php echo $obj->telefono;?></td></tr>
<tr><td>Dirección</td><td><?php echo $obj->direccion;?></td></tr>
</table>

</td>
<td>ESCUELAS ON LINE<BR><?php echo $obj->FormaPago; ?>
<?php if($obj->ConstanciaPago != ''){?>
<br><a class="btn btn-default" href="https://www.tca.ec/images/files/2020/<?php echo $obj->ConstanciaPago;?>" target="_blank"><i class="fa fa-picture-o" aria-hidden="true"></i> Comprobante</a>
<?php } ?>
</td>
</tr>
<?php }   ?>

</table>

<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$Reporte_Escuelas->terminate();
?>