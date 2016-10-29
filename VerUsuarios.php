<?php

	$link= mysqli_connect("localhost", "root", "", "quiz");
	//$link = mysqli_connect("mysql.hostinger.es", "u531741362_root", "iratiania", "u531741362_quiz");
	
	$usuarios = mysqli_query($link, "select * from usuario" );
	echo "<meta charset='utf-8'>
		<link rel='stylesheet' type='text/css' href='estilos/nuestroEstilo.css/>
		<h1> USUARIOS </h1>
		<br>";
	echo '<table border=1> <tr> <th> NOMBRE </th> <th> APELLIDOS </th><th> CORREO </th><th> TELEFONO </th>
		<th> ESPECIALIDAD </th><th> INTERESES </th><th> IMAGEN </th></tr>';
	while ($row = mysqli_fetch_array( $usuarios )) {
		$imagen = "uploads/" . $row['Imagen'];
		echo '<tr><td>' . $row['Nombre'] . '</td> <td>' . $row['Apellidos'].'</td><td>' . $row['Correo'].'</td><td>'. 
			$row['Telefono'].'</td><td>' . $row['Especialidad'].'</td><td>' . $row['Intereses']. '</td><td>' . 
			'<img src="'. htmlspecialchars($imagen) .'" alt="image" width="250" height="150"/>' .'</td></tr>';
	}
	echo '</table>';
	echo ' <br> <br> <p> <a href="layout.html"> P&aacute;gina principal </a> </p>';
	
	mysqli_free_result($usuarios);
	mysqli_close($link);
	
?>