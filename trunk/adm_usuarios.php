<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "configuracion"; ?>
<?php include("inc_functions.php"); ?>	
<?php 

	// DATA MANIPULATION
	
	if ($_POST["action"]!="" || $_GET["action"]!="") {
	
		// Agregar Usuario
		if ($_POST["action"]=="Crear") {
			
			$login = $_POST["txtLogin"];
			$password = $_POST["txtPassword"];
			$nombre = $_POST["txtNombre"];
			$email = $_POST["txtEmail"];
			$ind_activo = $_POST["cmbEstatus"];
			$id_usuario = $_SESSION["id_usuario"];
			
			$action_result = agregarUsuario($link, $login, $password, $nombre, $email, $ind_activo, $id_usuario);
		}
		
		// Cargar Datos para Modificar Usuario
		if($_GET["action"]=="Modificar") {
			$id = $_GET["id"];
			$usuario = obtenerUsuario($link, $id);
		}
		
		// Modificar Usuario
		if ($_POST["action"]=="Modificar") {
			
			$id = $_POST["id"];
			$login = $_POST["txtLogin"];
			$password = $_POST["txtPassword"];
			$nombre = $_POST["txtNombre"];
			$email = $_POST["txtEmail"];
			$ind_activo = $_POST["cmbEstatus"];
			if($ind_activo=="") {
				$ind_activo = $_POST["txtEstatus"];
			}
			$id_usuario = $_SESSION["id_usuario"];
			
			$action_result = modificarUsuario($link, $id, $password, $nombre, $email, $ind_activo, $id_usuario);
		}
		
		// Eliminar Usuario
		if($_GET["action"]=="Eliminar") {
			$id = $_GET["id"];
			$action_result = eliminarUsuario($link,$id);
		}	
			
		if($_GET["action"]=="Activar") {
			$id = $_GET["id"];
			$action_result = activarUsuario($link,$id);
		}
		if($_GET["action"]=="Inactivar") {
			$id = $_GET["id"];
			$action_result = inactivarUsuario($link,$id);
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
				
				<h1>Administrar Usuarios</h1>
				<?php include("inc_mensajes_crud.php"); ?>              
                <h3>Usuarios Existentes</h3>
                
					<table style="padding-left:10px; font-size:11px" width="100%">
            			<tr>
                    		<td colspan="7"><hr></td>
                		</tr>            	
                		<tr>
                			<td width="250"><strong>LOGIN</strong></td>
                    		<td width="250"><strong>NOMBRE</strong></td>
                    		<td width="250"><strong>CREADO POR</strong></td>
                    		<td width="100"><strong>ESTATUS</strong></td>
                            <td width="100"><strong>ACCIONES</strong></td>
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
						$query = "SELECT u1.id, u1.fecha_modificacion, u1.nombre, u2.login as usuario,
						                 u1.ind_activo, u1.login, u1.fecha_ultimo_login 
						           	FROM ts_usuario u1 LEFT JOIN ts_usuario u2
						           	  ON u1.id_usuario  = u2.id 
						           WHERE u1.ind_activo < 2 
						        ORDER BY u1.login ";

						$result = mysql_query($query,$link);
						
						$lastPage = ceil(mysql_num_rows($result)/$rowsPerPage); 
						
						$query .= "LIMIT $offset, $rowsPerPage";
						$result = mysql_query($query,$link);
					
						while ($row = mysql_fetch_object($result)) {
						
							$inactiva = false;
							if($row->ind_activo==0) {
								$inactiva = true;	
							}
 						?>               
          				<tr style="color: #000">
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<?php echo $row->login; ?>
                    		</td>
                    		<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<?php echo $row->nombre; ?>
                    		</td>
                    		<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<?php if($row->usuario!="") { ?>
                                <img src="images/icons/user.png" align="texttop" border="0" /> <?php echo $row->usuario; ?>
                                <?php } ?>
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
                            <td align="left">
                                <?php if($row->id!=$_SESSION["id_usuario"]) { ?> 
                                <a href="adm_consultar_usuario.php?id=<?php echo $row->id; ?>" title="Consultar">
                                	<img src="images/icons/zoom.png" align="texttop" border="0" />
                           		</a>
                                <?php if($row->id!=1) { ?>
                            	<a href="adm_usuarios.php?action=Modificar&id=<?php echo $row->id; ?>" title="Modificar">
                                	<img align="texttop" src="images/icons/pencil.png" border="0" />
                               	</a>
                                <a href="adm_usuarios.php?action=Eliminar&id=<?php echo $row->id; ?>" title="Eliminar">
                                	<img src="images/icons/cross.png" align="texttop" border="0" 
                                     onclick="javascript:return confirm('Esta seguro que desea eliminar?');" />
                           		</a>
                               	<?php if($inactiva) { ?>                               	
                            	<a href="adm_usuarios.php?action=Activar&id=<?php echo $row->id; ?>" title="Activar">
                                	<img align="texttop" src="images/icons/bullet_green.png" border="0" />
                               	</a>
                               	<?php } else { ?>
                            	<a href="adm_usuarios.php?action=Inactivar&id=<?php echo $row->id; ?>" title="Inactivar">
                                	<img align="texttop" src="images/icons/bullet_red.png" border="0" />
                               	</a>  
                               	<?php } ?>
                                <?php } ?>
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
                	<h3>Crear Usuario</h3>				
				<?php
				}
				else {
				?>	
					<h3>Modificar Usuario</h3>                   
                <?php 
				}
				?>
				<form action="adm_usuarios.php" method="post" enctype="multipart/form-data" 
                 onSubmit="return validate_usuario_form(this);">	
                    <p>                 
					<?php include("inc_mensajes.php"); ?>									
					<label>LOGIN</label>
					<input name="txtLogin" type="text" size="60" value="<?php echo $usuario->login; ?>" 
                    <?php if($_GET["action"]=="Modificar") { ?> disabled="disabled" <?php } ?> />
					<label>PASSWORD</label>
					<input name="txtPassword" type="password" size="60" value="<?php echo $usuario->password; ?>" />                  
					<label>CONFIRMAR PASSWORD</label>
					<input name="txtPasswordConfirm" type="password" size="60" value="<?php echo $usuario->password; ?>" /> 										
                    <label>NOMBRE DEL USUARIO</label>
					<input name="txtNombre" type="text" size="60" value="<?php echo $usuario->nombre; ?>" />
                    <label>EMAIL</label>
					<input name="txtEmail" type="text" size="60" value="<?php echo $usuario->email; ?>" /> 
                    <label>ESTATUS</label>
                    <select name="cmbEstatus" <?php if($id==$_SESSION["id_usuario"]) { ?> disabled="disabled" <?php } ?>>
                    <?php 
					
						$result = obtenerIndActivo($link);
						while($row=obtenerRegistro($result)) {
					?>		
						<option value="<?php echo($row->codigo); ?>" 
						 <?php if($usuario->ind_activo==$row->codigo) { ?> selected <?php } ?>>
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
                    <input name="id" type="hidden" value="<?php echo $id; ?>" /> 
                    <input name="txtEstatus" type="hidden" value="<?php echo $usuario->ind_activo; ?>" />                 
					<?php } else { ?>
                    <input name="action" type="hidden" value="Crear" />
                    <?php } ?>
                    <input class="button" value="ENVIAR" type="submit" />
                    <input class="button" value="CANCELAR" type="reset"  onClick="window.location='adm_usuarios.php';" />	
					</p>			
				</form>
                <?php if($_GET["action"]=="Modificar") { ?>
                <p>
                	<a href="adm_usuarios.php">
                	<img align="texttop" src="images/icons/add.png" border="0" /> 
                	<strong>Crear Usuario</strong>
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