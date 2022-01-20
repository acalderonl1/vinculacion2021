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
if($_GET[IdEvento]!=''){
Execute("UPDATE `Live_Brief` SET   `Live_Brief`.`estadisticas` = '$_GET[cantidad]', `Live_Brief`.`estadisticas2` = '$_GET[cantidad2]' WHERE  `Live_Brief`.`Id` ='$_GET[IdEvento]'");
echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
 Estadisticas actualizadas correctamente
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>


<script>
//alert("SISTEMA EN MANTENIMIENTO, SE PUEDE AGREGAR NUEVOS, NO SE PUEDE EDITAR O ELIMINAR");
</script>
<?php 


/***************************************************
			SABER DIA DE LA SEMANA
/***************************************************/


function DiaNumero ($s)
{
$a['Sunday'] = "7";
$a['Monday'] = "1";
$a['Tuesday'] = "2";
$a['Wednesday'] = "3";
$a['Thursday'] = "4";
$a['Friday'] = "5";
$a['Saturday'] = "6";
return $a[date('l', strtotime($s))];
}

function textoDia ($s)
{
$a['Sunday'] = "Domingo";
$a['Monday'] = "Lunes";
$a['Tuesday'] = "Martes";
$a['Wednesday'] = "Miercoles";
$a['Thursday'] = "Jueves";
$a['Friday'] = "Viernes";
$a['Saturday'] = "Sabado";
return $a[date('l', strtotime($s))];
}


 $sql = "SELECT
  `Live_Brief_categorias`.`Id`,
  `Live_Brief_categorias`.`tipo`,
  `Live_Brief_categorias`.`titulo`,
  `Live_Brief_categorias`.`hora`,
  `Live_Brief_categorias`.`periodo`,
  
  `Live_Brief_categorias`.`dia`
FROM
  `Live_Brief_categorias`
WHERE

 `Live_Brief_categorias`.`tipo` = '2'
  ;";
$a = ExecuteRows($sql);
$b = json_encode( $a );
$c = json_decode($b);

foreach($c as $tmp){ } 



/***************************************************
			PARAMETROS DE INICIALIZAR EL CALENDARIO
/***************************************************/

if($_GET[m]==''){$m= date(m);}else{$m=$_GET[m];}
if($_GET[y]==''){$y= date(Y);}else{$y=$_GET[y];}
if($_GET[LblCategoria]==''){$LblCategoria = 'Todas';}else{$LblCategoria=$_GET[LblCategoria];}

if($_GET[live]==''){$live = 'on';}else{$live=$_GET[live];}
if($_GET[rec]==''){$rec = 'on';}else{$rec=$_GET[rec];}
if($_GET[ytube]==''){$ytube = 'on';}else{$ytube=$_GET[ytube];}
if($_GET[escuelas]==''){$escuelas = 'on';}else{$escuelas=$_GET[escuelas];}
if($_GET[v]==''){$vista = 'mes';}else{$vista=$_GET[v];}
if($_GET[alquiler]==''){$alquiler = 'on';}else{$alquiler=$_GET[alquiler];}
if($_GET[calAnterior]==''){$calAnterior = 'on';}else{$calAnterior=$_GET[calAnterior];}
if($_GET[Arena]==''){$Arena = 'on';}else{$Arena=$_GET[Arena];}
if($_GET[PresencialTCA]==''){$PresencialTCA = 'on';}else{$PresencialTCA=$_GET[PresencialTCA];}

//$ad=date("j");
 
# Obtenemos el dia de la semana del primer dia
# Devuelve 0 para domingo, 6 para sabado
$sm=date("w",mktime(0,0,0,$m,1,$y))+7;
# Obtenemos el ultimo dia del mes
 $ud=date("d",(mktime(0,0,0,$m+1,1,$y)-1));
 
/*
Copiar URL
 'PHPKEYID='.$falsekey.'&m='.$m.'&y='.$y.'&v='.$vista.'&live='.$live.'&rec='.$rec.'&ytube='.$ytube.'&escuelas='.$escuelas.'&alquiler='.$alquiler.'&calAnterior='.$calAnterior.'&Arena='.$Arena.'&PresencialTCA='.$PresencialTCA.'&LblCategoria='.$LblCategoria;

*/

?>

<form class="form-inline sticky-top" style="background:#fff">
<input type="hidden" name="PHPKEYID" value="<?php echo $falsekey;?>">


<table class="table d-print-none"><tr>
<td>

 <a  class="btn btn-default" href="main.php?m=<?php echo date(m); ?>&y=<?php echo date(Y);?>"><span><i class="fa fa-calendar-o"></i></span></a>
 <a href="main.php?&m='.$m.'&y='.$y.'&v=agenda&live='.$live.'&rec='.$rec.'&ytube='.$ytube.'&escuelas='.$escuelas.'&alquiler='.$alquiler.'&calAnterior='.$calAnterior.'&Arena='.$Arena.'&PresencialTCA='.$PresencialTCA.'&LblCategoria='.$LblCategoria; ?>" class="btn btn-default"> <i class="fa fa-bars" aria-hidden="true"></i></a>
<a href="main.php?&m='.$m.'&y='.$y.'&v=mes&live='.$live.'&rec='.$rec.'&ytube='.$ytube.'&escuelas='.$escuelas.'&alquiler='.$alquiler.'&calAnterior='.$calAnterior.'&Arena='.$Arena.'&PresencialTCA='.$PresencialTCA.'&LblCategoria='.$LblCategoria; ?>" class="btn btn-default"><i class="fa fa-calendar" aria-hidden="true"></i></a>
 <a  class="btn btn-default" href="main.php?m=<?php if ($m>1){echo $m-1; } else {echo 12;}?>&y=<?php if ($m==01){echo $y-1; } else {echo $y;}?>"><span><i class="fa fa-arrow-up"></i></span></a>
   <a  class="btn btn-default" href="main.php?m=<?php if ($m<12){echo $m+1; } else {echo '01';}?>&y=<?php if ($m==12){echo $y+1; } else {echo $y;}?>"><span><i class="fa fa-arrow-down"></i></span></a>
   
   
   
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
<input type="number" class="form-control" name="y" value="<?php echo $y;?>" style="width:80px;">


 <button type="submit" class="btn btn-default">Generar</button>
<a class="btn btn-primary" href="Listado.Eventos.php?m=<?php echo $m;?>&y=<?php echo $y;?>">Generar Listado</a>
 <!--
<div class="dropdown" style="float: left;">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Categorias: <?php echo $LblCategoria;?>
  </button>
    
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
   <a href="main.php?v=<?php echo$vista;?>&m=<?php echo $m; ?>&y=<?php echo $y; ?>&live=on&rec=on&ytube=on&escuelas=on&alquiler=on&calAnterior=on&Arena=on&PresencialTCA=on&&LblCategoria=Todas" class="dropdown-item">Todas</a> 
 

<a style="background: #013077; color: #fff;" href="main.php?v=<?php echo$vista;?>&m=<?php echo $m; ?>&y=<?php echo $y; ?>&live=off&rec=off&ytube=on&escuelas=off&alquiler=off&calAnterior=off&Arena=off&PresencialTCA=off&LblCategoria=OnDemand" class="dropdown-item"><i class="fa fa-youtube-play" aria-hidden="true"></i> OnDemand</a>
<a style="background: #000000; color: #fff;"  href="main.php?v=<?php echo$vista;?>&m=<?php echo $m; ?>&y=<?php echo $y; ?>&live=off&rec=on&ytube=off&escuelas=off&alquiler=off&calAnterior=off&Arena=off&PresencialTCA=off&LblCategoria=Grabaciones, Montajes, ensayos y otros" class="dropdown-item"><i class="fa fa-video-camera" aria-hidden="true"></i> Grabaciones, Montajes, ensayos y otros</a>
<a style="background: #3d4856; color: #fff;"  href="main.php?v=<?php echo$vista;?>&m=<?php echo $m; ?>&y=<?php echo $y; ?>&live=on&rec=off&ytube=off&escuelas=off&alquiler=off&calAnterior=off&Arena=off&PresencialTCA=off&LblCategoria=LiveStreaming" class="dropdown-item"><i class="fa fa-forumbee" aria-hidden="true"></i> Live</a>
<a style="background: #4c0479; color: #fff;" href="main.php?v=<?php echo$vista;?>&m=<?php echo $m; ?>&y=<?php echo $y; ?>&escuelas=on&live=off&rec=off&ytube=off&alquiler=off&calAnterior=off&Arena=off&PresencialTCA=off&LblCategoria=Escuelas" class="dropdown-item"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Escuelas</a>
<a style="background: #79041a; color: #fff;" href="main.php?v=<?php echo$vista;?>&m=<?php echo $m; ?>&y=<?php echo $y; ?>&alquiler=on&escuelas=off&live=off&rec=off&ytube=off&calAnterior=off&Arena=off&PresencialTCA=off&LblCategoria=Alquiler" class="dropdown-item"><i class="fa fa-address-book" aria-hidden="true"></i> Alquiler</a>
<a style="background: #03c8f4; color: #fff;" href="main.php?v=<?php echo$vista;?>&m=<?php echo $m; ?>&y=<?php echo $y; ?>&PresencialTCA=on&Arena=off&alquiler=off&escuelas=off&live=off&rec=off&ytube=off&calAnterior=off&LblCategoria=Presencial-TCA" class="dropdown-item"><i class="fa fa-address-book" aria-hidden="true"></i> Presencial TCA</a>
<a style="background: #0985a0; color: #fff;" href="main.php?v=<?php echo$vista;?>&m=<?php echo $m; ?>&y=<?php echo $y; ?>&Arena=on&alquiler=off&escuelas=off&live=off&rec=off&ytube=off&calAnterior=off&PresencialTCA=off&LblCategoria=ArenaTCA" class="dropdown-item"><i class="fa fa-university" aria-hidden="true"></i> Arena</a>
<a style="background: #ff5722; color: #fff;" href="main.php?v=<?php echo$vista;?>&m=<?php echo $m; ?>&y=<?php echo $y; ?>&alquiler=off&escuelas=off&live=off&rec=off&ytube=off&calAnterior=on&Arena=off&PresencialTCA=off&LblCategoria=Calendario Anterior" class="dropdown-item"><i class="fa fa-address-book" aria-hidden="true"></i> Calendario Anterior</a>


  </div>
</div>
-->




</td>

</tr>
</table>
</form>

<table align="center"><tr><td>


<table class="table table-bordered table-sm" >

<tbody >
<tr>
<?php
$uc=$sm+$ud;
for($i=1;$i<=49;$i++)
{
if($i==$sm){$day=1;}

if($i<$sm || $i>=$uc)
{
//DIAS PREVIOS
if($i<$sm){ ?>
<?php if($vista=='agenda'){?><tr><td style="height:1px;  padding: 0px;"></td></tr> <?php } ?>
<?php if($vista=='mes'){?><td style="height:1px;  padding: 0px;"></tD> <?php } ?>



<?php }
//DIAS DEL SIGUIENTE MES
if($i>=$uc){ ?>

<?php if($vista=='agenda'){?><tr><td style="height:1px;  padding: 0px;"></td></tr> <?php } ?>
<?php if($vista=='mes'){?><td></tD> <?php } ?>
<?php }
}else{ 

//Formateando dia
if($day<10){$dia='0'.$day;}else{$dia=$day;}
 $fdia = $y.'-'.$m.'-'.$dia;
 
 // activamos casilla si dis conincide con actual
if($hoy==$fdia){ $color ='border-top: 5px solid #0073b7; background: #e2f3fd;';}else{$color='';}

?>
<?php if($vista=='agenda'){?><tr> <?php } ?>
<td  style="<?php echo $color;?>width:14%; font-size:11px;"><b><?php echo dame_el_dia($fdia);?> <?php echo fechas($fdia);?> </b> <hr>

<?php
$d = DiaNumero($fdia); 
?>

<span class="text-danger">
<?php 
echo ExecuteScalar("SELECT
`Live_Brief`.`titulo`
FROM
`Live_Brief_Fechas`
INNER JOIN `Live_Brief` ON `Live_Brief`.`Id` = `Live_Brief_Fechas`.`IdEvento`
WHERE
`Live_Brief_Fechas`.`fecha` = '$fdia' AND
`Live_Brief_Fechas`.`tipodato` = 666");
/*******feriados */

?>
</span>

<?php 

/**************************************
 NUEVO CALENDARIO 2020 LIVE
 Listar todo tipo de eventos
/**************************************/
 $sql = "
SELECT
  `Live_Brief_Fechas`.`IdEvento`,
  `Live_Brief_Fechas`.`fecha`,
  `Live_Brief_Fechas`.`hora`,
  `Live_Brief_Fechas`.`tipodato`,
  `Live_Brief_Fechas`.`titulo`,
  `Live_Brief`.`Id`,
  `Live_Brief`.`tipo`,
  `Live_Brief`.`SubTipo`,
  `Live_Brief`.`categoria`,
  `Live_Brief`.`titulo`,
  `Live_Brief`.`estado`,
  `Live_Brief`.`estadisticas`,
  `Live_Brief`.`estadisticas2`,
  `Live_Brief`.`SalaEvento`,
  `Live_Brief`.`UsuarioGrabar`,
  `Live_Brief`.`Grabar`,
  `Live_Brief`.`Modalidad`,
  `Live_Brief`.`UserId`,
  `Live_Brief_categorias`.`titulo` AS `lblcategoria`,
  `Live_Brief_Fechas`.`titulo` AS `ObservacionFecha`,
  `Live_Brief_categorias`.`dia`,
  `Live_Brief_categorias`.`periodo`,
  `Live_Brief_Fechas`.`Id` AS `FechaId`
FROM
  `Live_Brief_Fechas`
  INNER JOIN `Live_Brief` ON `Live_Brief`.`Id` = `Live_Brief_Fechas`.`IdEvento`
  INNER JOIN `Live_Brief_categorias` ON `Live_Brief_categorias`.`Id` =
    `Live_Brief`.`categoria`
WHERE
  `Live_Brief_Fechas`.`fecha` = '$fdia' 
  AND 
  `Live_Brief_Fechas`.`tipodato` !='666'
ORDER BY
  `Live_Brief_Fechas`.`hora`

;";
$a = ExecuteRows($sql);
$b = json_encode( $a );
$c = json_decode($b);

foreach($c as $tmp){  ?>

<?php 
# Verificar errores: Este tipo de fechas nunca puede ser despues del evento Tipo dato = 2 - 4

 $VerificaFecha = ExecuteScalar("SELECT `Live_Brief_Fechas`.`fecha` FROM `Live_Brief_Fechas`WHERE `Live_Brief_Fechas`.`IdEvento` = '$tmp->IdEvento' AND `Live_Brief_Fechas`.`tipodato` = '$tmp->tipo' ");
//echo ("SELECT `Live_Brief_Fechas`.`fecha` FROM `Live_Brief_Fechas`WHERE `Live_Brief_Fechas`.`IdEvento` = '$tmp->IdEvento' AND `Live_Brief_Fechas`.`tipodato` = '$tmp->tipo' ");

//if($tmp->fecha > $VerificaFecha){ $VerificaFecha = '<strong style="color: #ff0000;">E  R  R  O  R <br>'.$tmp->UserId.' favor corregir </strong><br> <small>Fecha de presentación es menor</small><br>';}else{$VerificaFecha='';}
?>
 <BR> 

<?php
/**************************************
 GRABACIONES, ENSAYOS Y MONTAJES
/**************************************/
if($rec =='on'){
 #--------GRABACIONES
if($tmp->tipodato =='5' ){?>
<div class="card" style=" border-top: 4px; border-top-style: solid;  border-color: #000000;">
<span style="color:#fff;background: #000000; padding: 2px 4px 2px 10px;  display: block;">
GRABACION
<?php if($tmp->Grabar =='1'){ echo '<i class="fa fa-video-camera" aria-hidden="true"></i>  Grabación Domicilio';}?>   
<?php if($tmp->Grabar =='4'){ echo '<i class="fa fa-video-camera" aria-hidden="true"></i>  Grabación Teatro';}?>   
<?php if($tmp->Grabar =='5'){ echo '<i class="fa fa-video-camera" aria-hidden="true"></i>  Grabación Virtual';}?>   
<?php if($tmp->Grabar =='6'){ echo '<i class="fa fa-video-camera" aria-hidden="true"></i>  Grabación EXTERNA';}?>   
 
 

</span>
<div class="card-body" style="padding: 4px; border: 1px solid #000000;">


<b><?php echo $tmp->titulo;?></b>
<br><?php echo $tmp->ObservacionFecha;?>
<br><small><?php echo $tmp->lblcategoria;?></small>
<br>Hora: <?php echo $tmp->hora;?>
<?php if($tmp->Grabar =='4'){?><br><?php echo sala($tmp->SalaEvento);?><?php } ?>
<br>

<div class="btn-group d-print-none" role="group" aria-label="Evento<?php echo $tmp->Id;?>">
<a class="btn btn-dark btn-sm" href="Proceso.Imprimir.Brief.php?Id=<?php echo $tmp->Id;?>"  <?php echo popup(650,700);?>><i class="fa fa-eye" aria-hidden="true"></i></a>

<?php /*if($UserData[calendario]=='1'){?>
<a class="btn btn-dark btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=fecha"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<a class="btn btn-dark btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=fecha"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
<?php } */?>
</div>
 </div>
</div>





<?php } #-- END GRABACION   ?>


<?php  #--------Ensayos  
if($tmp->tipodato =='7'){?>
<div class="card" style=" border-top: 4px; border-top-style: solid;  border-color: #000000;">
<span style="color:#fff;background: #000000; padding: 2px 4px 2px 10px;  display: block;">
<i class="fa fa-sitemap" aria-hidden="true"></i> ENSAYOS</span>
<div class="card-body" style="padding: 4px; border: 1px solid #000000;">
<b><?php echo $tmp->titulo;?></b>
<br><small><?php echo $tmp->ObservacionFecha;?></small>
<br><small><?php echo $tmp->lblcategoria;?></small>
<br>Hora: <?php echo $tmp->hora;?>
<br><?php echo sala($tmp->SalaEvento);?>
<br>
<div class="btn-group d-print-none" role="group" aria-label="Evento<?php echo $tmp->Id;?>">
<a class="btn btn-dark btn-sm" href="Proceso.Imprimir.Brief.php?Id=<?php echo $tmp->Id;?>"  <?php echo popup(650,700);?>><i class="fa fa-eye" aria-hidden="true"></i></a>

<?php /*if($UserData[calendario]=='1'){?>
<a class="btn btn-dark btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=fecha"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<a class="btn btn-dark btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=fecha"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
<?php } */?>
</div>
</div>
 </div>
</div>




<?php } #--- END ENSAYOS ?>


<?php  #-------- MONTAJES 
if($tmp->tipodato =='6'){?>
<div class="card" style=" border-top: 4px; border-top-style: solid;  border-color: #000000;">
<span style="color:#fff;background: #000000; padding: 2px 4px 2px 10px;  display: block;">
<i class="fa fa-cog" aria-hidden="true"></i> MONTAJE
</span>
<div class="card-body" style="padding: 4px; border: 1px solid #000000;">

<b><?php echo $tmp->titulo;?></b>
<br><small><?php echo $tmp->ObservacionFecha;?></small>
<br><small><?php echo $tmp->lblcategoria;?></small>
<br>Hora: <?php echo $tmp->hora;?>
<br><?php echo sala($tmp->SalaEvento);?>
<br>
<div class="btn-group d-print-none" role="group" aria-label="Evento<?php echo $tmp->Id;?>">
<a class="btn btn-dark btn-sm" href="Proceso.Imprimir.Brief.php?Id=<?php echo $tmp->Id;?>"  <?php echo popup(650,700);?>><i class="fa fa-eye" aria-hidden="true"></i></a>
<?php /*if($UserData[calendario]=='1'){?>
<a class="btn btn-dark btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=fecha"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<a class="btn btn-dark btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=fecha"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
<?php } */?>
</div>
 </div>
</div>


<?php } #--- END MONTAJES ?>

<?php  #-------- OTRO TIPO
if($tmp->tipodato =='3'&& $tmp->categoria!='21'){?>
<div class="card" style=" border-top: 4px; border-top-style: solid;  border-color: #000000;">
<span style="color:#fff;background: #000000; padding: 2px 4px 2px 10px;  display: block;">
<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Otros: <?php echo $tmp->ObservacionFecha;?>
</span>
<div class="card-body" style="padding: 4px; border: 1px solid #000000;">
<b><?php echo $tmp->titulo;?></b>
<br><small><?php echo $tmp->ObservacionFecha;?></small>
<br><small><?php echo $tmp->lblcategoria;?></small>
<br>Hora: <?php echo $tmp->hora;?>
<br><?php echo sala($tmp->SalaEvento);?>
<br>
<div class="btn-group d-print-none" role="group" aria-label="Evento<?php echo $tmp->Id;?>">
<a class="btn btn-default btn-sm" href="Proceso.Imprimir.Brief.php?Id=<?php echo $tmp->Id;?>"  <?php echo popup(650,700);?>><i class="fa fa-eye" aria-hidden="true"></i></a>

<?php if($UserData[auth]=='PROPIO'){?>
<a class="btn btn-default btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=fecha"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<a class="btn btn-default btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=fecha"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
<?php } ?>
</div>
 </div>
</div>


</div>
<?php } #--- END MONTAJES ?>

<?php  }
/**************************************
END GRABACIONES, ENSAYOS Y MONTAJES
/**************************************/
?>





<?php 
/*
#-------- ONDEMAND 
if($ytube == 'on'){
if($tmp->tipodato =='1'){?>
<div class="card" style="border-top: 4px; border-top-style: solid;  border-color: #013077;">
<span style="color: #fff; padding: 2px 4px 2px 10px;  display: block; background: #013077"><i class="fa fa-youtube-play" aria-hidden="true"></i> OnDemand <?php if($tmp->categoria=='23'){echo 'Resagado';}?> </span>
<div class="card-body"  style="padding: 4px; border: 1px solid #013077;">
<b><?php echo $tmp->titulo;?></b>
<br><small><?php echo $tmp->ObservacionFecha;?></small>
<br><small><?php echo $tmp->lblcategoria;?></small>
<br>Hora: <?php echo $tmp->hora;?>
<?php if($tmp->SalaEvento !=''){?><br><?php echo sala($tmp->SalaEvento);?><?php } ?>
<br>
<div class="btn-group d-print-none" role="group" aria-label="Evento<?php echo $row->Id;?>">
<a class="btn btn-default btn-sm" href="Proceso.Imprimir.Brief.php?Id=<?php echo $tmp->Id;?>"  <?php echo popup(650,700);?>><i class="fa fa-eye" aria-hidden="true"></i></a>

<?php if($UserData[calendario]=='1'){?>
<a class="btn btn-default btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=data"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<a class="btn btn-default btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=fecha"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
<?php } ?>

<?php if($tmp->Grabar!='2'){?>
 <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-video-camera" aria-hidden="true"></i> <small>
 <?php echo  ExecuteScalar("SELECT `Live_Brief_Fechas`.`fecha` FROM `Live_Brief_Fechas` WHERE  `Live_Brief_Fechas`.`IdEvento` = '$tmp->Id' AND  `Live_Brief_Fechas`.`tipodato` = '5'");
  ?></small></button>
<?php } ?> 

</div>
 </div>
</div>




<?php }  }


 #--- END ON DEMAND ?>
 
 <?php  #-------- LIVE STREAMING
if($live == 'on'){
if($tmp->tipodato =='2'){?>
<div class="card" style=" border-top: 4px; border-top-style: solid;  border-color: #3d4856;">
<span style="color:#fff; background: #3d4856; padding: 2px 4px 2px 10px;  display: block;"><i class="fa fa-forumbee" aria-hidden="true"></i> LiveStreaming  <?php if($tmp->categoria=='24'){echo 'Resagado';}?> <?php if($tmp->SubTipo =='0'){echo 'PREGRABADO';}else{ echo 'PRESENCIAL';}?></span>
<div class="card-body"  style="padding: 4px; border: 1px solid #3d4856;">
<b><?php echo $tmp->titulo;?></b>
<br><small><?php echo $tmp->ObservacionFecha;?></small>
<br><small><?php echo $tmp->lblcategoria;?></small>
<br>Hora: <?php echo $tmp->hora;?>
<?php if($tmp->SalaEvento !=''){?><br><?php echo sala($tmp->SalaEvento);?><?php } ?>
<br>
<div class="btn-group d-print-none" role="group" aria-label="Evento<?php echo $tmp->Id;?>">
<a class="btn btn-default btn-sm" href="Proceso.Imprimir.Brief.php?Id=<?php echo $tmp->Id;?>"  <?php echo popup(650,700);?>><i class="fa fa-eye" aria-hidden="true"></i></a>

<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#Estaditicas<?php echo $tmp->IdEvento;?>"><i class="fa fa-bar-chart" aria-hidden="true"></i></button>
<?php if($UserData[calendario]=='1'){?>
<a class="btn btn-default btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=data"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<a class="btn btn-default btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=fecha"  ><i class="fa fa-trash" aria-hidden="true"></i></a>

<?php } ?>

<?php if($tmp->Grabar!='2'){?>
 <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-video-camera" aria-hidden="true"></i> <small>
 <?php echo  ExecuteScalar("SELECT `Live_Brief_Fechas`.`fecha` FROM `Live_Brief_Fechas` WHERE  `Live_Brief_Fechas`.`IdEvento` = '$tmp->Id' AND  `Live_Brief_Fechas`.`tipodato` = '5'");
  ?></small></button>
<?php } ?> 

</div>
 </div>
</div>



<div class="modal fade danger" id="Estaditicas<?php echo $tmp->IdEvento;?>" tabindex="-1" aria-labelledby="Estaditicas<?php echo $tmp->IdEvento;?>Label" aria-hidden="true">
  <div class="modal-dialog modal-sm"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>
      <div class="modal-body">
     Por favor indique cuantas visualizaciones en total tuvo esta transmición
	 <br><b><?php echo $tmp->titulo;?></b>
	 <br><b><?php echo $tmp->fecha;?></b>
	  
	  <form name="id="Estaditicas<?php echo $tmp->IdEvento;?>">
	  <input type="hidden" name="PHPKEYID" value="<?php echo $falsekey;?>">
	  <input type="hidden" name="IdEvento" value="<?php echo $tmp->IdEvento;?>">
	  <input type="hidden" name="m" value="<?php echo $_GET[m];?>">
	  <input type="hidden" name="y" value="<?php echo $_GET[y];?>">
  <div class="form-group">
Asistencia Virtual   
   <input type="number" class="form-control" name="cantidad" value="<?php echo $tmp->estadisticas;?>">
    
  </div>

  <div class="form-group">
Asistencia Presencial  
   <input type="number" class="form-control" name="cantidad2" value="<?php echo $tmp->estadisticas2;?>">
    
  </div>

  <button type="submit" class="btn btn-primary">Grabar</button>
</form>
      </div>

    </div>
  </div>
</div>





<?php }  }
 #--- END LIVE STREAMING */?>
 
 

 <?php  # -- EVENTOS DEL TEATRO
 $Activo = 1;
if($tmp->tipodato =='5'){$Activo = 0;}
if($tmp->tipodato =='6'){$Activo = 0;}
if($tmp->tipodato =='7'){$Activo = 0;}
if($tmp->tipodato =='99'){$Activo = 0;}

if($tmp->tipo !='4' && $Activo ==1){?>
<div class="card" style=" border-top: 4px; border-top-style: solid;  border-color: #0d6efd">
<span style="color:#fff; background: #0d6efd; padding: 2px 4px 2px 10px;  display: block; text-transform:uppercase"><?php echo $tmp->lblcategoria; ;?></span>
<div class="card-body"  style="padding: 4px; border: 1px solid #0d6efd">
<b><?php echo $tmp->titulo;?></b>
<br><small><?php echo $tmp->ObservacionFecha;?></small>
<br>Hora: <?php echo $tmp->hora;?>
<?php if($tmp->SalaEvento !=''){?><br><?php echo sala($tmp->SalaEvento);?><?php } ?>
<br>
<div class="btn-group d-print-none" role="group" aria-label="Evento<?php echo $tmp->Id;?>">
<a class="btn btn-primary btn-sm" href="Proceso.Imprimir.Brief.php?Id=<?php echo $tmp->Id;?>"  <?php echo popup(650,700);?>><i class="fa fa-eye" aria-hidden="true"></i></a>
<a class="btn btn-primary btn-sm" href="../DataBrief/Live_Briefedit.php?Id=<?php echo $tmp->Id;?>"  <?php echo popup(300,200);?>><i class="fa fa-upload" aria-hidden="true"></i></a>

<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Estaditicas<?php echo $tmp->IdEvento;?>"><i class="fa fa-bar-chart" aria-hidden="true"></i></button>
<?php if($UserData[auth]=='PROPIO'){?>
<a class="btn btn-primary btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=data"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<a class="btn btn-primary btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=fecha"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
<?php } ?>
<?php if($UserData[auth]=='TODOS'){?>
<a class="btn btn-primary btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=data"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<a class="btn btn-primary btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=fecha"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
<?php } ?>

<?php /*if($tmp->Grabar!='2'){?>
 <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-video-camera" aria-hidden="true"></i> <small>
 <?php echo  ExecuteScalar("SELECT `Live_Brief_Fechas`.`fecha` FROM `Live_Brief_Fechas` WHERE  `Live_Brief_Fechas`.`IdEvento` = '$tmp->Id' AND  `Live_Brief_Fechas`.`tipodato` = '5'");
  ?></small></button>
<?php } */?> 

</div>
 </div>
</div>



<div class="modal fade danger" id="Estaditicas<?php echo $tmp->IdEvento;?>" tabindex="-1" aria-labelledby="Estaditicas<?php echo $tmp->IdEvento;?>Label" aria-hidden="true">
  <div class="modal-dialog modal-sm"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>
      <div class="modal-body">
     Por favor indique cuantas visualizaciones en total tuvo esta transmición
	 <br><b><?php echo $tmp->titulo;?></b>
	 <br><b><?php echo $tmp->fecha;?></b>
	  
	  <form name="id="Estaditicas<?php echo $tmp->IdEvento;?>">
	  <input type="hidden" name="PHPKEYID" value="<?php echo $falsekey;?>">
	  <input type="hidden" name="IdEvento" value="<?php echo $tmp->IdEvento;?>">
	  <input type="hidden" name="m" value="<?php echo $_GET[m];?>">
	  <input type="hidden" name="y" value="<?php echo $_GET[y];?>">
  <div class="form-group">
Asistencia Virtual   
   <input type="number" class="form-control" name="cantidad" value="<?php echo $tmp->estadisticas;?>">
    
  </div>

  <div class="form-group">
Asistencia Presencial  
   <input type="number" class="form-control" name="cantidad2" value="<?php echo $tmp->estadisticas2;?>">
    
  </div>

  <button type="submit" class="btn btn-primary">Grabar</button>
</form>
      </div>

    </div>
  </div>
</div>





<?php }  
 #--- END LIVE STREAMING ?>
 


 


 <?php  #-------- LALQUILER

if($tmp->tipodato =='99'){?>
<div class="card" style=" border-top: 4px; border-top-style: solid;  border-color: #dc3545;">
<span style="color:#fff; background: #dc3545; padding: 2px 4px 2px 10px;  display: block; text-transform:uppercase"><i class="fa fa-address-book" aria-hidden="true"></i> PRE-RESERVA</span>
<div class="card-body"  style="padding: 4px; border: 1px solid #dc3545;">
<b><?php echo $tmp->titulo;?></b>
<br><small><?php echo $tmp->ObservacionFecha;?></small>
<br><small><?php echo $tmp->lblcategoria;?></small>
<br>Hora: <?php echo $tmp->hora;?>
<?php if($tmp->SalaEvento !=''){?><br><?php echo sala($tmp->SalaEvento);?><?php } ?>
<br>
<div class="btn-group d-print-none" role="group" aria-label="Evento<?php echo $tmp->Id;?>">
<a class="btn btn-danger btn-sm" href="Proceso.Imprimir.Brief.php?Id=<?php echo $tmp->Id;?>"  <?php echo popup(650,700);?>><i class="fa fa-eye" aria-hidden="true"></i></a>

<?php  if($UserData[auth]=='TODOS'){?>
<a class="btn btn-danger btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=data"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<a class="btn btn-danger btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=fecha"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
<?php } ?>

<?php if($UserData['auth']=='RESERVA'){?>
<a class="btn btn-danger btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=data&tipo=reserva"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<a class="btn btn-danger btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=fecha&tipo=reserva"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
<?php } ?>
<?php /*if($tmp->Grabar!='2' ){?>
 <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-video-camera" aria-hidden="true"></i> <small>
 <?php echo  ExecuteScalar("SELECT `Live_Brief_Fechas`.`fecha` FROM `Live_Brief_Fechas` WHERE  `Live_Brief_Fechas`.`IdEvento` = '$tmp->Id' AND  `Live_Brief_Fechas`.`tipodato` = '5'");
  ?></small></button>
<?php } */?> 

</div>
 </div>
</div>


</div>
<?php }  
 #--- END ALQUIULER ?>
 


 <?php  #-------- LALQUILER
if($alquiler == 'on'){
if($tmp->tipodato =='4'){?>
<div class="card" style=" border-top: 4px; border-top-style: solid;  border-color: #ffc107;">
<span style="color:#fff; background: #ffc107; padding: 2px 4px 2px 10px;  display: block; text-transform:uppercase"><i class="fa fa-address-book" aria-hidden="true"></i> ALQUILER</span>
<div class="card-body"  style="padding: 4px; border: 1px solid #ffc107;">
<b><?php echo $tmp->titulo;?></b>
<br><small><?php echo $tmp->ObservacionFecha;?></small>
<br><small><?php echo $tmp->lblcategoria;?></small>
<br>Hora: <?php echo $tmp->hora;?>
<?php if($tmp->SalaEvento !=''){?><br><?php echo sala($tmp->SalaEvento);?><?php } ?>
<br>
<div class="btn-group d-print-none" role="group" aria-label="Evento<?php echo $tmp->Id;?>">
<a class="btn btn-warning btn-sm" href="Proceso.Imprimir.Brief.php?Id=<?php echo $tmp->Id;?>"  <?php echo popup(650,700);?>><i class="fa fa-eye" aria-hidden="true"></i></a>

<?php if($UserData[auth]=='ALQUILER'){?>
<a class="btn btn-warning btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=data"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<a class="btn btn-warning btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=fecha"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
<?php } ?>

<?php if($UserData[auth]=='TODOS'){?>
<a class="btn btn-warning btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=data"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<a class="btn btn-warning btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=fecha"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
<?php } ?>

<?php /*if($tmp->Grabar!='2' ){?>
 <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-video-camera" aria-hidden="true"></i> <small>
 <?php echo  ExecuteScalar("SELECT `Live_Brief_Fechas`.`fecha` FROM `Live_Brief_Fechas` WHERE  `Live_Brief_Fechas`.`IdEvento` = '$tmp->Id' AND  `Live_Brief_Fechas`.`tipodato` = '5'");
  ?></small></button>
<?php } */?> 

</div>
 </div>
</div>


</div>
<?php }  }
 #--- END ALQUIULER ?>
 
 
 
  <?php  /*-------- PRESENCIAL TCA
if($PresencialTCA == 'on'){
if($tmp->tipodato =='9'){?>
<div class="card" style=" border-top: 4px; border-top-style: solid;  border-color: #03c8f4;">
<span style="color:#fff; background: #03c8f4; padding: 2px 4px 2px 10px;  display: block;"><i class="fa fa-address-book" aria-hidden="true"></i> <?php echo $tmp->lblcategoria;?></span>
<div class="card-body"  style="padding: 4px; border: 1px solid #03c8f4;">
<b><?php echo $tmp->titulo;?></b>
<br><small><?php echo $tmp->ObservacionFecha;?></small>
<br><small><?php echo $tmp->lblcategoria;?></small>
<br>Hora: <?php echo $tmp->hora;?>
<?php if($tmp->SalaEvento !=''){?><br><?php echo sala($tmp->SalaEvento);?><?php } ?>
<br>
<div class="btn-group d-print-none" role="group" aria-label="Evento<?php echo $tmp->Id;?>">
<a class="btn btn-default btn-sm" href="Proceso.Imprimir.Brief.php?Id=<?php echo $tmp->Id;?>"  <?php echo popup(650,700);?>><i class="fa fa-eye" aria-hidden="true"></i></a>
<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#Estaditicas<?php echo $tmp->IdEvento;?>"><i class="fa fa-bar-chart" aria-hidden="true"></i></button>
<?php if($UserData[calendario]=='1'){?>
<a class="btn btn-default btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=data"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<a class="btn btn-default btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=fecha"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
<?php } ?>

<?php if($tmp->Grabar!='2'){?>
 <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-video-camera" aria-hidden="true"></i> <small>
 <?php echo  ExecuteScalar("SELECT `Live_Brief_Fechas`.`fecha` FROM `Live_Brief_Fechas` WHERE  `Live_Brief_Fechas`.`IdEvento` = '$tmp->Id' AND  `Live_Brief_Fechas`.`tipodato` = '5'");
  ?></small></button>
<?php } ?> 

</div>
 </div>
</div>

<div class="modal fade danger" id="Estaditicas<?php echo $tmp->IdEvento;?>" tabindex="-1" aria-labelledby="Estaditicas<?php echo $tmp->IdEvento;?>Label" aria-hidden="true">
  <div class="modal-dialog modal-sm"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>
      <div class="modal-body">
     Por favor indique cuantas visualizaciones en total tuvo esta transmición
	 <br><b><?php echo $tmp->titulo;?></b>
	 <br><b><?php echo $tmp->fecha;?></b>
	  
	  <form name="id="Estaditicas<?php echo $tmp->IdEvento;?>">
	  <input type="hidden" name="PHPKEYID" value="<?php echo $falsekey;?>">
	  <input type="hidden" name="IdEvento" value="<?php echo $tmp->IdEvento;?>">
	  <input type="hidden" name="m" value="<?php echo $_GET[m];?>">
	  <input type="hidden" name="y" value="<?php echo $_GET[y];?>">
  <div class="form-group">
Asistencia Virtual   
   <input type="number" class="form-control" name="cantidad" value="<?php echo $tmp->estadisticas;?>">
    
  </div>

  <div class="form-group">
Asistencia Presencial  
   <input type="number" class="form-control" name="cantidad2" value="<?php echo $tmp->estadisticas2;?>">
    
  </div>

  <button type="submit" class="btn btn-primary">Grabar</button>
</form>
      </div>

    </div>
  </div>
</div>


<?php }   }
 #--- END ALQUIULER ?>

  
 <?php  #-------- LIVE ESPECIAL
if($live == 'on'){
if($tmp->tipodato =='8' && $tmp->categoria=='18'){?>
<div class="card" style=" border-top: 4px; border-top-style: solid;  border-color: #3d4856;">
<span style="color:#fff; background: #3d4856; padding: 2px 4px 2px 10px;  display: block;"><i class="fa fa-forumbee" aria-hidden="true"></i> Otros <?php echo $tmp->lblcategoria;?></span>
<div class="card-body"  style="padding: 4px; border: 1px solid #3d4856;">
<b><?php echo $tmp->titulo;?></b>
<br><small><?php echo $tmp->ObservacionFecha;?></small>
<br><small><?php echo $tmp->lblcategoria;?></small>
<br>Hora: <?php echo $tmp->hora;?>
<?php if($tmp->SalaEvento !=''){?><br><?php echo sala($tmp->SalaEvento);?><?php } ?>
<br>
<div class="btn-group d-print-none" role="group" aria-label="Evento<?php echo $tmp->Id;?>">
<a class="btn btn-default btn-sm" href="Proceso.Imprimir.Brief.php?Id=<?php echo $tmp->Id;?>"  <?php echo popup(650,700);?>><i class="fa fa-eye" aria-hidden="true"></i></a>
<a class="btn btn-default btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=data"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<?php if($tmp->Grabar!='2'){?>
 <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-video-camera" aria-hidden="true"></i> <small>
 <?php echo  ExecuteScalar("SELECT `Live_Brief_Fechas`.`fecha` FROM `Live_Brief_Fechas` WHERE  `Live_Brief_Fechas`.`IdEvento` = '$tmp->Id' AND  `Live_Brief_Fechas`.`tipodato` = '5'");
  ?></small></button>
<?php } ?> 
</div>
</div>
</div>
<?php }  }
 #--- END LIVE ESPECIò ?>
 


 
  <?php  
  #-------- ARENA TCA
if($Arena == 'on'){
if($tmp->tipodato =='11'){?>
<div class="card" style=" border-top: 4px; border-top-style: solid;  border-color: #0985a0;">
<span style="color:#fff; background: #0985a0; padding: 2px 4px 2px 10px;  display: block;"><i class="fa fa-university" aria-hidden="true"></i> <?php echo $tmp->lblcategoria;?></span>
<div class="card-body"  style="padding: 4px; border: 1px solid #0985a0;">
<b><?php echo $tmp->titulo;?></b>
<br><small><?php echo $tmp->ObservacionFecha;?></small>
<br><small><?php echo $tmp->lblcategoria;?></small>
<br>Hora: <?php echo $tmp->hora;?>
<?php if($tmp->SalaEvento !=''){?><br><?php echo sala($tmp->SalaEvento);?><?php } ?>
<br>
<div class="btn-group d-print-none" role="group" aria-label="Evento<?php echo $tmp->Id;?>">
<a class="btn btn-default btn-sm" href="Proceso.Imprimir.Brief.php?Id=<?php echo $tmp->Id;?>"  <?php echo popup(650,700);?>><i class="fa fa-eye" aria-hidden="true"></i></a>
<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#Estaditicas<?php echo $tmp->IdEvento;?>"><i class="fa fa-bar-chart" aria-hidden="true"></i></button>
<?php if($UserData[calendario]=='1'){?>
<a class="btn btn-default btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=data"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#fecha<?php echo $tmp->FechaId;?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
<?php } ?>

<?php if($tmp->Grabar!='2'){?>
 <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-video-camera" aria-hidden="true"></i> <small>
 <?php echo  ExecuteScalar("SELECT `Live_Brief_Fechas`.`fecha` FROM `Live_Brief_Fechas` WHERE  `Live_Brief_Fechas`.`IdEvento` = '$tmp->Id' AND  `Live_Brief_Fechas`.`tipodato` = '5'");
  ?></small></button>
<?php } ?> 

</div>
 </div>
</div>


<div class="modal fade danger" id="Estaditicas<?php echo $tmp->IdEvento;?>" tabindex="-1" aria-labelledby="Estaditicas<?php echo $tmp->IdEvento;?>Label" aria-hidden="true">
  <div class="modal-dialog modal-sm"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>
      <div class="modal-body">
     Por favor indique cuantas visualizaciones en total tuvo esta transmición
	 <br><b><?php echo $tmp->titulo;?></b>
	 <br><b><?php echo $tmp->fecha;?></b>
	  
	  <form name="id="Estaditicas<?php echo $tmp->IdEvento;?>">
	  <input type="hidden" name="PHPKEYID" value="<?php echo $falsekey;?>">
	  <input type="hidden" name="IdEvento" value="<?php echo $tmp->IdEvento;?>">
	  <input type="hidden" name="m" value="<?php echo $_GET[m];?>">
	  <input type="hidden" name="y" value="<?php echo $_GET[y];?>">
  <div class="form-group">
Asistencia Virtual   
   <input type="number" class="form-control" name="cantidad" value="<?php echo $tmp->estadisticas;?>">
    
  </div>

  <div class="form-group">
Asistencia Presencial  
   <input type="number" class="form-control" name="cantidad2" value="<?php echo $tmp->estadisticas2;?>">
    
  </div>

  <button type="submit" class="btn btn-primary">Grabar</button>
</form>
      </div>

    </div>
  </div>
</div>



<?php }
 }  
 #--- END ARENA   */?>
 
 
 
 
 <?php  #-------- ESCUELAS
if($escuelas == 'on'){
if($tmp->tipodato =='3'&& $tmp->categoria=='21'){?>
<div class="card" style=" border-top: 4px; border-top-style: solid;  border-color: #4c0479;">
<span style="color:#fff;background: #4c0479; padding: 2px 4px 2px 10px;  display: block;"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Escuelas de Arte</span>
<div class="card-body"  style="padding: 4px; border: 1px solid #4c0479;">
<b><?php echo $tmp->titulo;?></b>
<br><small><?php echo $tmp->ObservacionFecha;?></small>
<br><small><?php echo $tmp->lblcategoria;?></small>


<br>
<div class="btn-group d-print-none" role="group" aria-label="Evento<?php echo $tmp->Id;?>">
<a class="btn btn-default btn-sm" href="Proceso.Imprimir.Brief.php?Id=<?php echo $tmp->Id;?>"  <?php echo popup(650,700);?>><i class="fa fa-eye" aria-hidden="true"></i></a>

<?php if($UserData[calendario]=='1'){?>
<a class="btn btn-default btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=data"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<a class="btn btn-default btn-sm"href="http://localhost/2020/Proceso.Editar.Brief.php?Id=<?php echo $tmp->Id;?>&tab=fecha"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
<?php } ?>

<?php if($tmp->Grabar!='2'){?>
 <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-video-camera" aria-hidden="true"></i> <small>
 <?php echo  ExecuteScalar("SELECT `Live_Brief_Fechas`.`fecha` FROM `Live_Brief_Fechas` WHERE  `Live_Brief_Fechas`.`IdEvento` = '$tmp->Id' AND  `Live_Brief_Fechas`.`tipodato` = '5'");
  ?></small></button>
<?php } ?> 

</div>
 </div>
</div>

<?php }  }
 #--- END ESCUELAS?>
 
 
 
 
 
 


 
 











<?php } 
/**************************************
 end NUEVO CALENDARIO 2020 LIVE
/**************************************/  ?>
	
	















<?php 

/*
/**************************************
ALERTA DE EVENTOS  QUE NO TIENEN  DATOS
/**************************************/
/*
if($ytube == 'on'){

	
// oMITIMOS SE OMITE DESDE MI ESTUDIO	
$alerta=0; 	
$sql = "SELECT
  `Live_Brief_categorias`.`Id`,
  `Live_Brief_categorias`.`tipo`,
  `Live_Brief_categorias`.`titulo`,
  `Live_Brief_categorias`.`periodo`,
  `Live_Brief_categorias`.`dia`
FROM
  `Live_Brief_categorias`
WHERE
`Live_Brief_categorias`.`dia` = '$d' AND
 `Live_Brief_categorias`.`tipo` = '1' AND
   `Live_Brief_categorias`.`Id` != '1'
  ;";
$a = ExecuteRows($sql);
$b = json_encode( $a );
$c = json_decode($b);

foreach($c as $tmp){  
$alerta = ExecuteScalar("SELECT `Live_Brief`.`Id` FROM  `Live_Brief` WHERE  `Live_Brief`.`categoria` = $tmp->Id  AND	`Live_Brief`.`fecha` = '$fdia'");
 if($alerta==''){ ?>
 <div class="card d-print-none" style="border-top: 4px; border-top-style: solid;  border-color: #013077;">
<span style="color: #fff; padding: 2px 4px 2px 10px;  display: block; background: #013077"><i class="fa fa-youtube-play" aria-hidden="true"></i> OnDemand </span>
<div class="card-body"  style="padding: 4px; border: 1px solid #013077;">
<strong  style="color: #ff0000;">NO HAY EVENTO</strong>
<br><small><?php echo $tmp->titulo;?></small>
</div>
</div>
<?php } ?>
<?php } ?>



<?php
/**************************************
ON DEMAND DESDE MI ESTUDIO
/**************************************/
/*
$alerta=0; 	
$sql = "SELECT
  `Live_Brief_categorias`.`Id`,
  `Live_Brief_categorias`.`tipo`,
  `Live_Brief_categorias`.`titulo`,
  `Live_Brief_categorias`.`periodo`,
  `Live_Brief_categorias`.`dia`
FROM
  `Live_Brief_categorias`
WHERE
`Live_Brief_categorias`.`dia` = '$d' AND
 `Live_Brief_categorias`.`tipo` = '1' AND
 `Live_Brief_categorias`.`periodo` LIKE '%$semana%'
 ORDER BY
  `Live_Brief_categorias`.`hora` ASC
  ;";
$a = ExecuteRows($sql);
$b = json_encode( $a );
$c = json_decode($b);

foreach($c as $tmp){  
 $alerta = ExecuteScalar("SELECT
  `Live_Brief`.`Id`
FROM
  `Live_Brief`
  INNER JOIN `Live_Brief_Fechas` ON `Live_Brief_Fechas`.`IdEvento` =
    `Live_Brief`.`Id`
WHERE
  `Live_Brief`.`categoria` = '$tmp->Id' AND
  `Live_Brief_Fechas`.`fecha` = '$fdia' 
LIMIT 1
  ");

 if($alerta==''){ ?>
 <div class="card d-print-none" style="border-top: 4px; border-top-style: solid;  border-color: #013077;">
<span style="color: #fff; padding: 2px 4px 2px 10px;  display: block; background: #013077"><i class="fa fa-youtube-play" aria-hidden="true"></i> OnDemand </span>
<div class="card-body"  style="padding: 4px; border: 1px solid #013077;">
<strong  style="color: #ff0000;">NO HAY EVENTO</strong>
<br><small><?php echo $tmp->titulo;?></small>
</div>
</div>
<?php } ?>
<?php } ?>
<?php
}

*/

/**************************************
END ALERTA DE EVENTOS ON DEMAND QUE NO TIENEN  DATOS
/**************************************/
  ?>




<?php
/**************************************
 EVENTOS LIVE STREAM
/**************************************/
if($live == 'on'){
 $sql = "SELECT
  `Live_Brief_categorias`.`Id`,
  `Live_Brief_categorias`.`tipo`,
  `Live_Brief_categorias`.`titulo`,
  `Live_Brief_categorias`.`hora`,
  `Live_Brief_categorias`.`periodo`,
  
  `Live_Brief_categorias`.`dia`
FROM
  `Live_Brief_categorias`
WHERE
`Live_Brief_categorias`.`dia` = '$d' AND
 `Live_Brief_categorias`.`tipo` = '2' AND
 `Live_Brief_categorias`.`periodo` LIKE '%$semana%'
 ORDER BY
  `Live_Brief_categorias`.`hora` ASC
  ;";
$a = ExecuteRows($sql);
$b = json_encode( $a );
$c = json_decode($b);


foreach($c as $tmp){  
//$alerta = ExecuteScalar("SELECT `Live_Brief`.`Id` FROM  `Live_Brief` WHERE  `Live_Brief`.`categoria` = $tmp->Id  AND	`Live_Brief`.`fecha` = '$fdia'");
 $alerta = ExecuteScalar("SELECT
  `Live_Brief`.`Id`
FROM
  `Live_Brief`
  INNER JOIN `Live_Brief_Fechas` ON `Live_Brief_Fechas`.`IdEvento` =
    `Live_Brief`.`Id`
WHERE
  `Live_Brief`.`categoria` = '$tmp->Id' AND
  `Live_Brief_Fechas`.`fecha` = '$fdia' 
LIMIT 1
  ");


 if($alerta==''){ ?><!--
 <div class="card d-print-none" style="border-top: 4px; border-top-style: solid;  border-color: #3d4856;">
<span style="color: #fff; padding: 2px 4px 2px 10px;  display: block; background: #3d4856"><i class="fa fa-youtube-play" aria-hidden="true"></i> LiveStreaming </span>
<div class="card-body"  style="padding: 4px; border: 1px solid #3d4856;">
<strong  style="color: #ff0000;">NO HAY EVENTO</strong>
<br><small><?php echo $tmp->titulo;?></small>
</div>
</div> -->
<?php } ?>
<?php } ?>




<?php  

}
/**************************************}
END EVENTOS  LIVE STREMING
/**************************************/
?>



<?php
/**************************************
 EVENTOS LIVE STREAM
/**************************************/
if($live == 'on'){
$sql = "SELECT
  `Live_Brief_categorias`.`Id`,
  `Live_Brief_categorias`.`tipo`,
  `Live_Brief_categorias`.`titulo`,
  `Live_Brief_categorias`.`hora`,
  `Live_Brief_categorias`.`periodo`,
  
  `Live_Brief_categorias`.`dia`
FROM
  `Live_Brief_categorias`
WHERE
`Live_Brief_categorias`.`dia` = '$d' AND
 `Live_Brief_categorias`.`tipo` = '2' AND
 `Live_Brief_categorias`.`periodo` ='0'
 ORDER BY
  `Live_Brief_categorias`.`hora` ASC
  ;";
$a = ExecuteRows($sql);
$b = json_encode( $a );
$c = json_decode($b);


foreach($c as $tmp){  
$alerta = ExecuteScalar("SELECT `Live_Brief`.`Id` FROM  `Live_Brief` WHERE  `Live_Brief`.`categoria` = $tmp->Id  AND	`Live_Brief`.`fecha` = '$fdia'");
 if($alerta==''){ ?><!--
 <div class="card d-print-none" style="border-top: 4px; border-top-style: solid;  border-color: #3d4856;">
<span style="color: #fff; padding: 2px 4px 2px 10px;  display: block; background: #3d4856"><i class="fa fa-youtube-play" aria-hidden="true"></i> LiveStreaming </span>
<div class="card-body"  style="padding: 4px; border: 1px solid #3d4856;">
<strong  style="color: #ff0000;">NO HAY EVENTO</strong>
<br><small><?php echo $tmp->titulo;?></small>
</div>
</div>-->
<?php } ?>
<?php } ?>




<?php  

}
/**************************************}
END EVENTOS  LIVE STREMING
/**************************************/
?>







<?php
/**************************************
 EVENTOS  CALENDARIO ANTERIOR
/**************************************/

/*
if($calAnterior == 'on'){
  ?>

 <div class="card d-print-none" style="border-top: 4px; border-top-style: solid;  border-color: #ff5722;">
<span style="color: #fff; padding: 2px 4px 2px 10px;  display: block; background: #ff5722"><i class="fa fa-calendar" aria-hidden="true"></i> Calendario Anterior </span>
<div class="card-body"  style="padding: 4px; border: 1px solid #ff5722;">
<?php $sql = "SELECT
  `eventos_calendario`.`id`,
  `eventos_calendario`.`evento`,
  `eventos_calendario`.`ubicacion`,
  `eventos_calendario`.`finicio`,
  `eventos_conf`.`salas`,
  `eventos_calendario`.`hinicio`
FROM
  `eventos_calendario`
  INNER JOIN `eventos_conf` ON
    `eventos_conf`.`Id` = `eventos_calendario`.`ubicacion`
WHERE
  `eventos_calendario`.`finicio` = '$fdia'
  ;";
$a = ExecuteRows($sql);
$b = json_encode( $a );
$c = json_decode($b);


foreach($c as $tmp){  ?>
<table class="table table-bordered table-sm">
<tr><td><small><?php echo $tmp->evento;?></small>
<br><small><?php echo $tmp->hinicio;?></small>
<br><small><?php echo $tmp->salas;?></small>
</td></tr></table>
<?php } ?>

</div>
</div>






<?php  
}
/**************************************}
END calendario anterior
/**************************************/
?>




</td>

<?php if($vista=='agenda'){?></tr> <?php } ?>
<?php 
$day++;
}
// cuando llega al final de la semana, iniciamos una columna nueva
			if($i%7==0)
			{
				++$semana;
				echo "</tr><tr>";
			}
		}
	?>
	</tr>
</tbody>
</table>

  



</td></tr></table>
<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$main->terminate();
?>