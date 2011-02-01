<?php 
	session_start();
	
	$_SESSION["login"] = "";
	$_SESSION["nombre"] = "";
	$_SESSION["id_usuario"] = "";
	$_SESSION["id_empresa"] = "";
	
	include("inc_redirect.php");
	redirect("index.php");
?>