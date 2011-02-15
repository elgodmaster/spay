<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "envios"; ?>
<?php include("inc_functions.php"); ?>	
<?php 

	// DATA MANIPULATION
	
	if ($_POST["action"]!="" || $_GET["action"]!="") {
	
		// Buscar Datos Cliente
		if ($_POST["action"]=="Buscar") {
			$envio = obtenerClienteRIF($link,strtoupper($_POST["txtBuscarCliente"]));
		}
		
		// Cargar Envio
		if ($_POST["action"]=="Crear") {
			$envio->id_cliente = $_POST["id_cliente"];
			$envio->rif = strtoupper($_POST["txtRIF"]);
			$envio->nombre = strtoupper($_POST["txtNombre"]);
			$envio->direccion = strtoupper($_POST["txtDireccion"]);
			$envio->ciudad = strtoupper($_POST["txtCiudad"]);
			$envio->telefono = strtoupper($_POST["txtTelefono"]);
			$envio->tipo_envio = $_POST["cmbGenerar"];
			$envio->tipo_cobro = $_POST["cmbCobrar"];
			$envio->id_proveedor = $_POST["cmbProveedor"];
			$envio->id_destino = $_POST["cmbDestino"];
			$envio->bultos = $_POST["txtBultos"];
			$envio->observaciones = strtoupper($_POST["txtObservaciones"]);
			if($_POST["remesa"]!="") {
				$envio->remesa = $_POST["remesa"];
			}
			else {
				$envio->remesa = $_POST["txtRemesa"];
				
			}
			$envio->factura = $_POST["txtFactura"];
			$envio->flete = $_POST["txtFlete"];
			$envio->mercancia = $_POST["txtMercancia"];
			$envio->bskg = $_POST["txtBsKg"];
			$envio->peso = $_POST["txtPeso"];
			$envio->viaje = $_POST["txtViaje"];
			$envio->otro = $_POST["cmbOtroEnvio"];
			$action_result = cargarEnvio($link, $envio);
			
			if($envio->tipo_envio=="N" && $envio->otro=="N") {
				$nota = "adm_nota_de_entrega.php?id=".$_SESSION["id_ultimo_envio"];
				$envio->remesa = obtenerNumeroRemesa($link, $_SESSION["id_ultimo_envio"]);
			}
			if($envio->otro=="N") {
				$envio = "nothing";
			}
		}	
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
					
				<h1>Cargar Env&iacute;o</h1>				
				<?php include("inc_mensajes_crud.php"); ?>
				<?php if($nota!="") { ?>   
				<span style="padding-left:15px">
				<strong>Haga <a href="<?php echo $nota; ?>">click aqui</a> para generar la Nota de Entrega</strong>    
				</span>
				<?php } ?>  
				<form action="adm_cargar_envio.php" method="post" enctype="multipart/form-data" 
                 onSubmit="return validate_buscar_cliente_form(this);">
                 	<p>
                 	<strong>RIF</strong>
                 	&nbsp;                
					<input name="txtBuscarCliente" type="text" size="12" style="text-transform:uppercase" /> 
					<input name="action" type="hidden" value="Buscar" />
					&nbsp;
                 	<input class="button" value="CARGAR DETALLES CLIENTE" type="submit" />
                	</p>
                </form>
				<form name="frmSP" action="adm_cargar_envio.php" method="post" enctype="multipart/form-data" 
                 onSubmit="return validate_envio_form(this);">	
                 	<p>
                    <?php include("inc_mensajes.php"); ?>    	             
				    </p>
                    <?php include("inc_lists.php"); ?>               
					<hr />
 					<p><strong class="orange">DATOS DEL CLIENTE</strong></p>
 					<hr />		
 					<p>											
                    <strong style="padding-right:5px">RIF</strong>
					<input name="txtRIF" type="text" size="12" style="text-transform:uppercase" 
                     value="<?php echo $envio->rif; ?>" />     	
                    <br /><br />													
                    <strong style="padding-right:5px">NOMBRE O RAZON SOCIAL</strong>
					<input name="txtNombre" type="text" size="70" style="text-transform:uppercase" 
                     value="<?php echo $envio->nombre; ?>" />  	
                    <br /><br />													
                    <strong style="padding-right:5px">DIRECCION FISCAL</strong>
					<input name="txtDireccion" type="text" size="79" maxlength="120" style="text-transform:uppercase" 
                     value="<?php echo $envio->direccion; ?>" />   
                    <br /><br />
                    <strong style="padding-right:5px">CIUDAD</strong>
					<input name="txtCiudad" type="text" size="25" style="text-transform:uppercase" 
                     value="<?php echo $envio->ciudad; ?>" /> 
                    &nbsp;                     	 														
                    <strong style="padding-right:5px">TELEFONOS</strong>
					<input name="txtTelefono" type="text" size="42" style="text-transform:uppercase" 
                     value="<?php echo $envio->telefono; ?>" />
                    <br /><br />
                    <hr />
                    <p>
                    <strong class="orange">DATOS DEL ENVIO</strong>
                    </p>		
                    <hr />												
                    <p>
                    	<strong style="padding-right:5px">GENERAR</strong>
                    	<select name="cmbGenerar" onChange="NotaDeEntrega(frmSP)">
                    		<option value="">SELECCIONE...</option>
                    		<option value="N"
                    		<?php if($envio->tipo_envio=="N") { ?> selected <?php } ?>>
                    		 NOTA DE ENTREGA
                    		</option>
                    		<option value="F" 
                    		 <?php if($envio->tipo_envio=="F") { ?> selected <?php } ?>>
                    		 FACTURA
                    		</option>
	                    </select>  
	                    &nbsp;
	                    <strong style="padding-right:5px">COBRAR POR:</strong>
                    	<select name="cmbCobrar" onChange="PesoValor(frmSP)">
                    		<option value="" selected></option>
                    		<option value="V" <?php if($envio->tipo_cobro=="V") { ?> selected <?php } ?>>
                    		 VALOR</option>
                    		<option value="P" <?php if($envio->tipo_cobro=="P") { ?> selected <?php } ?>>
                    		 PESO
                    		</option>
                    		<option value="M" <?php if($envio->tipo_cobro=="M") { ?> selected <?php } ?>>
                    		 VIAJE
                    		</option>
	                    </select>  
	                    <br />  <br />                
						<strong style="padding-right:5px">PROVEEDOR</strong>
	                    <select name="cmbProveedor" onChange="cargarFlete(frmSP)">
	                    <option value="">SELECCIONE...</option>
	                    <?php 
							$result = obtenerProveedores($link);
							while($row=mysql_fetch_object($result)) {
						?>		
							<option value="<?php echo($row->id); ?>">
							 <?php echo substr($row->nombre,0,90); ?>
	                       	</option>	
	                    <?php
							}
						?>
	                    </select> 
	                    <br />  <br />      
						<strong style="padding-right:5px">DESTINO</strong>
	                    <select name="cmbDestino">
	                    <option value="">SELECCIONE...</option>
	                    <?php 
							$result = obtenerDestinos($link);
							while($row=mysql_fetch_object($result)) {
						?>		
							<option value="<?php echo($row->id); ?>" 
							 <?php if($envio->id_destino==$row->id) { ?> selected <?php } ?>>
							 <?php echo($row->nombre); ?>
	                       	</option>	
	                    <?php
							}
						?>
	                    </select> 
	                    <br /><br />
                    	<strong style="padding-right:5px">BULTOS</strong>
						<input name="txtBultos" type="text" size="1" style="text-transform:uppercase; text-align:right;" /> 
						&nbsp; 
                    	<strong style="padding-right:5px">REMESA</strong>
						<input name="txtRemesa" type="text" size="5" style="text-transform:uppercase; text-align:right;"  
						 value="<?php echo $envio->remesa; ?>" 
						 <?php if($envio->tipo_envio!="" && $envio->tipo_envio=="N") { ?> disabled <?php } ?> /> 
						&nbsp;
                    	<strong style="padding-right:5px">FACTURA</strong>
						<input name="txtFactura" type="text" size="5" style="text-transform:uppercase; text-align:right;" />    
						&nbsp;
                    	<strong style="padding-right:5px">VALOR DEL VIAJE</strong>
						<input name="txtViaje" type="text" size="2" style="text-transform:uppercase; 
						 text-align:right;" <?php if($envio->tipo_cobro!="" && $envio->tipo_cobro!="M") { ?> disabled <?php } ?> /> 
						<strong>Bs.</strong>
						<br /><br />
                    	<strong style="padding-right:5px">VALOR MERCANCIA</strong>
						<input name="txtMercancia" type="text" size="8" style="text-transform:uppercase; text-align:right;" /> 
						<strong>Bs.</strong>   
						&nbsp;
                    	<strong style="padding-right:5px">FLETE</strong>
						<input name="txtFlete" type="text" size="1" style="text-transform:uppercase; text-align:right;" 
						 value="<?php echo $envio->flete; ?>" 
						 <?php if($envio->tipo_cobro!="" && $envio->tipo_cobro!="V") { ?> disabled <?php } ?> /> 
						<strong style="padding-right:5px">%</strong>  
						&nbsp;
                    	<strong style="padding-right:5px">PESO</strong>
						<input name="txtPeso" type="text" size="2" style="text-transform:uppercase; 
						 text-align:right;" <?php if($envio->tipo_cobro!="" && $envio->tipo_cobro!="P") { ?> disabled <?php } ?> /> 
						<strong>Kg</strong>
						&nbsp;
						<strong style="padding-right:5px">Bs/Kg</strong>
						<input name="txtBsKg" type="text" size="1"
						 style="text-align:right;" <?php if($envio->tipo_cobro!="" && $envio->tipo_cobro!="P") { ?> disabled <?php } ?> />
	                    <br /><br />
                    	<strong style="padding-right:5px">OBSERVACIONES</strong>
						<input name="txtObservaciones" type="text" size="82" style="text-transform:uppercase;" /> 
                    </p>
                    <br />
                    <hr />   
                    <p>
                    <strong style="padding-right:5px">&iquest;DESEA AGREGAR OTRO ENVIO A ESTA NOTA DE ENTREGA / FACTURA ?</strong>
                    <select name="cmbOtroEnvio">
                    	<option value=""></option>
                    	<option value="S">SI</option>
                    	<option value="N">NO</option>
                    </select> 
                    </p>           
                    <hr />
                                                   
                    <p>
                    <?php if($_GET["action"]=="Modificar") { ?>
                   	<input name="action" type="hidden" value="Modificar" />  
                    <input name="id" type="hidden" value="<?php echo $chofer->id; ?>" />                  
					<?php } else { ?>
                    <input name="action" type="hidden" value="Crear" />
                    <input name="id_cliente" type="hidden" value="<?php echo $envio->id; ?>" />
                    <input name="remesa" type="hidden" value="<?php echo $envio->remesa; ?>" />
                    <?php } ?>
                    <input class="button" value="CARGAR ENVIO" type="submit" />
                    <input class="button" value="CANCELAR" type="reset"  onClick="window.location='adm_cargar_envio.php';" />	
					</p>			
				</form>
                <?php if($_GET["action"]=="Modificar") { ?>
                <p>
                	<a href="adm_choferes.php">
                	<img align="texttop" src="images/icons/add.png" border="0" /> 
                	<strong>Agregar Chofer</strong>
                    </a>
                </p>
                <?php } ?>
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