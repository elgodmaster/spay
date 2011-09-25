<?php include("inc_redirect.php"); ?>
<?php	
	include("inc_conectarse.php");
	
	session_start();
	
	$login = $_POST["txtLogin"];
	$password = $_POST["txtPassword"];
	
	$query = "SELECT * FROM ts_usuario WHERE login = '".$login."' AND ind_activo < 2 ";
	
	$result = mysql_query($query, $link);
	
	while($row=mysql_fetch_object($result)) { 
		
		// Password Incorrecto.
		if (!($row->password == $password)) {
			redirect("index.php?message=passwordIncorrecto");
		}
		
		if($row->ind_activo==0) {
			redirect("index.php?message=usuarioInactivo");		
		}
			
		// Usuario Validado Exitosamente
		$_SESSION["login"] = $login;
		$_SESSION["nombre"] = $row->nombre;
		$_SESSION["ind_admin"] = $row->ind_admin;
		$_SESSION["id_usuario"] = $row->id;
		$_SESSION["id_empresa"] = $row->id_empresa;
		
		$query = "UPDATE ts_usuario SET fecha_ultimo_login=CURDATE() WHERE id=".$row->id;
		$result = mysql_query($query, $link);
		
		redirect("admin.php");
	}
	
	// El Usuario no existe.
	redirect("index.php?message=usuarioInvalido");		
?>