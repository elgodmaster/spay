<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "configuracion"; ?>
<?php include("inc_functions.php"); ?>	
<?php 
	$proveedor = obtenerProveedor($link,$_GET["id"]);
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

				<h1>Consultar Proveedor</h1>
				<div align="right">
				<a href="adm_proveedores.php" class="orange"><strong><< Regresar</strong></a>
				</div>	          
				<br />                	
 					<p>											
                    <strong style="padding-right:5px">RIF</strong>
					<input name="txtRIF" type="text" size="12" style="text-transform:uppercase" 
                     value="<?php echo $proveedor->rif; ?>" disabled />     	
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;                      											
                    <strong style="padding-right:5px">FLETE</strong>
					<input name="txtFlete" type="text" size="1" style="text-transform:uppercase; text-align:right;" 
                     value="<?php echo $proveedor->flete; ?>" disabled />
                    <strong style="padding-right:5px">%</strong> 
                     &nbsp;											
                    <strong style="padding-right:5px">&iquest;TIENE SEGURO PROPIO?</strong>
                    <select name="cmbSeguro" disabled>
                    	<option value="N" selected>NO</option>
                    	<option value="S"
                    	 <?php if($proveedor->seguro=="S") { ?> selected <?php } ?>>
                    	 SI</option>
                    </select> 
                    <br /><br />													
                    <strong style="padding-right:5px">NOMBRE O RAZON SOCIAL</strong>
					<input name="txtNombre" type="text" size="70" style="text-transform:uppercase" 
                     value="<?php echo $proveedor->nombre; ?>" disabled />  	
                    <br /><br />													
                    <strong style="padding-right:5px">DIRECCION FISCAL</strong>
					<input name="txtDireccion" type="text" size="79" style="text-transform:uppercase" 
                     value="<?php echo $proveedor->direccion; ?>" disabled/>   
                    <br /><br />
                    <strong style="padding-right:5px">CIUDAD</strong>
					<input name="txtCiudad" type="text" size="25" style="text-transform:uppercase" 
                     value="<?php echo $proveedor->ciudad; ?>" disabled /> 
                    &nbsp;                     	 														
                    <strong style="padding-right:5px">TELEFONOS</strong>
					<input name="txtTelefono" type="text" size="42" style="text-transform:uppercase" 
                     value="<?php echo $proveedor->telefono; ?>" disabled />
                    <br /><br />                    		           
                	<hr />
                <p>
                	<strong style="padding-right:5px">ESTATUS</strong>
                    <span style="color:<?php echo colorIndEstatus($proveedor->ind_activo); ?>; font-weight:bold">
					<?php echo indEstatusStr($link,$proveedor->ind_activo); ?>
                    </span>       
                    &nbsp;
                    <strong style="padding-right:5px">PROVEEDOR DESDE</strong>
					<input name="txtTelefono" type="text" size="8" style="text-transform:uppercase" 
                     value="<?php echo mostrarFecha($proveedor->fecha_creacion); ?>" disabled />
                             
                </p> 
                <hr />
                								
	  		</div> 	
	<!-- content-wrap ends here -->	
	</div>
<!-- wrap ends here -->
</div>		
<?php include("inc_footer.php"); ?>
</body>
</html>
<?php include("inc_desconectarse.php"); ?>