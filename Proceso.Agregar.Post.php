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
<?php include "header.php" ?>



<?php 
function alias($s) {
  $s = strtolower($s);
  $s = preg_replace("/-a-|á|à|â|ã|ª/","a",$s);$s = preg_replace("/-A-|Á|À|Â|Ã/","a",$s);$s = preg_replace("/-e-|é|è|ê/","e",$s);$s = preg_replace("/-E-|É|È|Ê/","e",$s);$s = preg_replace("/-i-|í|ì|î/","i",$s);$s = preg_replace("/-I-|Í|Ì|Î/","i",$s);$s = preg_replace("/-o-|ó|ò|ô|õ|º/","o",$s);$s = preg_replace("/-O-|Ó|Ò|Ô|Õ/","o",$s);$s = preg_replace("/-u-|ú|ù|û/","u",$s);$s = preg_replace("/-U-|Ú|Ù|Û/","u",$s);$s = str_replace(" ","-",$s);$s = str_replace("ñ","n",$s);$s = str_replace("Ñ","N",$s);$s = preg_replace('/[^a-zA-Z0-9_.-]/','',$s);
  $s = str_replace("-la-","-",$s);$s = str_replace("-le-","-",$s);$s = str_replace("-li-","-",$s);$s = str_replace("-lo-","-",$s);$s = str_replace("-lu-","-",$s);$s = str_replace("-da-","-",$s);$s = str_replace("-de-","-",$s);$s = str_replace("-di-","-",$s);$s = str_replace("-do-","-",$s);$s = str_replace("-du-","-",$s);$s = str_replace("-al-","-",$s);$s = str_replace("-el-","-",$s);$s = str_replace("-il-","-",$s);$s = str_replace("-ol-","-",$s);$s = str_replace("-ul-","-",$s);$s = str_replace("-a-","-",$s);$s = str_replace("-e-","-",$s);$s = str_replace("-i-","-",$s);$s = str_replace("-o-","-",$s);$s = str_replace("-u-","-",$s);$s = str_replace("-y-","-",$s);$s = str_replace("-an-","-",$s);$s = str_replace("-en-","-",$s);$s = str_replace("-in-","-",$s);$s = str_replace("-on-","-",$s);$s = str_replace("-un-","-",$s);$s = str_replace("-del-","-",$s);$s = str_replace("-las-","-",$s);$s = str_replace("-les-","-",$s);$s = str_replace("-lis-","-",$s);$s = str_replace("-los-","-",$s);$s = str_replace("-lus-","-",$s);$s = str_replace("-q-","-",$s);$s = str_replace("-que-","-",$s);$s = str_replace("-con-","-",$s);$s = str_replace("-por-","-",$s);$s = str_replace("-as-","-",$s);$s = str_replace("-es-","-",$s);$s = str_replace("-is-","-",$s);$s = str_replace("-os-","-",$s);$s = str_replace("-us-","-",$s);$s = str_replace("-un-","-",$s);$s = str_replace("-una-","-",$s);$s = str_replace("-uno-","-",$s);$s = str_replace("-estos-","-",$s);$s = str_replace("-para-","-",$s);$s = str_replace("-junto-","-",$s);$s = str_replace("-era-","-",$s);$s = str_replace("-son-","-",$s);$s = str_replace("-mas-","-",$s);$s = str_replace("-sa-","-",$s);$s = str_replace("-se-","-",$s);$s = str_replace("-si-","-",$s);$s = str_replace("-so-","-",$s);$s = str_replace("-su-","-",$s);
  return $s;
  }
  
