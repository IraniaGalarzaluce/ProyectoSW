
<html>
  <head>
   	<title>Añadir pregunta</title>
	
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
	<h1> AÑADIR PREGUNTA </h1>
	<form method="post">
		<p> Pregunta(*) : <input type="text" required name="pregunta" size="21" value="" />
		<p> Respuesta(*) : <input type="text" required name="respuesta" size="21" value="" />
		<p> Complejidad (1-5): <input type="text" name="complejidad" size="21" value="" />
		<br>
		<p> Email(*) : <input type="email" required name="email" size="21" value="" />
		<p> Password(*): <input type="password" required name="pass" size="21" value="" />
		<br>
		<p> <input id="input_2" type="submit" />
	</form>
	
	<p> <a href="layout2.html"> Pagina principal </a> </p>
</body>
</html>

<?php

	if (isset($_POST['email'])){
		$link = mysqli_connect("localhost", "root", "", "quiz");
		//$link = mysqli_connect("mysql.hostinger.es", "u531741362_root", "iratiania", "u531741362_quiz");
		
		function validarExpresion($variable, $expresion){
				$validar = array(
						 "options" => array("regexp"=>$expresion)
					);
				if(!filter_var($variable, FILTER_VALIDATE_REGEXP, $validar)){
					return false;
				}
				else{
					return true;
				}
			}
			
		function validaRequerido($valor){
			if(trim($valor) == ''){
				return false;
			}
			else{
				return true;
			}
		}
		
		if(!validaRequerido($_POST['email'])){
				echo '<br> <br> <p> Error: Faltan campos obligatorios por rellenar. </p> <br> <br>';
				die();
		}
		
		if(!validaRequerido($_POST['pass'])){
				echo '<br> <br> <p> Error: Faltan campos obligatorios por rellenar. </p> <br> <br>';
				die();
		}
		
		//if(!validarExpresion($_POST['email'], '/^[a-z]{2,}[0-9]{3}@ikasle\.ehu\.(eus|es)$/')){
			//	echo '<br> <br> <p> Error: La complejidad debe ser un número del 1 al 5. </p> <br> <br>';
				//die();
		//}
		
		$email=$_POST['email']; 
		$pass=$_POST['pass'];
		
		$usuarios = mysqli_query($link,"select * from usuario where correo='$email' and password='$pass'");
		
		$cont= mysqli_num_rows($usuarios); 
		
		if($cont==1){
		
			if(!validaRequerido($_POST['pregunta'])){
				echo '<br> <br> <p> Error: Faltan campos obligatorios por rellenar. </p> <br> <br>';
				die();
			}
			if(!validaRequerido($_POST['respuesta'])){
				echo '<br> <br> <p> Error: Faltan campos obligatorios por rellenar. </p> <br> <br>';
				die();
			}
	
			if(!trim($_POST['complejidad']) == ''){
				if(!validarExpresion($_POST['complejidad'], '/^(1|2|3|4|5){1}$/')){
					echo '<br> <br> <p> Error: La complejidad debe ser un número del 1 al 5. </p> <br> <br>';
					die();
				}
			}
			
			
			$usuarios = mysqli_query($link,"select * from pregunta");
			$cont= mysqli_num_rows($usuarios); 
			
			$cod = $cont+1;
			
			$sql="INSERT INTO pregunta VALUES ('$cod', '$_POST[pregunta]', '$_POST[respuesta]', '$_POST[complejidad]', '$email' )";

			if (!mysqli_query($link ,$sql)){
				die('Error: ' . mysqli_error($link));
			}
			
			echo "
			<br>
			<br>
			<br>";
			echo "<p> Pregunta añadida. </p>";
			echo '<br> <br> <p> <a href="verPreguntas2.php"> Ver preguntas </a> </p>';
			
		}
		else{
			echo "<p> <FONT COLOR=RED>Datos incorrectos !!</FONT> </p>";
		}
		
		mysqli_close($link);
	}
?>