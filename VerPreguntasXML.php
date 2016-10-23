<?php

	$xml = simplexml_load_file('preguntas.xml');
	
	echo '<style type="text/css">
		<!--
			h1{color: #B40404; text-align: center; font: small-caps bold 300% serif}
			p{text-align: center;}
			table{margin: 0 auto;}
			td{width: 350px; text-align: center; font: 120% serif}
			a{font: small-caps bold 120% serif;}
			body{background-color: #E6E6E6}
		-->
		</style>
		<h1> PREGUNTAS </h1>
		<br>';
	echo '<table border=1> <tr> <th> PREGUNTA </th> <th> COMPLEJIDAD </th><th> TEMA </th></tr>';
	
	foreach ($xml->children() as $pregunta){
		echo "<tr>";
		echo "<td>" . $pregunta->itemBody->p . "</td>";
		echo "<td width='50%'>". $pregunta['complexity'] ."</td>";
		echo "<td>" . $pregunta['subject'] . "</td>";
		echo "</tr>";
	}

	echo "</table>";
	
	echo ' <br> <br> <p> <a href="layout2.php?email=' . $_REQUEST['email'] . '"> Pagina principal </a> </p>';

?>