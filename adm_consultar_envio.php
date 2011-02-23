<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "envios"; ?>
<?php include("inc_functions.php"); ?>	
<?php 
	$envio = obtenerEnvio($link,$_GET["id"]);
	$cliente = obtenerCliente($link,$envio->id_cliente);
	if($envio->id_guia!="") {
		$guia = obtenerGuia($link, $envio->id_guia);
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
					
				<h1>Consultar Env&iacute;o</h1>
				<div align="right">
				<a href="adm_envios.php" class="orange"><strong><< Regresar</strong></a>
				</div>				   
                <div style="padding-left:10px">
                	<p>
                	<strong>FECHA CREACION</strong>&nbsp; 
            		<input name="txtRIF" type="text" size="8" style="text-transform:uppercase" 
                     value="<?php echo mostrarFecha($envio->fecha_creacion);  ?>" disabled />
                    &nbsp;
                    <?php 
                    	if($guia->numero_guia=="") { 
                    		$valor = "";
                    	}
                    	else {
                    		$valor = str_pad($guia->numero_guia, 6, "0", STR_PAD_LEFT);
                    	}
                    ?>
                    <strong>GUIA N&deg;</strong>&nbsp; 
                    <input name="txtRIF" type="text" size="5" style="text-transform:uppercase; text-align:right;" 
                     value="<?php echo $valor;  ?>" disabled />
                    &nbsp;
                    <?php  
                    	if($envio->tipo_envio=="F") { 
                    		$valor = str_pad($envio->remesa, 6, "0", STR_PAD_LEFT);
                    	}
                    	else {
                    		$valor = obtenerNumeroFactura($link, $envio->id_factura);
                    		if($valor!="") {
								$valor = str_pad($valor, 9, "0", STR_PAD_LEFT);                    			
                    		}
                    	}
                    ?>
                    <strong>FACTURA SPAY N&deg;</strong>&nbsp; 
                    <input name="txtRIF" type="text" size="9" style="text-transform:uppercase; text-align:right;" 
                     value="<?php echo $valor; ?>" disabled />
                    &nbsp;
					</p>
					<hr />
 					<p><strong class="orange">DATOS DEL CLIENTE</strong></p>
 					<hr />		
 					<p>											
                    <strong style="padding-right:5px">RIF</strong>
					<input name="txtRIF" type="text" size="12" style="text-transform:uppercase" 
                     value="<?php echo $cliente->rif; ?>" disabled />     	
                    <br /><br />													
                    <strong style="padding-right:5px">NOMBRE O RAZON SOCIAL</strong>
					<input name="txtNombre" type="text" size="70" style="text-transform:uppercase" 
                     value="<?php echo $cliente->nombre; ?>" disabled />  	
                    <br /><br />													
                    <strong style="padding-right:5px">DIRECCION FISCAL</strong>
					<input name="txtDireccion" type="text" size="79" style="text-transform:uppercase" 
                     value="<?php echo $cliente->direccion; ?>" disabled />   
                    <br /><br />
                    <strong style="padding-right:5px">CIUDAD</strong>
					<input name="txtCiudad" type="text" size="25" style="text-transform:uppercase" 
                     value="<?php echo $cliente->ciudad; ?>" disabled /> 
                    &nbsp;                     	 														
                    <strong style="padding-right:5px">TELEFONOS</strong>
					<input name="txtTelefono" type="text" size="42" style="text-transform:uppercase" 
                     value="<?php echo $cliente->telefono; ?>" disabled />
                    <br /><br />
                    <hr />
                    <p>
                    <strong class="orange">DATOS DEL ENVIO</strong>
                    </p>		
                    <hr />												
                    <p>
                    	<strong style="padding-right:5px">GENERAR</strong>
                    	<input name="txtTelefono" type="text" size="20" style="text-transform:uppercase" 
                     		value="<?php echo tipoEnvio($envio->tipo_envio); ?>" disabled />  
                     	&nbsp;
						<strong style="padding-right:5px">COBRAR POR</strong>
                    	<input name="txtTelefono" type="text" size="5" style="text-transform:uppercase" 
                     		value="<?php echo tipoCobro($envio->tipo_cobro); ?>" disabled />                       	
	                    <br />  <br />                
						<strong style="padding-right:5px">PROVEEDOR</strong>
                    	<input name="txtTelefono" type="text" size="30" style="text-transform:uppercase" 
                     		value="<?php echo obtenerProveedorStr($link, $envio->id_proveedor); ?>" disabled />             
	                    &nbsp;      
						<strong style="padding-right:5px">DESTINO</strong>
                    	<input name="txtTelefono" type="text" size="30" style="text-transform:uppercase" 
                     		value="<?php echo obtenerDestinoStr($link, $envio->id_destino); ?>" disabled /> 
	                    <br /><br />
                    	<strong style="padding-right:5px">BULTOS</strong>
						<input name="txtBultos" type="text" size="1" 
						 style="text-transform:uppercase; text-align:right;" 
						 value="<?php echo $envio->bultos; ?>" disabled /> 
						&nbsp; 
                    	<strong style="padding-right:5px">REMESA</strong>
						<input name="txtRemesa" type="text" size="5" 
						 style="text-transform:uppercase; text-align:right;"  
						 value="<?php echo str_pad($envio->remesa, 6, "0", STR_PAD_LEFT); ?>" disabled /> 
						&nbsp;
                    	<strong style="padding-right:5px">FACTURA</strong>
						<input name="txtFactura" type="text" size="5" 
						 style="text-transform:uppercase; text-align:right;" 
						 value="<?php echo str_pad($envio->factura, 6, "0", STR_PAD_LEFT); ?>" disabled />    
						&nbsp;
						<?php 
							if($envio->viaje!="") {
								$valor = number_format($envio->viaje,2,",",".");
							}
							else {
								$valor = "";
							}
						?>
                    	<strong style="padding-right:5px">VALOR DEL VIAJE</strong>
						<input name="txtViaje" type="text" size="2" 
						 style="text-transform:uppercase; text-align:right;" 
						 value="<?php echo $valor; ?>" disabled /> 
						<strong>Bs.</strong>
						<br /><br />
                    	<strong style="padding-right:5px">VALOR MERCANCIA</strong>
						<input name="txtMercancia" type="text" size="8" 
						 style="text-transform:uppercase; text-align:right;" 
						 value="<?php echo number_format($envio->mercancia,2,",","."); ?>" disabled /> 
						<strong>Bs.</strong>   
						&nbsp;
						<?php 
							if($envio->flete!="") {
								$valor = number_format($envio->flete,2,",",".");
							}
							else {
								$valor = "";
							}
						?>
                    	<strong style="padding-right:5px">FLETE</strong>
						<input name="txtFlete" type="text" size="1" 
						 style="text-transform:uppercase; text-align:right;" 
						 value="<?php echo $valor; ?>" disabled /> 
						<strong style="padding-right:5px">%</strong>  
						&nbsp;
						<?php 
							if($envio->peso!="") {
								$valor = number_format($envio->peso,2,",",".");
							}
							else {
								$valor = "";
							}
						?>
                    	<strong style="padding-right:5px">PESO</strong>
						<input name="txtPeso" type="text" size="2" 
						 style="text-transform:uppercase; text-align:right;" 
						 value="<?php echo $valor; ?>" disabled /> 
						<strong>Kg</strong>
						&nbsp;
						<?php 
							if($envio->bskg!="") {
								$valor = number_format($envio->bskg,2,",",".");
							}
							else {
								$valor = "";
							}
						?>
						<strong style="padding-right:5px">Bs/Kg</strong>
						<input name="txtBsKg" type="text" size="1"
						 style="text-align:right;" 
						 value="<?php echo $valor; ?>" disabled />
                    </p>
                    <br />
                    <hr />   
                    <p>
                    <strong style="padding-right:5px;">ESTATUS</strong>
                    <span style="color:<?php echo colorIndEnvio($envio->ind_envio); ?>; font-weight:bold">
					<?php echo indEnvioStr($link,$envio->ind_envio); ?>
                    </span>
                    &nbsp;
                    <strong style="padding-right:5px;">FECHA</strong><input name="txtRIF" type="text" size="8" style="text-transform:uppercase" 
                     value="<?php echo mostrarFecha($envio->fecha_modificacion);  ?>" disabled />
                    <?php if($envio->ind_envio > 1 && $envio->ind_envio < 5) { ?>
                    &nbsp;
                    <strong style="padding-right:5px;">CHOFER</strong><input name="txtRIF" type="text" size="47" style="text-transform:uppercase" 
                     value="<?php echo obtenerChoferStr($link, $guia->id_chofer);  ?>" disabled />
                    <?php } ?>
                    <?php if($envio->motivo!="") { ?>
                    <br /><br />
                    <strong style="padding-right:5px;">OBSERVACIONES</strong>
                    <br />
                    <?php echo $envio->motivo; ?>
                    <?php } ?>
                    </p>           
                    <hr />
                                                   			
				</div>
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