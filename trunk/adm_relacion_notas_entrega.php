<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "envios"; ?>
<?php include("inc_functions.php"); ?>	
<?php 
	// Agregar Region
	if ($_POST["action"]=="Agregar") {
		$id = $_GET["id"];
		$comentarios = strtoupper($_POST["txtComentarios"]);
		$action_result = agregarComentarioRelacion($link, $id, $comentarios);
	}	
	$factura = obtenerFactura($link, $_GET["id"]);
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
				
				<?php include("inc_mensajes_crud.php"); ?>	
				<h1>Relaci&oacute;n de Env&iacute;os</h1>				
				<div align="right" style="padding:0px 0px 20px 15px">
				<a href="adm_consultar_factura_proveedor.php?id=<?php echo $_GET["id"]; ?>">
                    <strong><< Regresar</strong>
              	</a>
              	</div>	
				<div align="left" style="padding:0px 0px 20px 15px">
				<a href="adm_relacion_notas_entrega_imp.php?id=<?php echo $factura->id; ?>" target="_blank">
                	<img src="images/icons/printer.png" align="texttop" border="0" />
                    <strong>Versi&oacute;n Imprimible</strong>
              	</a>
				</div>

                    <table width="800px">
            			<tr>
                    		<td colspan="6">
							<table valign="top" border=0 style="padding-left:15px">
								<tr>
									<td width="100px"  >
										<img src="images/logo_small.jpg" width="100px" height="25%" />
									</td>
									<td valign="middle" style="padding:5px 5px 10px 10px" width="360px">
										<strong style="font-size:20px">INVERSIONES SPAY, C.A.</strong>
                                        <br />
                                        Av. Victoria entre calle Chile con Internacional, <br />
                                        Urb. Las Acacias, Edif. Bologna, PB, Local 1, Caracas. <br />
                                        Tel&eacute;fonos: (58-0212) 633.31.89 - Fax: (58-212) 632.8383 <br />
                                        E-mail: transportespay@gmail.com
									</td>
                                    <td align="right" valign="top" style="font-size:16px; ">     
                                    RELACION N&deg; 
                                    <strong style="font-size:22px">
                                    <?php echo str_pad($factura->relacion, 4, "0", STR_PAD_LEFT); ?>
                                    </strong>
                                    <br /><br />
                                    FACTURA N&deg; 
                                    <strong style="font-size:22px">
                                    <?php echo str_pad($factura->numero_factura, 9, "0", STR_PAD_LEFT); ?>
                                    </strong>
                                    <br /><br />
                                    <strong>
                                    	<?php echo "CARACAS, ".mostrarFecha($factura->fecha_creacion); ?>
                                    </strong>
                                    </td>
								</tr>
							</table>
                    		</td>
                		</tr>
                	</table>	
                    <br />
                	<p style="width:850px;">
                     <strong style="font-size:22px;  ">
                     SE&Ntilde;ORES: 
                     <?php echo obtenerProveedorStr($link, $factura->id_proveedor); ?>
                     </strong>
                	</p>
                	
 <?php 
 						$total_general = 0;
						$query = "SELECT e.*, c.nombre as cliente 
						            FROM ts_envio e,
						                 ts_proveedor p, ts_cliente c,
						                 ts_destino d 
						           WHERE e.ind_activo < 2
						             AND e.id_proveedor = p.id 
						             AND e.id_cliente = c.id 
						             AND e.id_destino = d.id 
						             AND e.id_factura=".$factura->id." 
						             AND e.tipo_cobro='V'   
						        ORDER BY e.fecha_creacion";	

						$result = obtenerResultset($link,$query);
						
						if(mysql_num_rows($result)>0) {
 ?>    
                	<p>&nbsp;</p>	
                	<p style="font-size:15px;  
                     width:850px;">
                	A CONTINUACION LE RELACIONAMOS FACTURAS DE MERCANCIA ENTREGADA <br />CUYO FLETE NO HA SIDO PAGADO
                	</p>	
                	<p style="font-size:13px;   
                     width:850px;">
                	ENVIOS POR % FLETE
                	</p>
                    <div style="width:850px">
					<table style="padding-left:15px; font-size:11px;  
                     width:520px;">
                		<tr>
                    		<td colspan="11"><hr></td>
                		</tr>            	
                		<tr>
                			<td width="80" align="left"><strong>N&deg; FACTURA</strong></td>
                			<td width="300" align="left"><strong>CLIENTE</strong></td>
                			<td width="100" align="right"><strong>MONTO Bs</strong></td>
                		</tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr>
                		<?php  
						$total_valor = "";
					
						while ($row = obtenerRegistro($result)) {
							$inactiva = false;
							if($row->ind_activo==0) {
								$inactiva = true;	
							}
 						?>               
          				<tr>
                			<td <?php if($inactiva) {?>  <?php } ?> align="left">
								<?php echo str_pad($row->factura, 9, "0", STR_PAD_LEFT); ?>
                    		</td>
                			<td <?php if($inactiva) {?>  <?php } ?> align="left">
								<?php echo $row->cliente; ?>
                    		</td>                  		
                    		<td align="right">
								<?php echo number_format($row->mercancia,2,",","."); ?>
                    		</td>
            			</tr>		
						<?php 
							$total_valor += $row->mercancia;
						} 
						?>
                        
                        <tr>
                        	<td colspan="6">&nbsp;</td>
                        </tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr>                        
                        <tr>
                        	<td align="left">
                            </td>
                        	<td align="right">
                        		<strong>TOTAL Bs</strong>
                            </td>
                        	<td align="right">
                        		<strong><?php echo  number_format($total_valor,2,",","."); ?></strong>
                            </td>
                        </tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr> 
                        <tr>
                        	<td colspan="6">&nbsp;</td>
                        </tr> 
                        <tr>
                        	<td colspan="6"></td>
                        </tr>                                                                                               
          			</table>
                    
                    </div>
          			
<?php 
				} 
				 
				$total_general += $total_valor;
				$total_valor = 0;
