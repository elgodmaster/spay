<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "envios"; ?>
<?php include("inc_functions.php"); ?>	
<?php 

	if ($_POST["action"]!="" || $_GET["action"]!="") {
	
		if($_GET["action"]=="Modificar") {
			$envio = obtenerEnvio($link,$_GET["id"]);
			$cliente = obtenerCliente($link,$envio->id_cliente);
		}
		
		if ($_POST["action"]=="Modificar") {
			$envio->id = $_POST["id"];
			$envio->bultos = $_POST["txtBultos"];
			$envio->remesa = $_POST["txtRemesa"];
			if($_POST["txtRemesa"]=="") {
				$envio->remesa = $_POST["txtRemesaAux"];	
			}
			$envio->factura = $_POST["txtFactura"];
			$envio->flete = $_POST["txtFlete"];
			$envio->mercancia = $_POST["txtMercancia"];
			$envio->bskg = $_POST["txtBsKg"];
			$envio->peso = $_POST["txtPeso"];
			$envio->viaje = $_POST["txtViaje"];
			
			$action_result = modificarEnvio($link, $envio);
			$envio=NULL;
		}
		
		// Eliminar Envio
		if($_GET["action"]=="Eliminar") {
			$id = $_GET["id"];
			$action_result = eliminarEnvio($link,$id);
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
					
				<h1>Administrar Env&iacute;os</h1>
				
                    <table>
            			<tr>
                    		<td colspan="6">
                    		<form name="frmEnvio" action="adm_envios.php" method="post" 
                    		 enctype="multipart/form-data" onSubmit="return validate_busqueda_envio_form(this);">                  		 
                    		  	<?php if(isset($_POST["txtBusqueda"])) { ?>
                    		 	<input type="button" class="button" value="LIMPIAR BUSQUEDA" 
                    		 	 onclick="javascript:document.location.href = 'adm_envios.php';" />
                    		 	<?php } else { ?>
                    		 	<input style="height:10px" name="txtBusqueda" type="text" size="24" /> 
                    		 	&nbsp;<strong>ESTATUS</strong>&nbsp;
                    		 	<select name="cmbEstatusEnvio">
                    		 		<option value=""></option>
                    		 		<option value=1>GENERADO</option>
                    		 		<option value=2>EN RUTA</option>
                    		 		<option value=3>ENTREGADO</option>
                    		 		<option value=4>DEVUELTO</option>
                    		 		<option value=5>NO ENTREGADO</option>
                    		 	</select>
                    		 	&nbsp;
								<strong>FECHA</strong>
								&nbsp;
								<select name="cmbDiaI">
									<option value=""></option>
								<?php 
									$i=1;
									while ($i <= 31) {
								?>	
									<option value="<?php echo $i; ?>">
									<?php echo $i; ?>
									</option>
								<?php 
										$i++;
									}
								?>	
								</select>
								<select name="cmbMesI">
									<option value=""></option>
								<?php 
									$i=1;
									while ($i <= 12) {
								?>	
									<option value="<?php echo $i; ?>">
									<?php echo $i; ?>
									</option>
								<?php 
										$i++;
									}
								?>	
								</select>
								<select name="cmbAnoI">
									<option value=""></option>
								<?php 
									$i = date("Y");
									while ($i >= date("Y")-10) {
								?>	
									<option value="<?php echo $i; ?>">
									<?php echo $i; ?>
									</option>
								<?php 
										$i--;
									}
								?>	
								</select>  
								&nbsp;                  		 	
                    		  	<input name="action" type="hidden" value="Buscar" />
                    		 	<input type="submit" class="button" value="BUSCAR" />
                    		 	<?php } ?>
                    		</form>
                    		</td>
                		</tr>
                	</table>					
					<?php include("inc_mensajes_crud.php"); ?>           
					<table style="padding-left:10px; font-size:11px" width="900px">
            			<tr>
                    		<td colspan="11"><hr></td>
                		</tr>            	
                		<tr>
                			<td width="110"><strong>FECHA</strong></td>
                			<td width="300"><strong>PROVEEDOR</strong></td>
                			<td width="80" align="center"><strong>REM</strong></td>
                			<td width="80" align="center"><strong>FAC</strong></td>
                			<td width="400"><strong>CLIENTE</strong></td>
                			<td width="150"><strong>DESTINO</strong></td>
                    		<td width="130"><strong>ESTATUS</strong></td>
                            <td width="120"><strong>ACCIONES</strong></td>
                		</tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr>
                		<?php
						
						// Paginacion
						$rowsPerPage = getRowsPerPage($link);
						$page = getPage();
						$offset = ($page - 1) * $rowsPerPage;
				
						// Determino el numero de paginas 
						$query = "SELECT e.*, u.login 
						            FROM ts_envio e, ts_usuario u,
						                 ts_proveedor p, ts_cliente c,
						                 ts_destino d 
						           WHERE e.id_usuario = u.id 
						             AND e.ind_activo < 2
						             AND e.id_proveedor = p.id 
						             AND e.id_cliente = c.id 
						             AND e.id_destino = d.id "; 

						if($_POST["txtBusqueda"]!="") {
							$query .= " AND (c.nombre LIKE '%".$_POST["txtBusqueda"]."%'
										  OR p.nombre LIKE '%".$_POST["txtBusqueda"]."%' 
										  OR d.nombre LIKE '%".$_POST["txtBusqueda"]."%' 
										  OR e.remesa LIKE '%".$_POST["txtBusqueda"]."%' 
										  OR e.factura LIKE '%".$_POST["txtBusqueda"]."%'  			
										) ";
						}						           
						
						if($_POST["cmbEstatusEnvio"]!="") {
							$query .= " AND e.ind_envio=".$_POST["cmbEstatusEnvio"];
						}		

						$fechaI = $_POST["cmbAnoI"]."-".$_POST["cmbMesI"]."-".$_POST["cmbDiaI"];
						
						if($fechaI!="--") {
							$query .= " AND e.fecha_creacion='".$fechaI."' "; 
						}
						
						$query .= " ORDER BY e.fecha_creacion DESC, e.ind_envio, e.remesa, e.factura ";	
						
						$result = obtenerResultset($link,$query);

						$lastPage = ceil(numeroRegistros($result)/$rowsPerPage); 
						
						$query .= "LIMIT $offset, $rowsPerPage";
						$result = obtenerResultset($link,$query);
					
						while ($row = obtenerRegistro($result)) {
						
							$inactiva = false;
							if($row->ind_activo==0) {
								$inactiva = true;	
							}
 						?>               
          				<tr style="color: #000">
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<?php echo mostrarFecha($row->fecha_creacion); ?>
                    		</td> 
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<?php echo substr(obtenerProveedorStr($link, $row->id_proveedor),0,22); ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="center"> 
								<?php echo str_pad($row->remesa, 6, "0", STR_PAD_LEFT); ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>  align="center"> 
								<?php echo substr(str_pad($row->factura, 6, "0", STR_PAD_LEFT),0,6); ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<?php echo substr(obtenerClienteStr($link, $row->id_cliente),0,28); ?>
                    		</td> 
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<?php echo substr(obtenerDestinoStr($link, $row->id_destino),0,15); ?>
                    		</td>
                    		<td style="color:<?php echo colorIndEnvio($row->ind_envio); ?>; font-size:9px">
								<strong><?php echo indEnvioStr($link, $row->ind_envio); ?></strong>
                    		</td>
                            <td align="left">
                                <a href="adm_consultar_envio.php?id=<?php echo $row->id; ?>" title="Consultar">
                                	<img src="images/icons/zoom.png" align="texttop" border="0" />
                           		</a>
                           		<?php if($row->ind_envio==1 || $row->ind_envio>3) { ?>
                            	<a href="adm_envios.php?action=Modificar&id=<?php echo $row->id; ?>" title="Modificar">
                                	<img align="texttop" src="images/icons/pencil.png" border="0" />
                               	</a>
                                <a href="adm_envios.php?action=Eliminar&id=<?php echo $row->id; ?>" title="Eliminar">
                                	<img src="images/icons/cross.png" align="texttop" border="0" 
                                     onclick="javascript:return confirm('Esta seguro que desea eliminar?');" />
                           		</a>
                           		<?php } ?>
                           		<?php if($row->tipo_envio=="N") { ?>
                                <a href="adm_nota_de_entrega.php?id=<?php echo $row->id; ?>" title="Nota de Entrega">
                                	<img src="images/icons/page.png" align="texttop" border="0" />
                           		</a>
                           		<?php } ?>
                            </td>
            			</tr>		
						<?php } ?>
                        
                        <tr>
                        	<td colspan="6">&nbsp;</td>
                        </tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr>                        
                        <tr>
                        	<td colspan="11" align="center">
                            <?php printPaginationNavigation($page,$lastPage); ?>
                            </td>
                        </tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr> 
                        <tr>
                        	<td colspan="6">&nbsp;</td>
                        </tr>  
                                                                                                                                
          			</table>                 

				<h3>Modificar Env&iacute;o</h3>                   
				<form name="frmSP" action="adm_envios.php" method="post" enctype="multipart/form-data" 
                 onSubmit="return validate_modificar_envio_form(this);">	
                    <?php include("inc_mensajes.php"); ?>    	             
				    <?php include("inc_lists.php"); ?>               
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
                    	<select name="cmbGenerar" onChange="NotaDeEntrega(frmSP)"  disabled>
                    		<option value="">SELECCIONE...</option>
                    		<option value="N"
                    		 <?php if($envio->tipo_envio=="N") { ?> selected <?php } ?>>
                    		 NOTA DE ENTREGA</option>
                    		<option value="F" 
                    		 <?php if($envio->tipo_envio=="F") { ?> selected <?php } ?>>
                    		 FACTURA
                    		</option>
	                    </select>  
	                    &nbsp;
	                    <strong style="padding-right:5px">COBRAR POR:</strong>
                    	<select name="cmbCobrar" onChange="PesoValor(frmSP)" disabled>
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
	                    <select name="cmbProveedor" onChange="cargarFlete(frmSP)" disabled>
	                    <option value="">SELECCIONE...</option>
	                    <?php 
							$result = obtenerProveedores($link);
							while($row=mysql_fetch_object($result)) {
						?>		
							<option value="<?php echo($row->id); ?>" 
							 <?php if($envio->id_proveedor==$row->id) { ?> selected <?php } ?>>
							 <?php echo($row->nombre); ?>
	                       	</option>	
	                    <?php
							}
						?>
	                    </select>    
	                    <br />  <br />  
						<strong style="padding-right:5px">DESTINO</strong>
	                    <select name="cmbDestino" disabled>
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
						<input name="txtBultos" type="text" size="1" style="text-transform:uppercase; text-align:right;" 
						 value="<?php echo $envio->bultos; ?>" />
						&nbsp; 
                    	<strong style="padding-right:5px">REMESA</strong>
						<input name="txtRemesa" type="text" size="3" style="text-transform:uppercase; text-align:right;"
						 <?php if($envio->tipo_envio=="N") { ?> disabled <?php } ?>  
						 value="<?php echo $envio->remesa; ?>" /> 
						&nbsp;
                    	<strong style="padding-right:5px">FACTURA</strong>
						<input name="txtFactura" type="text" size="3" style="text-transform:uppercase; text-align:right;"  
						 value="<?php echo $envio->factura; ?>" />    
						&nbsp;
                    	<strong style="padding-right:5px">VALOR DEL VIAJE</strong>
						<input name="txtViaje" type="text" size="2" 
						 style="text-transform:uppercase; text-align:right;" 
						 value="<?php echo $envio->viaje; ?>" 
						 <?php if($envio->tipo_cobro!="M") { ?> disabled <?php } ?> /> 
						<strong>Bs.</strong>
						<br /><br />
                    	<strong style="padding-right:5px">VALOR MERCANCIA</strong>
						<input name="txtMercancia" type="text" size="8" 
						 style="text-transform:uppercase; text-align:right;" 
						 value="<?php echo $envio->mercancia; ?>" /> 
						<strong>Bs.</strong>   
						&nbsp;
                    	<strong style="padding-right:5px">FLETE</strong>
						<input name="txtFlete" type="text" size="1" 
						 style="text-transform:uppercase; text-align:right;" 
						 value="<?php echo $envio->flete; ?>" 
						 <?php if($envio->tipo_cobro!="V") { ?> disabled <?php } ?> /> 
						<strong style="padding-right:5px">%</strong>  
						&nbsp;
                    	<strong style="padding-right:5px">PESO</strong>
						<input name="txtPeso" type="text" size="2" 
						 style="text-transform:uppercase; text-align:right;" 
						 value="<?php echo $envio->peso; ?>" 
						 <?php if($envio->tipo_cobro!="P") { ?> disabled <?php } ?> /> 
						<strong>Kg</strong>
						&nbsp;
						<strong style="padding-right:5px">Bs/Kg</strong>
						<input name="txtBsKg" type="text" size="1"
						 style="text-align:right;" 
						 value="<?php echo $envio->bskg; ?>" 
						 <?php if($envio->tipo_cobro!="P") { ?> disabled <?php } ?> /> 
                    </p>
                    <br />
                    <hr />   
                                                   
                    <p>
                    <?php if($_GET["action"]=="Modificar") { ?>
                   	<input name="action" type="hidden" value="Modificar" />  
                    <input name="id" type="hidden" value="<?php echo $envio->id; ?>" />  
                    <input name="txtRemesaAux" type="hidden" value="<?php echo $envio->remesa; ?>" />                
					<?php } else { ?>
                    <input name="action" type="hidden" value="Crear" />
                    <input name="id_cliente" type="hidden" value="<?php echo $envio->id; ?>" />
                    <?php } ?>
                    <input class="button" value="GUARDAR CAMBIOS" type="submit" />
                    <input class="button" value="CANCELAR" type="reset"  onClick="window.location='adm_envios.php';" />	
					</p>			
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