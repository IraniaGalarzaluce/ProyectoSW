<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<?php
			$email = $_GET['email']; 
			echo $email
		?>
      	<span class="right"><a href="layout.html" >Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
	<?php
		$email = $_GET['email']; 
		echo '<span><a href="layout2.php?email='. $email. '">Inicio</a></span>';
		echo '<span><a href="VerPreguntasXML2.php?email=' . $email. '"> Ver preguntas</a><span>';
		echo '<span><a href="GestionPreguntas.php?email=' . $email . '">Editar preguntas</a></span>';
		echo '<span><a href="creditos2.php?email=' . $email . '">Creditos</a></span>';
	?>

	</nav>
    <section class="main" id="s1">
    
	<div>
	Aqui se visualizan las preguntas y los creditos ...
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
<?php

//span > a{
//   	text-align: center;
//   	text-decoration: none;
//   	font: 100% serif;
//   	color:black;
//}

//span > a:hover{
//   	color: #B40404;
//}

//header a{
//	display:inline;
//  padding: 8px 16px;
//}

//section.main a{
//	display:block;
//  padding: 8px 16px;
//}
?>
