<?php
	session_start();
	unset($_SESSION['email']);
	unset($_SESSION['profesor']);
	session_destroy();
	header("location:layout.html");	
?>