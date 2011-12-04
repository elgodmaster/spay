<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "configuracion"; ?>
<?php include("inc_functions.php"); ?>	
<?php 
	$cliente = obtenerCliente($link,$_GET["id"]);
	$variables = "page=".$_GET["page"]."&txtBusqueda=".$_REQUEST["txtBusqueda"];	
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

				<h1>Consultar Cliente</h1>
				<div align="right">
				<a href="adm_clientes.php?<?php echo $variables; ?>" class="orange"><strong><< Regresar</strong></a>
				</div>	          
				<br />                	
 					<p>											
                    <strong style="padding-right:5px">RIF</strong>
					<input name="txtRIF" type="text" size="12" style="text-transform:uppercase" 
                     value="<?php echo $cliente->rif; ?>" disabled />     	
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;                      											
                    <strong style="padding-right:5px">FLETE</strong>
					<input name="txtFlete" type="text" size="1"  style="text-transform:uppercase; text-align:right;" 
                     value="<?php echo $cliente->flete; ?>" disabled />
                    <strong style="padding-right:5px">%</strong> 
                     &nbsp;											
                    <strong style="padding-right:5px">&iquest;TIENE SEGURO PROPIO?</strong>
                    <select name="cmbSeguro" disabled>
                    	<option value="N" selected>NO</option>
                    	<option value="S"
                    	 <?php if($cliente->seguro=="S") { ?> selected <?php } ?>>
                    	 SI</option>
                    </select> 
                    <br /><br />													
                    <strong style="padding-right:5px">NOMBRE O RAZON SOCIAL</strong>
					<input name="txtNombre" type="text" size="70" style="text-transform:uppercase" 
                     value="<?php echo $cliente->nombre; ?>" disabled />  	
                    <br /><br />													
                    <strong style="padding-right:5px">DIRECCION FISCAL</strong>
					<input name="txtDireccion" type="text" size="79" style="text-transform:uppercase" 
                     value="<?php echo $cliente->direccion; ?>" disabled/>   
                    <br /><br />
                    <strong style="padding-right:5px">CIUDAD</strong>
					<input name="txtCiudad" type="text" size="25" style="text-transform:uppercase" 
                     value="<?php echo $cliente->ciudad; ?>" disabled /> 
                    &nbsp;                     	 														
                    <strong style="padding-right:5px">TELEFONOS</strong>
					<input name="txtTelefono" type="text" size="42" style="text-transform:uppercase" 
                     value="<?php echo $cliente->telefono; ?>" disabled />
                    <br /><br />                    
                    <strong style="padding-right:5px">CORREO ELECTRONICO</strong>
					<input name="txtEmail" type="text" size="74" maxlength="120" style="text-transform:uppercase" 
                     value="<?php echo $cliente->email; ?>"  disabled />   
                    <br /><br />
                    <strong style="padding-right:5px">RETIENE IVA</strong>
                    <select name="cmbIVA"   disabled >
                    	<option value=1 <?php if ($cliente->iva==1) { ?> selected <?php }?>>SI</option>
                    	<option value=0 <?php if ($cliente->iva==0) { ?> selected <?php }?>>NO</option>
                    </select> 
                    &nbsp;           
                    <strong style="padding-right:5px">RETIENE ISLR</strong>
                    <select name="cmbISLR"  disabled >
                    	<option value=1 <?php if ($cliente->islr==1) { ?> selected <?php }?>>SI</option>
                    	<option value=0 <?php if ($cliente->islr==0) { ?> selected <?php }?>>NO</option>
                    </select>   
                    <br /><br />
					<strong style="padding-right:5px">DESTINO DE LOS ENVIOS</strong>
                    <select name="cmbDestino" disabled>
                    <option value="">SELECCIONE...</option>
                    <?php 
						$result = obtenerDestinos($link);
						while($row=mysql_fetch_object($result)) {
					?>		
						<option value="<?php echo($row->id); ?>" 
						 <?php if($cliente->id_destino==$row->id) { ?> selected <?php } ?>>
						 <?php echo($row->nombre); ?>
                       	</option>	
                    <?php
						}
					?>
                    </select>                     		
                <br /><br />             
                <hr />
                <p>
                	<strong style="padding-right:5px">ESTATUS</strong>
                    <span style="color:<?php echo colorIndEstatus($cliente->ind_activo); ?>; font-weight:bold">
					<?php echo indEstatusStr($link,$cliente->ind_activo); ?>
                    </span>       
                    &nbsp;
                    <strong style="padding-right:5px">CLIENTE DESDE</strong>
					<input name="txtTelefono" type="text" size="8" style="text-transform:uppercase" 
                     value="<?php echo mostrarFecha($cliente->fecha_creacion); ?>" disabled />
                             
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