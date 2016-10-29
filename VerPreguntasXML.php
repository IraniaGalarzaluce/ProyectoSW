<?php

	$xml = simplexml_load_file('preguntas.xml');
	
	echo "<meta charset='utf-8'>
		<link rel='stylesheet' type='text/css' href='estilos/nuestroEstilo.css'/>
		<h1> PREGUNTAS </h1>
		<br>";
	echo '<table border=1> <tr> <th> PREGUNTA </th> <th> COMPLEJIDAD </th><th> TEMA </th></tr>';
	
	foreach ($xml->children() as $pregunta){
		echo "<tr>";
		echo "<td>" . $pregunta->itemBody->p . "</td>";
		echo "<td width='50%'>". $pregunta['complexity'] ."</td>";
		echo "<td>" . $pregunta['subject'] . "</td>";
		echo "</tr>";
	}

	echo "</table>";
	
	echo ' <br> <br> <p> <a href="layout.php?email=' . $_REQUEST['email'] . '"> Pagina principal </a> </p>';

?>