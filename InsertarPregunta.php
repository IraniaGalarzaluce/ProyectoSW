<html>
  <head>
   	<title>A&ntilde;adir pregunta</title>
	
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
	<h1> A&Ntilde;ADIR PREGUNTA </h1>
	<form method="post">
		<p> Pregunta(*) : <input type="text" required name="pregunta" size="21" value="" />
		<p> Respuesta(*) : <input type="text" required name="respuesta" size="21" value="" />
		<p> Complejidad (1-5): <input type="text" name="complejidad" size="21" value="" />
		<p> Tema(*) : <input type="text" required name="tema" size="21" value="" />
		<br>
		<input type="hidden" name="email" value="<?php echo $_REQUEST['email']; ?>" />
		<p> Password(*): <input type="password" required name="pass" size="21" value="" />
		<br>
		<p> <input id="input_2" type="submit" value="Añadir"/>
	</form>
	<?php
		echo '<p><a href="layout2.php?email=' . $_REQUEST['email'] . '"> Pagina principal </a></p>';
	?>
</body>
</html>

<?php
	
	if (isset($_POST['pass'])){
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
		
		if(!validaRequerido($_POST['pass'])){
				echo '<br> <br> <p> Error: Faltan campos obligatorios por rellenar. </p> <br> <br>';
				die();
		}
		
		$email=$_REQUEST['email']; 
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
			
			echo "
			<br>
			<br>
			<br>";
			echo "<p> Pregunta a&ntilde;adida. </p>";
			echo '<br> <br> <p> <a href="VerPreguntasXML.php?email=' . $email. '"> Ver preguntas </a> </p>';
			
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
			
		}
		else{
			echo "<p> <FONT COLOR=RED>Datos incorrectos !!</FONT> </p>";
		}
		
		mysqli_close($link);
	}
?>