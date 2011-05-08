<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "reportes"; ?>
<?php include("inc_functions.php"); ?>	
<?php 

	if ($_POST["action"]!="" || $_GET["action"]!="") {
	
		if($_GET["action"]=="EnviarRuta") {
			$action_result = enviarGuiaRuta($link,$_GET["id"]);
		}
				
		if ($_POST["action"]=="Modificar") {
			$guia->envios = $_POST["chkEnvio"];
			$guia->id_chofer = $_POST["cmbChofer"];
			$action_result = modificarGuia($link, $guia, $_POST["id"]); 
		}
				
		if ($_GET["action"]=="MarcarEntregada") {
			$id = $_GET["id"];
			$action_result = marcarGuiaEntregada($link,$id);
		}
		
		if($_GET["action"]=="Eliminar") {
			$id = $_GET["id"];
			$action_result = eliminarGuia($link,$id);
		}	
		
	}
	
	$variables = "page=".$_GET["page"]."&cmbEstatusGuia=".$_REQUEST["cmbEstatusGuia"]."&cmbAnoI=".$_REQUEST["cmbAnoI"]."&cmbMesI=".$_REQUEST["cmbMesI"]."&cmbDiaI=".$_REQUEST["cmbDiaI"];
	
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
					
				<h1>Reporte de Env&iacute;os</h1>
				
                    <table>
            			<tr>
                    		<td colspan="6">
                    		<form name="frmSP" action="adm_reporte_envios.php" method="post" 
                    		 enctype="multipart/form-data" onSubmit="return validate_busqueda_envio_form(this);">                  		 
                    		  	<?php if(isset($_REQUEST["txtBusqueda"]) && $_REQUEST["txtBusqueda"]!="") { ?>
                    		 	<input type="button" class="button" value="LIMPIAR BUSQUEDA" 
                    		 	 onclick="javascript:document.location.href = 'adm_guias.php';" />
                    		 	<?php } else { ?>
								&nbsp;<strong>FECHA INICIO</strong>
								&nbsp;
								<select name="cmbDiaI">
									<option value=""></option>
								<?php 
									$i=1;
									while ($i <= 31) {
								?>	
									<option value="<?php echo $i; ?>" <?php if($_REQUEST["cmbDiaI"]==$i) { ?> selected <?php } ?>>
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
									<option value="<?php echo $i; ?>" <?php if($_REQUEST["cmbMesI"]==$i) { ?> selected <?php } ?>>
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
									while ($i >= date("Y")-3) {
								?>	
									<option value="<?php echo $i; ?>" <?php if($_REQUEST["cmbAnoI"]==$i) { ?> selected <?php } ?>>
									<?php echo $i; ?>
									</option>
								<?php 
										$i--;
									}
								?>	
								</select>  
								&nbsp;&nbsp;
								<strong>FECHA FIN</strong>
								&nbsp;
								<select name="cmbDiaF">
									<option value=""></option>
								<?php 
									$i=1;
									while ($i <= 31) {
								?>	
									<option value="<?php echo $i; ?>" <?php if($_REQUEST["cmbDiaF"]==$i) { ?> selected <?php } ?>>
									<?php echo $i; ?>
									</option>
								<?php 
										$i++;
									}
								?>	
								</select>
								<select name="cmbMesF">
									<option value=""></option>
								<?php 
									$i=1;
									while ($i <= 12) {
								?>	
									<option value="<?php echo $i; ?>" <?php if($_REQUEST["cmbMesF"]==$i) { ?> selected <?php } ?>>
									<?php echo $i; ?>
									</option>
								<?php 
										$i++;
									}
								?>	
								</select>
								<select name="cmbAnoF">
									<option value=""></option>
								<?php 
									$i = date("Y");
									while ($i >= date("Y")-3) {
								?>	
									<option value="<?php echo $i; ?>" <?php if($_REQUEST["cmbAnoF"]==$i) { ?> selected <?php } ?>>
									<?php echo $i; ?>
									</option>
								<?php 
										$i--;
									}
								?>	
								</select>  
                    		 	<br/>
                    		 	<br/>	             
				   	 			<?php include("inc_lists.php"); ?>
								&nbsp;<strong>REGION</strong>
			                    <select name="cmbRegion" onChange="cargarEstados2(frmSP,0)">
			                    <option value="">SELECCIONE...</option>
			                    <?php 
									$result = obtenerRegiones($link);
									while($row=mysql_fetch_object($result)) {
								?>		
									<option value="<?php echo($row->id); ?>" 
									 <?php if($_POST["cmbRegion"]==$row->id) { ?> selected <?php } ?>>
									 <?php echo($row->nombre); ?>
			                       	</option>	
			                    <?php
									}
								?>
			                    </select>   
								&nbsp;<strong>ESTADO</strong>
			                  	<select name="cmbEstado" disabled=true"  onChange="cargarDestinos(frmSP,0)">
			                    </select>
			                    <?php if($_POST["cmbRegion"]!="") {?> 
			                    <script type="text/javascript" language="JavaScript">
			                    	cargarEstados2(frmSP,<?php echo $_POST["cmbEstado"]; ?>);
			                    </script>
			                    <?php }?>	  
								&nbsp;<strong>DESTINO</strong>
			                  	<select name="cmbDestino" disabled=true" >
			                    </select>
			                    <?php if($_POST["cmbEstado"]!="") {?> 
			                    <script type="text/javascript" language="JavaScript">
			                    	cargarDestinos(frmSP,<?php echo $_POST["cmbDestino"]; ?>);
			                    </script>
			                    <?php }?>
								<br />  
								<br />    
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
                    		 	&nbsp;<strong>CHOFER</strong>&nbsp;
                    		 	<select name="cmbChofer">
			                    <option value="">SELECCIONE...</option>
			                    <?php 
									$result = obtenerChoferes($link);
									while($row=mysql_fetch_object($result)) {
								?>		
									<option value="<?php echo($row->id); ?>" 
									 <?php if($_REQUEST["cmbChofer"]==$row->id) { ?> selected <?php } ?>>
									 <?php echo($row->nombre); ?>
			                       	</option>	
			                    <?php
									}
								?>
                    		 	</select>
								<br />  
								<br />              		 	
                    		  	<input name="action" type="hidden" value="Buscar" />
                    		 	<input type="submit" class="button" value="GENERAR REPORTE" />
                    		 	<?php } ?>
                    		</form>
                    		</td>
                		</tr>
                	</table>					
					<?php 
						if($_POST["action"]!="") {
					?>         
					<table style="padding-left:10px; font-size:11px" width="830px">
            			<tr>
                    		<td colspan="11"><hr></td>
                		</tr>            	
                		<tr>
                			<td width="60" align="center"><strong>BULTOS</strong></td>
                			<td width="80" align="center"><strong>VALOR MERCANCIA</strong></td>
                			<td width="80" align="center"><strong>FLETE VALOR</strong></td>
                			<td width="80" align="center"><strong>FLETE PESO</strong></td>
                			<td width="80" align="center"><strong>FLETE VIAJE</strong></td>
                		</tr>
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
                		</tr>
                		<?php
					
						// Determino el numero de paginas 
						$query = "SELECT SUM(e.bultos) as bultos, 
						                 SUM(e.mercancia) as mercancia,  
						                 SUM(e.mercancia*(e.flete/100)) as flete_valor, 
						                 SUM(e.peso) as peso, 
						                 SUM(e.peso*e.bskg) as flete_peso, 
						                 SUM(e.viaje) as viaje 
						            FROM ts_envio e ";

						if($_REQUEST["cmbChofer"]!="") {
							$query .= " JOIN ts_guia g ON e.id_guia = g.id AND g.id_chofer=".$_REQUEST["cmbChofer"]; 
						}
						
						if($_REQUEST["cmbDestino"]=="") {
							
							if($_REQUEST["cmbEstado"]!="") {
								$query .= " JOIN ts_destino d ON e.id_destino = d.id AND d.id_estado=".$_REQUEST["cmbEstado"]; 
							}
							elseif($_REQUEST["cmbRegion"]!="") { 
								$query .= " JOIN ts_destino d ON e.id_destino = d.id AND d.id_region=".$_REQUEST["cmbRegion"];
							}
						}
						
						
						
						$query .= " WHERE e.ind_activo = 1 "; 				           	

						$fechaI = $_REQUEST["cmbAnoI"]."-".$_REQUEST["cmbMesI"]."-".$_REQUEST["cmbDiaI"];
						$fechaF = $_REQUEST["cmbAnoF"]."-".$_REQUEST["cmbMesF"]."-".$_REQUEST["cmbDiaF"];
						
						if($fechaI!="--") {
							$query .= " AND e.fecha_creacion between '".$fechaI."' and '".$fechaF."' "; 
						}
						if($_REQUEST["cmbProveedor"]!="") {
							$query .= " AND e.id_proveedor=".$_REQUEST["cmbProveedor"]; 
						}
						if($_REQUEST["cmbCliente"]!="") {
							$query .= " AND e.id_cliente=".$_REQUEST["cmbCliente"]; 
						}
						
						if($_REQUEST["cmbDestino"]!="") {
							$query .= " AND e.id_destino=".$_REQUEST["cmbDestino"]; 
						}
						
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
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>  align="center"> 
								<strong><?php echo $row->bultos; ?></strong>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>  align="center"> 
								<strong><?php echo number_format($row->mercancia,2,",",".");  ?></strong>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>  align="center"> 
								<strong><?php echo number_format($row->flete_valor,2,",",".");  ?></strong>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>  align="center"> 
								<strong><?php echo number_format($row->flete_peso,2,",",".");  ?></strong>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>  align="center"> 
								<strong><?php echo number_format($row->viaje,2,",",".");  ?></strong>
                    		</td>
                    		<?php 
							} 
							?>
                            </td>
            			</tr>	
            			<tr>
                    		<td class="text" colspan="11"><hr></td>
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