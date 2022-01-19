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


 
 $Archivo = $_GET[grupo];

?>




Elija un archivo para mostrar
<form>
<input type="hidden" name="PHPKEYID" value="<?php echo $falsekey;?>" />
  
  <table><tr><td>
    <select name="grupo" class="form-control">
	 <?php 
/**************************
Archivos Procesados
/**************************/

  $sql = "
SELECT
  `Finanzas_Archivos`.`Id`,
  `Finanzas_Archivos`.`archivo`,
  `Finanzas_Archivos`.`fecha`
FROM
  `Finanzas_Archivos`
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
	<option value="<?php echo $obj->Id;?>">ARCHIVO: <?php echo $obj->archivo;?>  INGRESADO EL: <?php echo $obj->fecha;?></option>
<?php } ?>

	</select>
</td><td>
  <button type="submit" class="btn btn-primary">Mostrar</button>

  </td><td>
  
<?php if($Archivo==''){?>
    <a class="btn btn-success" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
   Agregar un Excel
  </a>


<?php } ?>
  </td></tr></table>
</form>



<?php if($Archivo==''){?>
  
  <div class="collapse" id="collapseExample">
  <div class="card card-body">
    <iframe src="http://localhost/VINCULACION/core/Finanzas_Archivosadd.php" frameborder="0" style="    height: 350px;
    width: 100%;
}"></iframe>
  </div>
</div>
<?php } ?>

<?php if($Archivo!=''){
 
// Datos del Archivo Procesado

 $sql = "
SELECT
  `Finanzas_Archivos`.`Id`,
  `Finanzas_Archivos`.`archivo`,
  `Finanzas_Archivos`.`Saldo`,
  `Finanzas_Archivos`.`Estado`,
  `Finanzas_Archivos`.`fecha`
FROM
  `Finanzas_Archivos`
WHERE
 `Finanzas_Archivos`.`Id` = $Archivo

";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){} 

if($_GET[Proceso] =='1'){ Execute("UPDATE  `Finanzas_Archivos` SET  `Finanzas_Archivos`.`Estado`='1'  WHERE `Finanzas_Archivos`.`Id` = '$Archivo'");  }

if($obj->Estado =='0' ){
?>
<a href="../ProcesaBanco.php?file=data/excel/<?php echo $obj->archivo;?>&Id=<?php echo $obj->Id;?>"> Si no observa datos Clic aqui para  procesar el archivo.  <b>Usar solo una vez</b><a/>
<?php }
$Archivo = $obj->fecha;

?>

<h3>Informe</h3>







<table>
<tr><td>
<div style="    display: block;
    width: 750px;
    overflow: scroll;
    height: 500px;">

  
<table class="table table-bordered" >

<tr>
<td></td>
<td>Fecha Contable</td>
<td>Lugar</td>
<td>Mes</td>
<td>Tipo</td>
<td>NUT</td>
<td>Valor</td>
<td>Numero</td>
<td>Concepto</td>
<td>Saldo Movimiento</td>
<td>Descripcion</td>
<td>Fecha Real</td>
<td>Subido el </td>
</tr>
 <?php 
/**************************
REPORTE DE ESCUELAS
/**************************/

  $sql = "
SELECT
  `Finanzas_Banco`.`Id`,
  `Finanzas_Banco`.`FechaContable`,
  `Finanzas_Banco`.`lugar`,
  `Finanzas_Banco`.`mes`,
  `Finanzas_Banco`.`tipo`,
  `Finanzas_Banco`.`nut`,
  `Finanzas_Banco`.`valor`,
  `Finanzas_Banco`.`numero`,
  `Finanzas_Banco`.`concepto`,
  `Finanzas_Banco`.`SaldoMovimiento`,
  `Finanzas_Banco`.`descripcion`,
  `Finanzas_Banco`.`FechaReal`,
  `Finanzas_Banco`.`grupo`
FROM
  `Finanzas_Banco`
WHERE
  `Finanzas_Banco`.`grupo` ='$Archivo'
ORDER BY    `Finanzas_Banco`.`Id` ASC
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
<tr>
<td><?php echo $obj->Id;?></td>
<td><?php echo $obj->FechaContable;?></td>
<td><?php echo $obj->lugar;?></td>
<td><?php echo $obj->mes;?></td>
<td><?php echo $obj->tipo;?></td>
<td><?php echo $obj->nut;?></td>
<td><?php echo $obj->valor;?></td>
<td><?php echo $obj->numero;?></td>
<td><?php echo $obj->concepto;?></td>
<td><?php echo $obj->SaldoMovimiento;?></td>
<td><?php echo $obj->descripcion;?></td>
<td><?php echo $obj->FechaReal;?> </td>
<td><?php echo $obj->grupo;?> </td>
</tr>
<?php } ?>

