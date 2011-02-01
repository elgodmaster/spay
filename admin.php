<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php include("inc_functions.php"); ?>
<?php $_SESSION["modulo"] = ""; ?>
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
				<h1>Bienvenido</h1>
                <p>
                	<strong>
                    	<a href="envios.php">
                        	<img align="texttop" src="images/icons/lorry.png" border="0" />
                            ENVIOS
                       	</a>
                   	</strong>
                    <br />
                    En este m&oacute;dulo podr&aacute; cargar en el sistema nuevos env&iacute;os, tanto por 
                    factura directa como por nota de entrega.
                </p>				
                <p>
                	<strong>
                    	<a href="guias.php">
                    		<img align="texttop" src="images/icons/paste_plain.png" border="0" />    	
                            GUIAS DE ENTREGA
                       	</a>
                  	</strong>
                    <br />
                     En este m&oacute;dulo podr&aacute; generar e imprimir gu&iacute;as de entrega a partir 
                     de env&iacute;os cargados en el sistema.
                     
                </p>
                <p>
                	<strong>
                    	<a href="facturas.php">
                    		<img align="texttop" src="images/icons/printer.png" border="0" />    	
                            FACTURAS
                       	</a>
                   	</strong>
                    <br />
                    En este m&oacute;dulo podr&aacute; generar e imprimir facturas a clientes y proveedores.
                    Tambi&eacute;n podr&aacute; consultar el estatus de facturas generadas.
                </p>
                <p>
                	<strong>
                    	<a href="reportes.php">
                    		<img align="texttop" src="images/icons/chart_bar.png" border="0" />    	
                            REPORTES
                       	</a>
                   	</strong>
                    <br />
                    En este m&oacute;dulo podr&aacute; consultar reportes estad&iacute;sticos por clientes, 
                    proveedores, destinos y choferes.
                </p>                                
                <p>
                	<strong>
                    	<a href="configuracion.php">
                    		<img align="texttop" src="images/icons/wrench.png" border="0" />    	
                            CONFIGURACION
                       	</a>
                   	</strong>
                    <br />
                    En este m&oacute;dulo podr&aacute; actualizar los datos de usuario, as&iacute; como administrar 
                    su lista de clientes, proveedores, destinos y choferes. 
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