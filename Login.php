<html>
<head>
	<title> Login </title>
	
	<style type="text/css">
		<!--
			h1{color: #B40404; text-align: center; font: small-caps bold 300% serif}
			p{text-align: center;}
			body{background-color : #E6E6E6}
			a{text-align : center; font: small-caps bold 120% serif}
			form{font: small-caps 120% serif; margin-left: 10em; margin-right: 10em}
		-->
	</style>
		
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
		$link = mysqli_connect("localhost", "root", "", "quiz");
		//$link = mysqli_connect("mysql.hostinger.es", "u531741362_root", "iratiania", "u531741362_quiz");
	
		$email=$_POST['email']; 
		$pass=$_POST['pass'];
		
		$usuarios = mysqli_query($link,"select * from usuario where correo='$email' and password='$pass'");
		
		$cont= mysqli_num_rows($usuarios); 
		mysqli_close($link);
			
		if($cont==1){
			header('location:layout2.html');
		}
		else {
			echo "<p> <FONT COLOR=RED>Datos incorrectos !!</FONT> </p>";
		}
	}
?>
