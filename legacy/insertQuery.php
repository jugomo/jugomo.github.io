
<?php

	/* RECOGER LAS VARIABLES */
  	$format = 'xml';
  
  	$tablaSolicitada = isset($_GET['tabla']) ? $_GET['tabla'] : "";
	$comando		 = isset($_GET['cmd']) ? $_GET['cmd'] : "";
	
	//mensajes
	$idUsuario		   = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : "";
	$idEstablecimiento = isset($_GET['idEstablecimiento']) ? $_GET['idEstablecimiento'] : "";
  	$idBusqTipo        = isset($_GET['idBusqTipo']) ? $_GET['idBusqTipo'] : "";
  	$mensaje           = isset($_GET['mensaje']) ? $_GET['mensaje'] : "";
  	$hora              = isset($_GET['hora']) ? $_GET['hora'] : "";
	
  	
  	
  	/* CONECTAR A LA BASE DE DATOS */
	$link = mysql_connect('mysql13.000webhost.com','a7990788_user','calendario2010') or die ('Error al conectar base de datos');
	$esquema = "a7990788_jugomo";
  	mysql_select_db($esquema,$link) or die ('Error al seleccionar un esquema de base de datos');
  
  	
  	$date = new DateTime();
  	$lastUpdated = $date->getTimestamp();
  	
  
  	/* REALIZAR LA INSERCION */
  	if ($tablaSolicitada=='Mensajes'){
  		$query = "INSERT INTO mensajes (idUsuario,idEstablecimiento,idBusqTipo,mensaje,hora,lastUpdated)" . 
  							   "VALUES ('".$idUsuario."','".$idEstablecimiento."','".$idBusqTipo."','".$mensaje."','".$hora."','".$lastUpdated."');";
  	}   
  
  	
  	//echo $query;
  	
  	$result = mysql_query($query,$link) or die ('Error al consultar base de datos' . mysql_error());
  	//mysql_error()
  	//var_dump(mysql_query($query,$link));   //devuelve:    bool(true)
  	$lineasActualizadas = mysql_affected_rows($link);
  	//SI USO REPLACE: returns 2 if the new row replaced an old row. This is because in this case one row was inserted after the duplicate was deleted. 
  	
  	
  	
  	
  	
  	/* DEVUELVO EL NUMERO DE LINEAS AFECTADAS */
  	header('Content-type: text/xml');
    echo '<posts>';
    echo '<' . $tablaSolicitada . '>';
    echo '<result>';
    echo $lineasActualizadas;
    echo '</result>';
    echo '</' . $tablaSolicitada . '>';
    echo '</posts>';
  
  
    
    /* disconnect from the db */
  	@mysql_close($link);
  
?>



