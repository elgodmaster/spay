<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "guias"; ?>
<?php include("inc_functions.php"); ?>	
<?php 
	$guia = obtenerGuia($link, $_GET["id"]);
	$chofer = obtenerChofer($link, $guia->id_chofer);
	$usuario = obtenerUsuario($link, $_SESSION["id_usuario"]);
?>	

                    <table width="1250px" style="font-family:Arial, Helvetica, sans-serif;">
            			<tr>
                    		<td colspan="6">
							<table valign="top" border=0 style="padding-left:10px">
								<tr>
									<td width="70px">
										<img src="images/logo_small.jpg" width="70px" height="95px" />
									</td>
									<td align="left" valign="middle" style="padding:5px 5px 10px 10px; 
									 color:#999; font-size:10px" width="500px">
										<strong style="font-size:14px">INVERSIONES SPAY, C.A.</strong>
                                        <br />
                                        <strong style="font-size:10px">NIT 0-187590205</strong>
                                        <br />
                                        Av. Victoria entre calle Chile con Internacional, <br />
                                        Urb. Las Acacias, Edif. Bologna, PB, Local 1, Caracas. <br />
                                        Tel&eacute;fonos: (58-0212) 633.31.89 - Fax: (58-212) 632.8383 <br />
                                        E-mail: transportespay@gmail.com
									</td>
                                    <td align="right" valign="top" width="660x" style="font-size:16px; color:#999">     
                                    <?php 
                                    	if($guia->numero_guia=="") {
                                    		$guia->numero_guia = $guia->id;
                                    		$str_guia = "GUIA TEMPORAL";
                                    	}
                                    	else {
                                    		$str_guia = "GUIA";
                                    	}
                                    ?>
                                    <?php echo $str_guia; ?> N&deg; 
                                    
                                    <strong style="font-size:22px">
                                    <?php echo str_pad($guia->numero_guia, 4, "0", STR_PAD_LEFT); ?>
                                    </strong>
                                    <br /><br />
                                    <strong  style="font-size:14px">
                                    	<?php echo "PLACA CAMION ".$chofer->placa; ?>
                                    </strong>
                                    <br /><br />
                                    <strong>
                                    	<?php echo "CARACAS, ".mostrarFecha($guia->fecha_creacion); ?>	
                                    </strong>
                                    </td>
								</tr>
							</table>							
                    		</td>
                		</tr> 
                	</table>	
					<table style="padding-left:10px; font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#999" width="1250px">
            			<tr>
                    		<td colspan="11"><hr></td>
                		</tr>            	
                		<tr>
                			<td width="300" align="left"><strong>PROVEEDOR</strong></td>
                			<td width="40" align="center"><strong>BULTOS</strong></td>
                			<td width="60" align="center"><strong>REMESA</strong></td>
                			<td width="70" align="center"><strong>FACTURA</strong></td>
                			<td width="400" align="left"><strong>CLIENTE</strong></td>
                			<td width="110" align="left"><strong>DESTINO</strong></td>
                			<td width="90" align="left"><strong>PAGADERO</strong></td>
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
						             AND e.id_guia=".$guia->id."  
						        ORDER BY e.fecha_creacion DESC, e.remesa, e.factura";

						$result = obtenerResultset($link,$query);
					
						while ($row = obtenerRegistro($result)) {
						
							$inactiva = false;
							if($row->ind_activo==0) {
								$inactiva = true;	
							}
 						?>               
          				<tr>
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
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="left">
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
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="left">
								<?php echo obtenerClienteStr($link, $row->id_cliente); ?>
                    		</td> 
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="left">
								<?php echo obtenerDestinoStr($link, $row->id_destino); ?>
                    		</td>    
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="left">
								<?php echo pagadero($row->tipo_envio); ?>
                    		</td>                 		
                    		<td align="right">
								<?php echo number_format($row->mercancia,2,",","."); ?>
                    		</td>
                    		<td align="center">
								<?php if($row->flete!="") { echo number_format($row->flete,2,",","."); ?>%<?php } ?>
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
                		</tr>                    		<?php 
							$query = "SELECT id_guia,
							                 COUNT(1) facturas, 
							                 SUM(bultos) bultos,
							                 SUM(mercancia) mercancia,
							                 SUM((flete/100)*mercancia) flete,
							                 SUM(viaje) viaje,
							                 SUM(peso*bskg) peso
							            FROM ts_envio
							           WHERE id_guia=".$guia->id." 
							         GROUP BY id_guia";      
							 $result2 = obtenerResultset($link, $query);
							 $totales = obtenerRegistro($result2);         		
                		?>                         
                        <tr>
                        	<td align="left">
                        		<strong>BULTOS</strong>
                            </td>
                        	<td align="center">
                        		<strong><?php echo $totales->bultos; ?></strong>
                            </td>
                        	<td align="center">
                        		<strong>FACTURAS</strong>
                            </td>
                        	<td align="center">
                        		<strong><?php echo $totales->facturas; ?></strong>
                            </td>
                        	<td align="left">
                        		<strong>&nbsp;</strong>
                            </td>
                        	<td align="left">
                        		<strong>&nbsp;</strong>
                            </td>
                        	<td align="left">
                        		<strong>TOTAL Bs.</strong>
                            </td>
                        	<td align="right">
                        		<strong>
                        		<?php 
									if(!$_GET["valor"]=="no") {
                        				echo  number_format($totales->mercancia,2,",",".");
									} 
                        		?>
                        		</strong>
                            </td>
                        	<td align="right">
                        		<strong>&nbsp;</strong>
                            </td>
                        	<td align="right">
                        		<strong>
                        		<?php 
									if(!$_GET["flete"]=="no") {
										echo  number_format(($totales->flete + $totales->peso + $totales->viaje),2,",","."); 
									}
								?>
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
                        	<td colspan="6"></td>
                        </tr>                                                                                               
          			</table>
                  	<table style="padding-left:10px; font-family:Arial, Helvetica, sans-serif; color:#999" width="850px">  
                        <tr>
                        	<td>&nbsp;</td>
                        	<td>&nbsp;</td>
                        	<td>&nbsp;</td>
                        	<td>&nbsp;</td>
                        	<td>&nbsp;</td>
                        </tr>
                        <tr>
                        	<td>&nbsp;</td>
                        	<td>&nbsp;</td>
                        	<td>&nbsp;</td>
                        	<td>&nbsp;</td>
                        	<td>&nbsp;</td>
                        </tr>    
                        <tr>
                        	<td width="300px" align="center" style="border-bottom:1px solid">
                        	<strong><?php echo strtoupper($usuario->nombre); ?></strong>
                        	</td>
                        	<td width="60px">&nbsp;</td>
                        	<td width="300px"  align="center" style="border-bottom:1px solid">
                        	<strong><?php echo $chofer->nombre; ?></strong>
                        	</td>
                        	<td width="60px">&nbsp;</td>
                        	<td width="300px"  align="right" style="border-bottom:1px solid">&nbsp;</td>
                        </tr>   
                        <tr>
                        	<td align="center" style=" font-size:14px; font-weight:bold">
                            POR INVERSIONES SPAY, C.A.
                            </td>
                        	<td>&nbsp;</td>
                        	<td align="center" style=" font-size:14px; font-weight:bold">
                            NOMBRE DEL CHOFER
                            </td>
                        	<td>&nbsp;</td>
                        	<td align="center" style="font-size:14px; font-weight:bold">
                            <?php echo $chofer->cedula; ?> POR EL CHOFER
                            </td>
                        </tr>
                        <tr>
                        	<td>&nbsp;</td>
                        	<td>&nbsp;</td>
                        	<td>&nbsp;</td>
                        	<td>&nbsp;</td>
                        	<td>&nbsp;</td>
                        </tr>
                        <tr>
                        	<td colspan=3 style="font-size:16px; font-weight:bold">
                            </td>
                        </tr> 
                 	</table>         
</body>
</html>
<?php include("inc_desconectarse.php"); ?>