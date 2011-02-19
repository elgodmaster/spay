<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "configuracion"; ?>
<?php 	
	// Modificar Usuario
	if ($_POST["action"]=="Corregir") {
		
		$query = "UPDATE ts_factura 
		             SET proveedor='INDUSTRIAS BELL POWER C.A' 
		           WHERE id IN(144,162)";
		mysql_query($query, $link);
		
		$query = "UPDATE ts_factura 
		             SET proveedor='DISTRIBUIDORA TOJO-AGRO, C.A' 
		           WHERE id IN(156,157)";
		mysql_query($query, $link);
		
		$query = "UPDATE ts_factura 
		             SET proveedor='GAESCA C.A' 
		           WHERE id=161";
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
				
				<h1>Corregir Facturas</h1>
                <p>
				<?php include("inc_mensajes_crud.php"); ?>
                </p>              

                <h3>Para corregir las Facturas con proveedores duplicados haga click en ACEPTAR.</h3>				
				<form action="z_corregir_facturas.php" method="post" enctype="multipart/form-data" 
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