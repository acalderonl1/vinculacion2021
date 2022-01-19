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



?>


<!-- scrollToTop -->
<!-- ================ -->
<div class="scrollToTop circle"><i class="fa fa-angle-up"></i></div>


<!-- page wrapper start -->
<!-- ================ -->
	  <div id="page-start"></div>

	  <div class="row">
<div class="col d-print-none">

<h4>Próximos eventos</h4>

		<table class="table table-bordered table-hover">
<tr>
<td></td>
<td></td>
<td>Evento</td>
<td>Fecha</td>
<td>Hora</td>



</tr>
	
		<?php 
		
		$datos = "SELECT
    `teatro13_temporada`.`temporada`.`Id`,
    `teatro13_temporada`.`temporada`.`titulo`,
    `teatro13_temporada`.`temporada`.`fecha1`,
    `teatro13_temporada`.`temporada`.`hora1`,
    `teatro13_temporada`.`temporada`.`carpeta`,
    `teatro13_temporada`.`temporada`.`foto`,
    `teatro13_temporada`.`temporada`.`e_ticket`
  FROM
    `teatro13_temporada`.`temporada`
	  WHERE
		  `teatro13_temporada`.`temporada`.`e_ticket` !='1'";
	   $a = ExecuteRows($datos);
	   $b = json_encode($a);
	   $c = json_decode($b);
	   foreach($c as $obj){


		?>

		<tr>
			
     
		<td>


</td>
<td style="width:120px">
<a href="http://localhost/VINCULACION/Taquilla.php?evento=<?php echo $obj->Id; ?>" class="btn btn-primary"> <i class="fa fa-eye" aria-hidden="true"></i></a>
</TD>

			<td><?php echo $obj->titulo; ?></td>
			<td><?php echo dame_el_dia($obj->fecha1); echo ' '; echo fechas($obj->fecha1); ?></td>
			<td><?php echo $obj->hora1; ?></td>
	
		</tr>


		<?php } ?>
	   </table>
</div>

<div class="col">

<div class="d-none d-print-block">
<img id="logo_img" src="https://www.tca.ec/images/2019/Logo-Teatro-Centro-de-Arte.svg" alt="Teatro Centro de Arte León Febres-Cordero" style="width:160px;">
<hr>

