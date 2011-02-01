<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "configuracion"; ?>
<?php include("inc_functions.php"); ?>	
<?php 

	// DATA MANIPULATION
	
	if ($_POST["action"]!="" || $_GET["action"]!="") {
	
		// Agregar Chofer
		if ($_POST["action"]=="Crear") {
			$nombre = strtoupper($_POST["txtNombre"]);
			$cedula = $_POST["txtCedula"];
			$telefono = $_POST["txtTelefono"];
			$placa = strtoupper($_POST["txtPlaca"]);
			$direccion = strtoupper($_POST["txtDireccion"]);
			$ind_activo = $_POST["cmbEstatus"];
			$action_result = agregarChofer($link, $nombre, $cedula, $telefono, 
			                               $placa, $direccion, $ind_activo);
		}
		
		// Cargar Datos para Modificar Chofer
		if($_GET["action"]=="Modificar") {
			$chofer = obtenerChofer($link, $_GET["id"]);
		}
		
		// Modificar Chofer
		if ($_POST["action"]=="Modificar") {
			$id = $_POST["id"];
			$nombre = strtoupper($_POST["txtNombre"]);
			$cedula = $_POST["txtCedula"];
			$telefono = $_POST["txtTelefono"];
			$placa = strtoupper($_POST["txtPlaca"]);
			$direccion = strtoupper($_POST["txtDireccion"]);
			$ind_activo = $_POST["cmbEstatus"];
			$action_result = modificarChofer($link, $id, $nombre, $cedula, $telefono, 
			                                 $placa, $direccion, $ind_activo);
		}
		
		// Eliminar Chofer
		if($_GET["action"]=="Eliminar") {
			$id = $_GET["id"];
			$action_result = eliminarChofer($link,$id);
		}	
			
		if($_GET["action"]=="Activar") {
			$id = $_GET["id"];
			$action_result = activarChofer($link,$id);
		}
		if($_GET["action"]=="Inactivar") {
			$id = $_GET["id"];
			$action_result = inactivarChofer($link,$id);
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
					
				<h1>Administrar Choferes</h1>
				<?php include("inc_mensajes_crud.php"); ?>           
                <h3>Choferes Existentes</h3>
                
					<table style="padding-left:10px; font-size:11px" width="850px">
            			<tr>
                    		<td colspan="7"><hr></td>
                		</tr>            	
                		<tr>
                			<td width="300"><strong>NOMBRE</strong></td>
                			<td width="100"><strong>PLACA</strong></td>
                			<td width="320"><strong>TELEFONOS</strong></td>
                    		<td width="100"><strong>USUARIO</strong></td>
                    		<td width="150" align="center"><strong>FECHA</strong></td>
                    		<td width="100"><strong>ESTATUS</strong></td>
                            <td width="100"><strong>ACCIONES</strong></td>
                		</tr>
            			<tr>
                    		<td class="text" colspan="7"><hr></td>
                		</tr>
                		<?php
						
						// Paginacion
						$rowsPerPage = getRowsPerPage($link);
						$page = getPage();
						$offset = ($page - 1) * $rowsPerPage;
				
						// Determino el numero de paginas 
						$query = "SELECT c.*, u.login 
						            FROM ts_chofer c JOIN ts_usuario u 
						              ON c.id_usuario = u.id 
						           WHERE c.ind_activo < 2 
						        ORDER BY c.nombre ";	
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
								<?php echo $row->nombre; ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<?php echo $row->placa; ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<?php echo $row->telefono; ?>
                    		</td>
                    		<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<img src="images/icons/user.png" align="texttop" border="0" /> <?php echo $row->login; ?>
                    		</td>
                    		<td align="center" <?php if($inactiva) {?> style="color:#999;" <?php } ?>> 
								<?php echo date("d-m-Y", strtotime($row->fecha_modificacion)); ?>
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
                            <td align="center"> 
                                <a href="adm_consultar_chofer.php?id=<?php echo $row->id; ?>" title="Consultar">
                                	<img src="images/icons/zoom.png" align="texttop" border="0" />
                           		</a>
                            	<a href="adm_choferes.php?action=Modificar&id=<?php echo $row->id; ?>" title="Modificar">
                                	<img align="texttop" src="images/icons/pencil.png" border="0" />
                               	</a>
                                <a href="adm_choferes.php?action=Eliminar&id=<?php echo $row->id; ?>" title="Eliminar">
                                	<img src="images/icons/cross.png" align="texttop" border="0" 
                                     onclick="javascript:return confirm('Esta seguro que desea eliminar?');" />
                           		</a>
                               	<?php if($inactiva) { ?>                               	
                            	<a href="adm_choferes.php?action=Activar&id=<?php echo $row->id; ?>" title="Activar">
                                	<img align="texttop" src="images/icons/bullet_green.png" border="0" />
                               	</a>
                               	<?php } else { ?>
                            	<a href="adm_choferes.php?action=Inactivar&id=<?php echo $row->id; ?>" title="Inactivar">
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
                    		<td class="text" colspan="7"><hr></td>
                		</tr>                        
                        <tr>
                        	<td colspan="7" align="center">
                            <?php printPaginationNavigation($page,$lastPage); ?>
                            </td>
                        </tr>
            			<tr>
                    		<td class="text" colspan="7"><hr></td>
                		</tr> 
                        <tr>
                        	<td colspan="6">&nbsp;</td>
                        </tr>  
                                                                                                                                
          			</table>                 
				<?php 
				if($_GET["action"]!="Modificar") {
				?>	
                	<h3>Agregar Chofer</h3>				
				<?php
				}
				else {
				?>	
					<h3>Modificar Chofer</h3>                   
                <?php 
				}
				?>
				<form action="adm_choferes.php" method="post" enctype="multipart/form-data" 
                 onSubmit="return validate_chofer_form(this);">	
                    <p>                 
 					<?php include("inc_mensajes.php"); ?>														
                    <label>NOMBRE</label>
					<input name="txtNombre" type="text" size="60" style="text-transform:uppercase" 
                     value="<?php echo $chofer->nombre; ?>" />     														
                    <label>CEDULA DE IDENTIDAD</label>
					<input name="txtCedula" type="text" size="8" style="text-transform:uppercase" 
                     value="<?php echo $chofer->cedula; ?>" />														
                    <label>TELEFONOS</label>
					<input name="txtTelefono" type="text" size="40" style="text-transform:uppercase" 
                     value="<?php echo $chofer->telefono; ?>" />														
                    <label>PLACA CAMION</label>
					<input name="txtPlaca" type="text" size="8" style="text-transform:uppercase" 
                     value="<?php echo $chofer->placa; ?>" />  														
                    <label>DIRECCION</label>
					<input name="txtDireccion" type="text" size="100" style="text-transform:uppercase" 
                     value="<?php echo $chofer->direccion; ?>" />                  
					<label>ESTATUS</label>
                    <select name="cmbEstatus">
                    <?php 
						$result = obtenerIndActivo($link);
						while($row=mysql_fetch_object($result)) {
					?>		
						<option value="<?php echo($row->codigo); ?>" 
						 <?php if($chofer->ind_activo==$row->codigo) { ?> selected <?php } ?>>
						 <?php echo($row->valor); ?>
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
                    <input name="id" type="hidden" value="<?php echo $chofer->id; ?>" />                  
					<?php } else { ?>
                    <input name="action" type="hidden" value="Crear" />
                    <?php } ?>
                    <input class="button" value="ENVIAR" type="submit" />
                    <input class="button" value="CANCELAR" type="reset"  onClick="window.location='adm_choferes.php';" />	
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