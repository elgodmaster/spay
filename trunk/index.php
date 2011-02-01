<?php include("inc_redirect.php"); ?>
<?php include("inc_session.php"); ?>
<?php 
	if($_SESSION["id_usuario"]!="") { 
		redirect("admin.php");
	}
?>
<?php include("inc_functions.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php include("inc_metadata.php"); ?>
<body>
<!-- wrap starts here --><?php include("inc_header.php"); ?>
<div id="wrap"> 
	
	<!-- content-wrap starts here -->	
	<div id="content-wrap" align="center">  
		   <br />
           <div id="login-form" align="center">
				<h2>ENTRAR AL SISTEMA</h2>
                <div align="left" style="padding-left:15px"> 
				<form action="db_login.php" method="post" onSubmit="return validate_login_form(this);">	
                    <p>          
                    <label id="mensError" style ="color:#F00; background-color:#FFC6C6; border-color:#F00;">
                    	<?php 
							if($_GET["message"]=='usuarioInvalido') {
								echo "<img align='texttop' src='images/icons/cancel.png' border='0'  /> USUARIO INVALIDO!";	
							}
							if($_GET["message"]=='passwordIncorrecto') {
								echo "<img align='texttop' src='images/icons/cancel.png' border='0'  /> PASSWORD INCORRECTO!";	
							}
							if($_GET["message"]=='usuarioInactivo') {
								echo "<img align='texttop' src='images/icons/cancel.png' border='0'  /> USUARIO INACTIVO."; 
								echo "<br />POR FAVOR CONTACTE AL ADMINISTRADOR.";	
							}								
						?>
                    </label> 									
                    <label>LOGIN</label>
					<input name="txtLogin" type="text" size="46" />
					<label>PASSWORD</label>
					<input name="txtPassword" type="password" size="46" />
                    <input name"action" type="hidden" value="Login" />
                    <br />
                    <br />
                    <span style="padding-left:40px">&nbsp;</span>
                    <input class="button" value="ENTRAR AL SISTEMA" type="submit" />
                    <input class="button" value="CANCELAR" type="reset"  onClick="cleanMensajes()" />
                    </p>			
				</form>				
				<br />	
            </div>
		</div>			
	<!-- content-wrap ends here -->	
	</div>
<!-- wrap ends here -->
</div>		
<?php include("inc_footer.php"); ?>
</body>
</html>