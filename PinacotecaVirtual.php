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




<?php if($_GET[Galeria]==''){?>

<h3>Pinacoteca Virtual</h3>
<table class="table table-bordered" >
<tr>
<td>ID</td>
<td>Web</td>
<td>Titulo</td>
<td>Obras</td>
<td></td>

</tr>




 <?php 
 
/**************************
Listado de galeria
/**************************/
$t=0;
  $sql = "
SELECT
  `teatro13_temporada`.`pinacotega_galeria`.`Id`,
  `teatro13_temporada`.`pinacotega_galeria`.`titulo`,
  `teatro13_temporada`.`pinacotega_galeria`.`estado`,
  `teatro13_temporada`.`pinacotega_galeria`.`descripcion`
FROM
  `teatro13_temporada`.`pinacotega_galeria`
  
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
<tr>
<td>2020<?php echo $obj->Id; ?></td>
<td><?php echo $obj->estado;?></td>
<td ><?php echo $obj->titulo?></td>
<td><?php echo  ExecuteScalar("SELECT Count(`teatro13_temporada`.`pinacoteca_obras`.`Id`) AS `total` FROM `teatro13_temporada`.`pinacoteca_obras` WHERE `teatro13_temporada`.`pinacoteca_obras`.`IdGaleria` = $obj->Id");?></td>

<td><a class="btn btn-default" href="PinacotecaVirtual.php?PHPSESION=<?php echo $falsekey;?>&Galeria=<?php echo $obj->Id;?>&tipo=A4">Ver obras</a></td>
<td><a class="btn btn-default" href="PinacotecaVirtual.php?PHPSESION=<?php echo $falsekey;?>&Galeria=<?php echo $obj->Id;?>&tipo=Cel">Celulas</a></td>


</tr>
<?php }  ?>
<!--
<tr>
<td></td>
<td></td>
<td>TODA LA PINACOTECA NAVIDEÑA DISPONIBLE (NO VENDIDO)</td>
<td></td>

<td><a class="btn btn-primary" href="PinacotecaVirtual.php?PHPSESION=<?php echo $falsekey;?>&Galeria=0&tipo=A4">Ver obras</a></td>
<td></td>


</tr>-->

</table>

<?php } else{
	
	
/**************************
Listado de galeria A4
/**************************/	
	
if($_GET[tipo]=='A4'){
	?>

<table><tr><td style="width:100%; height: 21cm; text-transform:uppercase">
<table>
<tr><td><img src="https://www.tcagye.com/2020/images/Pinacoteca-Intro.jpg" class="img-fluid" style="width:100% "></td></tr>
</table>
</td></tr></table>	
<div style="  display:block; page-break-before:always;"></div>
<table><tr><td style="width:100%; height: 21cm; text-transform:uppercase">
<table>
<tr><td><img src="https://www.tcagye.com/2020/images/Pinacoteca-Carta.jpg" class="img-fluid" style="width:100% "></td></tr>
</table>
</td></tr></table>	
<div style="  display:block; page-break-before:always;"></div>


	<?php
 
if($_GET[Galeria]>0){$galeria = '='.$_GET[Galeria];}else{$galeria='>4';}
	
$t=1;
  $sql = "
SELECT
  `teatro13_temporada`.`pinacoteca_obras`.`Id`,
  `teatro13_temporada`.`pinacoteca_obras`.`obra`,
  `teatro13_temporada`.`pinacoteca_obras`.`autor`,
  `teatro13_temporada`.`pinacoteca_obras`.`tecnica`,
  `teatro13_temporada`.`pinacoteca_obras`.`medidas`,
  `teatro13_temporada`.`pinacoteca_obras`.`valor`,
  `teatro13_temporada`.`pinacoteca_obras`.`inventario`,
  `teatro13_temporada`.`pinacoteca_obras`.`donacion`,
  `teatro13_temporada`.`pinacoteca_obras`.`FechaIngreso`,
  `teatro13_temporada`.`pinacoteca_obras`.`estado`,
  `teatro13_temporada`.`pinacoteca_obras`.`fotoObra`,
  `teatro13_temporada`.`pinacoteca_obras`.`orden`,
  `teatro13_temporada`.`pinacoteca_obras`.`IdGaleria`,
  `teatro13_temporada`.`pinacoteca_obras`.`carpeta`
FROM
  `teatro13_temporada`.`pinacoteca_obras`
WHERE
  `teatro13_temporada`.`pinacoteca_obras`.`IdGaleria` $galeria
  AND 
    `teatro13_temporada`.`pinacoteca_obras`.`estado` = 1
  ORDER BY 
    `teatro13_temporada`.`pinacoteca_obras`.`inventario` ASC
  
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
<?php if($t==1){?>
<table style="margin-left: auto;
    margin-right: auto;
"><tr><td style="padding:1cm; width:20cm; height: 21cm; text-transform:uppercase">
<h3><?php echo ExecuteScalar(" SELECT `teatro13_temporada`.`pinacotega_galeria`.`titulo` FROM `teatro13_temporada`.`pinacotega_galeria` WHERE `teatro13_temporada`.`pinacotega_galeria`.`Id` = $obj->IdGaleria");?></h3>
<hr>
<?php } ?>
<table >
<tr><td><img src="https://www.tca.ec/images/<?php echo $obj->carpeta;?>/<?php echo $obj->fotoObra;?>" class="img-fluid" style="height: 12cm; "></td></tr>
<tr><td>
<?php if($obj->estado==2){ ?>
<table style="color: #ffffff;
    font-weight: bold;
    background: #e20000;
    border: 1px solid #da0000;
    text-align: center;
    width: 100%; "><tr><td>
<td style="padding:4px"><h4>VENDIDO</h4> </td></tr></table>
<?php } ?> 


<table style="width:100%; <?php if($obj->estado==2){  echo 'background: #f9dfe4;';} ?>"><tr><td>
<h3> <?php echo $obj->obra;?></h3><h5>$ <?php echo $obj->valor;?></h5>
</td></tr></table>
</td></tr>
<tr><td>
<table class="table table-bordered table-sm" style="<?php if($obj->estado==2){  echo ' background: #f9dfe4;';} ?>">
<tr><td>Inventario</td><td><?php echo $obj->inventario;?></td></tr>
<tr><td>Autor</td><td><?php echo $obj->autor;?></td></tr>
<tr><td>Técnica</td><td><?php echo $obj->tecnica;?></td></tr>
<tr><td>Medidas</td><td><?php echo $obj->medidas;?></td></tr>
</table>
	

</td></tr>
</table>
<?php if($t==2){?>
</td></tr></table>
<div class="alert alert-primary" role="alert" style="text-align:center">
<h6>Pinacoteca actualizada al  <?php echo dame_el_dia($hoy);?> <?php echo fechas($hoy);?>  <?php echo $hora;?></h6></div>
<div style="  display:block; page-break-before:always;"></div>
<?php 

$t = 0; } ?>

<?php ++$t; }  ?>

<table><tr><td style="width:100%; height: 21cm; text-transform:uppercase">
<table>
<tr><td><img src="https://www.tcagye.com/2020/images/Pinacoteca-Promo.jpg" class="img-fluid" style="width:100% "></td></tr>
</table>
</td></tr></table>	


<?php } 


	
/**************************
END Listado de galeria A4
/**************************/	 ?>

