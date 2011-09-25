<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "envios"; ?>
<?php include("inc_functions.php"); ?>	
<?php 
	$envio = obtenerEnvio($link,$_GET["id"]);
    $observaciones = $envio->nota_entrega;
	$tipo_cobro = $envio->tipo_cobro;
	$id_cliente = $envio->id_cliente;
	$query = "SELECT * 
	            FROM ts_envio 
	           WHERE fecha_creacion = '".$envio->fecha_creacion."' 
	             AND remesa = ".$envio->remesa;
	$result = mysql_query($query, $link);
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
					
				<h1>Nota de Entrega</h1>
				<div align="right">
				<a href="adm_envios.php" class="orange">
				<strong><< Regresar</strong>
				</a>
				</div>	
				<div align="left" style="padding:0px 0px 20px 15px">
				<a href="adm_nota_de_entrega_imp.php?id=<?php echo $envio->id; ?>" target="_blank">
                	<img src="images/icons/printer.png" align="texttop" border="0" />
                    <strong>Versi&oacute;n Imprimible</strong>
              	</a>
				</div>
				
                    <table width="800px">
            			<tr>
                    		<td colspan="6">
							<table valign="top" border=0 style="padding-left:10px">
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
                                    <td align="right" valign="top" width="300px" style="font-size:16px">
                                    NOTA DE ENTREGA N&deg; <strong style="font-size:22px">
                                    <?php echo str_pad($envio->remesa, 4, "0", STR_PAD_LEFT); ?>
                                    </strong>
                                    <br /><br />
                                    <strong><?php echo mostrarFecha($envio->fecha_creacion); ?></strong>
                                    </td>
								</tr>
							</table>
                    		</td>
                		</tr>
                	</table>					
					<table style="padding-left:10px; font-size:11px" width="830px">
            			<tr>
                    		<td colspan="11"><hr></td>
                		</tr>            	
                		<tr>
                			<td width="350"><strong>PROVEEDOR</strong></td>
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
                    	<td width="130" align="right"><strong><?php echo $valor; ?></strong></td>	
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
          				<tr style="color: #000">
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
                        <tr>
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
                        </tr>
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
                  	<table style="padding-left:10px" width="800px">      
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
                        	<td colspan="3">
                        	<?php if ($observaciones!="") { ?>
                        	<strong>OBSERVACIONES:</strong><br/>
                        	<?php echo $observaciones; ?>
                        	<?php } ?>
                        	</td>
                        </tr>
                        <tr>
                        	<td width="300px">&nbsp;</td>
                        	<td width="100px">&nbsp;</td>
                        	<td width="450px">&nbsp;</td>
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
                        	<td colspan=4 style="border-bottom:2px dashed">&nbsp;</td>
                        </tr>
                 	</table>                                 
	  		</div> 	
	<!-- content-wrap ends here -->	
	</div>
<!-- wrap ends here -->
</div>		
<?php include("inc_footer.php"); ?>
</body>
</html>
<?php include("inc_desconectarse.php"); ?>