<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php include("inc_functions.php"); ?>
<?php $_SESSION["modulo"] = "guias"; ?>
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
				<h1>Gu&iacute;as de Entrega</h1>
                <p>
                	<strong>
                    	<a href="adm_generar_guia.php">
                    		<img align="texttop" src="images/icons/paste_plain.png" border="0" />    	
                            Generar Gu&iacute;a
                       	</a>
                   	</strong>
                    <br />
                    Le permite generar una nueva gui&iacute;a a partir de env&iacute;os a&uacute;n no asignados.
                </p>				
                <p>
                	<strong>
                    	<a href="adm_guias.php">
                    		<img align="texttop" src="images/icons/paste_plain.png" border="0" />    	
                            Administrar Gu&iacute;as
                       	</a>
                   	</strong>
                    <br />
                    Le permite consultar gu&iacute;as existentes, as&iacute; 
                    como modificar y eliminar gu&iacute;as (cuando aplique).
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