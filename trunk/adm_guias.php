<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "guias"; ?>
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
		
		if($_POST["action"]=="RegistrarPagoChofer") {
			$pago->id = $_GET["id"];
			$pago->forma_pago = $_POST["cmbFormaPago"];
			$pago->fecha_pago = $_POST["cmbAnoI"]."-".$_POST["cmbMesI"]."-".$_POST["cmbDiaI"];
			$pago->numero = $_POST["txtNumero"];
			$pago->banco = $_POST["txtBanco"];
			$pago->observaciones = strtoupper($_POST["txtObservaciones"]);
			$pago->flete = $_POST["txtFlete"];
			$action_result = registrarPagoChofer($link, $pago);
			$_REQUEST["cmbAnoI"] = NULL; 
			$_REQUEST["cmbMesI"] = NULL; 
			$_REQUEST["cmbDiaI"] = NULL;
		}
		
	}
	
	$variables = "page=".$_REQUEST["page"]."&cmbEstatusGuia=".$_REQUEST["cmbEstatusGuia"]."&cmbAnoI=".$_REQUEST["cmbAnoI"]."&cmbMesI=".$_REQUEST["cmbMesI"]."&cmbDiaI=".$_REQUEST["cmbDiaI"]."&cmbChofer=".$_REQUEST["cmbChofer"];
	
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
					
				<h1>Administrar Gu&iacute;as</h1>
				
                    <table>
            			<tr>
                    		<td colspan="6">
                    		<form name="frmEnvio" action="adm_guias.php" method="post" 
                    		 enctype="multipart/form-data" onSubmit="return validate_busqueda_envio_form(this);">                  		 
                    		  	<?php if(isset($_REQUEST["txtBusqueda"]) && $_REQUEST["txtBusqueda"]!="") { ?>
                    		 	<input type="button" class="button" value="LIMPIAR BUSQUEDA" 
                    		 	 onclick="javascript:document.location.href = 'adm_guias.php';" />
                    		 	<?php } else { ?>
                    		 	&nbsp;<strong>CHOFER</strong>&nbsp;
                    		 	<select name="cmbChofer">
                    		 		<option value=""></option>
                    		 		<?php
                    		 			$choferes = obtenerChoferes($link,1);
                    		 			while($chofer = obtenerRegistro($choferes)) {
                    		 		?>
                    		 		<option value="<?php echo $chofer->id; ?>" 
                    		 		 <?php if($_REQUEST["cmbChofer"]==$chofer->id) { ?> selected <?php } ?>>
                    		 		<?php echo $chofer->nombre; ?>
                    		 		</option>
                    		 		<?php } ?>
                    		 	</select>
                    		 	&nbsp;<strong>ESTATUS</strong>&nbsp;
                    		 	<select name="cmbEstatusGuia">
                    		 		<option value=""></option>
                    		 		<option value=0 <?php if($_REQUEST["cmbEstatusGuia"]==0 && $_REQUEST["cmbEstatusGuia"]!="") {?> selected <?php } ?>>TEMPORAL</option>
                    		 		<option value=1 <?php if($_REQUEST["cmbEstatusGuia"]==1) {?> selected <?php } ?>>EN RUTA</option>
                    		 		<option value=2 <?php if($_REQUEST["cmbEstatusGuia"]==2) {?> selected <?php } ?>>ENTREGADA</option>
                    		 	</select>
                    		 	&nbsp;
								<strong>FECHA</strong>
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
									while ($i >= date("Y")-10) {
								?>	
									<option value="<?php echo $i; ?>" <?php if($_REQUEST["cmbAnoI"]==$i) { ?> selected <?php } ?>>
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
					<?php include("inc_mensajes_crud.php"); ?>           
					<table style="padding-left:10px; font-size:11px" width="830px">
            			<tr>
                    		<td colspan="11"><hr></td>
                		</tr>            	
                		<tr>
                			<td width="80"><strong>FECHA</strong></td>
                			<td width="80" align="center"><strong># GUIA</strong></td>
                			<td width="250"><strong>CHOFER</strong></td>
                			<td width="60" align="center"><strong>BULTOS</strong></td>
                			<td width="60" align="center"><strong>FACTURAS</strong></td>
                			<td width="80" align="right"><strong>MERCANCIA</strong></td>
                			<td width="60" align="right"><strong>FLETE</strong></td>
                    		<td width="80" style="padding-left:15px"><strong>ESTATUS</strong></td>
                            <td width="100"><strong>ACCIONES</strong></td>
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
						$query = "SELECT g.*, u.login, c.nombre as chofer 
						            FROM ts_guia g, ts_usuario u,
						                 ts_chofer c
						           WHERE g.id_usuario = u.id 
						             AND g.ind_activo < 2
						             AND g.id_chofer = c.id "; 				           
						
						if($_REQUEST["cmbEstatusGuia"]!="") {
							$query .= " AND g.ind_guia=".$_REQUEST["cmbEstatusGuia"];
						}				           
						
						if($_REQUEST["cmbChofer"]!="") {
							$query .= " AND g.id_chofer=".$_REQUEST["cmbChofer"];
						}		

						$fechaI = $_REQUEST["cmbAnoI"]."-".$_REQUEST["cmbMesI"]."-".$_REQUEST["cmbDiaI"];
						
						if($fechaI!="--") {
							$query .= " AND g.fecha_creacion='".$fechaI."' "; 
						}
						
						$query .= " ORDER BY g.fecha_creacion DESC, id DESC ";	
						
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
								<?php echo str_pad($row->numero_guia, 4, "0", STR_PAD_LEFT); ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>> 
								<?php echo $row->chofer; ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>  align="center"> 
								<?php echo $row->total_bultos; ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>  align="center"> 
								<?php echo $row->total_facturas; ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>  align="right"> 
								<?php echo number_format($row->total_mercancia,2,",",".");  ?>
                    		</td>
                			<td <?php if($inactiva) {?> style="color:#999;" <?php } ?>  align="right"> 
								<?php echo number_format($row->total_flete,2,",","."); ?>
                    		</td>
                    		<td style="color:<?php echo colorIndGuia($row->ind_guia); ?>; font-size:9px; padding-left:15px">
								<strong><?php echo indGuiaStr($row->ind_guia); ?></strong>
                    		</td>
                            <td align="left">
                                <a href="adm_consultar_guia.php?id=<?php echo $row->id; ?>&<?php echo $variables; ?>" title="Consultar">
                                	<img src="images/icons/zoom.png" align="texttop" border="0" />
                           		</a>
                                <a href="adm_guia_de_entrega.php?id=<?php echo $row->id; ?>&<?php echo $variables; ?>" title="Imprimir Gu&iacute;a">
                                	<img src="images/icons/printer.png" align="texttop" border="0" />
                           		</a>
                           		<?php if($row->ind_guia==0) { ?>
                            	<a href="adm_guias.php?action=EnviarRuta&id=<?php echo $row->id; ?>&<?php echo $variables; ?>" title="Enviar a Ruta">
                                	<img align="texttop" src="images/icons/lorry.png" border="0"  
                                     onclick="javascript:return confirm('Esta seguro que desea enviar esta Guia a Ruta?');"/>
                               	</a>                            	
                            	<a href="adm_modificar_guia.php?action=Modificar&id=<?php echo $row->id; ?>&<?php echo $variables; ?>" title="Modificar">
                                	<img align="texttop" src="images/icons/pencil.png" border="0" />
                               	</a>
                                <a href="adm_guias.php?action=Eliminar&id=<?php echo $row->id; ?>&<?php echo $variables; ?>" title="Eliminar">
                                	<img src="images/icons/cross.png" align="texttop" border="0" 
                                     onclick="javascript:return confirm('Esta seguro que desea eliminar?');" />
                           		</a>
                           		<?php } ?>
                           		<?php if($row->ind_guia==1) { ?>
                                <a href="adm_guias.php?action=MarcarEntregada&id=<?php echo $row->id; ?>&<?php echo $variables; ?>" title="Marcar como Entregada">
                                	<img src="images/icons/accept.png" align="texttop" border="0"  
                                     onclick="javascript:return confirm('Esta seguro que desea marcar esta Guia como Entregada?');"/>
                           		</a>
                           		<?php } ?>
                           		<?php if($row->ind_guia==2 && $row->ind_pagada==0) { ?>
                                <a href="adm_actualizar_guia.php?id=<?php echo $row->id; ?>&action=RegistrarPagoChofer" title="Registrar Pago a Chofer">
                                	<img src="images/icons/money.png" align="texttop" border="0"  
                                     onclick="javascript:return confirm('Esta seguro que desea realizar esta accion?');"/>
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