
<html>
	<head>
		<title> Creditos </title>
		<style type="text/css">
		<!--
			h1{color: #B40404; text-align: center; font: small-caps bold 300% serif}
			p{text-align: center;}
			table{margin: 0 auto;}
			td{width: 250px; text-align: center; font: small-caps bold 120%/150% serif}
			a{font: small-caps bold 120% serif;}
			body{background-color: #E6E6E6}
		-->
		</style>
	</head>
	<body>
		<h1> CREDITOS </h1>
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
	
		<?php
			$email = $_REQUEST['email'] ;
			echo '<p><a href="layout2.php?email=' . $email. '"> Pagina principal </a></p>'
		?>
		
	</body>
</html>