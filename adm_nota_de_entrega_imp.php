<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "envios"; ?>
<?php include("inc_functions.php"); ?>	
<?php 
	$envio = obtenerEnvio($link,$_GET["id"]);
	$tipo_cobro = $envio->tipo_cobro;
	$id_cliente = $envio->id_cliente;
	$remesa = $envio->remesa;
	$fecha = $envio->fecha_creacion;
	
	$query = "SELECT * 
	            FROM ts_envio 
	           WHERE fecha_creacion = '".$envio->fecha_creacion."' 
	             AND remesa = ".$envio->remesa;
	$result = mysql_query($query, $link);
	$result2 = mysql_query($query, $link);
?>	
                    <table width="800px" style="font-family:Arial, Helvetica, sans-serif; padding-left:15px;">
            		<tr>
                    	<td colspan="6">
						<table valign="top" border=0>
							<tr>
								<td width="70px">
									<img src="images/logo_small.jpg" width="70px" height="95px" />
								</td>
								<td valign="middle" style="padding:5px 5px 10px 15px; color:#999" width="360px">
									<strong style="font-size:14px">INVERSIONES SPAY, C.A.</strong>
                                        <br />
                                        <strong style="font-size:10px">NIT 0-187590205</strong>
                                        <br />
                                        <span style="font-size:10px">
                                        Av. Victoria entre calle Chile con Internacional, <br />
                                        Urb. Las Acacias, Edif. Bologna, PB, Local 1, Caracas. <br />
                                        Tel&eacute;fonos: (58-0212) 633.31.89 - Fax: (58-212) 632.8383 <br />
                                        E-mail: transportespay@gmail.com
                                        </span>
								</td>
                                    <td align="right" valign="top" width="330px" style="font-size:16px; color:#999">
                                    NOTA DE ENTREGA N&deg;<strong style="font-size:22px">
                                    <?php echo str_pad($remesa, 4, "0", STR_PAD_LEFT); ?>
                                    </strong>
                                    <br /><br />
                                    <strong><?php echo mostrarFecha($fecha); ?></strong>
                                    </td>
							</tr>
						</table>
                    	</td>
                	</tr>
                </table>					
				<table style="padding-left:15px; font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#999" width="800px">
            		<tr>
                    	<td colspan="11"><hr></td>
                	</tr>            	
                	<tr>
                		<td width="250"><strong>PROVEEDOR</strong></td>
                		<td width="60" align="center"><strong>BULTOS</strong></td>
                		<td width="60" align="center"><strong>REMESA</strong></td>
                		<td width="80" align="center"><strong>FACTURA</strong></td>
                		<td width="400"><strong>CLIENTE</strong></td>
                		<td width="110"><strong>DESTINO</strong></td>
                		<td width="110"><strong>PAGO</strong></td>
                		<?php 
                			if($envio->tipo_cobro=="V") { 
          						$valor = "MERCANCIA";
 							}
 							if($envio->tipo_cobro=="P") {
 								$valor = "PESO";
 							}
 							if($envio->tipo_cobro=="M") {
 								$valor = "VALOR VIAJE";
 							}
                    	?>                		
                    	<td width="120" align="right"><strong><?php echo $valor; ?></strong></td>	
                	</tr>
            		<tr>
                    	<td class="text" colspan="11"><hr></td>
                	</tr>     
                		<?php
                			
                			$total_bultos = 0;
                			$total_mercancia = 0;
                			$total_peso = 0;
                			$total_viaje = 0;
                			 
                			while($envio = obtenerRegistro($result)) { 
                		?>          
          			<tr style="color:#999">
                		<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
							<?php echo obtenerProveedorStr($link, $envio->id_proveedor); ?>
                    	</td>
                		<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="center">
							<?php echo $envio->bultos; ?>
                    	</td> 
                		<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="center"> 
							<?php echo str_pad($envio->remesa, 6, "0", STR_PAD_LEFT); ?>
                    	</td>
                		<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="center"> 
							<?php echo str_pad($envio->factura, 6, "0", STR_PAD_LEFT); ?>
                    	</td>
                		<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
							<?php echo obtenerClienteStr($link, $envio->id_cliente); ?>
                    	</td> 
                		<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
							<?php echo obtenerDestinoStr($link, $envio->id_destino); ?>
                    	</td>
                    	<td>
							<?php echo pagadero($envio->tipo_envio); ?>
                    	</td>
                        <td align="right">
	                		<?php 
	                			if($envio->tipo_cobro=="V") { 
	          						echo number_format($envio->mercancia,2,",",".");
	 							}
	 							if($envio->tipo_cobro=="P") {
	 								echo number_format($envio->peso,2,",",".");
	 							}
	 							if($envio->tipo_cobro=="M") {
	 								echo number_format($envio->viaje,2,",",".");
	 							}
	                    	?>
                     	</td>
            		</tr>		
            			<?php 
            					
	                			$total_bultos += $envio->bultos;
	                			$total_mercancia += $envio->mercancia;
	                			$total_peso += $envio->peso;
	                			$total_viaje += $envio->viaje;
                			}
                		?>	
                        <tr>
                        <td colspan="6">&nbsp;</td>
                        </tr>
            		<tr>
                    	<td class="text" colspan="11"><hr></td>
                	</tr>                        
                        	<td align="left">
                        	<strong>TOTAL DE BULTOS</strong>
                            </td>
                        	<td align="center">
                        	<strong><?php echo $total_bultos; ?></strong>
                            </td>
                        	<td colspan=2>
                        	<strong></strong>
                            </td>
                        	<td colspan=3 align="right">
	                		<?php 
	                			if($tipo_cobro=="V") { 
	          						$valor = "TOTAL VALOR DE LA MERCANCIA Bs.";
	 							}
	 							if($tipo_cobro=="P") {
	 								$valor = "TOTAL PESO DE LA MERCANCIA Kg";
	 							}
	 							if($tipo_cobro=="M") {
	 								$valor = "VALOR TOTAL DEL VIAJE Bs.";
	 							}
	                    	?>                          	
                        	<strong><?php echo $valor; ?></strong>
                            </td>
                        	<td align="right">
                        	<strong>
	                		<?php 
	                			if($tipo_cobro=="V") { 
	          						echo number_format($total_mercancia,2,",",".");
	 							}
	 							if($tipo_cobro=="P") {
	 								echo number_format($total_peso,2,",",".");
	 							}
	 							if($tipo_cobro=="M") {
	 								echo number_format($total_viaje,2,",",".");
	 							}
	                    	?>                        	
                        	</strong>
                            </td>
            		<tr>
                    	<td class="text" colspan="11"><hr></td>
                	</tr>  
                   	<tr>
                        <td colspan="6">&nbsp;</td>
                  	</tr>  
                   	<tr>
                        <td colspan="6">&nbsp;</td>
                  	</tr>
                  </table>
                  <table style="padding-left:15px; color:#999; font-size:11px; font-family:Arial, Helvetica, sans-serif;" width="800px">      
                        <tr>
	                        <td width="300px" style="border-bottom:1px solid">&nbsp;</td>
	                        <td width="100px">&nbsp;</td>
	                        <td width="450px" align="right" style="border-bottom:1px solid">&nbsp;</td>
                        </tr>   
                        <tr>
                        <td align="center" style=" font-size:14px; font-weight:bold">
                            POR INVERSIONES SPAY, C.A.
                            </td>
                        <td>&nbsp;</td>
                        <td align="center" style="font-size:14px; font-weight:bold">
                            POR <?php echo obtenerClienteStr($link, $id_cliente); ?>
                            </td>
                        </tr>
                        <tr>
                        <td width="300px">&nbsp;</td>
                        <td width="100px">&nbsp;</td>
                        <td width="450px">&nbsp;</td>
                        </tr> 
                        <tr>
                        <td colspan=3 style="font-size:16px; font-weight:bold">
                            </td>
                        </tr> 
                        <tr>
                        <td colspan=3 style="font-size:16px; font-weight:bold">
                            </td>
                        </tr>
                        <tr>
                        <td colspan=3 align="center" style="font-size:16px; font-weight:bold">
                            SE AGRADECE ENVIAR COPIA FIRMADA
                            </td>
                        </tr> 
                        <tr>
                        <td colspan=3 style="font-size:16px; font-weight:bold">
                            </td>
                        </tr>  
                        <tr>
                        <td colspan=3 style="font-size:16px; font-weight:bold">
                            </td>
                        </tr> 
                        <tr>
                        <td colspan=3 style="font-size:16px; font-weight:bold">
                            </td>
                        </tr> 
                        <tr>
                        <td colspan=4 style="border-bottom:1px dotted">&nbsp;</td>
                        </tr>
                        <tr>
                        <td colspan=3 style="font-size:16px; font-weight:bold">
                            </td>
                        </tr> 
                        <tr>
                        <td colspan=3 style="font-size:16px; font-weight:bold">
                            </td>
                        </tr> 
                        <tr>
                        <td colspan=3 style="font-size:16px; font-weight:bold">
                            </td>
                        </tr> 
                        <td colspan=3 style="font-size:16px; font-weight:bold">
                            </td>
                        </tr> 
                 </table>
                 
                    <table width="800px" style="font-family:Arial, Helvetica, sans-serif; padding-left:15px; color:#999">
            		<tr>
                    	<td colspan="6">
						<table valign="top" border=0>
							<tr>
								<td width="70px">
									<img src="images/logo_small.jpg" width="70px" height="95px" />
								</td>
								<td valign="middle" style="padding:5px 5px 10px 15px; color:#999" width="360px">
									<strong style="font-size:14px">INVERSIONES SPAY, C.A.</strong>
                                        <br />
                                        <strong style="font-size:10px">NIT 0-187590205</strong>
                                        <br />
                                        <span style="font-size:10px">
                                        Av. Victoria entre calle Chile con Internacional, <br />
                                        Urb. Las Acacias, Edif. Bologna, PB, Local 1, Caracas. <br />
                                        Tel&eacute;fonos: (58-0212) 633.31.89 - Fax: (58-212) 632.8383 <br />
                                        E-mail: transportespay@gmail.com
                                        </span>
								</td>
                                    <td align="right" valign="top" width="330px" style="font-size:16px; color:#999">
                                    NOTA DE ENTREGA N&deg;<strong style="font-size:22px">
                                    <?php echo str_pad($remesa, 4, "0", STR_PAD_LEFT); ?>
                                    </strong>
                                    <br /><br />
                                    <strong><?php echo mostrarFecha($fecha); ?></strong>
                                    </td>
							</tr>
						</table>
                    	</td>
                	</tr>
                </table>					
				<table style="padding-left:15px; font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#999" width="800px">
            		<tr>
                    	<td colspan="11"><hr></td>
                	</tr>            	
                	<tr>
                		<td width="250"><strong>PROVEEDOR</strong></td>
                		<td width="60" align="center"><strong>BULTOS</strong></td>
                		<td width="60" align="center"><strong>REMESA</strong></td>
                		<td width="80" align="center"><strong>FACTURA</strong></td>
                		<td width="400"><strong>CLIENTE</strong></td>
                		<td width="110"><strong>DESTINO</strong></td>
                		<td width="110"><strong>PAGO</strong></td>
                		<?php 
                			if($tipo_cobro=="V") { 
          						$valor = "MERCANCIA";
 							}
 							if($tipo_cobro=="P") {
 								$valor = "PESO";
 							}
 							if($tipo_cobro=="M") {
 								$valor = "VALOR VIAJE";
 							}
                    	?>                		
                    	<td width="120" align="right"><strong><?php echo $valor; ?></strong></td>	

                	</tr>
            		<tr>
                    	<td class="text" colspan="11"><hr></td>
                	</tr>                  		
                	<?php
                			
                			$total_bultos = 0;
                			$total_mercancia = 0;
                			$total_peso = 0;
                			$total_viaje = 0;
                			 
                			while($envio = obtenerRegistro($result2)) { 
                	?>           
          			<tr style="color:#999">
                		<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
							<?php echo obtenerProveedorStr($link, $envio->id_proveedor); ?>
                    	</td>
                		<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="center">
							<?php echo $envio->bultos; ?>
                    	</td> 
                		<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="center"> 
							<?php echo str_pad($envio->remesa, 6, "0", STR_PAD_LEFT); ?>
                    	</td>
                		<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="center"> 
							<?php echo str_pad($envio->factura, 6, "0", STR_PAD_LEFT); ?>
                    	</td>
                		<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
							<?php echo obtenerClienteStr($link, $envio->id_cliente); ?>
                    	</td> 
                		<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
							<?php echo obtenerDestinoStr($link, $envio->id_destino); ?>
                    	</td>
                    	<td>
							<?php echo pagadero($envio->tipo_envio); ?>
                    	</td>
                            <td align="right">
	                		<?php 
	                			if($envio->tipo_cobro=="V") { 
	          						echo number_format($envio->mercancia,2,",",".");
	 							}
	 							if($envio->tipo_cobro=="P") {
	 								echo number_format($envio->peso,2,",",".");
	 							}
	 							if($envio->tipo_cobro=="M") {
	 								echo number_format($envio->viaje,2,",",".");
	 							}
	                    	?>
                            </td>
            		</tr>			
            			<?php 
            					
	                			$total_bultos += $envio->bultos;
	                			$total_mercancia += $envio->mercancia;
	                			$total_peso += $envio->peso;
	                			$total_viaje += $envio->viaje;
                			}
                		?>	
                        <tr>
                        <td colspan="6">&nbsp;</td>
                        </tr>
            		<tr>
                    	<td class="text" colspan="11"><hr></td>
                	</tr>                        
                        	<td align="left">
                        	<strong>TOTAL DE BULTOS</strong>
                            </td>
                        	<td align="center">
                        	<strong><?php echo $total_bultos; ?></strong>
                            </td>
                        	<td colspan=2>
                        	<strong></strong>
                            </td>
                        	<td colspan=3 align="right">
	                		<?php 
	                			if($tipo_cobro=="V") { 
	          						$valor = "TOTAL VALOR DE LA MERCANCIA Bs.";
	 							}
	 							if($tipo_cobro=="P") {
	 								$valor = "TOTAL PESO DE LA MERCANCIA Kg";
	 							}
	 							if($tipo_cobro=="M") {
	 								$valor = "VALOR TOTAL DEL VIAJE Bs.";
	 							}
	                    	?>                          	
                        	<strong><?php echo $valor; ?></strong>
                            </td>
                        	<td align="right">
                        	<strong>
	                		<?php 
	                			if($tipo_cobro=="V") { 
	          						echo number_format($total_mercancia,2,",",".");
	 							}
	 							if($tipo_cobro=="P") {
	 								echo number_format($total_peso,2,",",".");
	 							}
	 							if($tipo_cobro=="M") {
	 								echo number_format($total_viaje,2,",",".");
	 							}
	                    	?>                        	
                        	</strong>
                            </td>
            		<tr>
                    	<td class="text" colspan="11"><hr></td>
                	</tr> 
                        <tr>
                        <td colspan="6">&nbsp;</td>
                    </tr>    
                   	<tr>
                        <td colspan="6">&nbsp;</td>
                  	</tr>
                  </table>
                  <table style="padding-left:15px; color:#999; font-size:11px; font-family:Arial, Helvetica, sans-serif;" width="800px">      
                        <tr>
	                        <td width="300px" style="border-bottom:1px solid">&nbsp;</td>
	                        <td width="100px">&nbsp;</td>
	                        <td width="450px" align="right" style="border-bottom:1px solid">&nbsp;</td>
                        </tr>   
                        <tr>
                        <td align="center" style=" font-size:14px; font-weight:bold">
                            POR INVERSIONES SPAY, C.A.
                            </td>
                        <td>&nbsp;</td>
                        <td align="center" style="font-size:14px; font-weight:bold">
                            POR <?php echo obtenerClienteStr($link, $id_cliente); ?>
                            </td>
                        </tr>
                        <tr>
                        <td width="300px">&nbsp;</td>
                        <td width="100px">&nbsp;</td>
                        <td width="450px">&nbsp;</td>
                        </tr> 
                        <tr>
                        <td colspan=3 style="font-size:16px; font-weight:bold">
                            </td>
                        </tr> 
                        <tr>
                        <td colspan=3 style="font-size:16px; font-weight:bold">
                            </td>
                        </tr>
                        <tr>
                        <td colspan=3 align="center" style="font-size:16px; font-weight:bold">
                            SE AGRADECE ENVIAR COPIA FIRMADA
                            </td>
                        </tr> 
                        <tr>
                        <td colspan=3 style="font-size:16px; font-weight:bold">
                            </td>
                        </tr>  
                        <td colspan=3 style="font-size:16px; font-weight:bold">
                            </td>
                        </tr> 
                 </table>                          
</body>
</html>
<?php include("inc_desconectarse.php"); ?>