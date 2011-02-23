<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "guias"; ?>
<?php include("inc_functions.php"); ?>	
<?php 
	$guia = obtenerGuia($link, $_GET["id"]);
	$chofer = obtenerChofer($link, $guia->id_chofer);
	$usuario = obtenerUsuario($link, $_SESSION["id_usuario"]);
	
	if($_POST["action"]=="MarcarEnvioEntregado") {
		$id = $_POST["id_envio"];
		$observaciones = strtoupper($_POST["txtMotivo"]);
		$action_result = marcarEnvioEntregado($link, $id, $observaciones);
	}	
	if($_POST["action"]=="MarcarEnvioNoEntregado") {
		$id = $_POST["id_envio"];
		$motivo = strtoupper($_POST["txtMotivo"]);
		$action_result = marcarEnvioNoEntregado($link, $id, $motivo);
	}	
	if($_POST["action"]=="MarcarEnvioDevuelto") {
		$id = $_POST["id_envio"];
		$motivo = strtoupper($_POST["txtMotivo"]);
		$action_result = marcarEnvioDevuelto($link, $id, $motivo);
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
					
				<h1>Consultar Gu&iacute;a</h1>
				<div align="right">
				<a href="adm_guias.php" class="orange"><strong><< Regresar</strong></a>
				</div>				   
                <div style="padding-left:10px">
                	<p>                                    
                	<?php 
	                    if($guia->numero_guia=="") {
	                      $guia->numero_guia = $guia->id;
	                    }
                    ?>
                	<strong>GUIA <?php if(!$guia->ind_guia) { echo "TEMPORAL "; } ?>N&deg;</strong>&nbsp; 
            		<input name="txtRIF" type="text" size="4" style="text-transform:uppercase; text-align:right" 
                     value="<?php echo str_pad($guia->numero_guia, 4, "0", STR_PAD_LEFT);  ?>" disabled />
                    &nbsp;
                	<strong>FECHA</strong>&nbsp; 
            		<input name="txtRIF" type="text" size="8" style="text-transform:uppercase; text-align:right" 
                     value="<?php echo mostrarFecha($guia->fecha_modificacion);  ?>" disabled />
                    &nbsp;
                	<strong>PLACA CAMION</strong>&nbsp; 
            		<input name="txtRIF" type="text" size="8" style="text-transform:uppercase;" 
                     value="<?php echo $chofer->placa;  ?>" disabled />
                    &nbsp;
                    <br /><br />
                	<strong>CHOFER</strong>&nbsp; 
            		<input name="txtRIF" type="text" size="50" style="text-transform:uppercase;" 
                     value="<?php echo $chofer->nombre;  ?>" disabled />
                    &nbsp;
                    <br /><br />
                   
                   	<h3>Env&iacute;os asociados</h3>
                   	<?php include("inc_mensajes_crud.php"); ?>
					<table style="padding-left:10px; font-size:11px" width="880px">
            			<tr>
                    		<td colspan="11"><hr></td>
                		</tr>            	
                		<tr>
                			<td width="220"><strong>PROVEEDOR</strong></td>
                			<td width="30" align="center"><strong>BULTOS</strong></td>
                			<td width="60" align="center"><strong>REMESA</strong></td>
                			<td width="70" align="center"><strong>FACTURA</strong></td>
                			<td width="350"><strong>CLIENTE</strong></td>
                			<td width="120"><strong>DESTINO</strong></td>
                    		<td width="70" align="right"><strong>MERCANCIA</strong></td>
                    		<td width="50" align="center"><strong>%</strong></td>
                            <td width="60" align="right" style="padding-right:10px"><strong>FLETE</strong></td>
                			<?php if($guia->ind_guia==2) { ?>
                            <td width="60" align="left"><strong>ACCIONES</strong></td>
                			<?php } ?>
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
						             AND e.id_guia=".$guia->id."  
						        ORDER BY e.fecha_creacion DESC, e.remesa, e.factura";

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
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<?php echo substr(obtenerProveedorStr($link, $row->id_proveedor),0,20); ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="center">
								<?php echo $row->bultos; ?>
                    		</td> 
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="center"> 
								<?php echo str_pad($row->remesa, 6, "0", STR_PAD_LEFT); ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="center"> 
								<?php echo substr(str_pad($row->factura, 6, "0", STR_PAD_LEFT),0,6); ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<?php echo  substr(obtenerClienteStr($link, $row->id_cliente),0,28); ?>
                    		</td> 
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<?php echo substr(obtenerDestinoStr($link, $row->id_destino),0,15); ?>
                    		</td>                		
                    		<td align="right">
								<?php echo number_format($row->mercancia,2,",","."); ?>
                    		</td>
                    		<td align="right">
								<?php if($row->flete!="") { echo  number_format($row->flete,2,",","."); ?>%<?php } ?>
                    		</td>		                		
                    		<td align="right" style="padding-right:10px">
								<?php echo number_format($valor,2,",","."); ?>
                    		</td>
                			<?php if($guia->ind_guia==2) { ?>
                            <td align="left">
                            	<?php if($row->ind_envio < 3) { ?>
                                <a href="adm_actualizar_envio.php?action=MarcarEnvioEntregado&id=<?php echo $row->id; ?>&id_guia=<?php echo $guia->id; ?>"  
                                   title="Marcar como Entregado">
                                	<img src="images/icons/accept.png" align="texttop" border="0"
                                     onclick="javascript:return confirm('Esta seguro que desea Marcar como Entregado?');" />
                           		</a>
                                <a href="adm_actualizar_envio.php?action=MarcarEnvioNoEntregado&id=<?php echo $row->id; ?>&id_guia=<?php echo $guia->id; ?>" 
                                   title="Marcar como No Entregado">
                                	<img src="images/icons/error.png" align="texttop" border="0"
                                     onclick="javascript:return confirm('Esta seguro que desea Marcar como No Entregado?');" />
                           		</a>
                                <a href="adm_actualizar_envio.php?action=MarcarEnvioDevuelto&id=<?php echo $row->id; ?>&id_guia=<?php echo $guia->id; ?>" 
                                   title="Marcar como Devuelto">
                                	<img src="images/icons/cancel.png" align="texttop" border="0"
                                     onclick="javascript:return confirm('Esta seguro que desea marcar como Devuelto?');" />
                           		</a>
                           		<?php } ?>
                            	<?php if($row->ind_envio==4) { ?>
                                <a href="adm_nota_de_devolucion.php?id=<?php echo $row->id; ?>&id_guia=<?php echo $guia->id; ?>" 
                                   title="Nota de Devoluci&oacute;n">
                                	<img src="images/icons/page_error.png" align="texttop" border="0" />
                           		</a>
                           		<?php } ?>
                           	</td> 
                           	<?php } ?>
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
                        		<strong>BULTOS</strong>
                            </td>
                        	<td align="center">
                        		<strong><?php echo $guia->total_bultos; ?></strong>
                            </td>
                        	<td align="center">
                        		<strong>FACTURAS</strong>
                            </td>
                        	<td align="center">
                        		<strong><?php echo $guia->total_facturas; ?></strong>
                            </td>
                        	<td align="left">
                        		<strong>&nbsp;</strong>
                            </td>
                        	<td align="left">
                        		<strong>TOTAL Bs.</strong>
                            </td>
                        	<td align="right">
                        		<strong><?php echo  number_format($guia->total_mercancia,2,",",".");; ?></strong>
                            </td>
                        	<td align="right">
                        		<strong>&nbsp;</strong>
                            </td>
                        	<td align="right" style="padding-right:10px">
                        		<strong><?php echo  number_format($guia->total_flete,2,",",".");; ?></strong>
                            </td>
                        </tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr> 
                        <tr>
                        	<td colspan="11">&nbsp;</td>
                        </tr> 
                        <tr>
                        	<td colspan="11"><hr /></td>
                        </tr>
                        <tr>
                        	<td colspan="11">
                    <strong style="padding-right:5px;">ESTATUS</strong>
                    <span style="color:<?php echo colorIndGuia($guia->ind_guia); ?>; font-weight:bold">
					<?php echo indGuiaStr($guia->ind_guia); ?>
                    </span>                        	
                        	</td>
                        </tr>   
                        <tr>
                        	<td colspan="11"><hr /></td>
                        </tr>                                                                                                
          			</table>
                                                  			
				</div>
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