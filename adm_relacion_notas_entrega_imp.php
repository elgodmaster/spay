<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "guias"; ?>
<?php include("inc_functions.php"); ?>	
<?php 
	$factura = obtenerFactura($link, $_GET["id"]);
?>	
		      <table width="850px" style="font-family:Arial, Helvetica, sans-serif;">
            			<tr>
                    		<td colspan="6">
							<table valign="top" border=0 style="padding-left:10px">
								<tr>
									<td width="70px"  >
										<img src="images/logo_small.jpg" width="70px" height="95px" />
									</td>
									<td align="left" valign="middle" style="padding:5px 5px 10px 10px; 
									 color:#999; font-size:10px" width="430px">
										<strong style="font-size:14px">INVERSIONES SPAY, C.A.</strong>
                                        <br />
                                        <strong style="font-size:10px">NIT 0-187590205</strong>
                                        <br />
                                        Av. Victoria entre calle Chile con Internacional, <br />
                                        Urb. Las Acacias, Edif. Bologna, PB, Local 1, Caracas. <br />
                                        Tel&eacute;fonos: (58-0212) 633.31.89 - Fax: (58-212) 632.8383 <br />
                                        E-mail: transportespay@gmail.com
									</td>
                                    <td align="right" valign="top" style="font-size:16px; color:#999">     
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
                	<p style="width:850px; text-align:center">
                     <strong style="font-size:22px; font-family:Arial, Helvetica, sans-serif; padding-left:15px; color:#999">
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
						        ORDER BY e.factura";	

						$result = obtenerResultset($link,$query);
						
						if(mysql_num_rows($result)>0) {
 ?>    
                	<p>&nbsp;</p>	
                	<p style="font-size:15px; font-family:Arial, Helvetica, sans-serif; padding-left:15px; color:#999; 
                     width:850px; text-align:center">
                	A CONTINUACION LE RELACIONAMOS FACTURAS DE MERCANCIA ENTREGADA <br />CUYO FLETE NO HA SIDO PAGADO
                	</p>	
                	<p style="font-size:13px; font-family:Arial, Helvetica, sans-serif; padding-left:15px; color:#999; 
                     width:850px; text-align:center">
                	ENVIOS POR % FLETE
                	</p>
                    <div style="width:850px" align="center">
					<table style="padding-left:10px; font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#999; 
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
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="left">
								<?php echo str_pad($row->factura, 9, "0", STR_PAD_LEFT); ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="left">
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
						        ORDER BY e.factura";	
						$result = obtenerResultset($link,$query);
						
						if(mysql_num_rows($result)>0) {
 ?>              			
                	<p>&nbsp;</p>	
                	<p style="font-size:15px; font-family:Arial, Helvetica, sans-serif; padding-left:15px; color:#999; 
                     width:850px; text-align:center">
                	A CONTINUACION LE RELACIONAMOS FACTURAS DE MERCANCIA ENTREGADA <br />CUYO FLETE NO HA SIDO PAGADO
                	</p>
                	<p style="font-size:13px; font-family:Arial, Helvetica, sans-serif; padding-left:15px; color:#999; 
                     width:850px; text-align:center">
                	ENVIOS POR PESO
                	</p>
                    
                    <div style="width:850px" align="center">
					<table style="padding-left:10px; font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#999" width="520px">
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
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="left">
								<?php echo str_pad($row->factura, 9, "0", STR_PAD_LEFT); ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="left">
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
						        ORDER BY e.factura";	
						$result = obtenerResultset($link,$query);
						
						if(mysql_num_rows($result)>0) {
 ?>         			
                	<p>&nbsp;</p>	
                	<p style="font-size:15px; font-family:Arial, Helvetica, sans-serif; padding-left:15px; color:#999; 
                     width:850px; text-align:center">
                	A CONTINUACION LE RELACIONAMOS FACTURAS DE MERCANCIA ENTREGADA <br />CUYO FLETE NO HA SIDO PAGADO
                	</p>
                	<p style="font-size:13px; font-family:Arial, Helvetica, sans-serif; padding-left:15px; color:#999; 
                     width:850px; text-align:center">
                	ENVIOS POR VIAJE
                	</p>
                    
                    <div style="width:850px" align="center">
					<table style="padding-left:10px; font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#999" width="520px">
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
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="left">
								<?php echo str_pad($row->factura, 9, "0", STR_PAD_LEFT); ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="left">
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
					
                    <div style="width:850px" align="center">
					<table style="padding-left:10px; font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#999" 
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
                	<p style="font-size:15px; font-family:Arial, Helvetica, sans-serif; padding-left:15px; color:#999; 
                     width:850px; text-align:center">
                	<?php echo $factura->comentarios; ?>
                	</p>                     
</body>
</html>
<?php include("inc_desconectarse.php"); ?>