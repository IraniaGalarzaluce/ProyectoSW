<html>
	<head>
		<title> Cr&eacute;ditos </title>
		<meta charset='utf-8'>
		<link rel='stylesheet' type='text/css' href='estilos/nuestroEstilo.css'/>
	</head>
	<body>
		<h1> CR&Eacute;DITOS </h1>
		<p> <img src = "imagen.jpg"> </p>
		<table>
			<tr>
				<td> Ania Berazaluce </td>
				<td> Irati Galarza </td>
			</tr>
			<tr>
				<td> Ingenier&iacute;a del Software </td>
				<td> Ingenier&iacute;a del Software </td>
			</tr>
		</table>
		<br>
		<br>
		
		<form method = "POST" action = "creditos.php">
			<center>
			<input type = "submit" name = "submit" value = "Geolocalizaci&oacute;n">
			</center>
		</form>

		<?php
		if(isset($_POST['submit'])){
			require_once('lib/nusoap.php');
			require_once('lib/class.wsdlcache.php');
			$soapservidor = new nusoap_client( 'http://v1.fraudlabs.com/ip2locationwebservice.asmx?wsdl', true);
			
			$IPServ = $_SERVER['SERVER_ADDR'];

			$parms = array("IP" => $IPServ,"LICENSE" => "02-DG42-QEXG");
			$servidor = $soapservidor->call('IP2Location', array($parms));

			echo "<p class='geo'>";
			
			echo "Ubicaci&oacute;n del servidor:" . "<br> ";
			echo "Pa&iacute;s: " . $servidor["COUNTRYNAME"] . ". Regi&oacute;n: " . $servidor["REGION"] . ". Ciudad: " . $servidor["CITY"] . "<br><br>";
			
			$soapcliente = new nusoap_client( 'http://v1.fraudlabs.com/ip2locationwebservice.asmx?wsdl', true);
	
			$IP = !empty($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
					
			$parmsC = array("IP" => $IP ,"LICENSE" => "02-DG42-QEXG");
			$cliente = $soapcliente->call('IP2Location', array($parmsC));
			
			echo "Ubicaci&oacute;n del cliente:" . "<br>";
			echo "Pa&iacute;s: " . $cliente["COUNTRYNAME"] .". Regi&oacute;n: ". $cliente["REGION"] .". Ciudad: ". $cliente["CITY"];

			echo "</p>";
		}
		?>
		<br>
		<br>
		<p>
		<a href = "layout.html"> P&aacute;gina principal </a>
		</P>
	</body>
</html>