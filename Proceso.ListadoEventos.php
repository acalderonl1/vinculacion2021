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
<?php include("systeatro2020.php"); ?>
<table class="table table-bordered">
<tr><td></td><td style="width:300px">Evento</td><td>Grabación</td><td>Subida/Transmisión</td><td style="width:600px"></td></tr>
<?php 
$sql = "SELECT
  `Live_Brief`.`Id`,
  `Live_Brief`.`tipo`,
  `Live_Brief`.`categoria`,
  `Live_Brief`.`titulo`,
  `Live_Brief`.`fecha`,
  `Live_Brief`.`descripcion`,
  `Live_Brief`.`observaciones`,
  `Live_Brief`.`carpeta`,
  `Live_Brief`.`estadisticas`,
  `Live_Brief`.`fechaGrabacion`,
  `Live_Brief`.`HoraGrabacion`,
  `Live_Brief`.`FechaEvento`,
  `Live_Brief`.`HoraEvento`,
  `Live_Brief`.`SalaEvento`,
  `Live_Brief`.`estado`,
  `Live_Brief`.`UsuarioGrabar`
FROM
  `Live_Brief`
WHERE
  `Live_Brief`.`estado` != 3
ORDER BY
  `Live_Brief`.`fecha` ASC

  ;";
$a = ExecuteRows($sql);
$b = json_encode( $a );
$c = json_decode($b);

foreach($c as $row){?>
<tr><td>
<a href="Proceso.Imprimir.Brief.php?Id=<?php echo $row->Id;?>" class="btn btn-default" <?php echo popup(800,500);?>><i class="fa fa-print" aria-hidden="true"></i></a>
<a href="Live_Briefedit.php?Id=<?php echo $row->Id;?>" class="btn btn-default" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
<a href="Live_Briefdelete.php?Id=<?php echo $row->Id;?>" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i></a>

</td>
<td>
<h4><?php echo $row->titulo;?></h4>
<table class="table table-bordered table-sm">
<tr><td>COD</td><td>2020<?php echo $row->Id;?></td></tr>
<tr><td>TIPO</td><td><?php if($row->tipo =='1'){ echo 'ONDEMAND';}?><?php if($row->tipo =='2'){ echo 'LIVE STREAMING';}?><?php if($row->tipo =='3'){ echo 'OTRA';}?></td></tr>
<tr><td>CATEGORIA</td><td><?php echo ExecuteScalar("SELECT `Live_Brief_categorias`.`titulo` FROM `Live_Brief_categorias` WHERE `Live_Brief_categorias`.`Id` =  $row->categoria;"); ?></td></tr>
</table>
</td>
<!-- aplica grabacion -->
<td>
	<?php if($row->fechaGrabacion!=''){?>
<table width="100%" class="table table-bordered table-sm">
<tr><td><i class="fa fa-video-camera" aria-hidden="true"></i><i class="fa fa-calendar" aria-hidden="true"></i></td><td><?php echo dame_el_dia($row->fechaGrabacion);?> <?php echo fechas($row->fechaGrabacion);?></td></tr>
<tr><td><i class="fa fa-video-camera" aria-hidden="true"></i><i class="fa fa-clock-o" aria-hidden="true"></i></td><td><?php echo $row->HoraGrabacion;?></td></tr>
<tr><td><i class="fa fa-video-camera" aria-hidden="true"></i><i class="fa fa-user" aria-hidden="true"></i></td><td><?php echo $row->UsuarioGrabar;?></td></tr>

    </table>
<?php } ?></td>
<!-- feca de transmicipon -->

<td>
<table width="100%" class="table table-bordered table-sm">
 <tr><td><i class="fa fa-youtube-play" aria-hidden="true"></i><i class="fa fa-calendar" aria-hidden="true"></i></td><td>
<?php
// EVENTO TIENE FECHA DE TRANSMICIÓN EN EL SISTEMA
 if($row->FechaEvento!=''){?>
		<?php echo dame_el_dia($row->FechaEvento);?> <?php echo fechas($row->FechaEvento);?>
<?php }else{
//Leemos los datos desde la categoria	
	?>
<?php echo dame_el_dia($row->fecha);?> <?php echo fechas($row->fecha);?>	
<?php }?>
</td></tr>
<tr><td ><i class="fa fa-youtube-play" aria-hidden="true"></i><i class="fa fa-clock-o" aria-hidden="true"></i></td>
        <td>
		<?php echo $row->HoraEvento;?>
		<?php echo ExecuteScalar("SELECT `Live_Brief_categorias`.`hora` FROM `Live_Brief_categorias` WHERE `Live_Brief_categorias`.`Id` =  $row->categoria;"); ?>

		</td>

        </tr>
    </table>

</td>
<td>


<table class="table table-sm">
<tbody><tr><td style="background: #ffb100; color: #fff;"> INGRESADO </td></tr>
<tr>
<td style="font-size:11px">
<table class="table table-sm" style="margin-bottom:0px;"><tbody><tr><td style="width:60%">

<div class="progress">
  <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<code>Evento vencido</code>
 </td>
 <td style="width:30%">%%%%</td></tr></tbody></table>
 
<table class="table table-sm table-bordered" style="margin-bottom:0px;"> 
<tbody><tr><td>Diseño Gráfico</td><td>Afiche</td><td>Adaptaciones</td><td>Anuncios de prensa</td><td>Totem/Tv</td></tr>
<tr><td></td><td>
</td>
<td>{data}</td>
<td></td>
<td></td></tr>
</tbody></table>

<table class="table table-sm table-bordered" style="margin-bottom:0px;"> 
<tbody><tr><td>Web Developer</td><td>Website</td><td>Evento</td><td>Mailing</td><td>Ticketshow</td></tr>
<tr>
<td></td>
<td></td>

<td></td>
<td></td>
<td></td>
</tr>
</tbody></table>

<table class="table table-sm table-bordered" style="margin-bottom:0px;"> 
<tbody><tr><td>Community Manager</td><td>Post</td><td>Campaña</td></tr>
<tr><td></td>
<td></td>

<td>
<table class="table table-sm table-bordered"> 
<tbody><tr><td></td>
<td>Inicio</td><td>Fin</td><td>Resultados</td></tr>
<tr>
<td></td>

<td></td>
<td></td>
<td>0</td>

</tr>
  </tbody></table>
  

</td></tr>
</tbody></table>


</td></tr>



</tbody></table>



</td>
</tr>
<?php }  ?>

</table>

<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$main->terminate();
?>