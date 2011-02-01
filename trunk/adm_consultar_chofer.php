<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "configuracion"; ?>
<?php include("inc_functions.php"); ?>	
<?php 
	$chofer = obtenerChofer($link, $_GET["id"]);
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
					
				<h1>Consultar Chofer</h1>
				<div align="right">
				<a href="adm_choferes.php" class="orange"><strong><< Regresar</strong></a>
				</div>	          
                
				<br />

                    <p>                 
 					<?php include("inc_mensajes.php"); ?>														
                    <label>NOMBRE</label>
					<input name="txtNombre" type="text" size="60" style="text-transform:uppercase" 
                     value="<?php echo $chofer->nombre; ?>" disabled />     														
                    <label>CEDULA DE IDENTIDAD</label>
					<input name="txtCedula" type="text" size="8" style="text-transform:uppercase" 
                     value="<?php echo $chofer->cedula; ?>" disabled />														
                    <label>TELEFONOS</label>
					<input name="txtTelefono" type="text" size="40" style="text-transform:uppercase" 
                     value="<?php echo $chofer->telefono; ?>" disabled />														
                    <label>PLACA CAMION</label>
					<input name="txtPlaca" type="text" size="8" style="text-transform:uppercase" 
                     value="<?php echo $chofer->placa; ?>" disabled />  														
                    <label>DIRECCION</label>
					<input name="txtDireccion" type="text" size="100" style="text-transform:uppercase" 
                     value="<?php echo $chofer->direccion; ?>"  disabled />   
                    </p>
	                <br />          
	                <hr />
	                <p>
	                	<strong style="padding-right:5px">ESTATUS</strong>
	                    <span style="color:<?php echo colorIndEstatus($chofer->ind_activo); ?>; font-weight:bold">
						<?php echo indEstatusStr($link,$chofer->ind_activo); ?>
	                    </span>       
	                    &nbsp;
	                    <strong style="padding-right:5px">CHOFER DESDE</strong>
						<input name="txtTelefono" type="text" size="8" style="text-transform:uppercase" 
	                     value="<?php echo mostrarFecha($chofer->fecha_creacion); ?>" disabled />
	                             
	                </p> 
	                <hr /> 		
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