<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php include("inc_functions.php"); ?>
<?php $_SESSION["modulo"] = "configuracion"; ?>
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
				
				<h1>Configuraci&oacute;n</h1>
				<?php if($_SESSION["id_usuario"]!=15) { ?>
                <p>
                	<strong>
                    	<a href="adm_cuenta.php">
                    		<img align="texttop" src="images/icons/user.png" border="0" />     	
                            Datos de Usuario
                       	</a>
                   	</strong>
                    <br />
                    Le permite modificar sus datos de acceso, incluyendo su password.
                </p>	
                <?php } ?>			 
                <p>
                	<strong>
                    	<a href="adm_usuarios.php">
                        	<img align="texttop" src="images/icons/application_form_edit.png" border="0" /> 
                            Administrar Usuarios
                      	</a>
                   	</strong>
                    <br />
                    Le permite crear nuevos usuarios en el sistema, as&iacute; como modificar y eliminar usuarios existentes.
                </p>
                <p>
                	<strong>
                    	<a href="adm_clientes.php">
                    		<img align="texttop" src="images/icons/group.png" border="0" />    	
                            Clientes
                       	</a>
                   	</strong>
                    <br />
                    Le permite crear, modificar y eliminar clientes del sistema.
                </p>     
                <p>
                	<strong>
                    	<a href="adm_proveedores.php">
                    		<img align="texttop" src="images/icons/group.png" border="0" />    	
                            Proveedores
                       	</a>
                   	</strong>
                    <br />
                    Le permite crear, modificar y eliminar proveedores del sistema.
                </p>      
                <p>
                	<strong>
                    	<a href="adm_destinos.php">
                    		<img align="texttop" src="images/icons/map.png" border="0" />    	
                            Destinos
                       	</a>
                   	</strong>
                    <br />
                    Le permite crear, modificar y eliminar destinos en el sistema, as&iacute; 
                    como estados y regiones.
                </p>  
                <p>
                	<strong>
                    	<a href="adm_choferes.php">
                    		<img align="texttop" src="images/icons/lorry.png" border="0" />    	
                            Choferes y Camiones
                       	</a>
                   	</strong>
                    <br />
                    Le permite crear, modificar y eliminar choferes del sistema.
                </p>      	
                <p>
                	<strong>
                    	<a href="adm_datos_sistema.php">
                    		<img align="texttop" src="images/icons/wrench_orange.png" border="0" />    	
                            Datos del Sistema
                       	</a>
                   	</strong>
                    <br />
                    Le permite modificar valores del sistema como por ejemplo el valor del IVA.
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