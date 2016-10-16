<?php

	$link= mysqli_connect("localhost", "root", "", "quiz");
	//$link = mysqli_connect("mysql.hostinger.es", "u531741362_root", "iratiania", "u531741362_quiz");
	
	$preguntas = mysqli_query($link, "select * from pregunta" );
	echo '<style type="text/css">
		<!--
			h1{color: #B40404; text-align: center; font: small-caps bold 300% serif}
			p{text-align: center;}
			table{margin: 0 auto;}
			td{width: 250px; text-align: center; font: 120% serif}
			a{font: small-caps bold 120% serif;}
			body{background-color: #E6E6E6}
		-->
		</style>
		<h1> PREGUNTAS </h1>
		<br>';
	echo '<table border=1> <tr> <th> PREGUNTA </th> <th> RESPUESTA </th><th> COMPLEJIDAD </th><th> AUTOR </th></tr>';
	while ($row = mysqli_fetch_array( $preguntas )) {
		$comp = $row['Complejidad'];
		if($comp == 0){
			$comp="";
		}
		echo '<tr><td>' . $row['Pregunta'] . '</td> <td>' . $row['Respuesta'].'</td><td>' . $comp.'</td><td>'. $row['Correo'].'</td></tr>';
	}
	echo '</table>';
	echo ' <br> <br> <p> <a href="layout2.html"> Pagina principal </a> </p>';
	
	mysqli_free_result($preguntas);
	mysqli_close($link);
	
?>