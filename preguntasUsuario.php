<?php	

	session_start();
	if(!isset($_SESSION['email'])){
		header("location:Login.php");
	}
	if($_SESSION['profesor']=='SI'){
		header("location:Login.php");
	}
	
	$link= mysqli_connect("localhost", "root", "", "quiz");
	//$link = mysqli_connect("mysql.hostinger.es", "u531741362_root", "iratiania", "u531741362_quiz");
	
	$preguntas = mysqli_query($link, "select * from pregunta" );
	$email = $_SESSION['email'];
	$contT = 0;
	$cont = 0;
	while ($row = mysqli_fetch_array( $preguntas )) {
		$autor = $row['Correo'];
		$contT++;
		if($autor == $email){
			$cont++;
		}
	}
	echo "Mis preguntas/Todas las preguntas: " . $cont . "/" . $contT;
?>