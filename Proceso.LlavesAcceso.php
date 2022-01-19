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
$Reporte_Escuelas = new Reporte_Escuelas();

// Run the page
$Reporte_Escuelas->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php" ?>

<h3>Eventos Activos</h3>

<table class="table table-bordered" style="width:20cm">

<tr>
<td></td>
<td>Evento</td>
<td>Fecha</td>
<td>Llave de Acceso</td>
</tr>
 <?php 
/**************************
REPORTE DE ESCUELAS
/**************************/

  $sql = "
SELECT
  `teatro13_temporada`.`temporada`.`Id`,
  `teatro13_temporada`.`temporada`.`titulo`,
  `teatro13_temporada`.`temporada`.`fecha1`,
  `teatro13_temporada`.`temporada`.`LlaveAcceso`,
  `teatro13_temporada`.`temporada`.`front`

FROM
  `teatro13_temporada`.`temporada`
WHERE
  `teatro13_temporada`.`temporada`.`front` = 1
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
<tr>
<td><?php echo $obj->Id;?></td>
<td><?php echo $obj->titulo;?></td>
<td><?php echo $obj->fecha1;?></td>
<td><?php echo $obj->LlaveAcceso;?></td>
</tr>
<?php } ?>

</table>


<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$Reporte_Escuelas->terminate();
?>