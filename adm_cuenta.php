<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "configuracion"; ?>
<?php include("inc_functions.php"); ?>	
<?php 	
	// Modificar Usuario
	if ($_POST["action"]=="Modificar") {
		
		$id = $_SESSION["id_usuario"];
		$login = $_POST["txtLogin"];
		$password = $_POST["txtPassword"];
		$nombre = $_POST["txtNombre"];
		$email = $_POST["txtEmail"];
		$ind_activo = $_POST["txtEstatus"];
		$id_usuario = $_SESSION["id_usuario"];
	
		$action_result = modificarUsuario($link, $id, $password, $nombre, $email, 1, $id_usuario);
	}

	// Cargo Datos del Usuario Actual
	$id = $_SESSION["id_usuario"];
	$usuario = obtenerUsuario($link,$id);
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
				
				<h1>Datos de Usuario</h1>
                <p>
                <label id="mensCRUD" style="color: #063; background-color:#DCFCDA;">
        
                <?php 	
				// Manejo de mensajes de operaciones
				
				// Usuarios					
				if($action_result=="exitoModificarUsuario") {
					echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Datos actualizados exitosamente.";
				}					
				?>
                </label>
                </p>              

                <h3>Actualizar Datos</h3>				
				<form action="adm_cuenta.php" method="post" enctype="multipart/form-data" 
                 onsubmit="return validate_usuario_form(this);">	
                    <p>                 
                    <label id="mensError" style ="color:#F00; background-color:#FFC6C6; border-color:#F00;">
                    </label> 									
					<label>LOGIN</label>
					<input name="txtLogin" type="text" size="60" value="<?php echo $usuario->login; ?>" disabled="disabled" />
					<label>PASSWORD</label>
					<input name="txtPassword" type="password" size="60" value="<?php echo $usuario->password; ?>" />                  
					<label>CONFIRMAR PASSWORD</label>
					<input name="txtPasswordConfirm" type="password" size="60" value="<?php echo $usuario->password; ?>" /> 										
                    <label>NOMBRE DEL USUARIO</label>
					<input name="txtNombre" type="text" size="60" value="<?php echo $usuario->nombre; ?>" />
                    <label>EMAIL</label>
					<input name="txtEmail" type="text" size="60" value="<?php echo $usuario->email; ?>" /> 
                    <label>ESTATUS</label>
                    <select name="cmbEstatus" disabled="disabled">
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
                    <br />                                       
                    </p>              
                    <hr />
                    <p> 
                   	<input name="action" type="hidden" value="Modificar" />  
                    <input name="id" type="hidden" value="<?php echo $_SESSION["id_usuario"]; ?>" />                 
                    <input class="button" value="ENVIAR" type="submit" />
                    <input class="button" value="CANCELAR" type="reset"  onclick="window.location='adm_cuenta.php';" />	
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