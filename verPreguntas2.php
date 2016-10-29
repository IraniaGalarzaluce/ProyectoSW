<?php

	$link= mysqli_connect("localhost", "root", "", "quiz");
	//$link = mysqli_connect("mysql.hostinger.es", "u531741362_root", "iratiania", "u531741362_quiz");
	
	echo "<meta charset='utf-8'>
		<link rel='stylesheet' type='text/css' href='estilos/nuestroEstilo.css'/>
		<h1> PREGUNTAS </h1>
		<br>";
	echo '<table border=1> <tr> <th> PREGUNTA </th> <th> COMPLEJIDAD </th><th> AUTOR </th></tr>';
	
	$preguntas = mysqli_query($link, "select * from pregunta" );
	while ($row = mysqli_fetch_array( $preguntas )) {
		$comp = $row['Complejidad'];
		if($comp == 0){
			$comp="";
		}
		echo '<tr><td>' . $row['Pregunta'] .'</td><td>' . $comp.'</td><td>'. $row['Correo'].'</td></tr>';
	}
	echo '</table>';
	$email = $_GET['email'];
	//echo ' <br> <br> <p> <a href="layout2.php?email=' . $email . '"> Pagina principal </a> </p>';
	
	mysqli_free_result($preguntas);
	
	$horaAccion = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
	$ip = $_SERVER["REMOTE_ADDR"];
	
	if(!($ids = mysqli_query($link, "SELECT max(IdConexion) as id FROM conexiones WHERE Correo='$email'"))){
		die('Error: ' . mysqli_error($link));
	}
	$row = mysqli_fetch_array($ids);
	$idconex = $row['id'];
	
	$tipo = "ver pregunta";
	
	$sql="INSERT INTO acciones(IdConexion, Correo, Tipo, Hora, IP) VALUES ('$idconex', '$email', '$tipo', '$horaAccion', '$ip' )";
	if (!mysqli_query($link ,$sql)){
		die('Error: ' . mysqli_error($link));
	}
	
	mysqli_close($link);
	
?>