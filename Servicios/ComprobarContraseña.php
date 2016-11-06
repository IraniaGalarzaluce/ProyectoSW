<?php
	//incluimos la clase nusoap.php
	require_once('../lib/nusoap.php');
	require_once('../lib/class.wsdlcache.php');
	
	//creamos el objeto de tipo soap_server
	$ns="http://localhost/ProyectoSW/Servicios"; 
	$server = new soap_server;
	$server->configureWSDL('comprobar',$ns);
	$server->wsdl->schemaTargetNamespace=$ns;

	//registramos la función que vamos a implementar
	$server->register('comprobar', array('pass'=>'xsd:string'), array('resp'=>'xsd:string'),$ns);

	//implementamos la función
	function comprobar ($pass){
		$myfile = fopen("toppasswords.txt", "r") or die("Unable to open file!");
		$encontrado = false;
		$valido = "VALIDO";
		$novalido = "NOVALIDO";

		while(!feof($myfile) && !enocntrado) {
 			$pass2 = fgets($myfile);
 			if (strcmp($pass, $pass2) == 0)
 				encontrado=true;
		}
		fclose($myfile);

		if(encontrado)
			return $valido;
		else
			return $novalido;

	}

	//llamamos al método service de la clase nusoap
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$server->service($HTTP_RAW_POST_DATA);
?>