?>          			
          			
 <?php 
 						
						$query = "SELECT e.*, c.nombre as cliente 
						            FROM ts_envio e,
						                 ts_proveedor p, ts_cliente c,
						                 ts_destino d 
						           WHERE e.ind_activo < 2
						             AND e.id_proveedor = p.id 
						             AND e.id_cliente = c.id 
						             AND e.id_destino = d.id 
						             AND e.id_factura=".$factura->id."   
						             AND e.tipo_cobro='P'  
						        ORDER BY e.fecha_creacion";	
						$result = obtenerResultset($link,$query);
						
						if(mysql_num_rows($result)>0) {
 ?>              			
                	<p>&nbsp;</p>	
                	<p style="font-size:15px; 
                     width:850px;">
                	A CONTINUACION LE RELACIONAMOS FACTURAS DE MERCANCIA ENTREGADA <br />CUYO FLETE NO HA SIDO PAGADO
                	</p>
                	<p style="font-size:13px; 
                     width:850px;">
                	ENVIOS POR PESO
                	</p>
                    
                    <div style="width:850px">
					<table style="padding-left:15px; font-size:11px;  " width="520px">
                		<tr>
                    		<td colspan="11"><hr></td>
                		</tr>            	
                		<tr>
                			<td width="80" align="left"><strong>N&deg; FACTURA</strong></td>
                			<td width="300" align="left"><strong>CLIENTE</strong></td>
                			<td width="100" align="right"><strong>MONTO Bs</strong></td>
                		</tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr>
                		<?php  
						$total_valor = "";
					
						while ($row = obtenerRegistro($result)) {
							$inactiva = false;
							if($row->ind_activo==0) {
								$inactiva = true;	
							}
 						?>               
          				<tr>
                			<td <?php if($inactiva) {?>  <?php } ?> align="left">
								<?php echo str_pad($row->factura, 9, "0", STR_PAD_LEFT); ?>
                    		</td>
                			<td <?php if($inactiva) {?>  <?php } ?> align="left">
								<?php echo $row->cliente; ?>
                    		</td>                  		
                    		<td align="right">
								<?php echo number_format($row->mercancia,2,",","."); ?>
                    		</td>
            			</tr>		
						<?php 
							$total_valor += $row->mercancia;
						} 
						?>
                        
                        <tr>
                        	<td colspan="6">&nbsp;</td>
                        </tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr>                        
                        <tr>
                        	<td align="left">
                            </td>
                        	<td align="right">
                        		<strong>TOTAL Bs</strong>
                            </td>
                        	<td align="right">
                        		<strong><?php echo  number_format($total_valor,2,",","."); $total_valor = 0; ?></strong>
                            </td>
                        </tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr> 
                        <tr>
                        	<td colspan="6">&nbsp;</td>
                        </tr> 
                        <tr>
                        	<td colspan="6"></td>
                        </tr>                                                                                               
          			</table>    
                    </div>
<?php 
		}				 
				$total_general += $total_valor;
				$total_valor = 0;
