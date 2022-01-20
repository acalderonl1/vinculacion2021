<?php namespace PHPMaker2019\LiveBrief;
?>
<?php
$RELATIVE_PATH = "./core/";
$ROOT_RELATIVE_PATH = "./core/";
?>
<?php include_once $RELATIVE_PATH . "autoload.php" ?>
<!DOCTYPE html>
<html>
<head>
<title>BMP 2020 - Teatro Centro de Arte</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="http://localhost/2020/core/Favico.png">
<link rel="apple-touch-icon-precomposed" href="http://localhost/2020/core/Favico.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://localhost/2020/core/Favico.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://localhost/2020/core/Favico.png">
<link rel="stylesheet" type="text/css" href="core/adminlte3/css/adminlte.css">
<link rel="stylesheet" type="text/css" href="core/plugins/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="core/phpcss/jquery.fileupload.css">
<link rel="stylesheet" type="text/css" href="core/phpcss/jquery.fileupload-ui.css">
<link rel="stylesheet" type="text/css" href="core/colorbox/colorbox.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="core/phpcss/LiveBrief.css">

<script src="http://localhost/2020/core/ckeditor/ckeditor.js"></script>
<script src="http://localhost/2020/core/phpjs/eweditor.js"></script>
<link rel="stylesheet" type="text/css" href="http://localhost/2020/core/phpcss/bootstrap-datetimepicker.css">
<script src="http://localhost/2020/core/phpjs/bootstrap-datetimepicker.js"></script>
<script src="http://localhost/2020/core/phpjs/ewdatetimepicker.js"></script>
<script src="http://localhost/2020/core/phpjs/userfn15.js"></script>
<script>

// Write your client script here, no need to add script tags.
</script>

<meta name="generator" content="PHPMaker v2019.0.10">
</head>
<body class="hold-transition" dir="ltr"  
>
<style>
html, body, .wrapper {
	min-height: 100%;
	overflow-x: visible;
}
</style>


<div class="card " style="width:100%; margin-left:auto; margin-right:auto; ">

<table ><tr><td>



</td></tr>
<tr><td>
  <div class="card-body">
<table  style="margin-left:auto; margin-right:auto">
<TR>
<td>



<table><tr><td style="width:100%; height: 21cm; text-transform:uppercase">
<table>
<tr><td><img src="http://localhost/2020/images/Pinacoteca-Intro.jpg" class="img-fluid" style="width:100% "></td></tr>
</table>
</td></tr></table>	
<div style="  display:block; page-break-before:always;"></div>
<table><tr><td style="width:100%; height: 21cm; text-transform:uppercase">
<table>
<tr><td><img src="http://localhost/2020/images/Pinacoteca-Carta.jpg" class="img-fluid" style="width:100% "></td></tr>
</table>
</td></tr></table>	
<div style="  display:block; page-break-before:always;"></div>


	<?php
 

	
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
  `teatro13_temporada`.`pinacoteca_obras`.`IdGaleria` 17
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
<div style="  display:block; page-break-before:always;"></div>
<?php 

$t = 0; } ?>

<?php ++$t; }  ?>

<table><tr><td style="width:100%; height: 21cm; text-transform:uppercase">
<table>
<tr><td><img src="http://localhost/2020/images/Pinacoteca-Promo.jpg" class="img-fluid" style="width:100% "></td></tr>
</table>
</td></tr></table>	


<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$Reporte_Escuelas->terminate();
?>