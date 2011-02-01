<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "guias"; ?>
<?php include("inc_functions.php"); ?>	
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
				
				<h1>Actualizar Env&iacute;o</h1>
                <p>
                <?php include("inc_mensajes_crud.php"); ?>
                </p>              			
				<form action="adm_consultar_guia.php?id=<?php echo $_GET["id_guia"]; ?>" 
				 method="post" enctype="multipart/form-data">	
                    <p>
                	<?php include("inc_mensajes.php"); ?>
                	<?php 
                		if($_GET["action"]=="MarcarEnvioEntregado") {
                			$valor = "AGREGUE AQUI OBSERVACIONES SOBRE EL ENVIO";
                		}
                		else {
                			$valor = "INDIQUE EL MOTIVO POR EL CUAL EL ENVIO FUE DEVUELTO / NO ENTREGADO";
                		}
                	?> 									
					<label><?php echo $valor; ?></label>
					<input name="txtMotivo" type="text" size="95"  style="text-transform:uppercase" />                                   
                    </p>                                  
                    <br />                 
                    <hr />
                    <p> 
                   	<input name="action" type="hidden" value="<?php echo $_GET["action"]; ?>" />  
                    <input name="id_envio" type="hidden" value="<?php echo $_GET["id"]; ?>" />                 
                    <input class="button" value="ENVIAR" type="submit" />
                    <input class="button" value="CANCELAR" type="reset" />	
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