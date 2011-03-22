<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "configuracion"; ?>
<?php 	
	if ($_POST["action"]=="Corregir") {
		
		$query = "UPDATE ts_factura
		             SET proveedor='FLEJES VENEZOLANOS, C.A' 
		           WHERE id = 244";
		mysql_query($query, $link);
		
		$query = "UPDATE ts_factura
		             SET proveedor='GRUPO CENTRAL XXI, C.A.'
		           WHERE id = 251";
		mysql_query($query, $link);
		
		$query = "UPDATE ts_factura
		             SET proveedor='FM POWER MATERIALES ELECTRICOS, C.A. (FERMETAL)'
		           WHERE id = 263";
		mysql_query($query, $link);
		
		$query = "UPDATE ts_factura
		             SET proveedor='INDUSTRIAS BELL POWER C.A'
		           WHERE id = 266";
		mysql_query($query, $link);
		
		$query = "UPDATE ts_factura
		             SET proveedor='INDUSTRIAS BELL POWER C.A'
		           WHERE id = 306";
		mysql_query($query, $link);
		
		$query = "UPDATE ts_factura
		             SET proveedor='CUREX C.A'
		           WHERE id = 314";
		mysql_query($query, $link);
		
		$query = "UPDATE ts_factura
		             SET proveedor='MUNDO PAPEL 2001, C.A.'
		           WHERE id = 319";
		mysql_query($query, $link);
		
		$query = "UPDATE ts_envio
		             SET id_factura=121
		           WHERE id = 361";
		mysql_query($query, $link);
		
		$action_result = "exitoModificarDatos";
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
				
				<h1>Corregir Envios</h1>
                <p>
				<?php include("inc_mensajes_crud.php"); ?>
                </p>              

                <h3>Para corregir los datos haga click en ACEPTAR.</h3>				
				<form action="z_corregir_datos.php" method="post" enctype="multipart/form-data" 
                  style="background-color:#FFF; border-color:#FFF">	                
                   	<input name="action" type="hidden" value="Corregir" />  
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