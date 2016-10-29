
<html>
	<head>
		<title> Creditos </title>
		<meta charset='utf-8'>
		<link rel='stylesheet' type='text/css' href='estilos/nuestroEstilo.css'/>
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