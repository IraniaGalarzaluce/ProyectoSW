<?php
	//incluimos la clase nusoap.php
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');
	
	//creamos el objeto de tipo soap_server
	$ns="http://localhost/ProyectoSW/samples"; 
	$server = new soap_server;
	$server->configureWSDL('ComprobarContrasena',$ns);
	$server->wsdl->schemaTargetNamespace=$ns;

	//registramos la función que vamos a implementar
	$server->register('comprobar', array('pass'=>'xsd:string'), array('resp'=>'xsd:string'),$ns);

	//implementamos la función
	function comprobar ($pass){

		$myfile = fopen("toppasswords.txt", "r") or die("Unable to open file!");

		while(!feof($myfile)){
			$pass2 = trim(fgets($myfile));
 			if (strcmp($pass, $pass2) == 0){
 				return "INVALIDA";
 			}
		}
		fclose($myfile);
		return "VALIDA";
	}

	//llamamos al método service de la clase nusoap
	//$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	//$server->service($HTTP_RAW_POST_DATA);

	$rawPostData = file_get_contents("php://input");
   	$server->service($rawPostData);
?>