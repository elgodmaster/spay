<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "facturas"; ?>
<?php include("inc_functions.php"); ?>	
<?php 

	if ($_POST["action"]!="" || $_GET["action"]!="") {
	
		if($_POST["action"]=="GenerarFacturaCliente") {
			$id_cliente = $_POST["id_cliente"];
			$remesa = $_POST["remesa"];
			$flete = $_POST["txtFlete"];
			$factura = ltrim($_POST["txtFactura"],"0"); 
			$cobrarSeguro = $_POST["cmbSeguro"];
			$seguro = $_POST["txtSeguro"];
			
			$action_result = generarFacturaCliente($link, $id_cliente, $flete, $remesa, $factura, 
			                                       $cobrarSeguro, $seguro, $_SESSION["envios"]);
	
			if(!action_result=="facturaYaExisteError") {
				$factura_cliente = "adm_consultar_factura_cliente.php?id=".obtenerIDFactura($link, $factura);
			}
			
			$_SESSION["envios"] = NULL;
		}
		
		if($_POST["action"]=="GenerarFacturaProveedor") {
			$id_proveedor = $_POST["id_proveedor"];
			$flete = $_POST["txtFlete"];
			$factura = $_POST["txtFactura"];
			$cobrarSeguro = $_POST["cmbSeguro"];
			$seguro = $_POST["txtSeguro"];
			
			$action_result = generarFacturaProveedor($link, $id_proveedor, $flete, $factura, $cobrarSeguro, 
			                                         $seguro, $_SESSION["envios"]);
			
			if(!action_result=="facturaYaExisteError") {
				$factura_proveedor = "adm_consultar_factura_proveedor.php?id=".obtenerIDFactura($link, $factura);
			}
			
			$_SESSION["envios"] = NULL;
		}
		
		if($_POST["action"]=="MarcarCobrada") {
			$id = $_GET["id"];
			$forma_pago = $_POST["cmbFormaPago"];
			$fecha_pago = $_POST["cmbAnoI"]."-".$_POST["cmbMesI"]."-".$_POST["cmbDiaI"];
			$numero = $_POST["txtNumero"];
			$banco = $_POST["txtBanco"];
			$observaciones = strtoupper($_POST["txtObservaciones"]);
			$action_result = facturaMarcarCobrada($link, $id, $forma_pago, $fecha_pago, $numero, $banco, $observaciones);
			$_POST["cmbAnoI"] = NULL; 
			$_POST["cmbMesI"] = NULL; 
			$_POST["cmbDiaI"] = NULL;
		}
		
		if($_POST["action"]=="Anular") {
			$id = $_GET["id"];
			$motivo = strtoupper($_POST["txtMotivo"]);
			$action_result = anularFactura($link, $id, $motivo);
		}
	}

	$variables = "page=".$_REQUEST["page"]."&txtBusqueda=".$_REQUEST["txtBusqueda"]."&cmbEstatusFactura=".$_REQUEST["cmbEstatusFactura"]."&cmbAnoI=".$_REQUEST["cmbAnoI"]."&cmbMesI=".$_REQUEST["cmbMesI"]."&cmbDiaI=".$_REQUEST["cmbDiaI"];
	
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
					
				<h1>Administrar Facturas</h1>	
								
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
                    		<form name="frmEnvio" action="adm_facturas.php" method="post" 
                    		 enctype="multipart/form-data" onSubmit="return validate_busqueda_factura_form(this);">                  		 
                    		  	<?php if(isset($_REQUEST["txtBusqueda"]) && $_REQUEST["txtBusqueda"]!="") { ?>
                    		 	<input type="button" class="button" value="LIMPIAR BUSQUEDA" 
                    		 	 onclick="javascript:document.location.href = 'adm_facturas.php';" />
                    		 	<?php } else { ?>
                    		 	<input style="height:10px" name="txtBusqueda" type="text" size="24" /> 
                    		 	&nbsp;<strong>ESTATUS</strong>&nbsp;
                    		 	<select name="cmbEstatusFactura">
                    		 		<option value=""></option>
                    		 		<option value=1 <?php if($_REQUEST["cmbEstatusFactura"]==1) {?> selected <?php } ?>>POR COBRAR</option>
                    		 		<option value=2 <?php if($_REQUEST["cmbEstatusFactura"]==2) {?> selected <?php } ?>>COBRADA</option>
                    		 		<option value=3 <?php if($_REQUEST["cmbEstatusFactura"]==3) {?> selected <?php } ?>>ANULADA</option>
                    		 	</select>
                    		 	&nbsp;
								<strong>FECHA</strong>
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
                    		  	<input name="action" type="hidden" value="Buscar" />
                    		 	<input type="submit" class="button" value="BUSCAR" />
                    		 	<?php } ?>
                    		</form>
                    		</td>
                		</tr>
                	</table>         
					<table style="padding-left:10px; font-size:11px" width="820px">
            			<tr>
                    		<td colspan="11"><hr></td>
                		</tr>            	
                		<tr>
                			<td width="80"><strong>FECHA</strong></td>
                			<td width="120" align="center"><strong># FACTURA</strong></td>
                			<td width="430"><strong>CLIENTE</strong></td>
                			<td width="60" align="center"><strong>BULTOS</strong></td>
                			<td width="120" align="right"><strong>TOTAL Bs</strong></td>
                    		<td width="120" style="padding-left:15px"><strong>ESTATUS</strong></td>
                            <td width="50"><strong>ACCIONES</strong></td>
                		</tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr>
                		<?php
						
						// Paginacion
						$rowsPerPage = getRowsPerPage($link);
						$page = getPage();
						$offset = ($page - 1) * $rowsPerPage;
				
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
							$query .= " AND ( f.numero_factura LIKE '%".$_REQUEST["txtBusqueda"]."%' 
							               OR p.nombre LIKE '%".$_REQUEST["txtBusqueda"]."%' 
							               OR c.nombre LIKE '%".$_REQUEST["txtBusqueda"]."%' )";
						}			           

						if($_REQUEST["cmbEstatusFactura"]!="") {
							$query .= " AND f.ind_factura=".$_REQUEST["cmbEstatusFactura"];
						}		
	
						$fechaI = $_REQUEST["cmbAnoIm"]."-".$_REQUEST["cmbMesIm"]."-".$_REQUEST["cmbDiaIm"];
						
						if($fechaI!="--") {
							$query .= " AND f.fecha_creacion='".$fechaI."' "; 
						}
							
						$query .= " ORDER BY f.fecha_creacion DESC, id DESC ";	
						
						$result = obtenerResultset($link,$query);

						$lastPage = ceil(numeroRegistros($result)/$rowsPerPage); 
						
						$query .= "LIMIT $offset, $rowsPerPage";
						$result = obtenerResultset($link,$query);
					
						while ($row = obtenerRegistro($result)) {
						
							$inactiva = false;
							if($row->ind_activo==0) {
								$inactiva = true;	
							}
							
							if($row->numero_guia=="") {
								$row->numero_guia = $row->id;
							}
 						?>               
          				<tr style="color: #000">
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>>
								<?php echo mostrarFecha($row->fecha_creacion); ?>
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
                            <td align="left">
                            	<?php if($row->tipo_factura=="P") { ?>
                                <a href="adm_consultar_factura_proveedor.php?id=<?php echo $row->id; ?>&<?php echo $variables; ?>" title="Ver Factura">
                                	<img src="images/icons/zoom.png" align="texttop" border="0" />
                           		</a>
                           		<?php } ?>
								<?php if($row->tipo_factura=="C") { ?>
                                <a href="adm_consultar_factura_cliente.php?id=<?php echo $row->id; ?>&<?php echo $variables; ?>" title="Ver Factura">
                                	<img src="images/icons/zoom.png" align="texttop" border="0" />
                           		</a>
                           		<?php } ?>
                           		<?php if($row->ind_factura==1) { ?>
                                <a href="adm_actualizar_factura.php?action=MarcarCobrada&id=<?php echo $row->id; ?>&<?php echo $variables; ?>" title="Marcar como Cobrada">
                                	<img src="images/icons/accept.png" align="texttop" border="0"  
                                     onclick="javascript:return confirm('Esta seguro que desea marcar esta Factura como cobrada?');"/>
                           		</a>
                                <a href="adm_actualizar_factura.php?action=Anular&id=<?php echo $row->id; ?>&<?php echo $variables; ?>" title="Anular">
                                	<img src="images/icons/cancel.png" align="texttop" border="0"  
                                     onclick="javascript:return confirm('Esta seguro que desea anular esta Factura?');"/>
                           		</a>
                           		<?php } ?>
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
                        	<td colspan="11" align="center">
                            <?php printPaginationNavigation($page,$lastPage, $variables); ?>
                            </td>
                        </tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr> 
                        <tr>
                        	<td colspan="6">&nbsp;</td>
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