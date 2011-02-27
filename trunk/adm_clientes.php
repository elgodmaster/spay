<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "configuracion"; ?>
<?php include("inc_functions.php"); ?>	
<?php 

	// DATA MANIPULATION
	
	if ($_POST["action"]!="" || $_GET["action"]!="") {
	
		if ($_POST["action"]=="Crear") {
			
			$cliente->rif = strtoupper($_POST["txtRIF"]);
			$cliente->nombre = strtoupper($_POST["txtNombre"]);
			$cliente->direccion = strtoupper($_POST["txtDireccion"]);
			$cliente->ciudad = strtoupper($_POST["txtCiudad"]);
			$cliente->telefono = strtoupper($_POST["txtTelefono"]);
			$cliente->id_destino = $_POST["cmbDestino"];
			$cliente->flete = $_POST["txtFlete"];
			$cliente->seguro = $_POST["cmbSeguro"];

			$action_result = agregarCliente($link, $cliente);
			$cliente=NULL;
		}
				
		if($_GET["action"]=="Modificar") {
			$cliente = obtenerCliente($link,$_GET["id"]);
		}
		
		if ($_POST["action"]=="Modificar") {

			$cliente->id = $_POST["id"];
			$cliente->rif = strtoupper($_POST["txtRIF"]);
			$cliente->nombre = strtoupper($_POST["txtNombre"]);
			$cliente->direccion = strtoupper($_POST["txtDireccion"]);
			$cliente->ciudad = strtoupper($_POST["txtCiudad"]);
			$cliente->telefono = strtoupper($_POST["txtTelefono"]);
			$cliente->id_destino = $_POST["cmbDestino"];
			$cliente->flete = $_POST["txtFlete"];
			$cliente->seguro = $_POST["cmbSeguro"];

			$action_result = modificarCliente($link, $cliente);
			$cliente=NULL;
		}
		
		if($_GET["action"]=="Eliminar") {
			$id = $_GET["id"];
			$action_result = eliminarCliente($link,$id);
		}	
			
		if($_GET["action"]=="Activar") {
			$id = $_GET["id"];
			$action_result = activarCliente($link,$id);
		}
		if($_GET["action"]=="Inactivar") {
			$id = $_GET["id"];
			$action_result = inactivarCliente($link,$id);
		}			
		
	}
	
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
					
				<h1>Administrar Clientes</h1>
									
					<?php include("inc_mensajes_crud.php"); ?>  
                    <table>
            			<tr>
                    		<td colspan="6">
                    		<form name="frmEnvio" action="adm_clientes.php" method="post" 
                    		 enctype="multipart/form-data" onSubmit="return validate_busqueda_form(this);">                   		 
                    		  	<?php if(isset($_REQUEST["txtBusqueda"]) && $_REQUEST["txtBusqueda"]!="") { ?>
                    		 	<input type="button" class="button" value="LIMPIAR BUSQUEDA" 
                    		 	 onclick="javascript:document.location.href = 'adm_clientes.php';" />
                    		 	<?php } else { ?>
                    		 	<input name="txtBusqueda" type="text" size="24" />                 		 	
                    		  	<input name="action" type="hidden" value="Buscar" />
                    		 	<input type="submit" class="button" value="BUSCAR" />
                    		 	<?php } ?>
                    		</form>
                    		</td>
                		</tr>
                	</table>         
					<table style="padding-left:10px; font-size:11px" width="850px">
            			<tr>
                    		<td colspan="11"><hr></td>
                		</tr>            	
                		<tr>
                			<td width="90"><strong>RIF</strong></td>
                			<td width="430"><strong>NOMBRE</strong></td>
                			<td width="150"><strong>USUARIO</strong></td>
                			<td width="100"><strong>ESTATUS</strong></td>
                			<td width="100"><strong>FECHA</strong></td>
                            <td width="100"><strong>ACCIONES</strong></td>
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
						$query = "SELECT c.*, u.login 
						            FROM ts_cliente c, ts_usuario u
						           WHERE c.id_usuario = u.id 
						             AND c.ind_activo < 2 "; 

						if($_REQUEST["txtBusqueda"]!="") {
							$query .= " AND  (c.nombre LIKE '%".$_REQUEST["txtBusqueda"]."%' 
							               OR c.rif LIKE '%".$_REQUEST["txtBusqueda"]."%' )";
						}						           		
						
						$query .= " ORDER BY c.nombre ";	
						
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
								<?php echo $row->rif; ?>
                    		</td> 
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<?php echo $row->nombre; ?>
                    		</td>
                    		<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<img src="images/icons/user.png" align="texttop" border="0" /> <?php echo $row->login; ?>
                    		</td>
                    		<td>
								<?php 
									if($inactiva) { 
										echo "<span style='color:#F00; font-weight:bold;'>INACTIVO</span>"; 
									} 
									else {
										echo "<span style='color:#093; font-weight:bold;'>ACTIVO</span>";
									}
								?>
                    		</td>
                    		<td align="left" <?php if($inactiva) {?> style="color:#999;" <?php } ?>> 
								<?php echo date("d-m-Y", strtotime($row->fecha_modificacion)); ?>
                  			</td>
                            <td align="left"> 
                                <a href="adm_consultar_cliente.php?&id=<?php echo $row->id; ?>&<?php echo $variables; ?>" title="Consultar">
                                	<img src="images/icons/zoom.png" align="texttop" border="0" />
                           		</a>
                            	<a href="adm_clientes.php?action=Modificar&id=<?php echo $row->id; ?>&<?php echo $variables; ?>" title="Modificar">
                                	<img align="texttop" src="images/icons/pencil.png" border="0" />
                               	</a>
                                <a href="adm_clientes.php?action=Eliminar&id=<?php echo $row->id; ?>&<?php echo $variables; ?>" title="Eliminar">
                                	<img src="images/icons/cross.png" align="texttop" border="0" 
                                     onclick="javascript:return confirm('Esta seguro que desea eliminar?');" />
                           		</a>
                               	<?php if($inactiva) { ?>                               	
                            	<a href="adm_clientes.php?action=Activar&id=<?php echo $row->id; ?>&<?php echo $variables; ?>" title="Activar">
                                	<img align="texttop" src="images/icons/bullet_green.png" border="0" />
                               	</a>
                               	<?php } else { ?>
                            	<a href="adm_clientes.php?action=Inactivar&id=<?php echo $row->id; ?>&<?php echo $variables; ?>" title="Inactivar">
                                	<img align="texttop" src="images/icons/bullet_red.png" border="0" />
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
                            <?php printPaginationNavigation($page,$lastPage, $variables); ?>
                            </td>
                        </tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr> 
                        <tr>
                        	<td colspan="6">&nbsp;</td>
                        </tr>  
                                                                                                                                
          			</table>                 
				<?php if($_GET["action"]=="Modificar") { ?>
				<h3>Modificar Cliente</h3>
				<?php } else { ?>
				<h3>Agregar Cliente</h3>
				<?php } ?>                   
				<form name="frmSP" action="adm_clientes.php" method="post" enctype="multipart/form-data" 
                 onSubmit="return validate_cliente_form(this);">	
                    <?php include("inc_mensajes.php"); ?>            	
 					<p>											
                    <strong style="padding-right:5px">RIF</strong>
					<input name="txtRIF" type="text" size="12" style="text-transform:uppercase" 
                     value="<?php echo $cliente->rif; ?>" />     	
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;                      											
                    <strong style="padding-right:5px">FLETE</strong>
					<input name="txtFlete" type="text" size="1" style="text-transform:uppercase; text-align:right;" 
                     value="<?php echo $cliente->flete; ?>" />
                     <strong style="padding-right:5px">%</strong>
                     &nbsp;											
                    <strong style="padding-right:5px">&iquest;TIENE SEGURO PROPIO?</strong>
                    <select name="cmbSeguro">
                    	<option value="N" selected>NO</option>
                    	<option value="S"
                    	 <?php if($cliente->seguro=="S") { ?> selected <?php } ?>>
                    	 SI</option>
                    </select> 
                    <br /><br />													
                    <strong style="padding-right:5px">NOMBRE O RAZON SOCIAL</strong>
					<input name="txtNombre" type="text" size="70" style="text-transform:uppercase" 
                     value="<?php echo $cliente->nombre; ?>" />  	
                    <br /><br />													
                    <strong style="padding-right:5px">DIRECCION FISCAL</strong>
					<input name="txtDireccion" type="text" size="79" maxlength="120" style="text-transform:uppercase" 
                     value="<?php echo $cliente->direccion; ?>" />   
                    <br /><br />
                    <strong style="padding-right:5px">CIUDAD</strong>
					<input name="txtCiudad" type="text" size="25" style="text-transform:uppercase" 
                     value="<?php echo $cliente->ciudad; ?>" /> 
                    &nbsp;                     	 														
                    <strong style="padding-right:5px">TELEFONOS</strong>
					<input name="txtTelefono" type="text" size="42" style="text-transform:uppercase" 
                     value="<?php echo $cliente->telefono; ?>" />
                    <br /><br />
					<strong style="padding-right:5px">DESTINO DE LOS ENVIOS</strong>
                    <select name="cmbDestino">
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
                    </p>  
                    <br />                 
                    <hr />                                                   
                    <p>
                    <?php if($_GET["action"]=="Modificar") { ?>
                   	<input name="action" type="hidden" value="Modificar" />  
                    <input name="id" type="hidden" value="<?php echo $cliente->id; ?>" />                  
					<?php } else { ?>
                    <input name="action" type="hidden" value="Crear" />
                    <input name="id_cliente" type="hidden" value="<?php echo $envio->id; ?>" />
                    <?php } ?>
                    <input class="button" value="ENVIAR" type="submit" />
                    <input class="button" value="CANCELAR" type="reset"  onClick="window.location='adm_clientes.php';" />	
					</p>			
				</form>
                <?php if($_GET["action"]=="Modificar") { ?>
                <p>
                	<a href="adm_clientes.php?<?php echo $variables; ?>">
                	<img align="texttop" src="images/icons/add.png" border="0" /> 
                	<strong>Agregar Cliente	</strong>
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