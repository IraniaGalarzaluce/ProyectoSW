<HTML>
<HEAD>
	<title> Editar preguntas</title>
	<meta charset='utf-8'>
	<link rel='stylesheet' type='text/css' href='estilos/nuestroEstilo.css'/>
	<script language = "javascript">
	
		function verP(){
			var emailUsuario = document.getElementById("email").value;
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function(){
				switch(xmlhttp.readyState) { 
				case 0: document.getElementById('estado').innerHTML = "Sin iniciar..."; 
					break;
				case 1: document.getElementById('estado').innerHTML ="<b>Cargando...</b>"; 
					break;
				case 2: document.getElementById('estado').innerHTML ="<b>Cargado...</b>"; 
					break;
				case 3: document.getElementById('estado').innerHTML = "Interactivo..."; 
					break;
				case 4: document.getElementById('estado').innerHTML ="<b>Completado!</b>";
					document.getElementById("divV").innerHTML = xmlhttp.responseText;
					break;
}
			}
			xmlhttp.open("GET","verPreguntas2.php?email=" + emailUsuario,true);
			xmlhttp.send();
		}
	
		function insertarP(){
			if (verificar()){
				var emailUsuario = document.getElementById("email").value;
				var pregunta = document.getElementById("preg").value;
				var respuesta = document.getElementById("resp").value;
				var complejidad = document.getElementById("comp").value;
				var tema =	document.getElementById("tema").value;
				var pass =	document.getElementById("pass").value;
				xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
				switch(xmlhttp.readyState) {
				case 0: document.getElementById('estado').innerHTML = "Sin iniciar..."; 
					break;
				case 1: document.getElementById('estado').innerHTML ="<b>Cargando...</b>"; 
					break;
				case 2: document.getElementById('estado').innerHTML ="<b>Cargado...</b>"; 
					break;
				case 3: document.getElementById('estado').innerHTML = "Interactivo..."; 
					break;
				case 4: document.getElementById('estado').innerHTML ="<b>Completado!</b>";
					document.getElementById("divI").innerHTML = xmlhttp.responseText;
					break;
}
			}
				xmlhttp.open("POST","InsertarPregunta.php",true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");	
				var datos = 'pregunta='+ pregunta +'&respuesta='+ respuesta +'&complejidad='+ complejidad +'&tema='+ tema +'&email='+ emailUsuario +'&pass='+ pass;
				xmlhttp.send(datos);
			}			
		}
		
		function verificar(){
			var pregunta = document.getElementById("preg").value;
			var respuesta = document.getElementById("resp").value;
			var complejidad = document.getElementById("comp").value;
			var tema =	document.getElementById("tema").value;
			var pass =	document.getElementById("pass").value;
			if (pregunta.length == 0){
				alert("El campo de pregunta está vacío");
				return false;
			}
			if (respuesta.length == 0){
				alert("El campo de respuesta está vacío");
				return false;
			}
			if (tema.length == 0){
				alert("El campo del tema está vacío");
				return false;
			}
			if (pass.length < 6){
				alert("Contraseña no valida");
				return false;
			}
			if (!(complejidad.length == 0)){
				if (!/^(1|2|3|4|5){1}$/.test(complejidad)){
					alert("Complejidad no valida: debe ser un numero del 1 al 5");
					return false;
				}
			}
			return true;
		}
		
	</script>
</HEAD>
<BODY>
	<div align="center">
		<OBJECT id="datos" data="GestionPreguntas.php" type="text/xml" style="display:none"> </OBJECT>
		<FORM METHOD="POST">
			Pregunta* <BR>
			<INPUT TYPE="TEXT" NAME="pregunta" id="preg" required><BR>
			Respuesta* <BR>
			<INPUT TYPE="TEXT" NAME="respuesta" id="resp" required><BR>
			Complejidad <BR>
			<INPUT TYPE="TEXT" NAME="complejidad" id="comp"><BR>
			Tema* <BR>
			<INPUT TYPE="TEXT" NAME="tema" id="tema" required><BR>
			<input type="hidden" id="email" name="email" value="<?php echo $_REQUEST['email']; ?>" /><br>
			Password* <BR>
			<INPUT TYPE="PASSWORD" NAME="pass" id="pass" required><BR>
			<br><br>
			<INPUT TYPE="button" value="InsertarPregunta" onClick="javascript:insertarP()">
			<INPUT TYPE="button" value="VerPreguntas" onClick="javascript:verP()">
		</FORM>
		<br>
		<div id="estado"></div>
		<br>
		<div id="divI">	</div> 
		<br><br>
		<div id="divV">	</div> 
		<?php
			$email = $_GET['email']; 
			echo '<p><a href="layout2.php?email='. $email. '">P&aacute;gina principal</a></p>';
		?>
	</div>
</BODY>
</HTML>



<?php 




?>

