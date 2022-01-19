<?php
namespace PHPMaker2019\LiveBrief;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 
?>
<?php include_once "autoload.php" ?>
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
<?php include("systeatro2020.php"); 

/***************************************************
			PARAMETROS DE INICIALIZAR EL CALENDARIO
/***************************************************/

if($_GET[m]==''){$m= date(m);}else{$m=$_GET[m];}
if($_GET[y]==''){$y= date(Y);}else{$y=$_GET[y];}?>


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


<H1>Facturas, Retenciones emitidas</H1>
<hr>
<table class="table table-bordered">
<tr><td>Tipo</td><td>Secuencial</td><td>Emitido a</td><td>Identificacion</td><td>Fecha de emisión</td><td>Número y Clave de Autorizacion</td><td></td><tr>
<?php

 $datos = "SELECT
  `teatro13_efacturas`.`xmldocumentos`.`Id`,
  `teatro13_efacturas`.`xmldocumentos`.`tipo`,
  `teatro13_efacturas`.`xmldocumentos`.`ruc`,
  `teatro13_efacturas`.`xmldocumentos`.`archivo`,
  `teatro13_efacturas`.`xmldocumentos`.`secuencial`,
  `teatro13_efacturas`.`xmldocumentos`.`nombre`,
  `teatro13_efacturas`.`xmldocumentos`.`femision`,
  `teatro13_efacturas`.`xmldocumentos`.`valor`,
  `teatro13_efacturas`.`xmldocumentos`.`presecuencial`
FROM
  `teatro13_efacturas`.`xmldocumentos`
WHERE  
  `teatro13_efacturas`.`xmldocumentos`.`femision` LIKE '$y-$m-%';
  
  
  "
  
  ;
$all_rows = ExecuteRows($datos);
$json_result = json_encode( $all_rows );
$array = json_decode($json_result);
foreach($array as $obj){


?>
<tr>
<td> <?php if($obj->tipo =='01'){ echo'FACTURA';}?> <?php if($obj->tipo =='07'){ echo'RETENCION';}?></td>
<td><?php echo $obj->secuencial;?></td>
<td><?php echo $obj->nombre;?></td>
<td><?php echo $obj->ruc;?></td>

<td><?php echo $obj->femision;?></td>
<td><?php echo substr($obj->archivo,0, -4);?></td>
<td>
  <!-- archivo xnml -->
  <a href="https://www.facturas.tcagye.com/RideTotal/ComprobantesAutorizados/descarga.php?f=<?php echo $obj->archivo;?>" class="btn btn-default">XML</a>
  <!-- genera PDF -->
  <?php if($obj->tipo =='01'){ ?>
    <a href="https://www.facturas.tcagye.com/xmltopdf/PDF.Facturas.php?archivo=<?php echo $obj->archivo;?>" target="_blank" class="btn btn-default">PDF</a>
  <?php } ?>
  
     <?php if($obj->tipo =='07'){ ?>
<a href="https://www.facturas.tcagye.com/xmltopdf/PDF.Retenciones.php?archivo=<?php echo $obj->archivo;?>" target="_blank" class="btn btn-default">PDF</a>
  <?php } ?>


</td>

<?php } ?>
</table>
<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$main->terminate();
?>