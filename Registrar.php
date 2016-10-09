<?php

	$link = mysqli_connect("localhost", "root", "", "quiz");
	//$link = mysqli_connect("mysql.hostinger.es", "u531741362_root", "iratiania", "u531741362_quiz");
	
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["imagen"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	if ($uploadOk == 0) {
		$file = "avatar.jpg";
	} 
	else {
		if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
			$file = basename($_FILES["imagen"]["name"]);
		} 
		else {
			$file = "avatar.jpg";
		}
	}
	
	$esp = $_POST['Especialidad'];
	if(strcmp($esp, "Otro") == 0){
		$esp = $_POST['otraEspecialidad'];
	}
	
	$sql="INSERT INTO usuario VALUES ('$_POST[Nombre]', '$_POST[Apellidos]', '$_POST[Correo]', '$_POST[Password]', '$_POST[Telefono]', '$esp', '$_POST[Opcional]', '$file' )";

	if (!mysqli_query($link ,$sql)){
		die('Error: ' . mysqli_error($link));
	}
	echo "<style type='text/css'>
		<!--
			p{text-align: center; font: small-caps bold 120% serif}
			a{text-align : center; font: small-caps bold 120% serif}
			body{background-color : #E6E6E6}
		-->
	</style>
	<br>
	<br>
	<br>";
	echo "<p> Usuario a&ntilde;adido. </p>";
	echo "<p> <a href='VerUsuarios.php'> Ver usuarios </a>";
	echo '<br> <br> <p> <a href="layout.html"> P&aacute;gina principal </a> </p>';
	mysqli_close($link);
	
?>