<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "configuracion"; ?>
<?php 	
	// Modificar Usuario
	if ($_POST["action"]=="Actualizar") {
		
		$query = "ALTER TABLE ts_envio ADD devolucion INT(15)";
		mysql_query($query, $link);
		
		$query = "INSERT INTO ts_config(parametro,
		                                codigo,
		                                valor,
		                                ind_activo,
		                                fecha_creacion,
		                                fecha_modificacion,
		                                id_usuario) 
		                         VALUES('SEQ_DEVOLUCION',
		                                1,
		                                7,
		                                1,
		                                CURDATE(),
		                                CURDATE(),
		                                1)";
		mysql_query($query, $link);
		
		$action_result = "exitoActualizarSistema";
	}
?>	
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
				
				<h1>Actualizar Sistema</h1>
                <p>
				<?php include("inc_mensajes_crud.php"); ?>
                </p>              

                <h3>Para actualizar el sistema haga click en ACEPTAR.</h3>				
				<form action="z_actualizar_sistema.php" method="post" enctype="multipart/form-data" 
                  style="background-color:#FFF; border-color:#FFF">	                
                   	<input name="action" type="hidden" value="Actualizar" />  
                    <input name="id" type="hidden" value="<?php echo $_SESSION["id_usuario"]; ?>" />                 
                    <input class="button" value="ACEPTAR" type="submit" onclick="alert('Esta seguro de ejecutar esta accion?')" />			
				</form>

                <br />                             
                								
	  		</div> 	
	<!-- content-wrap ends here -->	
	</div>
<!-- wrap ends here -->
</div>		
<?php include("inc_footer.php"); ?>
</body>
</html>
<?php include("inc_desconectarse.php"); ?>