</table>
  </div>
</td>
<td valign="top">



 <?php 

 #--Configuracion de meses 
  $mes1 = ExecuteScalar("SELECT  `Finanzas_Banco`.`mes` FROM `Finanzas_Banco` WHERE `Finanzas_Banco`.`grupo` = '$Archivo' ORDER BY `Finanzas_Banco`.`mes`");
 $mes2 = ExecuteScalar("SELECT `Finanzas_Banco`.`mes` FROM  `Finanzas_Banco` WHERE `Finanzas_Banco`.`grupo` = '$Archivo' ORDER BY `Finanzas_Banco`.`mes` DESC"); 
 
 /*echo $mes1 = ("SELECT  `Finanzas_Banco`.`mes` FROM `Finanzas_Banco` WHERE `Finanzas_Banco`.`grupo` = '$Archivo' ORDER BY `Finanzas_Banco`.`mes`");
 echo $mes2 = ("SELECT `Finanzas_Banco`.`mes` FROM  `Finanzas_Banco` WHERE `Finanzas_Banco`.`grupo` = '$Archivo' ORDER BY `Finanzas_Banco`.`mes` DESC");
 */
#-- Fechas del Informe
 $FechaInicial = ExecuteScalar("SELECT    `Finanzas_Banco`.`FechaContable` FROM `Finanzas_Banco` WHERE `Finanzas_Banco`.`grupo` = '$Archivo' ORDER BY  `Finanzas_Banco`.`FechaContable`");
 $FechaConsolidacion  = ExecuteScalar("SELECT `Finanzas_Banco`.`FechaContable`  FROM  `Finanzas_Banco` WHERE `Finanzas_Banco`.`grupo` = '$Archivo' ORDER BY  `Finanzas_Banco`.`FechaContable` DESC");
  

  
