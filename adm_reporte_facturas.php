<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "reportes"; ?>
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
					
				<h1>Reporte de Facturas</h1>	
								
				<?php include("inc_mensajes_crud.php"); ?>  	
				<p><?php include("inc_mensajes.php"); ?></p> 
				<?php if($factura_cliente!="") { ?>   
				<span style="padding-left:15px">
				<strong>Haga <a href="<?php echo $factura_cliente; ?>">click aqui</a> para ver la Factura</strong>    
				</span>
				<?php } ?>    
				<?php if($factura_proveedor!="") { ?>   
				<span style="padding-left:15px">
				<strong>Haga <a href="<?php echo $factura_proveedor; ?>">click aqui</a> para ver la Factura</strong>    
				</span>
				<?php } ?> 
                    <table>
            			<tr>
                    		<td colspan="6">
                    		<form name="frmEnvio" action="adm_reporte_facturas.php" method="post" 
                    		 enctype="multipart/form-data" onSubmit="return validate_busqueda_factura_form(this);">                  		 
								&nbsp;<strong>FECHA INICIO</strong>
								&nbsp;
								<select name="cmbDiaIm">
									<option value=""></option>
								<?php 
									$i=1;
									while ($i <= 31) {
								?>	
									<option value="<?php echo $i; ?>" <?php if($_REQUEST["cmbDiaIm"]==$i) { ?> selected <?php } ?>>
									<?php echo $i; ?>
									</option>
								<?php 
										$i++;
									}
								?>	
								</select>
								<select name="cmbMesIm">
									<option value=""></option>
								<?php 
									$i=1;
									while ($i <= 12) {
								?>	
									<option value="<?php echo $i; ?>" <?php if($_REQUEST["cmbMesIm"]==$i) { ?> selected <?php } ?>>
									<?php echo $i; ?>
									</option>
								<?php 
										$i++;
									}
								?>	
								</select>
								<select name="cmbAnoIm">
									<option value=""></option>
								<?php 
									$i = date("Y");
									while ($i >= date("Y")-10) {
								?>	
									<option value="<?php echo $i; ?>" <?php if($_REQUEST["cmbAnoIm"]==$i) { ?> selected <?php } ?>>
									<?php echo $i; ?>
									</option>
								<?php 
										$i--;
									}
								?>	
								</select>  
                    		 	&nbsp;
								<strong>FECHA FIN</strong>
								&nbsp;
								<select name="cmbDiaFm">
									<option value=""></option>
								<?php 
									$i=1;
									while ($i <= 31) {
								?>	
									<option value="<?php echo $i; ?>" <?php if($_REQUEST["cmbDiaFm"]==$i) { ?> selected <?php } ?>>
									<?php echo $i; ?>
									</option>
								<?php 
										$i++;
									}
								?>	
								</select>
								<select name="cmbMesFm">
									<option value=""></option>
								<?php 
									$i=1;
									while ($i <= 12) {
								?>	
									<option value="<?php echo $i; ?>" <?php if($_REQUEST["cmbMesFm"]==$i) { ?> selected <?php } ?>>
									<?php echo $i; ?>
									</option>
								<?php 
										$i++;
									}
								?>	
								</select>
								<select name="cmbAnoFm">
									<option value=""></option>
								<?php 
									$i = date("Y");
									while ($i >= date("Y")-10) {
								?>	
									<option value="<?php echo $i; ?>" <?php if($_REQUEST["cmbAnoFm"]==$i) { ?> selected <?php } ?>>
									<?php echo $i; ?>
									</option>
								<?php 
										$i--;
									}
								?>	
								</select>  
								<br /><br /> 
                    		 	&nbsp;<strong>PROVEEDOR</strong>&nbsp;
                    		 	<select name="cmbProveedor">
			                    <option value="">SELECCIONE...</option>
			                    <?php 
									$result = obtenerProveedores($link);
									while($row=mysql_fetch_object($result)) {
								?>		
									<option value="<?php echo($row->id); ?>" 
									 <?php if($_REQUEST["cmbProveedor"]==$row->id) { ?> selected <?php } ?>>
									 <?php echo($row->nombre); ?>
			                       	</option>	
			                    <?php
									}
								?>
                    		 	</select>
								<br />  
								<br />    
                    		 	&nbsp;<strong>CLIENTE</strong>&nbsp;
                    		 	<select name="cmbCliente">
			                    <option value="">SELECCIONE...</option>
			                    <?php 
									$result = obtenerClientes($link);
									while($row=mysql_fetch_object($result)) {
								?>		
									<option value="<?php echo($row->id); ?>" 
									 <?php if($_REQUEST["cmbCliente"]==$row->id) { ?> selected <?php } ?>>
									 <?php echo($row->nombre); ?>
			                       	</option>	
			                    <?php
									}
								?>
                    		 	</select>
								<br />       
								<br />  
								&nbsp;<strong>ESTATUS</strong>&nbsp;
                    		 	<select name="cmbEstatusFactura">
                    		 		<option value=""></option>
                    		 		<option value=1 <?php if($_REQUEST["cmbEstatusFactura"]==1) {?> selected <?php } ?>>POR COBRAR</option>
                    		 		<option value=2 <?php if($_REQUEST["cmbEstatusFactura"]==2) {?> selected <?php } ?>>COBRADA</option>
                    		 		<option value=3 <?php if($_REQUEST["cmbEstatusFactura"]==3) {?> selected <?php } ?>>ANULADA</option>
                    		 	</select>
								<br /><br />                 		 	
                    		  	<input name="action" type="hidden" value="Buscar" />
                    		 	<input type="submit" class="button" value="GENERAR REPORTE" />
                    		</form>
                    		</td>
                		</tr>
                	</table>         
                	<?php if($_POST["action"]!="") { ?>
					<table style="padding-left:10px; font-size:11px" width="200px">
            	  <!--  <tr>
                    		<td colspan="11"><hr></td>
                		</tr>            	
                		<tr>
                			<td width="80"><strong>FECHA</strong></td>
                			<td width="120" align="center"><strong># FACTURA</strong></td>
                			<td width="430"><strong>CLIENTE</strong></td>
                			<td width="60" align="center"><strong>BULTOS</strong></td>
                			<td width="120" align="right"><strong>TOTAL Bs</strong></td>
                    		<td width="120" style="padding-left:15px"><strong>ESTATUS</strong></td>
                		</tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr>
                 -->
                		<?php
						$total_facturas = 0;
						// Determino el numero de paginas 
						$query = "SELECT f.*, 
						                 u.login, 
						                 c.nombre as cliente,
						                 p.nombre as proveedor 
						            FROM ((( ts_factura f JOIN ts_usuario u ON f.id_usuario = u.id ) 
						                 LEFT JOIN ts_cliente c ON f.id_cliente = c.id)  
						                 LEFT JOIN ts_proveedor p ON f.id_proveedor = p.id ) 
						           WHERE f.ind_activo < 2 "; 		

						if($_REQUEST["txtBusqueda"]!="") {
							$query .= " AND f.numero_factura LIKE '%".$_REQUEST["txtBusqueda"]."%' ";
						}			           

						if($_REQUEST["cmbEstatusFactura"]!="") {
							$query .= " AND f.ind_factura=".$_REQUEST["cmbEstatusFactura"];
						}		
	
						$fechaI = $_REQUEST["cmbAnoIm"]."-".$_REQUEST["cmbMesIm"]."-".$_REQUEST["cmbDiaIm"];
						$fechaF = $_REQUEST["cmbAnoFm"]."-".$_REQUEST["cmbMesFm"]."-".$_REQUEST["cmbDiaFm"];
						
						if($fechaI!="--") {
							$query .= " AND f.fecha_modificacion between '".$fechaI."' and '".$fechaF."' "; 
						}
						if($_REQUEST["cmbProveedor"]!="") {
							$query .= " AND f.id_proveedor=".$_REQUEST["cmbProveedor"]; 
						}
						if($_REQUEST["cmbCliente"]!="") {
							$query .= " AND f.id_cliente=".$_REQUEST["cmbCliente"]; 
						}
							
						$query .= " ORDER BY f.fecha_modificacion DESC, id DESC ";	
						
						$result = obtenerResultset($link,$query);
					
						while ($row = obtenerRegistro($result)) {
						
							$inactiva = false;
							if($row->ind_activo==0) {
								$inactiva = true;	
							}
							
							if($row->numero_guia=="") {
								$row->numero_guia = $row->id;
							}
							
							$total_facturas += $row->total_pagar;
 						?>         
 						<!--       
          				<tr style="color: #000">
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<?php echo mostrarFecha($row->fecha_modificacion); ?>
                    		</td> 
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?> align="center">
								<?php echo str_pad($row->numero_factura, 9, "0", STR_PAD_LEFT); ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>> 
								<?php echo substr($row->cliente.$row->proveedor,0,33); ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>  align="center"> 
								<?php echo $row->total_bultos; ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>  align="right"> 
								<?php echo number_format($row->total_pagar,2,",",".");  ?>
                    		</td>
                    		<td style="color:<?php echo colorIndFactura($row->ind_factura); ?>; font-size:9px; padding-left:15px">
								<strong><?php echo indFacturaStr($row->ind_factura); ?></strong>
                    		</td>
            			</tr>	
            			-->	
						<?php } ?>
                        
                        <tr>
                        	<td colspan="4">&nbsp;</td>
                        </tr>
            			<tr>
                    		<td class="text" colspan="5"><hr></td>
                		</tr>                        
	                        <tr>
	                        	<td colspan="1" align="left">
	                        	<strong>TOTAL Bs.</strong> 
	                        	</td>
                        	<td align="left">
                        	<strong>
                        	<?php echo number_format($total_facturas,2,",",".");  ?>
                        	</strong>
                        	</td>
                        </tr>
            			<tr>
                    		<td class="text" colspan="5"><hr></td>
                		</tr> 
                        <tr>
                        	<td colspan="6">&nbsp;</td>
                        </tr>  
                                                                                                                                
          			</table>   
          			<?php } ?>                        
                								
	  		</div> 	
	<!-- content-wrap ends here -->	
	</div>
<!-- wrap ends here -->
</div>		
<?php include("inc_footer.php"); ?>
</body>
</html>
<?php include("inc_desconectarse.php"); ?>