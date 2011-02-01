<?php include("inc_redirect.php"); ?>
<?php
	if($_SESSION["nombre"]=="") {
		redirect("index.php");	
	}	
?>