<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "guias"; ?>
<?php include("inc_functions.php"); ?>	
<?php 
	$guia = obtenerGuia($link, $_GET["id"]);
	$envios = obtenerEnviosGuia($link, $guia->id);
	
	$i = 0;
	while($row = obtenerRegistro($envios)) {
		$envios_arr[$i] = $row->id;
		$i++;
	}
	
	function contieneEnvio($envios, $id_envio) {
		for($i=0; $i < count($envios); $i++) {
			if($envios[$i]==$id_envio) {
				return true;
			}
		}
		return false;
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
					
				<h1>Modificar Gu&iacute;a de Entrega</h1>						
					<?php include("inc_mensajes_crud.php"); ?> 				
					<?php if($guia_tmp!="") { ?>   
					<span style="padding-left:15px">
					<strong>Haga <a href="<?php echo $guia_tmp; ?>">click aqui</a> para ver la Gu&iacute;a</strong>    
					</span>
					<?php } ?>  
                    <table>
            			<tr>
                    		<td colspan="6">
                    		<form name="frmEnvio" action="adm_guias.php" method="post" 
                    		 enctype="multipart/form-data" onSubmit="return validate_busqueda_guia_form(this);">                  		 
                    		  	<?php if(isset($_POST["cmbRegion"])) { ?>
                    		 	<input type="button" class="button" value="LIMPIAR BUSQUEDA" 
                    		 	 onclick="javascript:document.location.href = 'adm_generar_guia.php';" />
                    		 	<?php } else { ?>
                    		 	<strong>REGION</strong>&nbsp;
                    		 	<select name="cmbRegion">
                    		 		<option value=""></option>
                    		 		<?php 
                    		 			$regiones = obtenerRegiones($link);
                    		 			while($row = obtenerRegistro($regiones)) {
                    		 		?>
                    		 		<option value="<?php echo $row->id; ?>">
                    		 		<?php echo $row->nombre; ?>
                    		 		</option>
                    		 		<?php } ?>
                    		 	</select> 
								&nbsp;                  		 	
                    		  	<input name="action" type="hidden" value="Buscar" />
                    		 	<input type="submit" class="button" value="BUSCAR" />
                    		 	<?php } ?>
                    		</form>
                    		</td>
                		</tr>
                	</table>  
					<?php include("inc_lists.php"); ?>
					<h3>Env&iacute;os Disponibles</h3>                    
					<form name="frmG" action="adm_guias.php" method="post" enctype="multipart/form-data" 
                	 onSubmit="return validate_generar_guia_form(this);"  
                     style="background-color:#FFF; border:none;	margin:0px; padding: 0px;">       
					<table style="padding-left:10px; font-size:11px" width="840px">
            			<tr>
                    		<td colspan="11"><hr></td>
                		</tr>            	
                		<tr>
                			<td width="40"><strong></strong></td>
                			<td width="250"><strong>PROVEEDOR</strong></td>
                			<td width="40" align="center"><strong>BULTOS</strong></td>
                			<td width="60" align="center"><strong>REMESA</strong></td>
                			<td width="70" align="center"><strong>FACTURA</strong></td>
                			<td width="350"><strong>CLIENTE</strong></td>
                			<td width="110"><strong>DESTINO</strong></td>
                    		<td width="70" align="right"><strong>MERCANCIA</strong></td>
                    		<td width="50" align="center"><strong>%</strong></td>
                            <td width="50" align="right"><strong>FLETE</strong></td>
                		</tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr>
                		<?php
						
						$query = "SELECT e.* 
						            FROM ts_envio e,
						                 ts_proveedor p, ts_cliente c,
						                 ts_destino d 
						           WHERE e.ind_activo < 2
						             AND e.id_proveedor = p.id 
						             AND e.id_cliente = c.id 
						             AND e.id_destino = d.id 
						             AND e.ind_envio IN (1,4,5) 
						             AND (e.id_guia IS NULL OR e.id_guia=".$guia->id.") "; 

						if($_POST["cmbRegion"]!="") {
							$query .= " AND d.id_region=".$_POST["cmbRegion"];
						}		

						$query .= " ORDER BY e.fecha_creacion, e.ind_envio DESC ";	
						
						$result = obtenerResultset($link,$query);
					
						while ($row = obtenerRegistro($result)) {
						
							$inactiva = false;
							if($row->ind_activo==0) {
								$inactiva = true;	
							}
 						?>               
          				<tr style="color: #000">
                    		<?php 
	                			if($row->tipo_cobro=="V") { 
	          						$valor = $row->mercancia*($row->flete/100);
	 							}
	 							if($row->tipo_cobro=="P") {
	 								$valor = $row->peso*$row->bskg;
	 							}
	 							if($row->tipo_cobro=="M") {
	 								$valor = $row->viaje;
	 							}
	                    	?>
                			<td align="center">
                				<input type="checkbox" name="chkEnvio[]" value="<?php echo $row->id; ?>" 
                                 style="vertical-align:text-bottom" onClick="sumarGuia(frmG)" 
                                 <?php if(contieneEnvio($envios_arr, $row->id)) { ?> checked <?php } ?> />
                			</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<?php echo obtenerProveedorStr($link, $row->id_proveedor); ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="center">
								<?php echo $row->bultos; ?>
                    		</td> 
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="center"> 
								<?php echo str_pad($row->remesa, 6, "0", STR_PAD_LEFT); ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="center"> 
								<?php echo str_pad($row->factura, 6, "0", STR_PAD_LEFT); ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<?php echo obtenerClienteStr($link, $row->id_cliente); ?>
                    		</td> 
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<?php echo obtenerDestinoStr($link, $row->id_destino); ?>
                    		</td>                   		
                    		<td align="right">
								<?php echo number_format($row->mercancia,2,",","."); ?>
                    		</td>
                    		<td align="center">
								<?php if($row->flete!="") { echo $row->flete; ?>%<?php } ?>
                    		</td>		                		
                    		<td align="right">
								<?php echo number_format($valor,2,",","."); ?>
                    		</td> 
            			</tr>		
						<?php } ?>
                        
                        <tr>
                        	<td colspan="6">&nbsp;</td>
                        </tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr>                        
                        <tr>
                        	<td align="left">
                        		<strong>&nbsp;</strong>
                            </td>
                        	<td align="left">
                        		<strong>BULTOS</strong>
                            </td>
                        	<td align="center">
                        		<strong>
                        			<label id="bultos"><?php echo $guia->total_bultos; ?></label>
                        		</strong>
                            </td>
                        	<td align="center">
                        		<strong>FACTURAS</strong>
                            </td>
                        	<td align="center">
                        		<strong>
                        			<label id="facturas"><?php echo $guia->total_facturas; ?></label>
                        		</strong>
                            </td>
                        	<td align="left">
                        		<strong>&nbsp;</strong>
                            </td>
                        	<td align="left">
                        		<strong>TOTAL Bs.</strong>
                            </td>
                        	<td align="right">
                        		<strong>
                        			<label id="mercancia">
                        				<?php echo number_format($guia->total_mercancia,2,",","."); ?>
                        			</label>
                        		</strong>
                            </td>
                        	<td align="right">
                        		<strong>&nbsp;</strong>
                            </td>
                        	<td align="right">
                        		<strong>
                        			<label id="flete">
                        				<?php echo number_format($guia->total_flete,2,",","."); ?>
                        			</label>
                        		</strong>
                            </td>
                        </tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr> 
                        <tr>
                        	<td colspan="6">&nbsp;</td>
                        </tr> 
                        <tr>
                        	<td colspan="6">
                    <?php include("inc_mensajes.php"); ?></td>
                        </tr>                                                                                               
          			</table>
                    <strong style="padding-left:15px">CHOFER</strong>&nbsp;
                     <select name="cmbChofer">
                     	<option value=""></option>
                     	<?php 
                     		$choferes = obtenerChoferes($link);
                     		while($row = obtenerRegistro($choferes)) {
                     	?>
                     	<option value="<?php echo $row->id; ?>" 
                     	 <?php if($guia->id_chofer==$row->id) { ?> selected <?php } ?>>
                     	<?php echo $row->nombre; ?>
                     	</option>
                     	<?php } ?>
                     </select> 
						&nbsp;                  		 	
                     <input name="action" type="hidden" value="Modificar" />
                     <input name="id" type="hidden" value="<?php echo $_GET["id"]; ?>"  />
                     <input type="submit" class="button" value="MODIFICAR GUIA" />    
                     <input type="reset" class="button" value="CANCELAR" onClick="limpiarTotalesGuia()" />       			   
          			 <br /><br /><br /><br />
          			</form>           
                								
	  		</div> 	
	<!-- content-wrap ends here -->	
	</div>
<!-- wrap ends here -->
</div>		
<?php include("inc_footer.php"); ?>
</body>
</html>
<?php include("inc_desconectarse.php"); ?>