#-- Valores para saldo inicial
    $row = ExecuteRow("  SELECT
  `Finanzas_Banco`.`Id`,
  `Finanzas_Banco`.`mes`,
  `Finanzas_Banco`.`valor`,
  `Finanzas_Banco`.`SaldoMovimiento`
FROM
  `Finanzas_Banco`
WHERE
  `Finanzas_Banco`.`mes` = '$mes1'
AND
  `Finanzas_Banco`.`grupo` ='$Archivo'
  ORDER BY    `Finanzas_Banco`.`Id` ASC
  LIMIT 1");

$SaldoIncial = $row[valor] +  $row[SaldoMovimiento];

 $SaldoBdP = ExecuteScalar("SELECT `Finanzas_Archivos`.`Saldo` FROM `Finanzas_Archivos` WHERE `Finanzas_Archivos`.`fecha` = '$Archivo'");
 
 #--- Valores 
 
 $DEP1 = ExecuteScalar("SELECT Sum(`Finanzas_Banco`.`valor`) FROM `Finanzas_Banco` WHERE `Finanzas_Banco`.`mes` = '$mes1' AND `Finanzas_Banco`.`tipo` = 'DEP' AND `Finanzas_Banco`.`grupo` ='$Archivo'");
 $DEP2 = ExecuteScalar("SELECT Sum(`Finanzas_Banco`.`valor`) FROM `Finanzas_Banco` WHERE `Finanzas_Banco`.`mes` = '$mes2' AND `Finanzas_Banco`.`tipo` = 'DEP' AND `Finanzas_Banco`.`grupo` ='$Archivo'");
 $DEPACUMULADO = ExecuteScalar("SELECT Sum(`Finanzas_Banco`.`valor`) AS `Sum_valor` FROM  `Finanzas_Banco` WHERE `Finanzas_Banco`.`grupo` = '$Archivo' AND `Finanzas_Banco`.`tipo` = 'DEP'");
 
 $NC1 = ExecuteScalar("SELECT Sum(`Finanzas_Banco`.`valor`) FROM `Finanzas_Banco` WHERE `Finanzas_Banco`.`mes` = '$mes1' AND `Finanzas_Banco`.`tipo` = 'N/C' AND `Finanzas_Banco`.`grupo` ='$Archivo'");
 $NC2 = ExecuteScalar("SELECT Sum(`Finanzas_Banco`.`valor`) FROM `Finanzas_Banco` WHERE `Finanzas_Banco`.`mes` = '$mes2' AND `Finanzas_Banco`.`tipo` = 'N/C' AND `Finanzas_Banco`.`grupo` ='$Archivo'");
 $NCACUMULADO = ExecuteScalar("SELECT Sum(`Finanzas_Banco`.`valor`) AS `Sum_valor` FROM  `Finanzas_Banco` WHERE `Finanzas_Banco`.`grupo` = '$Archivo' AND `Finanzas_Banco`.`tipo` = 'N/C'");
 
  $ND1 = ExecuteScalar("SELECT Sum(`Finanzas_Banco`.`valor`) FROM `Finanzas_Banco` WHERE `Finanzas_Banco`.`mes` = '$mes1' AND `Finanzas_Banco`.`tipo` = 'N/D' AND `Finanzas_Banco`.`grupo` ='$Archivo'");
 $ND2 = ExecuteScalar("SELECT Sum(`Finanzas_Banco`.`valor`) FROM `Finanzas_Banco` WHERE `Finanzas_Banco`.`mes` = '$mes2' AND `Finanzas_Banco`.`tipo` = 'N/D' AND `Finanzas_Banco`.`grupo` ='$Archivo'");
 $NDACUMULADO = ExecuteScalar("SELECT Sum(`Finanzas_Banco`.`valor`) AS `Sum_valor` FROM  `Finanzas_Banco` WHERE `Finanzas_Banco`.`grupo` = '$Archivo' AND `Finanzas_Banco`.`tipo` = 'N/D'");
 
 
  $CHE1 = ExecuteScalar("SELECT Sum(`Finanzas_Banco`.`valor`) FROM `Finanzas_Banco` WHERE `Finanzas_Banco`.`mes` = '$mes1' AND `Finanzas_Banco`.`tipo` = 'CHE' AND `Finanzas_Banco`.`grupo` ='$Archivo'");
 $CHE2 = ExecuteScalar("SELECT Sum(`Finanzas_Banco`.`valor`) FROM `Finanzas_Banco` WHERE `Finanzas_Banco`.`mes` = '$mes2' AND `Finanzas_Banco`.`tipo` = 'CHE' AND `Finanzas_Banco`.`grupo` ='$Archivo'");
 $CHEACUMULADO = ExecuteScalar("SELECT Sum(`Finanzas_Banco`.`valor`) AS `Sum_valor` FROM  `Finanzas_Banco` WHERE `Finanzas_Banco`.`grupo` = '$Archivo' AND `Finanzas_Banco`.`tipo` = 'CHE'");
 
#-- Saldo final

$SaldoFinal1 =  $SaldoIncial + $NC1 + $DEP1 - $CHE1 -$ND1;
$SaldoFinal2 =  $SaldoFinal1 + $NC2 + $DEP2 - $CHE2 -$ND2;
$SaldoAcumulado =    $SaldoIncial + $NCACUMULADO + $DEPACUMULADO - $CHEACUMULADO -$NDACUMULADO;

#-- Consolidado Valores
$Ingreso1 = $DEP1 + $NC1;
$Ingreso2 = $DEP2 + $NC2;
$Egreso1 =  $ND1 + $CHE1;
$Egreso2 =  $ND2 + $CHE2;

$IngresoAcumulado =  $Ingreso1 + $Ingreso2;
$EgresoAcumulado =  $Egreso1  + $Egreso2;

$Consolidado1 = $SaldoIncial + $Ingreso1  - $Egreso1;
$Consolidado2 = $Consolidado1 + $Ingreso2  - $Egreso2;


$SaldoNeto = $SaldoBdP + $Consolidado2;

 ?>

<table class="table table-bordered table-sm">
<tr>

<td colspan="2">Mes</td>

<td><?php echo meses($mes1); ?></td>
<td><?php echo meses($mes2); ?></td>

<td>Acumulado</td>
</tr>

<tr>

<td colspan="2">Saldo Inical al <?php echo $FechaInicial; ?></td>
<td><?php echo $SaldoIncial;?></td>
<td><?php echo $SaldoFinal1; ?></td>
<td><?php echo $SaldoIncial;?></td>
</tr>

<tr>
<td rowspan="2">Ingreso</td>
<td>DEP</td>
<td><?php echo $DEP1;?></td>
<td><?php echo $DEP2;?></td>
<td><?php echo $DEPACUMULADO;?></td>
</tr>
<tr>

<td>N/C</td>
<td><?php echo $NC1;?></td>
<td><?php echo $NC2;?></td>
<td><?php echo $NCACUMULADO;?></td>
</tr>


<tr>
<td rowspan="2">Egreso</td>
<td>N/D</td>
<td><?php echo $ND1;?></td>
<td><?php echo $ND2;?></td>
<td><?php echo $NDACUMULADO;?></td>
</tr>
<tr>

<td>CHE</td>
<td><?php echo $CHE1;?></td>
<td><?php echo $CHE2;?></td>
<td><?php echo $CHEACUMULADO;?></td>
</tr>


<td></td>
<td>Saldo final <?php echo $FechaConsolidacion; ?></td>
<td><?php echo $SaldoFinal1; ?></td>
<td><?php echo $SaldoFinal2; ?></</td>
<td><?PHP ECHO $SaldoAcumulado;?></td>
</tr>
</table>



<table class="table table-bordered table-sm">
<tr><td>Reporte consolidado de bancos a  <?php echo $FechaConsolidacion; ?></td></tr>
</table>


<table class="table table-bordered table-sm">
<tr>
<td>Mes</td>
<td><?php echo meses($mes1); ?></td>
<td><?php echo meses($mes2); ?></td>
<td>Acumulado</td>
</tr>

<tr>
<td>Saldo Inical al <?php echo $FechaInicial; ?></td>
<td><?php echo $SaldoIncial;?></td>
<td><?php echo $SaldoFinal1; ?></td>
<td><?php echo $SaldoIncial;?></td>
</tr>

<tr>
<td>Ingreso</td>
<td><?php echo $Ingreso1;?></td>
<td><?php echo $Ingreso2;?></td>
<td><?php echo $IngresoAcumulado;?></td>
</tr>
<tr>
<td>Egreso</td>
<td><?php echo $Egreso1;?></td>
<td><?php echo $Egreso2;?></td>
<td><?php echo $EgresoAcumulado;?></td>
</tr>


<tr>
<td>Saldo Final  <?php echo $FechaConsolidacion; ?></td>
<td><?php echo $Consolidado1;?></td>
<td><?php echo $Consolidado2;?></td>
<td><?php echo $Consolidado2;?></td>
</tr>

</table>



<table class="table table-bordered table-sm">
<tr><td>Saldo Cta Ahorro BdP</td><td><?php echo $SaldoBdP ;?></td></tr>
</table>

<table class="table table-bordered table-sm">
<tr><td>Saldo Neto TCA</td><td><?php echo $SaldoNeto;?></td></tr>
</table>

</td>
</tr></table>
<?php 



} ?>




<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$Reporte_Escuelas->terminate();
?>