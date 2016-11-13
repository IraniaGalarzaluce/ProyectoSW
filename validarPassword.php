<?php
	//incluimos la clase nusoap.php
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');

	//creamos el objeto de tipo soapclient.
	$soapclient = new nusoap_client('http://localhost/ProyectoSW/ComprobarContrasena.php?wsdl',true);

	$pass = $_GET['pass'];
	$result = $soapclient->call('comprobar',  array('pass'=>$pass));
	echo $result;

	// AÑADIR ESTE CODIGO AL FINAL DEL PHP QUE CONTIENE LA LLAMADA AL SERVICIO
	//Codigo para debugear y ver la respuesta y posibles errores, comentar cuando se comprueba que está correcto el servicio y la llamada
	//$err = $soapclient->getError();
	//if ($err) {
  //		echo '<p><b>Constructor error: ' . $err . '</b></p>';
	//}

	//echo '<h2>Request</h2>';
	//echo '<pre>' . htmlspecialchars($soapclient->request, ENT_QUOTES) . '</pre>';
	//echo '<h2>Response</h2>';
	//echo '<pre>' . htmlspecialchars($soapclient->response, ENT_QUOTES) . '</pre>';
	//echo htmlspecialchars($soapclient->response, ENT_QUOTES) . '</b></p>';
//	echo '<p><b>Debug: <br>';
	//echo htmlspecialchars($soapclient->debug_str, ENT_QUOTES) .'</b></p>';

	//Comentar hasta aquí

	//if($soapclient->fault){
   // 	echo "FAULT: <p>Code: (".$soapclient->faultcode.")</p>";
   // 	echo "String: ".$soapclient->faultstring;
	//}
	//else
	//{
   // 	//var_dump ($response);
   // 	echo "Codigo: ".$response['Codigo'];
	//}
?>