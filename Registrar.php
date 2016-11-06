
<?php

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
	
	echo "<meta charset='utf-8'>
		<link rel='stylesheet' type='text/css' href='estilos/nuestroEstilo.css'/>";
	
	if (!validaRequerido($_POST['Nombre'])) {
		echo '<br> <br> <p> Error: Faltan campos obligatorios por rellenar. </p> <br> <br>';
		echo "<p> <a href='registro.html'> Volver a registro </a> </p>";
		die();
	}
	if(!validaRequerido($_POST['Apellidos'])){
		echo '<br> <br> <p> Error: Faltan campos obligatorios por rellenar.  </p> <br> <br>';
		echo "<p> <a href='registro.html'> Volver a registro </a> </p>";
		die();
	}
	if(!validarExpresion($_POST['Apellidos'], '/^[a-zA-Z]+(\s)+[a-zA-Z]+$/')){
		echo '<br> <br> <p> Error: Debes introducir dos apellidos. </p> <br> <br>';
		echo "<p> <a href='registro.html'> Volver a registro </a> </p>";
		die();
	}
	if(!validaRequerido($_POST['Correo'])){
		echo '<br> <br> <p> Error: Faltan campos obligatorios por rellenar. </p> <br> <br>';
		echo "<p> <a href='registro.html'> Volver a registro </a> </p>";
		die();
	}
	if(!validarExpresion($_POST['Correo'], '/^[a-z]{2,}[0-9]{3}@ikasle\.ehu\.(eus|es)$/')){
		echo '<br> <br> <p> Error: El correo introducido no cumple el formato de la UPV/EHU. Vuelve a intentar registrarte por favor. </p> <br> <br>';
		echo "<p> <a href='registro.html'> Volver a registro </a> </p>";
		die();
	}
	
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');

	$soapclient = new nusoap_client( 'http://sw14.hol.es/ServiciosWeb/comprobarmatricula.php?wsdl',true);
	$email = $_POST['Correo'];
	$result = $soapclient->call('comprobar', array('x'=>$email));
	if (strcmp($result, "NO") == 0){
		echo '<br> <br> <p> Error: El correo introducido no está matriculado en SW. Vuelve a intentar registrarte por favor. </p> <br> <br>';
		echo "<p> <a href='registro.html'> Volver a registro </a> </p>";
		die();
	}
	
	if(!validaRequerido($_POST['Password'])){
		echo '<br> <br> <p> Error: Faltan campos obligatorios por rellenar. </p> <br> <br>';
		echo "<p> <a href='registro.html'> Volver a registro </a> </p>";
		die();
	}
	if(!validarExpresion($_POST['Password'], '/^.{6,}$/')){
		echo '<br> <br> <p> Error: La contraseña debe de tener al menos 6 caracteres. </p> <br> <br>';
		echo "<p> <a href='registro.html'> Volver a registro </a> </p>";
		die();
	}

	$soapclient2 = new nusoap_client('http://localhost/ProyectoSW/ComprobarContrasena.php?wsdl',true);
	$pass = $_POST['Password'];
	$result2 = $soapclient2->call('comprobar',  array('pass'=>$pass));
	if (strcmp($result2, "INVALIDA") == 0){
		echo '<br> <br> <p> Error: La contraseña no es lo suficientemente segura. Vuelva a intentarlo por favor. </p> <br> <br>';
		echo "<p> <a href='registro.html'> Volver a registro </a> </p>";
		die();
	}

	if(!validaRequerido($_POST['Telefono'])){
		echo '<br> <br> <p> Error: Faltan campos obligatorios por rellenar. </p> <br> <br>';
		echo "<p> <a href='registro.html'> Volver a registro </a> </p>";
		die();
	}
	if(!validarExpresion($_POST['Telefono'], '/^(6|7|9){1}[0-9]{8}$/')){
		echo '<br> <br> <p> Error: Telefono no válido. </p> <br> <br>';
		echo "<p> <a href='registro.html'> Volver a registro </a> </p>";
		die();
	}
	$esp = $_POST['Especialidad'];
	if(strcmp($esp, "Otro") == 0){
		if(!validaRequerido($_POST['otraEspecialidad'])){
			echo '<br> <br> <p> Error: Faltan campos obligatorios por rellenar. </p> <br> <br>';
			echo "<p> <a href='registro.html'> Volver a registro </a> </p>";
			die();
		}
		$esp = $_POST['otraEspecialidad'];
	}
	
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

	$sql="INSERT INTO usuario VALUES ('$_POST[Nombre]', '$_POST[Apellidos]', '$_POST[Correo]', '$_POST[Password]', '$_POST[Telefono]', '$esp', '$_POST[Opcional]', '$file' )";

	if (!mysqli_query($link ,$sql)){
		die('Error: ' . mysqli_error($link));
	}
	echo "
	<br>
	<br>
	<br>";
	echo "<p> Usuario a&ntilde;adido. </p>";
	echo "<p> <a href='VerUsuarios.php'> Ver usuarios </a>";
	echo '<br> <br> <p> <a href="layout.html"> P&aacute;gina principal </a> </p>';
	mysqli_close($link);
	
?>