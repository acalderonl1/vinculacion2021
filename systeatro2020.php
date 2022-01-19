<?php
namespace PHPMaker2019\LiveBrief;

/*-----------------
Valores Globales
---------------------
*/
date_default_timezone_set('America/Guayaquil');

$hoy= date("Y-m-d"); 
$hora = date("H:m:s");
$semana =0;





/*-----------------
Check Selectc
---------------------
*/
// Editor
function ChekSelect($x,$z)
	{
if($x == $z){ $u = 'selected';}
return ($u);
	}




/*-----------------
Datos de usuario
---------------------
*/



/*-----------------
Datos de usuario
---------------------
*/
 $u = CurrentUserName();

$UserData = ExecuteRow("SELECT
  `usuario`.`id`,
  `usuario`.`nombre`,
  `usuario`.`usuario`,
  `usuario`.`calendario`,
  `usuario`.`role`,
  `usuario`.`foto`,
  `usuario`.`auth`,
  `usuario`.`brief`
FROM
  `usuario`
WHERE
  `usuario`.`usuario` = '$u'");


  
  
  
  
/*-----------------
Funciones pequeñas
--------------------- */

/*-----------------
Generar Popup con JavaScript
--------------------- */
function popup($y,$z)
	{
$u = "target=\"popup\" onClick=\"window.open(this.href, this.target, 'width=".$y.",height=".$z."'); return false;\" ";
return ($u);
	}

/*-----------------
Formato moneda
---------------------
*/
function moneda($s)
{

$s = number_format((float)$s, 2, '.', '');
$a = explode(".", $s);
$b = '$ '.$a[0].'.<small>'.$a[1].'</small>';
return ($b);
}

/*-----------------
Formato Horas
---------------------
*/
function horas($s)
{
$a = explode(":", $s);
$b = $a[0].':'.$a[1];
return ($b);
}

/*-----------------
Diferencias entre dos horas
---------------------
*/

function diferenciaHoras($h1,$h2)
{

//Calculamos el tiempo que usara las instalacion es
 $tiempouso=date("H:i:s",strtotime("00:00:00")+strtotime($h2)-strtotime($h1));
// Transformemmos a Minutos
$min = explode(":", $tiempouso);
 $tmin= ($min[0] * 60) + $min[1];
 
//El teatro da tres horas siempre  esto es 180 minutos
 
$minutos =  $tmin - 180;

//Si minutos es mayor a 60 calculamos la hora
if($minutos>=60){ $h=  ($minutos/60); }

//Si minutos es entre 20 a 59 cobramos la hora
if($minutos>=20&&$minutos<59){ $h=1; }

//Si minutos es menor a 20  le damos gratis
if($minutos<20){ $h=0; }

$r= $h.','.$minutos;

return ($r);
}

/*-----------------
Agrega días a una fecha ingresada
---------------------
*/

/*-----------------
Agrega 20 dias a una fecha usado para caducar una prereserva
---------------------
*/
function conteo($a){
$b = explode(" ", $a);
$b = strtotime ( '+20 day' , strtotime ( $b[0] ) ) ;
$b = date ( 'Y-m-d' , $b );
return ($b);	
}

/*-----------------
Agrega 2 día determino si el evento ingresado es nuevo
---------------------
*/	
function fnuevo($a){
$b = explode(" ", $a);
$b = strtotime ( '+2 day' , strtotime ( $b[0] ) ) ;
$b = date ( 'Y-m-d' , $b );
return ($b);	
}

/*-----------------
Agrega 7 días ... ¿ no recuerdo para que lo usaba?
---------------------
*/	

function semana($a){
$b = explode(" ", $a);
$b = strtotime ( '+7 day' , strtotime ( $b[0] ) ) ;
$b = date ( 'Y-m-d' , $b );
return ($b);	
}


/*-----------------
Cuenta los dias de diferencia entre dos fechas
---------------------
*/	
function conteoestreno($b,$a){


$a =  explode("-", $a);
$timestamp1 = mktime(0,0,0,$a[1],$a[2],$a[0]); 
  
$a =  explode("-", $b);
$timestamp2 = mktime(4,12,0,$a[1],$a[2],$a[0]);


$segundos_diferencia = $timestamp1 - $timestamp2; 
$dias_diferencia = $segundos_diferencia / (60 * 60 * 24); 

//obtengo el valor absoulto de los días (quito el posible signo negativo) 
//$dias_diferencia = abs($dias_diferencia); 

$dias_diferencia = floor($dias_diferencia); 


return ($dias_diferencia);	
}


/*-----------------
Genera Fechas en letras
---------------------
*/	
function fechas($s)
{
$a = explode("-", $s);	
   switch ($a[1]) {
    case 1: $m = "Enero"; break;
	case 2: $m = "Febrero"; break;
	case 3: $m = "Marzo"; break;
	case 4: $m = "Abril"; break;
	case 5: $m = "Mayo"; break;
	case 6: $m = "Junio"; break;
    case 7: $m = "Julio"; break;
	case 8: $m = "Agosto"; break;
	case 9: $m = "Septiembre"; break;
	case 10: $m = "Octubre"; break;
	case 11: $m = "Noviembre"; break;
	case 12: $m = "Diciembre"; break;	
   }
$r =  $a[2].' de '.$m.' '.$a[0];
return $r;
}

function meses($s)
{

   switch ($s) {
    case 1: $m = "Enero"; break;
	case 2: $m = "Febrero"; break;
	case 3: $m = "Marzo"; break;
	case 4: $m = "Abril"; break;
	case 5: $m = "Mayo"; break;
	case 6: $m = "Junio"; break;
    case 7: $m = "Julio"; break;
	case 8: $m = "Agosto"; break;
	case 9: $m = "Septiembre"; break;
	case 10: $m = "Octubre"; break;
	case 11: $m = "Noviembre"; break;
	case 12: $m = "Diciembre"; break;	
   }

return $m;
}

function dame_el_dia ($s)
{
$a['Sunday'] = "Domingo";
$a['Monday'] = "Lunes";
$a['Tuesday'] = "Martes";
$a['Wednesday'] = "Mi&eacute;rcoles";
$a['Thursday'] = "Jueves";
$a['Friday'] = "Viernes";
$a['Saturday'] = "S&aacute;bado";
return $a[date('l', strtotime($s))];
}



/*-----------------
Identificamos las salas
---------------------
*/	

function sala($a)
{
	switch ($a) {
	//case 0:  $b="TODAS LAS SALAS"; break;
	case 2:  $b="TEATRO PRINCIPAL"; break;
	case 1:  $b="TEATRO EXPERIMENTAL";  break;
	case 3:  $b="SALA MULTIARTES";  break;
	case 4:  $b="SALA DE BALLET";  break;
	case 5:  $b="BIBLIOTECA";  break;
	case 6:  $b="4TO PISO";  break;
	case 7:  $b="5TO PISO";  break;
	case 8:  $b="OTROS ESPACIOS";  break;
	case 10:  $b="ESCALINATAS";  break;
	case 11:  $b="LA TERRAZA";  break;
	

	}
	return ($b);
	}
	
	function estrellas($a)
{
	switch ($a) {
	//case 0:  $b="TODAS LAS SALAS"; break;
	case 2:  $b="8"; break;
	case 1:  $b="6";  break;
	case 3:  $b="5";  break;
	case 4:  $b="4";  break;
	case 5:  $b="2";  break;
	case 6:  $b="2";  break;
	case 7:  $b="2";  break;
	case 8:  $b="1";  break;
	

	}
	return ($b);
	}

function absala($a)
{
	switch ($a) {
	//case 0:  $b="00"; break;
	case 2:  $b="TP"; break;
	case 1:  $b="TE";  break;
	case 3:  $b="SM";  break;
	case 4:  $b="SB";  break;
	case 5:  $b="SL";  break;
	case 6:  $b="4P";  break;
	case 7:  $b="5P";  break;
	case 8:  $b="OT";  break;
	

	}
	return ($b);
	}
	
	
	function tipos($a)
{
	switch ($a) {
	//case 0:  $b="00"; break;
	case 13:  $b="Propio Remunerad"; break;
	case 14:  $b="Coparticipación"; break;
	case 15:  $b="Alquiler"; break;
	case 16:  $b="Propio Gratuito"; break;
	case 91:  $b="Actividad Privada"; break;

	}
	return ($b);
	}
	
/*-----------------
Estados de los eventos
---------------------
*/	
	
function estado($a)
{


	switch ($a) {
	//case 0:  $b="00"; break;
	case 0:  $b="POR CONFIRMAR"; break;
	case 1:  $b="PRE-RESERVA";  break;
	case 2:  $b="PRE-RESERVA EXTENDIDA";  break;
	case 3:  $b="NO APLICA";  break;
	case 4:  $b="PRE-RESERVA CADUCADA";  break;
	case 5:  $b="RESERVA PARA FIRMA DE CONTRATO";  break;
	case 6:  $b="RESERVA CONTRATO FIRMADO";  break;
	case 7:  $b="RESERVA ATICIPO PAGADO %VALOR%";  break;
	
	
	}
	return ($b);
	}


/*-----------------
Obtengo los datos del empresario
---------------------
*/	


function iresponsable($a){
$b = ExecuteScalar("SELECT
  `eventos_empresarios`.`id`,
  `eventos_empresarios`.`cod`
FROM
  `eventos_empresarios`
WHERE
  `eventos_empresarios`.`cod` = '$a';");
return ($b);	
}

/*-----------------
para que es es esto ??? brief
---------------------
*/	
function diferenciaDias($inicio, $fin)
{
    $inicio = strtotime($inicio);
    $fin = strtotime($fin);
    $dif = $fin - $inicio;
    $diasFalt = (( ( $dif / 60 ) / 60 ) / 24);
    return ceil($diasFalt);
}


	
/*-------------------------------------
VALOR EN LETRAS
--------------------------------------
*/	
	
	class EnLetras
{
  var $Void = "";
  var $SP = " ";
  var $Dot = ".";
  var $Zero = "0";
  var $Neg = "Menos";
  
function ValorEnLetras($x, $Moneda ) 
{
    $s="";
    $Ent="";
    $Frc="";
    $Signo="";
        
    if(floatVal($x) < 0)
     $Signo = $this->Neg . " ";
    else
     $Signo = "";
    
    if(intval(number_format($x,2,'.','') )!=$x) //<- averiguar si tiene decimales
      $s = number_format($x,2,'.','');
    else
      $s = number_format($x,0,'.','');
       
    $Pto = strpos($s, $this->Dot);
        
    if ($Pto === false)
    {
      $Ent = $s;
      $Frc = $this->Void;
    }
    else
    {
      $Ent = substr($s, 0, $Pto );
      $Frc =  substr($s, $Pto+1);
    }

    if($Ent == $this->Zero || $Ent == $this->Void)
       $s = "Cero ";
    elseif( strlen($Ent) > 7)
    {
       $s = $this->SubValLetra(intval( substr($Ent, 0,  strlen($Ent) - 6))) . 
             "Millones " . $this->SubValLetra(intval(substr($Ent,-6, 6)));
    }
    else
    {
      $s = $this->SubValLetra(intval($Ent));
    }

    if (substr($s,-9, 9) == "Millones " || substr($s,-7, 7) == "Millón ")
       $s = $s . "de ";

    $s = $s . $Moneda;

    if($Frc != $this->Void)
    {
       $s = $s . " Con " . $this->SubValLetra(intval($Frc)) . "Centavos";
       //$s = $s . " " . $Frc . "/100";
    }
    return ($Signo . $s . " USA");
   
}


function SubValLetra($numero) 
{
    $Ptr="";
    $n=0;
    $i=0;
    $x ="";
    $Rtn ="";
    $Tem ="";

    $x = trim("$numero");
    $n = strlen($x);

    $Tem = $this->Void;
    $i = $n;
    
    while( $i > 0)
    {
       $Tem = $this->Parte(intval(substr($x, $n - $i, 1). 
                           str_repeat($this->Zero, $i - 1 )));
       If( $Tem != "Cero" )
          $Rtn .= $Tem . $this->SP;
       $i = $i - 1;
    }

    
    //--------------------- GoSub FiltroMil ------------------------------
    $Rtn=str_replace(" Mil Mil", " Un Mil", $Rtn );
    while(1)
    {
       $Ptr = strpos($Rtn, "Mil ");       
       If(!($Ptr===false))
       {
          If(! (strpos($Rtn, "Mil ",$Ptr + 1) === false ))
            $this->ReplaceStringFrom($Rtn, "Mil ", "", $Ptr);
          Else
           break;
       }
       else break;
    }

    //--------------------- GoSub FiltroCiento ------------------------------
    $Ptr = -1;
    do{
       $Ptr = strpos($Rtn, "Cien ", $Ptr+1);
       if(!($Ptr===false))
       {
          $Tem = substr($Rtn, $Ptr + 5 ,1);
          if( $Tem == "M" || $Tem == $this->Void)
             ;
          else          
             $this->ReplaceStringFrom($Rtn, "Cien", "Ciento", $Ptr);
       }
    }while(!($Ptr === false));

    //--------------------- FiltroEspeciales ------------------------------
    $Rtn=str_replace("Diez Un", "Once", $Rtn );
    $Rtn=str_replace("Diez Dos", "Doce", $Rtn );
    $Rtn=str_replace("Diez Tres", "Trece", $Rtn );
    $Rtn=str_replace("Diez Cuatro", "Catorce", $Rtn );
    $Rtn=str_replace("Diez Cinco", "Quince", $Rtn );
    $Rtn=str_replace("Diez Seis", "Dieciseis", $Rtn );
    $Rtn=str_replace("Diez Siete", "Diecisiete", $Rtn );
    $Rtn=str_replace("Diez Ocho", "Dieciocho", $Rtn );
    $Rtn=str_replace("Diez Nueve", "Diecinueve", $Rtn );
    $Rtn=str_replace("Veinte Un", "Veintiun", $Rtn );
    $Rtn=str_replace("Veinte Dos", "Veintidos", $Rtn );
    $Rtn=str_replace("Veinte Tres", "Veintitres", $Rtn );
    $Rtn=str_replace("Veinte Cuatro", "Veinticuatro", $Rtn );
    $Rtn=str_replace("Veinte Cinco", "Veinticinco", $Rtn );
    $Rtn=str_replace("Veinte Seis", "Veintiseís", $Rtn );
    $Rtn=str_replace("Veinte Siete", "Veintisiete", $Rtn );
    $Rtn=str_replace("Veinte Ocho", "Veintiocho", $Rtn );
    $Rtn=str_replace("Veinte Nueve", "Veintinueve", $Rtn );

    //--------------------- FiltroUn ------------------------------
    If(substr($Rtn,0,1) == "M") $Rtn = "Un " . $Rtn;
    //--------------------- Adicionar Y ------------------------------
    for($i=65; $i<=88; $i++)
    {
      If($i != 77)
         $Rtn=str_replace("a " . Chr($i), "* y " . Chr($i), $Rtn);
    }
    $Rtn=str_replace("*", "a" , $Rtn);
    return($Rtn);
}


function ReplaceStringFrom(&$x, $OldWrd, $NewWrd, $Ptr)
{
  $x = substr($x, 0, $Ptr)  . $NewWrd . substr($x, strlen($OldWrd) + $Ptr);
}


function Parte($x)
{
    $Rtn='';
    $t='';
    $i='';
    Do
    {
      switch($x)
      {
         Case 0:  $t = "Cero";break;
         Case 1:  $t = "Un";break;
         Case 2:  $t = "Dos";break;
         Case 3:  $t = "Tres";break;
         Case 4:  $t = "Cuatro";break;
         Case 5:  $t = "Cinco";break;
         Case 6:  $t = "Seis";break;
         Case 7:  $t = "Siete";break;
         Case 8:  $t = "Ocho";break;
         Case 9:  $t = "Nueve";break;
         Case 10: $t = "Diez";break;
         Case 20: $t = "Veinte";break;
         Case 30: $t = "Treinta";break;
         Case 40: $t = "Cuarenta";break;
         Case 50: $t = "Cincuenta";break;
         Case 60: $t = "Sesenta";break;
         Case 70: $t = "Setenta";break;
         Case 80: $t = "Ochenta";break;
         Case 90: $t = "Noventa";break;
         Case 100: $t = "Cien";break;
         Case 200: $t = "Doscientos";break;
         Case 300: $t = "Trescientos";break;
         Case 400: $t = "Cuatrocientos";break;
         Case 500: $t = "Quinientos";break;
         Case 600: $t = "Seiscientos";break;
         Case 700: $t = "Setecientos";break;
         Case 800: $t = "Ochocientos";break;
         Case 900: $t = "Novecientos";break;
         Case 1000: $t = "Mil";break;
         Case 1000000: $t = "Millón";break;
      }

      If($t == $this->Void)
      {
        $i = $i + 1;
        $x = $x / 1000;
        If($x== 0) $i = 0;
      }
      else
         break;
           
    }while($i != 0);
   
    $Rtn = $t;
    Switch($i)
    {
       Case 0: $t = $this->Void;break;
       Case 1: $t = " Mil";break;
       Case 2: $t = " Millones";break;
       Case 3: $t = " Billones";break;
    }
    return($Rtn . $t);
}

}


	
?>
