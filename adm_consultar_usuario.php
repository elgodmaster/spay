<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "configuracion"; ?>
<?php include("inc_functions.php"); ?>	
<?php 
	$usuario = obtenerUsuario($link, $_GET["id"]);
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
				
				<h1>Consultar Usuario</h1>
				<div align="right">
				<a href="adm_usuarios.php" class="orange"><strong><< Regresar</strong></a>
				</div>	          
                    <p>                 
					<?php include("inc_mensajes.php"); ?>									
					<label>LOGIN</label>
					<input name="txtLogin" type="text" size="60" value="<?php echo $usuario->login; ?>" disabled />
					<label>PASSWORD</label>
					<input name="txtPassword" type="password" size="60" value="<?php echo $usuario->password; ?>"  disabled />                  
					<label>CONFIRMAR PASSWORD</label>
					<input name="txtPasswordConfirm" type="password" size="60" value="<?php echo $usuario->password; ?>" disabled /> 										
                    <label>NOMBRE DEL USUARIO</label>
					<input name="txtNombre" type="text" size="60" value="<?php echo $usuario->nombre; ?>" disabled />
                    <label>EMAIL</label>
					<input name="txtEmail" type="text" size="60" value="<?php echo $usuario->email; ?>" disabled /> 
                    <br /><br />                    		           
                	<hr />
	                <p>
	                	<strong style="padding-right:5px">ESTATUS</strong>
	                    <span style="color:<?php echo colorIndEstatus($usuario->ind_activo); ?>; font-weight:bold">
						<?php echo indEstatusStr($link,$usuario->ind_activo); ?>
	                    </span>       
	                    &nbsp;
	                    <strong style="padding-right:5px">USUARIO DESDE</strong>
						<input name="txtTelefono" type="text" size="8" style="text-transform:uppercase" 
	                     value="<?php echo mostrarFecha($usuario->fecha_creacion); ?>" disabled />
	                             
	                </p>                                  
	                <br />
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