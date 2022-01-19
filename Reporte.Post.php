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

if($_GET[m]==''){$m= date(m);}else{$m=$_GET[m];}
if($_GET[y]==''){$y= date(Y);}else{$y=$_GET[y];}

?>


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
  <a href="https://www.tcagye.com/2020/Proceso.Agregar.Post.php" class="btn btn-default mb-2" >Agregar</a>

</form></td>





</tr>
</table>

<table class="table table-bordered" style="width:16cm">
<tr><td>ARTE</td><td>TEXTO PARA POST<br><small>SOLO SI APLICA</small></td><td style="width:200px">CONSTANCIA DE PUBLICACIÓN<br><small>CAPTURA PARA HISTORIAS, <BR> LINK PARA POST</small></td><tr>
 <?php 
 

 
/**************************
LISTADO DE TODAS LAS CLASES
Comprobamos que el alumno este matriculado
/**************************/

$sql = "
SELECT
  `Live_Brief_Post`.`Id`,
  `Live_Brief_Post`.`tipo`,
  `Live_Brief_Post`.`evento`,
  `Live_Brief_Post`.`imagen`,
  `Live_Brief_Post`.`post`,
  `Live_Brief_Post`.`fecha`,
  `Live_Brief_Post`.`captura`,
  `Live_Brief_Post`.`urlIG`,
  `Live_Brief_Post`.`urlFB`,
  `Live_Brief`.`titulo`,
  `Live_Brief_categorias`.`titulo` AS `titulo1`
FROM
  `Live_Brief_Post`
  INNER JOIN `Live_Brief` ON `Live_Brief`.`Id` = `Live_Brief_Post`.`evento`
  INNER JOIN `Live_Brief_categorias` ON `Live_Brief_categorias`.`Id` =
    `Live_Brief`.`categoria`
WHERE
	  `Live_Brief_Post`.`fecha` LIKE '$y-$m-%'
ORDER BY
  `Live_Brief_Post`.`fecha`
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
<tr><td style="105">
<img src="https://www.tcagye.com/data/images/<?php echo $obj->imagen;?>" width="104" height="180" ></td>
<td style="width:6cm">
<B>
Categoría: <?php echo $obj->titulo1;?><br>
Evento: <?php echo $obj->titulo;?>
</B>
<hr>
Fecha de publicación: <?php echo $obj->fecha;?>
<br>Tipo:  <?php if($obj->tipo==1){ echo 'POST';}?> <?php if($obj->tipo==2){ echo 'HISTORIA'; }?>
<hr>
<?php echo base64_decode($obj->post);?>
</td>
<td style="105">
<?php if($obj->captura !=''){?><img src="https://www.tcagye.com/data/images/<?php echo $obj->captura;?>" width="104" height="180" ><?php }else{ ?>

<a href="<?php echo $obj->urlIG;?>">Ver Post en Instagram</a><BR><BR>
<a href="<?php echo $obj->urlFB;?>">Ver Post en Facebook</a>
<?php } ?>

</td>
</tr>
<?php } ?>
</table>


<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$Reporte_Post->terminate();
?>