</div>
<?php 
  $DataEvento = ExecuteRow("SELECT
    `teatro13_temporada`.`temporada`.`Id`,
    `teatro13_temporada`.`temporada`.`fecha1`,
    `teatro13_temporada`.`temporada`.`hora1`,
    `teatro13_temporada`.`temporada`.`titulo`,
    `teatro13_temporada`.`temporada`.`foto_slider`,
    `teatro13_temporada`.`temporada`.`carpeta`,
    `teatro13_temporada`.`temporada`.`front`
FROM
`teatro13_temporada`.`temporada`
WHERE
    `teatro13_temporada`.`temporada`.`Id` = $_GET[evento] ");
?>

<a href="#"  onclick="window.print()" class="btn btn-primary d-print-none"> <i class="fa fa-print" aria-hidden="true"></i> Imprimir Reporte</a>
<table class="table table-bordered">

  <tr>
    <td>Evento:</td>
    <td><h2><?php echo $DataEvento['titulo'];?></h2></td>
  </tr>
  <tr>
    <td>Fecha:</td>
    <td><?php echo dame_el_dia($DataEvento['fecha1']); echo ' '; echo fechas($DataEvento['fecha1']); ?></td>
  </tr>
  <tr>
    <td>Hora:</td>
    <td><?php echo horas($DataEvento['hora1']);?></td>
  </tr>
  <tr>
    <td>Boletos:</td>
    <td>

	<?php 
/*---------------------------
COSTOS DE LOS Boletos
------------------------------*/
$ValidadorCosto = 0;
$ValidadorCosto = ExecuteScalar("SELECT
  Count(  `teatro13_temporada`.`eventos_precios`..`Id`) AS `total`
FROM
  `eventos_precios`
WHERE
    `teatro13_temporada`.`eventos_precios`..`id_evento` = '$_GET[evento]' ");

if($ValidadorCosto>0){
 $datos2 = "
 SELECT
    `teatro13_temporada`.`eventos_precios`..`id_evento`,
    `teatro13_temporada`.`eventos_precios`..`boleto`,
    `teatro13_temporada`.`eventos_precios`..`costo`
FROM
`teatro13_temporada`.`eventos_precios`
WHERE
    `teatro13_temporada`.`eventos_precios`..`id_evento` = $_GET[evento]";
$all_rows2 = ExecuteRows($datos2);
$json_result2 = json_encode($all_rows2);
$array2 = json_decode($json_result2);
foreach($array2 as $entradas){
	$valor= $entradas->boleto;
	echo   '<i class="fa fa-ticket" aria-hidden="true"></i> '.$entradas->boleto.' '.moneda($entradas->costo).'<br>'; 
} } ?>  </td>
  </tr>

</table>

<?php 


#-- Efectivo
$Efectivo = ExecuteRow("SELECT Sum(  `teatro13_temporada`.`boleteria_pagos`.`valor`) AS `total`, Sum(  `teatro13_temporada`.`boleteria_pagos`.`boletos`) AS `boletos` FROM `teatro13_temporada`.`boleteria_pagos` WHERE   `teatro13_temporada`.`boleteria_pagos`.`IdEvento` = '$_GET[evento]' AND   `teatro13_temporada`.`boleteria_pagos`.`statuspaymentez` = 3 AND   `teatro13_temporada`.`boleteria_pagos`.`tipo` = 'EFECTIVO'");
$Tarjeta = ExecuteRow("SELECT Sum(  `teatro13_temporada`.`boleteria_pagos`.`valor`) AS `total`, Sum(  `teatro13_temporada`.`boleteria_pagos`.`boletos`) AS `boletos` FROM `teatro13_temporada`.`boleteria_pagos` WHERE   `teatro13_temporada`.`boleteria_pagos`.`IdEvento` = '$_GET[evento]' AND   `teatro13_temporada`.`boleteria_pagos`.`statuspaymentez` = 3 AND   `teatro13_temporada`.`boleteria_pagos`.`tipo` = 'TARJETA'");
$Paymentez = ExecuteRow("SELECT Sum(  `teatro13_temporada`.`boleteria_pagos`.`valor`) AS `total`, Sum(  `teatro13_temporada`.`boleteria_pagos`.`boletos`) AS `boletos` FROM `teatro13_temporada`.`boleteria_pagos` WHERE   `teatro13_temporada`.`boleteria_pagos`.`IdEvento` = '$_GET[evento]' AND   `teatro13_temporada`.`boleteria_pagos`.`statuspaymentez` = 3 AND   `teatro13_temporada`.`boleteria_pagos`.`tipo` = 'PAYMENTEZ'");
$Cortesias = ExecuteRow("SELECT Sum(  `teatro13_temporada`.`boleteria_pagos`.`valor`) AS `total`, Sum(  `teatro13_temporada`.`boleteria_pagos`.`boletos`) AS `boletos` FROM `teatro13_temporada`.`boleteria_pagos` WHERE   `teatro13_temporada`.`boleteria_pagos`.`IdEvento` = '$_GET[evento]' AND   `teatro13_temporada`.`boleteria_pagos`.`statuspaymentez` = 3 AND   `teatro13_temporada`.`boleteria_pagos`.`tipo` = 'CORTESIA'");
$Bloqueos = ExecuteRow("SELECT Sum(  `teatro13_temporada`.`boleteria_pagos`.`valor`) AS `total`, Sum(  `teatro13_temporada`.`boleteria_pagos`.`boletos`) AS `boletos` FROM `teatro13_temporada`.`boleteria_pagos` WHERE   `teatro13_temporada`.`boleteria_pagos`.`IdEvento` = '$_GET[evento]' AND   `teatro13_temporada`.`boleteria_pagos`.`statuspaymentez` = 3 AND   `teatro13_temporada`.`boleteria_pagos`.`tipo` = 'BLOQUEO'");

$Taquilla =  $Efectivo['boletos']+$Tarjeta['boletos']+ $Paymentez['boletos']+$Cortesias['boletos']+$Bloqueos['boletos']; 
$Venta =  $Efectivo['total']+ $Tarjeta['total']+ $Paymentez['total']+ $Cortesias['total']+$Bloqueos['total']; 



?>


<table class="table table-bordered table-hover">
<tr><td>Tipo</td><td>Cantidad</td><td>Valor</td></tr>
<tr><td>EFECTIVO</td><td><?php  echo $Efectivo['boletos']; ?></td><td><?php echo $Efectivo['total']; ?></td></tr>
<tr><td>TARJETA</td><td><?php echo $Tarjeta['boletos']; ?></td><td><?php echo $Tarjeta['total']; ?></td></tr>
<tr><td>WEB</td><td><?php echo $Paymentez['boletos']; ?></td><td><?php echo $Paymentez['total']; ?></td></tr>
<tr><td>CORTESIAS</td><td><?php echo $Cortesias['boletos']; ?></td><td><?php echo $Cortesias['total']; ?></td></tr>
<tr><td>BLOQUEOS</td><td><?php echo $Bloqueos['boletos']; ?></td><td><?php echo $Bloqueos['total']; ?></td></tr>
<tr><td>TOTAL</td><td><?php echo $Taquilla; ?></td><td>$ <?php echo $Venta ?></td></tr>


</tr>
	
	   </table>


	   <h4>Detalle de ventas</h4>

	   <table class="table table-bordered table-sm">
		   <tr>
			   <td>#</td>
			   <td>Tipo</td>
			   <td>Nombres</td>
			   <td>Telefono</td>
			   <td>E-mail</td>
			   <td>Boletos</td>
		</tr>
		
		<?php 
		
		$datos = "SELECT
		  `teatro13_temporada`.`boleteria_pagos`.`Id`,
		  `teatro13_temporada`.`boleteria_pagos`.`nombres`,
		  `teatro13_temporada`.`boleteria_pagos`.`telefono`,
		  `teatro13_temporada`.`boleteria_pagos`.`email`,
		  `teatro13_temporada`.`boleteria_pagos`.`IdEvento`,
		  `teatro13_temporada`.`boleteria_pagos`.`statuspaymentez`,
		  `teatro13_temporada`.`boleteria_pagos`.`boletos`,
		  `teatro13_temporada`.`boleteria_pagos`.`sillas`,
		  `teatro13_temporada`.`boleteria_pagos`.`tipo`,
		  `teatro13_temporada`.`boleteria_pagos`.`idpaymentez`,
		  `teatro13_temporada`.`boleteria_pagos`.`codauto`,
		  `teatro13_temporada`.`boleteria_pagos`.`tarjeta`
	  FROM
		`teatro13_temporada`.`boleteria_pagos`
	  WHERE
		  `teatro13_temporada`.`boleteria_pagos`.`IdEvento` = $_GET[evento] AND
		  `teatro13_temporada`.`boleteria_pagos`.`statuspaymentez` = 3";
	   $a = ExecuteRows($datos);
	   $b = json_encode($a);
	   $c = json_decode($b);
	   foreach($c as $obj){


		?>
		   <tr>
			   <td></td>
			   <td><?php echo $obj-> tipo;?></td>
			   <td><?php echo $obj-> idpaymentez;?></td>
			   <td><?php echo $obj-> codauto;?></td>
			   <td><?php echo $obj-> tarjeta;?></td>
			   <td><?php echo $obj-> nombres;?></td>
			   <td><?php echo $obj-> telefono;?></td>
			   <td><?php echo $obj-> email;?></td>
			   <td><?php echo $obj-> boletos;?></td>
		</tr>
		<?php } ?>
	   </table>



</div>
	  </div>


<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$Reporte_Escuelas->terminate();
?>