/*-------------------------------
GUARDAR PASO 1G-GLOBAL
-----------------------------*/
if($_POST[paso]=='1G-GLOBAL'){



  #-- Subiendo Archivo
$dir_subida = '/home/teatro13/public_html/tcagye_com/data/images/';
$fichero_subido = $dir_subida . basename($_FILES['canvas']['name']);
$Archivo = $_FILES['canvas']['name'];
$ext= explode('.',$Archivo);
$NuevoNombre = $hoy.'-'.alias($Archivo).'.'.$ext[1];

#-- Mover Archivo
move_uploaded_file($_FILES['canvas']['tmp_name'], $fichero_subido);
#-- Cambiar el nombre
rename ('/home/teatro13/public_html/tcagye_com/data/images/'.$Archivo,'/home/teatro13/public_html/tcagye_com/data/images/'.$NuevoNombre);






//TRABAJAMOS LOS DATOS

$post= base64_encode($_POST[Post]);

 Execute ("INSERT INTO    `Live_Brief_Post` (`tipo`,`CategoriaEvento`,`evento`,`imagen`,`post`,`fecha`,`urlIG`,`urlFB`) 
 VALUES ('$_POST[tipo]','$_POST[categoria]','$_POST[Evento]','$NuevoNombre','$post','$_POST[fecha]','$_POST[urlIG]','$_POST[urlFB]')");

 Echo ("INSERT INTO    `Live_Brief_Post` (`tipo`,`CategoriaEvento`,`evento`,`imagen`,`post`,`fecha`,`urlIG`,`urlFB`) 
 VALUES ('$_POST[tipo]','$_POST[categoria]','$_POST[Evento]','$NuevoNombre','$post','$_POST[fecha]','$_POST[urlIG]','$_POST[urlFB]')");
 
 // Redireccionar
 
   echo '<meta http-equiv="refresh" content="10; url=https://www.tcagye.com/2020/Reporte.Post.php">';

} 



?>

<div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Categorías <?php echo ExecuteScalar("SELECT
  `Live_Brief_categorias`.`titulo`
FROM
  `Live_Brief_categorias`
WHERE
  `Live_Brief_categorias`.`Id` = '$_GET[categoria]'"); ?>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <?php 
  $sql = "
SELECT
  `Live_Brief_categorias`.`Id`,
  `Live_Brief_categorias`.`tipo`,
  `Live_Brief_categorias`.`estado`,
  `Live_Brief_categorias`.`titulo`
FROM
  `Live_Brief_categorias`
WHERE
  `Live_Brief_categorias`.`tipo` != '4' AND
  
  `Live_Brief_categorias`.`estado` = '1'
  ORDER BY 
  `Live_Brief_categorias`.`titulo` ASC
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
    <a class="dropdown-item" href="Proceso.Agregar.Post.php?paso=1GLOBAL&categoria=<?php echo $obj->Id;?>"><?php echo $obj->titulo;?></a>

<?php } ?>

  </div>
</div>

<?php  if($_GET[Evento]==''){?>
<h4>Listado de eventos</h4>
<table class="table table-bordered">

<?php 
$year = date(Y);
  $sql = "
  SELECT
  `Live_Brief`.`Id`,
  `Live_Brief`.`categoria`,
  `Live_Brief`.`titulo`,
  `Live_Brief`.`fecha`
FROM
  `Live_Brief`
WHERE
  `Live_Brief`.`categoria` = '$_GET[categoria]' AND
  `Live_Brief`.`fecha` LIKE '$year-%'
ORDER BY
  `Live_Brief`.`fecha` DESC
";
$a = ExecuteRows($sql);$b = json_encode($a);$c = json_decode($b);
foreach($c as $obj){ ?>
<tr><td><?php echo $obj->fecha;?></td><td><a  href="Proceso.Agregar.Post.php?paso=1GLOBAL&categoria=<?php echo $_GET[categoria];?>&Evento=<?php echo $obj->Id;?>"><?php echo $obj->titulo;?></a></td></tr>

<?php } ?>
</table>
<?php  } else { ?>

<?php 

/**********************
Paso 1
/**************************/
if($_GET[paso]=='1GLOBAL'){

?>
<h3  class="m-5"><?php echo ExecuteScalar("SELECT
  `Live_Brief`.`titulo`
FROM
  `Live_Brief`
WHERE
  `Live_Brief`.`Id` = '$_GET[Evento]' "); ?></h3>
<form method="POST" action="Proceso.Agregar.Post.php" enctype="multipart/form-data">
<input type="hidden" name="paso" value="1G-GLOBAL">
<input type="hidden" name="Evento" value="<?php echo $_GET[Evento];?>">
<input type="hidden" name="categoria" value="<?php echo $_GET[categoria];?>">


<table class="table table-bordered">
<tr>


<td>Tipo<br>
    <select name="tipo" class="form-control" required>
	<option value="">Por favor selecciona</option>	
<option value="1">Post o vídeo </option>
<option value="2">Historia</option>
<option value="3">Mailing</option>
	</select>
</td>


<td>
Fecha de Publicación<br>
  <input type="date" name="fecha" class="form-control" required>
</td>
</tr></table>
	
<table class="table table-bordered">
<tr>
<td>URL Instagram<br>
<textarea name="urlIG" class="form-control" ></textarea>
</td>
<td>URL Facebook<br>
<textarea name="urlFB" class="form-control"></textarea>
</td>
<td>URL Twitter<br>
<textarea name="urlTW" class="form-control" ></textarea>
</td>

</tr></table>


<table class="table table-bordered">
 <tr><td>Copy (Texto del Post)<br>    
<textarea name="Post" class="editor" rows="10" cols="80"></textarea>
</td></tr>
 
 <tr><td>Imagen<br>    
 <input type="file" class="form-control-file" name="canvas"  >
</td></tr>
 
   </table>
   

  <button type="submit" class="btn btn-primary">Grabar y continuar</button>
</form>
<?php }  // END PASO 1 GLOBAL ?>
<?php } //fin else ?>







<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$main->terminate();
?>