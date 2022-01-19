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
if($_GET[filtro]==''){$filtro= '';}else{$filtro=$_GET[filtro];}
?>
<h3>Reporte de Ingresos</h3>
<h6>Escuelas de Arte, Cursos, Talleres y Master Class</h6>



<table class="table d-print-none"><tr>

<td><div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <?php
  switch ($v) {
    case 1: echo "VER TODO"; break;
    case 2: echo "DONACIONES"; break;
    case 3: echo "ESCUELAS DE ARTE"; break;

}?>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

<a class="dropdown-item" href="Reporte.Paymentez.php?m=<?php echo $m; ?>&y=<?php echo $y; ?>&v=1" class="btn btn-default">VER TODO</a>
<a class="dropdown-item" href="Reporte.Paymentez.php?m=<?php echo $m; ?>&y=<?php echo $y; ?>&v=2" class="btn btn-default">DONACIONES</a>
<a class="dropdown-item" href="Reporte.Paymentez.php?m=<?php echo $m; ?>&y=<?php echo $y; ?>&v=3" class="btn btn-default">ESCUELAS DE ARTE</a>
<a class="dropdown-item" href="#" class="btn btn-default">ORDEN DE COBRO</a>
  </div>
</div></td><td>
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
    
    <input type="number" class="form-control" name="y" value="<?php echo $y;?>">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Generar</button>
</form></td>


<td>
<div class="btn-group" role="group" aria-label="OpcionesPaymentez">

<a href="https://dashboard.paymentez.com/ingreso" class="btn btn-success" target="_blank">Sistema de Paymentez</a>
<a href="Orden.Pago.php" class="btn btn-info" target="_blank">Orden de cobro</a>
</div>
</td>


</tr>
</table>
<?php 
/**************************
FILTRO ESCUELAS
/**************************/
if($v==3){?>
FILTRO ESCUELAS<HR>
<table>
<tr><td>
<form class="form-inline">
 
  <div class="form-group mx-sm-3 mb-2">
<select name="filtro" class="form-control">
<?php
/**************************
LISTADO FILTRO ESCUELAS
/**************************/

 $sql = "
SELECT
  `teatro13_temporada`.`esc_modalidades`.`Id`,
  `teatro13_temporada`.`esc_modalidades`.`modalidad`
FROM
  `teatro13_temporada`.`esc_modalidades`
  ;
  
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
<option value="<?php echo $obj->Id;?>" <?php if($filtro=='$obj->Id'){echo 'selected';}?>><?php echo $obj->modalidad;?></option>
<?php } ?>
</select>
  </div>

  <button type="submit" class="btn btn-primary mb-2">Generar</button>
</form>
</td></tr>
</table>
<?php } ?>


<?php 
/**************************
FILTRO DONACIONES
/**************************/
if($v==2){?>

FILTRO DONACIONES<HR>
<table>
<tr><td>
<form class="form-inline" action="Reporte.Paymentez.php" method="GET">
<input type="hidden" name="m" value ="<?php echo $_GET[m];?>">
<input type="hidden" name="y" value ="<?php echo $_GET[y];?>">
<input type="hidden" name="v" value ="<?php echo $_GET[v];?>">
 
  <div class="form-group mx-sm-3 mb-2">
<select name="filtro" class="form-control">
<option value="0" <?php if($filtro=='0'){echo 'selected';}?>>Teatro Centro de Arte</option>
<?php
/**************************
LISTADO FILTRO DONACIONES
/**************************/

 $sql = "
SELECT
  `teatro13_temporada`.`temporada`.`Id`,
  `teatro13_temporada`.`temporada`.`titulo`,
  `teatro13_temporada`.`temporada`.`fecha1`,
  `teatro13_temporada`.`temporada`.`relacion`
FROM
  `teatro13_temporada`.`temporada`
WHERE
  `teatro13_temporada`.`temporada`.`relacion` = 3 AND
   `teatro13_temporada`.`temporada`.`fecha1` LIKE '$y-$m-%' 
  
  ;
  
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
<option value="<?php echo $obj->Id;?>" <?php if($filtro==$obj->Id){echo 'selected';}?>><?php echo $obj->fecha1;?> <?php echo $obj->titulo;?></option>
<?php } ?>
</select>
  </div>

  <button type="submit" class="btn btn-primary mb-2">Generar</button>
</form>
</td></tr>
</table>
<?php 
// aplico filtros

$sqlb = "AND   `teatro13_temporada`.`donaciones`.`IdEvento` = '$filtro'"; 

} ?>




<table class="table table-bordered" >
<tr>
<td>CODIGO DF</td>
<td>STATUS</td>
<td>CONCEPTO BENEFICIARIO</td>
<td>VALOR</td>
<td></td>
<td>FECHA</td>
<td>DATOS FACTURACIÓN</td>
<td>DONACIONES<BR>PAYMENTEZ</td>
</tr>

 <?php 
 if($v!='3'){
/**************************
REPORTE DONACIONES
/**************************/




$t=0;
$sql = "
SELECT
  `teatro13_temporada`.`donaciones`.`Id`,
  `teatro13_temporada`.`donaciones`.`nombres`,
  `teatro13_temporada`.`donaciones`.`razonsocial`,
  `teatro13_temporada`.`donaciones`.`ruc`,
  `teatro13_temporada`.`donaciones`.`telefono`,
  `teatro13_temporada`.`donaciones`.`email`,
  `teatro13_temporada`.`donaciones`.`direccion`,
  `teatro13_temporada`.`donaciones`.`donacion`,
  `teatro13_temporada`.`donaciones`.`flog`,
  `teatro13_temporada`.`donaciones`.`hlog`,
  `teatro13_temporada`.`donaciones`.`idpaymentez`,
  `teatro13_temporada`.`donaciones`.`statuspaymentez`,
  `teatro13_temporada`.`donaciones`.`IdEvento`,
  `teatro13_temporada`.`donaciones`.`obra`,
      `teatro13_temporada`.`donaciones`.`reembolso`
FROM
  `teatro13_temporada`.`donaciones`
WHERE
  `teatro13_temporada`.`donaciones`.`flog` LIKE '$y-$m-%' AND
   `teatro13_temporada`.`donaciones`.`idpaymentez` !='' 
   $sqlb
  ;
  
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
<tr >
<td><?php echo $obj->idpaymentez;?></td>
<td><?php echo $obj->statuspaymentez;?></td>
<td style="text-transform:uppercase">DONACIONES A<br> <?php if($obj->obra==''){echo 'TEATRO';}else{ echo $obj->obra;}?></td>
<td><?php echo $obj->donacion;?></td>
<td><?php echo $obj->reembolso;?></td>
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
<td>DONACIONES<BR>PAYMENTEZ</td>
</tr>
<?php } } ?>


 <?php 
 
  if($v!='2'){
/**************************
REPORTE ESCUELAS
/**************************/
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
  `teatro13_temporada`.`esc_pagos`.`flog` LIKE '$y-$m-%';
  
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
<?php }  } ?>

</table>

<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$Reporte_Escuelas->terminate();
?>