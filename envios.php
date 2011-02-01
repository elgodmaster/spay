<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php include("inc_functions.php"); ?>
<?php $_SESSION["modulo"] = "envios"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php include("inc_metadata.php"); ?>
<body>
<!-- wrap starts here -->
<?php include("inc_header.php"); ?>	
<div id="wrap"> 
	<?php include("inc_menu.php"); ?>
	<!-- content-wrap starts here -->	
	<div id="content-wrap">  
			<?php include("inc_sidebar.php"); ?>	
	  		<div id="main"> 
				<h1>Env&iacute;os</h1>
                <p>
                	<strong>
                    	<a href="adm_cargar_envio.php">
                    		<img align="texttop" src="images/icons/lorry_add.png" border="0" />    	
                            Cargar Env&iacute;o
                       	</a>
                   	</strong>
                    <br />
                    Le permite cargar un nuevo env&iacute;o en el sistema.
                </p>				
                <p>
                	<strong>
                    	<a href="adm_envios.php">
                    		<img align="texttop" src="images/icons/lorry.png" border="0" />    	
                            Administrar Env&iacute;os
                       	</a>
                   	</strong>
                    <br />
                    Le permite consultar env&iacute;os existentes, as&iacute; 
                    como modificar y eliminar env&iacute;os (cuando aplique).
                </p>                						
	  		</div> 	
	<!-- content-wrap ends here -->	
	</div>
<!-- wrap ends here -->
</div>		
<?php include("inc_footer.php"); ?>
</body>
</html>
<?php include("inc_desconectarse.php"); ?>