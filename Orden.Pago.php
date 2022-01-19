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
if($_GET[paso]=='1'){
function random_str(    int $length = 42,    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string {    if ($length < 1) {        throw new \RangeException("Length must be a positive integer");    }    $pieces = [];    $max = mb_strlen($keyspace, '8bit') - 1;    for ($i = 0; $i < $length; ++$i) {        $pieces []= $keyspace[random_int(0, $max)];    }    return implode('', $pieces);}
//$a = random_str(128);
$Token=random_str(38);
?>
<h3>Orden de cobro</h3>
<h6>Cree una orden de cobro que puede enviar a su cliente de forma segura y privada</h6>

<div class="alert alert-primary" role="alert">
VALORES  PERMITIDOS POR BOTON DE PAGO PAYMENTEZ
<hr>
Monto diario por persona $ 1000
<br>Monto quincenal por persona $ 2000
<br> Transaccioens diarias por persona 2
<br> Transacciones quincenales por persona  4
</div>

<form action="Orden.Pago.php" method="POST">
<input type="hidden" name="paso" value="1G">
<input type="hidden" name="Token" value="<?php echo $Token;?>">
<table class=" table table-bordered">
<tr><td>Código</td><td><input type="text" value="OC-<?php echo date(ymdhs)?>" class="form-control" name="cod" ></td></tr>
<tr><td>Nombres y Apellidos</td><td><input type="text" value="" class="form-control" name="nombres" style="width:100%"required ></td></tr>
<tr><td>E-mail</td><td><input type="email" value="" class="form-control" name="email" required></td></tr>
<tr><td>Valor a cobrar<br><small>Valores enteros entre 1 & 1000 Dolar (es)</small></td><td><input type="number" min="1" max="1000" value="" class="form-control" name="valor" required></td></tr>
<tr><td>Concepto</td><td><input type="text" value="" class="form-control" name="concepto" style="width:100%" required></td></tr>
<tr><td>Fecha Habilitante</td><td><input type="date" min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" class="form-control" name="fhabilitante" required></td></tr>
<tr><td>Fecha Limite</td><td><input type="date" min="<?php echo date("Y-m-d");?>" value="" class="form-control" name="flimite" required></td></tr>

<tr><td>Token</td><td><input type="text" value="<?php echo $Token;?>" disabled>

</td></tr>

</table>

  <button type="submit" class="btn btn-primary mb-2">Generar</button>
</form>

<?php } ?>


<?php
if($_GET[paso]=='2'){


?>

<h2>Ordenes de cobro</h2>
<table class="table table-bordered">
<tr>
<td>Código</td><td>Cobrar a</td>
<td>Contacto</td>
<td>Concepto</td>
<td>Valor</td>
<td>Estado Paymentez</td>
<td><a href="Orden.Pago.php?paso=1" class="btn btn-default">Nueva Orden de Cobro</a></td>
</tr>
<?php 

 $sql = "
SELECT
  `OrdenCobro`.`Id`,
  `OrdenCobro`.`cod`,
  `OrdenCobro`.`nombres`,
  `OrdenCobro`.`email`,
  `OrdenCobro`.`valor`,
  `OrdenCobro`.`Iva`,
  `OrdenCobro`.`fhabilitante`,
  `OrdenCobro`.`flimite`,
  `OrdenCobro`.`concepto`,
  `OrdenCobro`.`Token`,
  `OrdenCobro`.`razonsocial`,
  `OrdenCobro`.`ruc`,
  `OrdenCobro`.`telefono`,
  `OrdenCobro`.`direccion`,
  `OrdenCobro`.`flog`,
  `OrdenCobro`.`hlog`,
  `OrdenCobro`.`paymentez`,
  `OrdenCobro`.`ip`,
  `OrdenCobro`.`idpaymentez`,
  `OrdenCobro`.`statuspaymentez`,
  `OrdenCobro`.`callback`,
  `OrdenCobro`.`tarjeta`,
  `OrdenCobro`.`codauto`,
  `OrdenCobro`.`reembolso`
FROM
  `OrdenCobro`
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){?>
<tr>
<td><?php echo $obj->cod; ?></td>
<td>Nombres: <?php echo $obj->nombres; ?><br>Razón Social: <?php echo $razonsocial;?><br>Ruc: <?php echo $ruc;?></td>
<td><?php echo $obj->email; ?><br><?php echo $obj->telefono;?></td>
<td><?php echo $obj->concepto; ?></td>
<td><?php echo $obj->valor; ?></td>
<td><textarea><?php echo $obj->paymentez; ?></textarea><br><?php echo $obj->statuspaymentez; ?><br><?php echo $obj->tarjeta; ?></td>
<td>
<script>function copy<?php echo $obj->Id;?>() { let textarea = document.getElementById("Url<?php echo $obj->Id;?>"); textarea.select(); document.execCommand("copy"); alert("Url Copiada");}</script>
<button  class="btn btn-block btn-sm btn-default" onclick="copy<?php echo $obj->Id;?>()">Copiar Url</button>
<textarea class="form-control" id="Url<?php echo $obj->Id;?>" style="height: 30px;">
https://www.teatrocentrodearte.org/e-shop/OrdenCobro.paymentez.php?Token=<?php echo $obj->Token;?>&paso=1
</textarea>
 </td>
</tr>
<?php } ?>
</table>
<?php } ?>

<?php 
// Grabadno los Dats

if($_POST[paso]=='1G'){
	
//Execute
Execute("INSERT INTO `OrdenCobro` (`cod`,`nombres`,`email`,`valor`,`concepto`,`fhabilitante`,`flimite`,`Iva`,`Token`) 
VALUES ('$_POST[cod]','$_POST[nombres]','$_POST[email]','$_POST[valor]','$_POST[concepto]','$_POST[fhabilitante]','$_POST[flimite]','0','$_POST[Token]')");	

// Redireccionar
 
  echo '<meta http-equiv="refresh" content="0; url=https://www.tcagye.com/2020/Orden.Pago.php?PHPKEYID='.$falsekey.'&paso=2">';

}
?>
<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$Reporte_Escuelas->terminate();
?>