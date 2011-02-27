<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "configuracion"; ?>
<?php include("inc_functions.php"); ?>	
<?php 

	// DATA MANIPULATION
	
	if ($_POST["action"]!="" || $_GET["action"]!="") {
	
		// Agregar Estado
		if ($_POST["action"]=="Crear") {
			$nombre = strtoupper($_POST["txtNombre"]);
			$id_region = $_POST["cmbRegion"];
			$ind_activo = $_POST["cmbEstatus"];
			$action_result = agregarEstado($link, $id_region, $nombre, $ind_activo);
		}
		
		// Cargar Datos para Modificar Estado
		if($_GET["action"]=="Modificar") {
			$estado = obtenerEstado($link, $_GET["id"]);
		}
		
		// Modificar Estado
		if ($_POST["action"]=="Modificar") {
			$id = $_POST["id"];
			$nombre = strtoupper($_POST["txtNombre"]);
			$id_region = $_POST["cmbRegion"];
			$ind_activo = $_POST["cmbEstatus"];
			$action_result = modificarEstado($link, $id, $id_region, $nombre, $ind_activo);
		}
		
		// Eliminar Estado
		if($_GET["action"]=="Eliminar") {
			$id = $_GET["id"];
			$action_result = eliminarEstado($link,$id);
		}	
			
		if($_GET["action"]=="Activar") {
			$id = $_GET["id"];
			$action_result = activarEstado($link,$id);
		}
		if($_GET["action"]=="Inactivar") {
			$id = $_GET["id"];
			$action_result = inactivarEstado($link,$id);
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
					
				<h1>Administrar Destinos</h1>
				<div align="right">
				<a href="adm_regiones.php"><strong>Regiones</strong></a> | 
				<span class="orange"><strong>Estados</strong></span> | 
				<a href="adm_destinos.php"><strong>Destinos</strong></a>
				</div>
				<?php include("inc_mensajes_crud.php"); ?>           
                <h3>Estados Existentes</h3>
                
					<table style="padding-left:10px; font-size:11px" width="100%">
            			<tr>
                    		<td colspan="6"><hr></td>
                		</tr>            	
                		<tr>
                			<td width="150"><strong>NOMBRE</strong></td>
                			<td width="150"><strong>REGION</strong></td>
                    		<td width="250"><strong>USUARIO</strong></td>
                    		<td width="120" align="center"><strong>FECHA</strong></td>
                    		<td width="100"><strong>ESTATUS</strong></td>
                            <td><strong>ACCIONES</strong></td>
                		</tr>
            			<tr>
                    		<td class="text" colspan="6"><hr></td>
                		</tr>
                		<?php
						
						// Paginacion
						$rowsPerPage = getRowsPerPage($link);
						$page = getPage();
						$offset = ($page - 1) * $rowsPerPage;
				
						// Determino el numero de paginas 
						$query = "SELECT e.id, e.nombre, e.fecha_modificacion,
						                 e.ind_activo, e.id_region, u.login 
						            FROM ts_estado e JOIN ts_usuario u 
						              ON e.id_usuario = u.id 
						           WHERE e.ind_activo < 2 
						        ORDER BY e.nombre ";	
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
								<?php echo obtenerRegionStr($link, $row->id_region); ?>
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
                            	<a href="adm_estados.php?action=Modificar&id=<?php echo $row->id; ?>&page=<?php echo $_GET["page"]?>" title="Modificar">
                                	<img align="texttop" src="images/icons/pencil.png" border="0" />
                               	</a>
                                <a href="adm_estados.php?action=Eliminar&id=<?php echo $row->id; ?>&page=<?php echo $_GET["page"]?>" title="Eliminar">
                                	<img src="images/icons/cross.png" align="texttop" border="0" 
                                     onclick="javascript:return confirm('Esta seguro que desea eliminar?');" />
                           		</a>
                               	<?php if($inactiva) { ?>                               	
                            	<a href="adm_estados.php?action=Activar&id=<?php echo $row->id; ?>&page=<?php echo $_GET["page"]?>" title="Activar">
                                	<img align="texttop" src="images/icons/bullet_green.png" border="0" />
                               	</a>
                               	<?php } else { ?>
                            	<a href="adm_estados.php?action=Inactivar&id=<?php echo $row->id; ?>&page=<?php echo $_GET["page"]?>" title="Inactivar">
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
                    		<td class="text" colspan="6"><hr></td>
                		</tr>                        
                        <tr>
                        	<td colspan="6" align="center">
                            <?php printPaginationNavigation($page,$lastPage); ?>
                            </td>
                        </tr>
            			<tr>
                    		<td class="text" colspan="6"><hr></td>
                		</tr> 
                        <tr>
                        	<td colspan="6">&nbsp;</td>
                        </tr>  
                                                                                                                                
          			</table>                 
				<?php 
				if($_GET["action"]!="Modificar") {
				?>	
                	<h3>Agregar Estado</h3>				
				<?php
				}
				else {
				?>	
					<h3>Modificar Estado</h3>                   
                <?php 
				}
				?>
				<form action="adm_estados.php" method="post" enctype="multipart/form-data" 
                 onSubmit="return validate_estado_form(this);">	
                    <p>                 
 					<?php include("inc_mensajes.php"); ?>                  
					<label>REGION</label>
                    <select name="cmbRegion">
                    <option value="">SELECCIONE...</option>
                    <?php 
						$result = obtenerRegiones($link);
						while($row=mysql_fetch_object($result)) {
					?>		
						<option value="<?php echo($row->id); ?>" 
						 <?php if($estado->id_region==$row->id) { ?> selected <?php } ?>>
						 <?php echo($row->nombre); ?>
                       	</option>	
                    <?php
						}
					?>
                    </select>   														
                    <label>NOMBRE</label>
					<input name="txtNombre" type="text" size="60" style="text-transform:uppercase" 
                     value="<?php echo $estado->nombre; ?>" />                  
					<label>ESTATUS</label>
                    <select name="cmbEstatus">
                    <?php 
						$result = obtenerIndActivo($link);
						while($row=mysql_fetch_object($result)) {
					?>		
						<option value="<?php echo($row->codigo); ?>" 
						 <?php if($estado->ind_activo==$row->codigo) { ?> selected <?php } ?>>
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
                    <input name="id" type="hidden" value="<?php echo $estado->id; ?>" />                  
					<?php } else { ?>
                    <input name="action" type="hidden" value="Crear" />
                    <?php } ?>
                    <input class="button" value="ENVIAR" type="submit" />
                    <input class="button" value="CANCELAR" type="reset"  onClick="window.location='adm_estados.php';" />	
					</p>			
				</form>
                <?php if($_GET["action"]=="Modificar") { ?>
                <p>
                	<a href="adm_estados.php?page=<?php echo $_GET["page"]?>">
                	<img align="texttop" src="images/icons/add.png" border="0" /> 
                	<strong>Agregar Estado</strong>
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