
<?php

  $MAXIMO_POSTS = 500;  //maximo numero de resultados que puedo mostrar

  /* RECOGER LAS VARIABLES */
  $format = 'xml';
  $tablaSolicitada = isset($_GET['tabla']) ? $_GET['tabla'] : "";  //tabla a consultar
  
  $usuario = isset($_GET['usr']) ? $_GET['usr'] : "";
  $ultimoTime = isset($_GET['lastime']) ? $_GET['lastime'] : "";
  
  
  /* CONECTAR A LA BASE DE DATOS */
  $link = mysql_connect('mysql13.000webhost.com','a7990788_user','calendario2010') or die ('Error al conectar base de datos');
  $esquema = "a7990788_jugomo";
  mysql_select_db($esquema,$link) or die ('Error al seleccionar un esquema de base de datos');

  
  
  /* REALIZAR LA CONSULTA */
  if ($tablaSolicitada=='Busqueda') {
  		$query = "SELECT * FROM busqueda;";
  	
  } else if ($tablaSolicitada=='BusquedaCriterio') {
  		$query = "SELECT * FROM busquedacriterio;";
  	
  } else if ($tablaSolicitada=='BusquedaEstablecimiento'){
  		$query = "SELECT * FROM busquedaestablecimiento;";
		
  } else if ($tablaSolicitada=='Mensajes' && $usuario!="") {
  		$query = "SELECT * FROM mensajes WHERE idUsuario!='" . $usuario . "' and hora>" . $ultimoTime . " ORDER BY hora desc;";
  	
  } else if ($tablaSolicitada=='t_BusqCriterio'){
  		$query = "SELECT * FROM t_busqcriterio;";
		
  } else if ($tablaSolicitada=='t_BusqTipo') {
  		$query = "SELECT * FROM t_busqtipo;";	
  	
  } else if ($tablaSolicitada=='t_Establecimiento'){
  		$query = "SELECT * FROM t_establecimiento;";
  		
  } else if ($tablaSolicitada=='t_Usuario') {
  		$query = "SELECT * FROM t_usuario;";
  
  } else if ($tablaSolicitada=='UbicacionSimulada') {
  		$query = "SELECT * FROM ubicacionsimulada WHERE idUsuario='" . $usuario . "' and activa=1;";
  	
  }
  
  //echo $query;
  
  $result = mysql_query($query,$link) or die ('Error al consultar base de datos');

  
  /* ORGANIZAR LOS RESULTADOS */
  $posts = array();
  if(mysql_num_rows($result)) {
    while($post = mysql_fetch_assoc($result)) {
      //$posts[] = array('post'=>$post);
      $posts[] = array($tablaSolicitada=>$post);
      ///// $tablaSolicitada arriba es la etiqueta q va a poner a cada elemento de la coleccion q devuelva
    }
  }

  
  /* DEVOLVER LOS RESULTADOS EN EL FORMATO ESPECIFICADO */
  if($format == 'json') {
	echo 'json';
    header('Content-type: application/json');
    echo json_encode(array('posts'=>$posts));
  } else {
    header('Content-type: text/xml');
    //header('Content-type: text/html');
    
    echo '<posts>';
    foreach($posts as $index => $post) {
      if(is_array($post)) {
        foreach($post as $key => $value) {
          echo '<'.$key.'>';
          if(is_array($value)) {
            foreach($value as $tag => $val) {
              echo '<'.$tag.'>',htmlentities($val),'</'.$tag.'>';
            }
          }
          echo '</'.$key.'>';
        }
      }
    }
    echo '</posts>';
  }

  /* disconnect from the db */
  @mysql_close($link);


?>

