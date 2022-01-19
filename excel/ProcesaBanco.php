<?php
	$db_host="tca.ec";
	$db_name="teatro13_tcageneral";
	$db_user="teatro13_tcagye";
	$db_pass="PKVJ6Ql0E0QiCMoM";
    include 'simplexlsx.class.php';
    $xlsx = new SimpleXLSX( $_GET[file] );
    try {
       $conn = new PDO( "mysql:host=$db_host;dbname=$db_name", "$db_user", "$db_pass");
       $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
	
	

  $hoy=date("Y-m-d");
  
    $stmt = $conn->prepare( "INSERT INTO  `Finanzas_Banco` (`FechaContable`,`lugar`,`mes`,`tipo`,`nut`,`valor`,`numero`,`concepto`,`SaldoMovimiento`,`descripcion`,`FechaReal`,`grupo`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bindParam( 1, $FechaContable);
    $stmt->bindParam( 2, $lugar);
    $stmt->bindParam( 3, $mes);
    $stmt->bindParam( 4, $tipo);
    $stmt->bindParam( 5, $nut);
    $stmt->bindParam( 6, $valor);
    $stmt->bindParam( 7, $numero);
    $stmt->bindParam( 8, $concepto);
    $stmt->bindParam( 9, $SaldoMovimiento);
    $stmt->bindParam( 10, $descripcion);
    $stmt->bindParam( 11, $FechaReal);
    $stmt->bindParam( 12, $grupo);
    foreach ($xlsx->rows() as $fields)
    {
        $FechaContable = $fields[0];
        $lugar = $fields[1];
        $mes = $fields[2];
        $tipo = $fields[3];
        $nut = $fields[4];
        $valor = $fields[5];
        $numero = $fields[6];
        $concepto = $fields[7];
        $SaldoMovimiento = $fields[8];
        $descripcion = $fields[9];
        $FechaReal = $fields[10];
		$grupo = $hoy;
      
       $stmt->execute();
    }
	
	//echo '<meta http-equiv="refresh" content="1; url=https://www.tcagye.com/2020/Financiera.main.php?PHPKEYID=8eit1IJ8Ojbbye0hVfl2pH6HZfqzePU3l0t45QVseYb8VBY7iuoDrJzGXj1qHyPOsXoGAnRBOiUVXE5UJ1NYWeAkn9EOmJupdA80JoDAC8o5GAvMkQPQfwYHbIt1t0WJ&v=mes">';