<?php   

if($_GET[tipo]=='Cel'){
	?>
<div class="container">	

	<?php

/**************************
Listado de galeria
/**************************/
$t=1;
  $sql = "
SELECT
  `teatro13_temporada`.`pinacoteca_obras`.`Id`,
  `teatro13_temporada`.`pinacoteca_obras`.`obra`,
  `teatro13_temporada`.`pinacoteca_obras`.`autor`,
  `teatro13_temporada`.`pinacoteca_obras`.`tecnica`,
  `teatro13_temporada`.`pinacoteca_obras`.`medidas`,
  `teatro13_temporada`.`pinacoteca_obras`.`valor`,
  `teatro13_temporada`.`pinacoteca_obras`.`inventario`,
  `teatro13_temporada`.`pinacoteca_obras`.`donacion`,
  `teatro13_temporada`.`pinacoteca_obras`.`FechaIngreso`,
  `teatro13_temporada`.`pinacoteca_obras`.`estado`,
  
  `teatro13_temporada`.`pinacoteca_obras`.`orden`,
  `teatro13_temporada`.`pinacoteca_obras`.`IdGaleria`,
  `teatro13_temporada`.`pinacoteca_obras`.`carpeta`
FROM
  `teatro13_temporada`.`pinacoteca_obras`
WHERE
  `teatro13_temporada`.`pinacoteca_obras`.`IdGaleria` = $_GET[Galeria]
  
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
<?php if($t==1){?>
<table class="table" style="margin-left: auto;
    margin-right: auto; width:100%;
"><tr><td style="height: 21cm; text-transform:uppercase">
<div class="row">	

<?php } ?>
<div  style="
    height: 5cm;
    border: 1px solid #ccc;
    padding: 10px;
    margin: 5px;
	width:8cm" >



<h4><?php echo $obj->obra;?></h4>
<span <?php if($obj->estado==2){ ?> style="color: #ff0000;
    font-weight: bold;
    background: #f7d5d5;
    border: 1px solid #ff0000;
text-align: center; "<?php } ?> ><?php if($obj->estado==2){ echo 'VENDIDO';}?> 
</span>

<br>Inventario: <?php echo $obj->inventario;?>
<br>Autor: <?php echo $obj->autor;?>
<br>Técnica: <?php echo $obj->tecnica;?>
<br>Medidas: <?php echo $obj->medidas;?>
<br><h5>Valor: $ <?php echo $obj->valor;?></h5>

</div>
<?php if($t==21){?>
</div>
</td></tr></table>
<div style="  display:block; page-break-before:always;"></div>
<?php 

$t = 0; } ?>
	
<?php  ++$t; }  ?>
</div>
<?php }  ?>

<?php }  ?>
<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$Reporte_Escuelas->terminate();
?>