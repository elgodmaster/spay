<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "configuracion"; ?>
<?php include("inc_functions.php"); ?>	
<?php 	
	if ($_POST["action"]=="Modificar") {
		$datos->iva = $_POST["txtIVA"];
		$datos->bskg = $_POST["txtBSKG"];
		$datos->seguro = $_POST["txtSeguro"];
		$datos->seq_nota_entrega = $_POST["txtSeqNotaEntrega"];
		$datos->seq_numero_guia = $_POST["txtSeqNumeroGuia"];
		$datos->seq_relacion = $_POST["txtSeqRelacion"];
		$datos->seq_devolucion = $_POST["txtSeqDevolucion"];
		$action_result = modificarDatosSistema($link, $datos);
	}
	
	$iva = obtenerIVA($link);
	$bskg = obtenerBSKG($link);
	$seguro = obtenerSeguro($link);
	$seq_nota_entrega = obtenerSeqNotaEntrega($link);
	$seq_numero_guia = obtenerSeqNumeroGuia($link);
	$seq_relacion = obtenerSeqRelacion($link);
	$seq_devolucion = obtenerSeqDevolucion($link);
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
				
				<h1>Datos del Sistema</h1>
				<?php include("inc_mensajes_crud.php"); ?>            

                <h3>Actualizar Datos</h3>				
				<form action="adm_datos_sistema.php" method="post" enctype="multipart/form-data" 
                 onSubmit="return validate_datos_sistema_form(this);">	
                    <p> 	
                    <?php include("inc_mensajes.php"); ?>    													
                    <strong style="padding-right:5px">IVA</strong>
					<input name="txtIVA" type="text" size="1" style="text-transform:uppercase; text-align:right;" 
                     value="<?php echo $iva; ?>" /> 									       
                    <strong style="padding-right:5px">%</strong>    
                    &nbsp;	    													
                    <strong style="padding-right:5px">Bs/Kg</strong>
					<input name="txtBSKG" type="text" size="1" style="text-transform:uppercase; text-align:right;" 
                     value="<?php echo $bskg; ?>" />    
                    &nbsp;     													
                    <strong style="padding-right:5px">Seguro</strong>
					<input name="txtSeguro" type="text" size="1" style="text-transform:uppercase; text-align:right;" 
                     value="<?php echo $seguro; ?>" /> 									       
                    <strong style="padding-right:5px">%</strong>    
                    <br /><br />      													
                    <strong style="padding-right:5px">SECUENCIA NOTA DE ENTREGA</strong>
					<input name="txtSeqNotaEntrega" type="text" size="1" style="text-transform:uppercase; text-align:right;" 
                     value="<?php echo $seq_nota_entrega; ?>" />    
                    <br /><br />       													
                    <strong style="padding-right:5px">SECUENCIA N&deg; GUIA</strong>
					<input name="txtSeqNumeroGuia" type="text" size="1" style="text-transform:uppercase; text-align:right;" 
                     value="<?php echo $seq_numero_guia; ?>" />   
                    <br /><br />      													
                    <strong style="padding-right:5px">SECUENCIA N&deg; RELACION</strong>
					<input name="txtSeqRelacion" type="text" size="1" style="text-transform:uppercase; text-align:right;" 
                     value="<?php echo $seq_relacion; ?>" />    
                    <br /><br /> 	    													
                    <strong style="padding-right:5px">SECUENCIA N&deg; DEVOLUCION</strong>
					<input name="txtSeqDevolucion" type="text" size="1" style="text-transform:uppercase; text-align:right;" 
                     value="<?php echo $seq_devolucion; ?>" />    
                    <br /><br />               
                    </p>                                  
                    <br />                 
                    <hr />
                    <p> 
                   	<input name="action" type="hidden" value="Modificar" />                 
                    <input class="button" value="GUARDAR CAMBIOS" type="submit" />
                    <input class="button" value="CANCELAR" type="reset"  onClick="window.location='adm_datos_sistema.php';" />	
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