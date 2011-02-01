<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php include("inc_functions.php"); ?>
<?php $_SESSION["modulo"] = "reportes"; ?>
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
				<h1>Reportes</h1>
                <p>
                	<strong>
                    	<a href="adm_reporte_proveedores.php">
                        	<img align="texttop" src="images/icons/chart_bar.png" border="0" /> 
                            Reporte por Proveedores
                       	</a>
                   	</strong>
                    <br />
                    Reportes estad&iacute;sticos de env&iacute;os por Proveedor.
                </p>	
                <p>
                	<strong>
                    	<a href="adm_reporte_clientes.php">
                        	<img align="texttop" src="images/icons/chart_bar.png" border="0" /> 
                            Reporte por Clientes
                       	</a>
                   	</strong>
                    <br />
                    Reportes estad&iacute;sticos de env&iacute;os por Cliente.
                </p>
                <p>
                	<strong>
                    	<a href="adm_reporte_destinos.php">
                        	<img align="texttop" src="images/icons/chart_bar.png" border="0" /> 
                            Reporte por Destinos
                       	</a>
                   	</strong>
                    <br />
                    Reportes estad&iacute;sticos de env&iacute;os por Destino.
                </p>
                <p>
                	<strong>
                    	<a href="adm_reporte_choferes.php">
                        	<img align="texttop" src="images/icons/chart_bar.png" border="0" /> 
                            Reporte por Choferes
                       	</a>
                   	</strong>
                    <br />
                    Reportes estad&iacute;sticos de env&iacute;os por Chofer.
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