?>          			
          			
 <?php 
 						
						$query = "SELECT e.*, c.nombre as cliente 
						            FROM ts_envio e,
						                 ts_proveedor p, ts_cliente c,
						                 ts_destino d 
						           WHERE e.ind_activo < 2
						             AND e.id_proveedor = p.id 
						             AND e.id_cliente = c.id 
						             AND e.id_destino = d.id 
						             AND e.id_factura=".$factura->id."   
						             AND e.tipo_cobro='M'  
						        ORDER BY e.fecha_creacion";	
						$result = obtenerResultset($link,$query);
						
						if(mysql_num_rows($result)>0) {
 ?>         			
                	<p>&nbsp;</p>	
                	<p style="font-size:15px; 
                     width:850px;">
                	A CONTINUACION LE RELACIONAMOS FACTURAS DE MERCANCIA ENTREGADA <br />CUYO FLETE NO HA SIDO PAGADO
                	</p>
                	<p style="font-size:13px; 
                     width:850px;">
                	ENVIOS POR VIAJE
                	</p>
                    
                    <div style="width:850px">
					<table style="padding-left:15px; font-size:11px;  " width="520px">
                		<tr>
                    		<td colspan="11"><hr></td>
                		</tr>            	
                		<tr>
                			<td width="80" align="left"><strong>N&deg; FACTURA</strong></td>
                			<td width="300" align="left"><strong>CLIENTE</strong></td>
                			<td width="100" align="right"><strong>MONTO Bs</strong></td>
                		</tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr>
                		<?php  
						$total_valor = "";
					
						while ($row = obtenerRegistro($result)) {
							$inactiva = false;
							if($row->ind_activo==0) {
								$inactiva = true;	
							}
 						?>               
          				<tr>
                			<td <?php if($inactiva) {?>  <?php } ?> align="left">
								<?php echo str_pad($row->factura, 9, "0", STR_PAD_LEFT); ?>
                    		</td>
                			<td <?php if($inactiva) {?>  <?php } ?> align="left">
								<?php echo $row->cliente; ?>
                    		</td>                  		
                    		<td align="right">
								<?php echo number_format($row->mercancia,2,",","."); ?>
                    		</td>
            			</tr>		
						<?php 
							$total_valor += $row->mercancia; 
							$total_general += $total_valor;
						} 
						?>
                        
                        <tr>
                        	<td colspan="6">&nbsp;</td>
                        </tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr>                        
                        <tr>
                        	<td align="left">
                            </td>
                        	<td align="right">
                        		<strong>TOTAL Bs</strong>
                            </td>
                        	<td align="right">
                        		<strong><?php echo  number_format($total_valor,2,",","."); ?></strong>
                            </td>
                        </tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr> 
                        <tr>
                        	<td colspan="6">&nbsp;</td>
                        </tr> 
                        <tr>
                        	<td colspan="6"></td>
                        </tr>                                                                                               
          			</table>    
                    </div>
<?php 
						}
?>          			 
					
                    <div style="width:850px">
					<table style="padding-left:15px; font-size:11px;  " 
                     width="520px">
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr>                        
                        <tr>
                        	<td align="left" width="210px">
                            </td>
                        	<td align="right">
                        		<strong>TOTAL GENERAL Bs</strong>
                            </td>
                        	<td align="right">
                        		<strong><?php echo  number_format($total_general,2,",","."); ?></strong>
                            </td>
                        </tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr>     
                		</table> 
                     </div>   
                	<p>&nbsp;</p>	
                	<p style="font-size:15px; 
                     width:850px;">
                	<?php echo $factura->comentarios; ?>
                	</p>      
                 	<p>&nbsp;</p>
               	<h3>Agregar Comentario</h3>
				<form action="adm_relacion_notas_entrega.php?id=<?php echo $_GET["id"]; ?>" 
				 method="post" enctype="multipart/form-data" 
                 onSubmit="return validate_comentatio_form(this);">	
                    <p>                 
 					<?php include("inc_mensajes.php"); ?>														
                    <label>COMENTARIOS</label>
					<input name="txtComentarios" type="text" size="127" style="text-transform:uppercase" />                                                   
                    </p>                                  
                    <br />                 
                    <hr />
                    <p> 
                   	<input name="action" type="hidden" value="Agregar" />  
                    <input name="id" type="hidden" value="<?php echo $factura->id; ?>" />                  
                    <input class="button" value="ENVIAR" type="submit" />
                    <input class="button" value="CANCELAR" type="reset" />	
					</p>			
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