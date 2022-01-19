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

/*-----------------
Tipo de medio
--------------------- */

function medio($z)
	{
   switch ($z) {
    case 1: $m = "Revista"; break;
	case 2: $m = "Prensa"; break;
	case 3: $m = "Tv"; break;
	case 4: $m = "Radio"; break;
	case 5: $m = "On-Line"; break;
	case 6: $m = "Otros"; break;
    
   }

return $m;

	}?>


		<div class="row">
		<div class="col">
		
			<hr><h2>Directorio de medios</h2><hr>	
			
		
<ul class="nav nav-pills">
  <li class="nav-item">
    <a  style="font-size: 16px;" class="nav-link <?php if($_GET[categoria]=='1'){ echo 'active';} ?>" href="Proceso.Medios.php?PHPKEYID=<?php echo $falsekey;?>&op=directorio&empresa=0&categoria=1">Revista</a>
  </li>
  <li class="nav-item">
    <a style="font-size: 16px;" class="nav-link <?php if($_GET[categoria]=='2'){ echo 'active';} ?>" href="Proceso.Medios.php?PHPKEYID=<?php echo $falsekey;?>&op=directorio&empresa=0&categoria=2">Prensa</a>
  </li>
  <li class="nav-item">
    <a style="font-size: 16px;" class="nav-link <?php if($_GET[categoria]=='3'){ echo 'active';} ?>" href="Proceso.Medios.php?PHPKEYID=<?php echo $falsekey;?>&op=directorio&empresa=0&categoria=3">Tv</a>
  </li> 
  <li class="nav-item">
    <a style="font-size: 16px;" class="nav-link <?php if($_GET[categoria]=='4'){ echo 'active';} ?>" href="Proceso.Medios.php?PHPKEYID=<?php echo $falsekey;?>&op=directorio&empresa=0&categoria=4">Radio</a>
  </li>
    <li class="nav-item">
    <a style="font-size: 16px;" class="nav-link <?php if($_GET[categoria]=='5'){ echo 'active';} ?>" href="Proceso.Medios.php?PHPKEYID=<?php echo $falsekey;?>&op=directorio&empresa=0&categoria=5">On-line</a>
  </li>

</ul>
		
		
	<?php 
if($_GET[empresa]=="0"){?>		
	<table class="table table-bordered" style="font-size: 16px;">
<?php

$datos = "SELECT
   `teatro13_tcarrhh`.`medios_empresa`.`Id`,
   `teatro13_tcarrhh`.`medios_empresa`.`empresa`,
   `teatro13_tcarrhh`.`medios_empresa`.`tipo`
FROM
  `teatro13_tcarrhh`. `medios_empresa`
  WHERE
    `teatro13_tcarrhh`.`medios_empresa`.`tipo` = '$_GET[categoria]'
  ;";
$all_rows = ExecuteRows($datos);
$json_result = json_encode( $all_rows );
$array = json_decode($json_result);
foreach($array as $obj){
?>
<tr>
<td><a href="Proceso.Medios.php?PHPKEYID=<?php echo $falsekey;?>&op=directorio&empresa=<?php echo $obj->Id;?>&categoria=<?php echo $obj->tipo;?>" class="btn btn-default">Ver empresas</a></td>
<td><?php echo $obj->empresa;?></td>
<td><?php echo medio($obj->tipo);?></td></tr>
<?php } ?>
	</table>

	
	
<?php } else { ?>		

	<div class="row">
<?php

$datos = "SELECT
  `teatro13_tcarrhh`. `medios_contactos`.`Id`,
  `teatro13_tcarrhh`. `medios_contactos`.`empresa`,
   `teatro13_tcarrhh`.`medios_contactos`.`subempresa`,
   `teatro13_tcarrhh`.`medios_contactos`.`subempresa2`,
   `teatro13_tcarrhh`.`medios_contactos`.`nombre`,
   `teatro13_tcarrhh`.`medios_contactos`.`apellidos`,
   `teatro13_tcarrhh`.`medios_contactos`.`cargo`,
   `teatro13_tcarrhh`.`medios_contactos`.`telefonos`,
   `teatro13_tcarrhh`.`medios_contactos`.`email`
FROM
   `teatro13_tcarrhh`.`medios_contactos`
WHERE
   `teatro13_tcarrhh`.`medios_contactos`.`empresa` = $_GET[empresa]
  ;";
$all_rows = ExecuteRows($datos);
$json_result = json_encode( $all_rows );
$array = json_decode($json_result);
foreach($array as $obj){
?>
<div class="col">
	<div class="card" style="width: 18rem; font-size: 16px;">

  <div class="card-body">
    <p class="card-title" style=" font-size:14px;"><BR><?php echo $obj->subempresa;?><BR><?php echo $obj->subempresa2;?></p>
    <p class="card-text">
	<small>
	<i class="fa fa-id-card-o" aria-hidden="true"></i> <?php echo $obj->nombre;?> <?php echo $obj->apellidos;?>
	<br><i class="fa fa-fax" aria-hidden="true"></i>  <?php echo $obj->cargo;?>
	<br><i class="fa fa-phone-square" aria-hidden="true"></i>  <?php echo $obj->telefonos;?>

		<br><i class="fa fa-envelope-o" aria-hidden="true"></i>  <?php echo $obj->email;?>
	</small>
	</p>




  </div>
</div>
	
	


            </div>
<?php } ?>

<?php } ?>	

</div>
</div>
	
	
	</div>
	
	</div>
	
	
	</div>



<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$main->terminate();
?>