<?php
	//incluimos la clase nusoap.php
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');
	
	//creamos el objeto de tipo soapclient.
	//http://www.mydomain.com/server.php se refiere a la url
	//donde se encuentra el servicio SOAP que vamos a utilizar.
	$soapclient = new nusoap_client( 'http://sw14.hol.es/ServiciosWeb/comprobarmatricula.php',false);
	
	$email = $_GET['email'];
	$result = $soapclient->call('comprobar', array('x'=>$email));
	echo $result;
	
	
?>