<?php
	session_start();
	if(!isset($_SESSION['email'])){
		header("location:Login.php");
	}
	if($_SESSION['profesor']=='SI'){
		header("location:Login.php");
	}

		sleep(2);
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
		
		$email=$_SESSION['email']; 
		
		if(!validaRequerido($_POST['pregunta'])){
			echo '<br> <br> <p> Error: Faltan campos obligatorios por rellenar. </p> <br> <br>';
			die();
		}
		if(!validaRequerido($_POST['respuesta'])){
			echo '<br> <br> <p> Error: Faltan campos obligatorios por rellenar. </p> <br> <br>';
			die();
		}
	
		if(!validaRequerido($_POST['tema'])){
			echo '<br> <br> <p> Error: Faltan campos obligatorios por rellenar. </p> <br> <br>';
			die();
		}
	
		if(!trim($_POST['complejidad']) == ''){
			if(!validarExpresion($_POST['complejidad'], '/^(1|2|3|4|5){1}$/')){
				echo '<br> <br> <p> Error: La complejidad debe ser un número del 1 al 5. </p> <br> <br>';
				die();
			}
		}
			
		$sql="INSERT INTO pregunta(Pregunta, Respuesta, Complejidad, Tema ,Correo) VALUES ('$_POST[pregunta]', '$_POST[respuesta]', '$_POST[complejidad]', '$_POST[tema]', '$email' )";

		if (!mysqli_query($link ,$sql)){
				die('Error: ' . mysqli_error($link));
		}
			
			echo "<p> Pregunta añadida. </p>";
			//echo '<br> <br> <p> <a href="VerPreguntasXML.php?email=' . $email. '"> Ver preguntas en formato XML </a> </p> <br>';
			
			$xml = simplexml_load_file('preguntas.xml');
			$pregunta = $xml->addChild('assessmentItem');
			$pregunta->addAttribute('complexity', $_POST['complejidad']);
			$pregunta->addAttribute('subject', $_POST['tema']);
			$enunciado = $pregunta->addChild('itemBody');
			$enunciado->addChild('p', $_POST['pregunta']);
			$respuesta = $pregunta->addChild('correctResponse');
			$respuesta->addChild('value', $_POST['respuesta']);
			
			$xml->asXML('preguntas.xml');
			
			$horaAccion = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
			$ip = $_SERVER["REMOTE_ADDR"];
			
			if(!($ids = mysqli_query($link, "SELECT max(IdConexion) as id FROM conexiones WHERE Correo='$email'"))){
				die('Error: ' . mysqli_error($link));
			}
			$row = mysqli_fetch_array($ids);
			$idconex = $row['id'];
			
			$tipo = "insertar pregunta";
	
			$sql="INSERT INTO acciones(IdConexion, Correo, Tipo, Hora, IP) VALUES ('$idconex', '$email', '$tipo', '$horaAccion', '$ip' )";
			if (!mysqli_query($link ,$sql)){
				die('Error: ' . mysqli_error($link));
			}
			
		//}
		//else{
		//	echo "<p> <FONT COLOR=RED>Datos incorrectos !!</FONT> </p>";
		//}
		
		mysqli_close($link);
?>