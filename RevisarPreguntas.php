<?php
session_start();
if(!isset($_SESSION['email'])){
	header("location:Login.php");
}
if($_SESSION['profesor']!='SI'){
	header("location:Login.php");
}
?>
<html>
<head>
	<meta charset="utf-8">
	<link rel='stylesheet' type='text/css' href='estilos/nuestroEstilo.css'/>
	<title> Revisar preguntas </title>
	<script type="text/javascript">
		function preguntaModificada(){
			<?php
			if(isset($_SESSION['pregunta'])){
				if($_SESSION['pregunta']=="Modificada"){
					echo "alert('Preguntada modificada correctamente');";
				}
				else{
					echo "alert('Ningún campo de la pregunta fue modificado');";
				}
				unset($_SESSION['pregunta']);
			}
			?>
		}
	</script>
</head>
<body onload="preguntaModificada()">
	<h1> Revisar preguntas </h1>

	<br>
	<form id="modificar" name="modificar" action="RevisarPreguntas.php" method="post">
		C&oacute;digo de la pregunta: 
		<input type="text" id="codigo" name="codigo" required><br>
		Pregunta: 
		<input type="text" id="pregunta" name="pregunta"><br>
		Respuesta:
		<input type="text" id="respuesta" name="respuesta"><br>
		Complejidad (1-5):
		<input type="text" id="complejidad" name="complejidad" pattern="[1-5]"><br>
		Tema:
		<input type="text" id="tema" name="tema"><br>
		<p><input type="submit" name="submit" value="MODIFICAR PREGUNTA"></p>


	</form>
	<br>

	<div class="mayus"> <p> Las preguntas: </p></div>
	<?php

	$link= mysqli_connect("localhost", "root", "", "quiz");
		//$link = mysqli_connect("mysql.hostinger.es", "u531741362_root", "iratiania", "u531741362_quiz");

	echo '<table border=1> <tr> <th> CODIGO </th> <th> PREGUNTA </th> <th> RESPUESTA </th> <th> COMPLEJIDAD </th> <th> TEMA </th> <th> AUTOR </th></tr>';

	$preguntas = mysqli_query($link, "select * from pregunta" );
	while ($row = mysqli_fetch_array( $preguntas )) {
		$comp = $row['Complejidad'];
		if($comp == 0){
			$comp="";
		}
		echo '<tr><td>' . $row['Codigo'] . '</td><td>'. $row['Pregunta'] .'</td><td>'. $row['Respuesta'] .'</td><td>' . $comp .'</td><td>'. $row['Tema'] .'</td><td>' . $row['Correo'].'</td></tr>';
	}
	echo '</table>';

	mysqli_close($link);

	?>

	<br>
	<p>
		<a href="layout3.php"> P&aacute;gina principal </a>
	</p>

</body>
</html>

<?php

	if(isset($_POST['codigo'])){

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

		if(!validaRequerido($_POST['codigo'])){
			echo "<script type='text/javascript'>
			alert('Por favor introduce un código de pregunta'); 
			</script>";
			die();
		}


		$pregunta = mysqli_query($link,"select * from pregunta where Codigo='$_POST[codigo]'");
		if (!$pregunta){
			die('Error: ' . mysqli_error($link));
		}


		$cont = mysqli_num_rows($pregunta); 

		if($cont==1){

			$mod = false;

			if(validaRequerido($_POST['pregunta'])){
				$sql="UPDATE pregunta set Pregunta='$_POST[pregunta]' where Codigo='$_POST[codigo]'";
				if (!mysqli_query($link ,$sql)){
					die('Error: ' . mysqli_error($link));
				}
				$mod=true;
			} 

			if(validaRequerido($_POST['respuesta'])){
				$sql="UPDATE pregunta set Respuesta='$_POST[respuesta]' where Codigo='$_POST[codigo]'";
				if (!mysqli_query($link ,$sql)){
					die('Error: ' . mysqli_error($link));
				}
				$mod=true;
			}

			if(!trim($_POST['complejidad']) == ''){
				if(!validarExpresion($_POST['complejidad'], '/^(1|2|3|4|5){1}$/')){
					echo "<script type='text/javascript'>
					alert('La complejidad debe ser un número del 1 al 5'); 
				</script>";
				die();
				}
			}
			else{
				$sql="UPDATE pregunta set Complejidad='$_POST[complejidad]' where Codigo='$_POST[codigo]'";
				if (!mysqli_query($link ,$sql)){
					die('Error: ' . mysqli_error($link));
				}
				$mod=true;
			}

			if(validaRequerido($_POST['tema'])){
				$sql="UPDATE pregunta set Tema='$_POST[tema]' where Codigo='$_POST[codigo]'";
				if (!mysqli_query($link ,$sql)){
					die('Error: ' . mysqli_error($link));
				}
				$mod=true;
			} 

			if($mod)
				$_SESSION['pregunta']="Modificada";
			else
				$_SESSION['pregunta']="NoModificada";

			header("location:RevisarPreguntas.php");
		}
		else{
			echo "<script type='text/javascript'>
			alert('No existe ninguna pregunta en la base de datos con dicho código.'); 
			</script>";
			die();
		}
	}
?>