<html>
<head>
	<title> Login </title>
	<link rel='stylesheet' type='text/css' href='estilos/nuestroEstilo.css'/>
		
</head>
<body>
	<h1> LOGIN </h1>

	<form action="Login.php" method="post">
		<p> Email : <input type="email" required name="email" size="21" value="" />
		<p> Password: <input type="password" required name="pass" size="21" value="" />
		<p> <input id="input_2" type="submit" />
	</form>
	
	<p> <a href="layout.html"> Página principal </a> </p>
	
</body>

</html>

<?php
	if (isset($_POST['email'])){
		
		//phpinfo();
		
		$link = mysqli_connect("localhost", "root", "", "quiz");
		//$link = mysqli_connect("mysql.hostinger.es", "u531741362_root", "iratiania", "u531741362_quiz");
	
		$email=$_POST['email']; 
		$pass=$_POST['pass'];
		
		$usuarios = mysqli_query($link,"select * from usuario where correo='$email' and password='$pass'");
		
		$cont= mysqli_num_rows($usuarios); 
			
		if($cont==1){
			$horaConex = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
			$sql="INSERT INTO conexiones(Correo, Hora) VALUES ('$email', '$horaConex' )";
			if (!mysqli_query($link ,$sql)){
				die('Error: ' . mysqli_error($link));
			}
			
			header("location:layout2.php?email=$email");

		}
		else {
			echo "<p> <FONT COLOR=RED>Datos incorrectos !!</FONT> </p>";
		}
		
		mysqli_close($link);
	}
?>
