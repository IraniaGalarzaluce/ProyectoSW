<?php
	session_start();
	//if(!isset($_SESSION['email'])){
	//	echo '<script languaje="javascript"> alert("Para acceder a esta funcionalidad debes haber inidiado sesión.") </script>';
	//}
?>
<html>
	<head>
		<title> Login </title>
		<link rel='stylesheet' type='text/css' href='estilos/nuestroEstilo.css'/>
		<meta charset="utf-8">
	</head>
	<body>
		<h1> LOGIN </h1>

		<form method="post">
			<p> Email : <input type="email" required name="correo" size="21" value="" /> </p>
			<p> Password: <input type="password" required name="pass" size="21" value="" /> </p>
			<p> <input id="input_2" type="submit" /> </p>
		</form>
		
		<p> <a href="layout.html"> Página principal </a> </p>
		
	</body>
</html>

<?php
	if (isset($_POST['correo'])){
		
		$link = mysqli_connect("localhost", "root", "", "quiz");
		//$link = mysqli_connect("mysql.hostinger.es", "u531741362_root", "iratiania", "u531741362_quiz");
	
		$email=$_POST['correo']; 
		$pass=$_POST['pass'];
		$profesor = "web000@ehu.es";
		
		$usuarios = mysqli_query($link,"select * from usuario where correo='$email' and password='$pass'");
		
		$cont = mysqli_num_rows($usuarios); 
			
		if($cont==1){

			$_SESSION['email'] = $email;

			$horaConex = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
			$sql="INSERT INTO conexiones(Correo, Hora) VALUES ('$email', '$horaConex' )";
			if (!mysqli_query($link ,$sql)){
				die('Error: ' . mysqli_error($link));
			}

			if ($email == $profesor){
				$_SESSION['profesor'] = "SI";
				echo "Como profesor";
				header("location:layout3.php");
			}
			else{
				$_SESSION['profesor'] = "NO";
				echo "Como alumno";
				header("location:layout2.php");
			}
		}
		else {
			echo "<p> <FONT COLOR=RED>Datos incorrectos !!</FONT> </p>";
		}
	
		mysqli_close($link);
	}
?>
