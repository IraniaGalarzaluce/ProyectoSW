<?php

	$link = mysqli_connect("localhost", "root", "", "quiz");
	//$link = mysqli_connect("mysql.hostinger.es", "u531741362_root", "iratiania", "u531741362_quiz");

	$esp = $_POST['Especialidad'];
	if(strcmp($esp, "Otro") == 0){
		$esp = $_POST['otraEspecialidad'];
	}

	$sql="INSERT INTO usuario VALUES ('$_POST[Nombre]', '$_POST[Apellidos]', '$_POST[Correo]', '$_POST[Password]', '$_POST[Telefono]', '$esp', '$_POST[Opcional]')";

	if (!mysqli_query($link ,$sql)){
		die('Error: ' . mysqli_error($link));
	}
	echo "Usuario a&ntilde;adido.";
	echo "<p> <a href='VerUsuarios.php'> Ver usuarios </a>";
	echo '<br> <br> <p> <a href="layout.html"> P&aacute;gina principal </a> </p>';
	mysqli_close($link);
	
?>