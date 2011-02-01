<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php include("inc_functions.php"); ?>
<?php $_SESSION["modulo"] = "facturas"; ?>
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
				<h1>Facturas</h1>
                <p>
                	<strong>
                    	<a href="adm_factura_proveedor.php">
                    		<img align="texttop" src="images/icons/printer_add.png" border="0" />    	
                            Generar Factura Proveedor
                       	</a>
                   	</strong>
                    <br />
                    Le permite generar una nueva factura a partir de env&iacute;os a&uacute;n no facturados.
                </p>
                <p>
                	<strong>
                    	<a href="adm_factura_cliente.php">
                    		<img align="texttop" src="images/icons/printer_add.png" border="0" />    	
                            Generar Factura Cliente
                       	</a>
                   	</strong>
                    <br />
                    Le permite generar una nueva factura a partir de env&iacute;os a&uacute;n no facturados.
                </p>				
                <p>
                	<strong>
                    	<a href="adm_facturas.php">
                    		<img align="texttop" src="images/icons/printer.png" border="0" />    	
                            Administrar Facturas
                       	</a>
                   	</strong>
                    <br />
                    Le permite consultar facturas existentes, as&iacute; 
                    como modificar, anular y eliminar facturas existentes (cuando aplique).
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