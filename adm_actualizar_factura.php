<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "facturas"; ?>
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
				
				<h1>Actualizar Factura</h1>
                <p>
                <?php include("inc_mensajes_crud.php"); ?>
                </p>          
                <?php if($_GET["action"]=="MarcarCobrada") { ?>    			
				<form name="frmSP" action="adm_facturas.php?id=<?php echo $_GET["id"]; ?>&page=<?php echo $_GET["page"]; ?>" 
				 method="post" enctype="multipart/form-data" 
                 onsubmit="return validate_factura_cobrada_form(this);">	
                    <p>
                	<?php include("inc_mensajes.php"); ?>
                	<br />
                	<strong>FORMA DE PAGO</strong>
                	<select name="cmbFormaPago" onchange="validarFormaPago(frmSP);">
                		<option value="">SELECCIONE...</option>
                		<option value="EFECTIVO">EFECTIVO</option>	
                		<option value="CHEQUE">CHEQUE</option>
                		<option value="TARJETA DE CREDITO">TARJETA DE CREDITO</option>
                		<option value="TARJETA DE DEBITO">TARJETA DE DEBITO</option>
                		<option value="TRANSFERENCIA ELECTRONICA">TRANSFERENCIA ELECTRONICA</option>
                	</select> 
                	&nbsp;
					<strong>PAGADO EN FECHA</strong>
					&nbsp;
					<select name="cmbDiaI">
						<option value=""></option>
					<?php 
						$i=1;
						while ($i <= 31) {
					?>	
						<option value="<?php echo $i; ?>">
						<?php echo $i; ?>
						</option>
					<?php 
							$i++;
						}
					?>	
					</select>
					<select name="cmbMesI">
						<option value=""></option>
					<?php 
						$i=1;
						while ($i <= 12) {
					?>	
						<option value="<?php echo $i; ?>">
						<?php echo $i; ?>
						</option>
					<?php 
							$i++;
						}
					?>	
					</select>
					<select name="cmbAnoI">
						<option value=""></option>
					<?php 
						$i = date("Y");
						while ($i >= date("Y")-10) {
					?>	
						<option value="<?php echo $i; ?>">
						<?php echo $i; ?>
						</option>
					<?php 
							$i--;
						}
					?>	
					</select>                             
                    <br />                             
                    <br />        
                	<strong style="padding-right:5px">N&deg;</strong>               	
					<input name="txtNumero" type="text" size="37"  style="text-transform:uppercase; text-align:right;" /> 
					&nbsp;
					<strong style="padding-right:5px">BANCO</strong>
					<input name="txtBanco" type="text" size="40"  style="text-transform:uppercase" />                              
                    <br />                             
                    <br />        
                	<strong style="padding-right:5px">OBSERVACIONES</strong>               	
					<input name="txtObservaciones" type="text" size="80"  style="text-transform:uppercase;" />       
                    <br />                                              
                    </p>               
                    <hr />
                    <p> 
                   	<input name="action" type="hidden" value="<?php echo $_GET["action"]; ?>" />  
                    <input name="id" type="hidden" value="<?php echo $_GET["id"]; ?>" />                 
                    <input class="button" value="ENVIAR" type="submit" />
                    <input class="button" value="CANCELAR" type="reset"  onClick="window.location='adm_actualizar_envio.php';" />	
					</p>			
				</form>
				<?php } ?>
                <?php if($_GET["action"]=="Anular") { ?>    			
				<form name="anular" action="adm_facturas.php?id=<?php echo $_GET["id"]; ?>&page=<?php echo $_GET["page"]; ?>" 
				 method="post" enctype="multipart/form-data" 
                 onSubmit="return validate_factura_anulada_form(anular);">	
                    <p>
                	<?php include("inc_mensajes.php"); ?>
                	<label>MOTIVO DE ANULACION</label>
					<input name="txtMotivo" type="text" size="80"  style="text-transform:uppercase" />                                                   
                    <p> 
                   	<input name="action" type="hidden" value="<?php echo $_GET["action"]; ?>" />  
                    <input name="id" type="hidden" value="<?php echo $_GET["id"]; ?>" />                 
                    <input class="button" value="ENVIAR" type="submit" />
                    <input class="button" value="CANCELAR" type="reset" />	
					</p>			
				</form>
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