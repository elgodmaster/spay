<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "facturas"; ?>
<?php include("inc_functions.php"); ?>	
<?php 

	$envios = $_POST["chkEnvio"];
	if($envios=="") {
		$envios = $_SESSION["envios"]; 
	}
	$_SESSION["envios"] = $envios;
		
	$factura->proveedor = "";
	$factura->factura = "";
	$factura->total_bultos;
	$factura->total_mercancia = 0;
	$factura->total_peso = 0;
	$factura->flete = 0;
	$factura->bskg = 0;
	$factura->total_viaje = 0;
	$factura->seguro = obtenerSeguro($link);
	
	foreach($envios as $id_envio) {
		
		// Obtengo el envio
		$query = "SELECT * FROM ts_envio WHERE id=".$id_envio;
		$result = mysql_query($query, $link);
		$row = mysql_fetch_object($result);
		
		if($factura->cliente=="") { 
			$factura->cliente = obtenerProveedor($link, $row->id_proveedor);
		}
		
		$factura->proveedor .= obtenerProveedorStr($link, $row->id_proveedor).", ";
		$factura->factura .= $row->factura.", ";
		$factura->total_bultos += $row->bultos;
		$factura->total_mercancia += $row->mercancia;
		$factura->total_peso += $row->peso;
		$factura->total_flete_mercancia += $row->mercancia*($row->flete/100);
		$factura->total_flete_peso += $row->peso*$row->bskg;
		$factura->total_viaje += $row->viaje;
		if($factura->flete==0) $factura->flete = $row->flete;
		if($factura->tipo_cobro=="") $factura->tipo_cobro = $row->tipo_cobro; 
	}
	
	$factura->proveedor = substr($factura->proveedor,0,-2);
	$factura->factura = substr($factura->factura,0,-2);
	$factura->total_flete = $factura->total_flete_mercancia + $factura->total_flete_peso + $factura->total_viaje;
	$factura->iva = obtenerIVA($link);
	$factura->total_iva = ($factura->iva/100)*$factura->total_flete;
	$factura->seguro = obtenerSeguro($link);
	$factura->total_seguro;	
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
					
				<h1>Generar Factura</h1>
				<form name="frmSP" action="adm_facturas.php" method="post" enctype="multipart/form-data" 
                 onSubmit="return validate_factura_proveedor_form(this);" 
                 style="background-color:#FFF; border:none;	margin:0px; padding: 0px;">					
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
                                    <td align="right" valign="top" width="220px">    
                                    <br /><br />	
                                    <strong style="padding-right:5px">FECHA</strong>
									<input name="txtFecha" type="text" size="8" style="text-transform:uppercase" 
				                     value="<?php echo date("d/m/Y"); ?>" disabled />    
                                    <br /><br />										
				                    <strong style="padding-right:5px">RIF</strong>
									<input name="txtRIF" type="text" size="12" style="text-transform:uppercase; text-align:right" 
				                     value="<?php echo $factura->cliente->rif; ?>" disabled />	   
                                    <br /><br />
                                    <strong style="padding-right:5px">FACTURA N&deg;</strong>
									<input name="txtFactura" type="text" size="8" style="text-align:right" />    
                                    <br /><br />	
                                    </td>
								</tr>
							</table>
                    		</td>
                		</tr>
                	</table>	
                   	             
				    <?php include("inc_lists.php"); ?>     
				    <p>          													
                    <strong style="padding-right:5px">NOMBRE O RAZON SOCIAL</strong>
					<input name="txtNombre" type="text" size="76" style="text-transform:uppercase" 
                     value="<?php echo $factura->cliente->nombre; ?>" disabled />  	
                    <br /><br />													
                    <strong style="padding-right:5px">DIRECCION FISCAL</strong>
					<input name="txtDireccion" type="text" size="85" style="text-transform:uppercase" 
                     value="<?php echo $factura->cliente->direccion; ?>" disabled />   
                    <br /><br />
                    <strong style="padding-right:5px">CIUDAD</strong>
					<input name="txtCiudad" type="text" size="31" style="text-transform:uppercase" 
                     value="<?php echo $factura->cliente->ciudad; ?>" disabled /> 
                    &nbsp;                     	 														
                    <strong style="padding-right:5px">TELEFONOS</strong>
					<input name="txtTelefono" type="text" size="41" style="text-transform:uppercase" 
                     value="<?php echo $factura->cliente->telefono; ?>" disabled />  	
                    <br /><br />													
                    <strong style="padding-right:5px">PROVEEDOR</strong>
					<input name="txtProveedor" type="text" size="92" style="text-transform:uppercase" 
                     disabled />    	
                    <br /><br />													
                    <strong style="padding-right:5px">N&deg; FACTURA O GUIA</strong>
					<input name="txtProveedor" type="text" size="62" style="text-transform:uppercase" 
                     value="<?php echo str_pad($factura->relacion, 4, "0", STR_PAD_LEFT); ?>" disabled /> 
                    &nbsp;                     	 														
                    <strong style="padding-right:5px">BULTOS</strong>
					<input name="txtTelefono" type="text" size="1" style="text-align:right" 
                     value="<?php echo $factura->total_bultos; ?>" disabled />  	
                    <br /><br />													
                    <strong style="padding-right:5px">VALOR MERCANCIA Bs.</strong>
					<input name="txtMercancia" type="text" size="15" style="text-align:right; font-weight:bold" 
                     value="<?php echo number_format($factura->total_mercancia,2,",","."); ?>" disabled /> 
                     &nbsp;									 				
                    <strong style="padding-right:8px">POR Bs.</strong>
					<input name="txtFlete" type="text" size="13" style="text-align:right" 
                     value="<?php
                     			if($factura->flete!=0) {  
                     				echo number_format($factura->flete,2,",",".")." %"; 
                     			}
                     		?>" onChange="fleteMercancia(frmSP)" <?php if($factura->tipo_cobro!="V") { ?> disabled <?php } ?> /> 
                     &nbsp;													
                    <strong style="padding-right:5px"></strong>
					<input name="txtTotalFleteMercancia" type="text" size="16" style="text-align:right; border:2px solid #666; font-weight:bold;" 
                     value="<?php
                     			if($factura->total_flete_mercancia!=0) { 
                     				echo number_format($factura->total_flete_mercancia,2,",","."); 
                     			}
                     			if($factura->total_viaje!=0) { 
                     				echo number_format($factura->total_viaje,2,",","."); 
                     			}
                     		?>" disabled  /> 
                     &nbsp;
                    <br />												
                    <strong style="padding-right:5px">POR KILO Bs.</strong>
					<input name="txtProveedor" type="text" size="29" style="text-align:right;" 
                     value="<?php 
                     			if($factura->total_peso!=0) { 
                     				echo number_format($factura->total_peso,2,",","."). " Kg";	
                     			} 
                     		?>" disabled /> 
                     &nbsp;													
                    <strong style="padding-right:5px">POR Bs.</strong>
					<input name="txtProveedor" type="text" size="13" style="text-align:right" 
                     value="<?php 
                     			if($factura->bskg!=0) { 
                     				echo number_format($factura->bskg,2,",",".")." Bs/Kg"; 
                     			}
                     		?>" disabled /> 
                     &nbsp;													
                    <strong style="padding-right:5px"></strong>
					<input name="txtTotalFletePeso" type="text" size="16" style="text-align:right; border:2px solid #666; font-weight:bold;" 
                     value="<?php
                     			if($factura->total_flete_peso!=0) { 
                     				echo number_format($factura->total_flete_peso,2,",","."); 
                     			}
                     		?>" disabled /> 
                     &nbsp;
                    <br />													
                    <strong style="padding-right:5px">I.V.A.</strong>
					<input name="txtProveedor" type="text" size="37" style="text-align:right;" 
                     value="<?php echo number_format(obtenerIVA($link),2,",",".")." %"; ?>" disabled /> 
                     &nbsp;													
                    <strong style="padding-right:7px">POR Bs.</strong>
					<input name="txtProveedor" type="text" size="13" style="text-align:right" 
                     value="<?php echo number_format($factura->total_flete,2,",","."); ?>" disabled /> 
                     &nbsp;													
                    <strong style="padding-right:5px"></strong>
					<input name="txtTotalFleteIva" type="text" size="16" style="text-align:right; border:2px solid #666; font-weight:bold;" 
                     value="<?php 
                     			echo number_format($factura->total_flete*($factura->iva/100),2,",","."); 
                     		?>" disabled /> 
                     &nbsp;  	
                    <br />				
                    <strong style="padding-right:1px">SEGURO DE MERCANCIA Bs.</strong>
					<input name="txtSeguro" type="text" size="13" style="text-align:right;" 
                     value="<?php 
                     			if($cliente->seguro=="N" || $cliente->seguro=="") {  
                     				echo number_format(obtenerSeguro($link),2,",",".")." %"; 
                     			}
                     		?>" onChange="seguroMercancia(frmSP)" <?php if($cliente->seguro=="S") { ?> disabled <?php } ?> /> 
                     &nbsp;													
                    <strong style="padding-right:9px">POR Bs.</strong>
					<input name="txtValorMercancia" type="text" size="13" style="text-align:right;"  
                     value="<?php 
                     			if($cliente->seguro=="N" || $cliente->seguro=="") {   
                     				echo number_format($factura->total_mercancia,2,",","."); 
                     			}
                     		?>"  disabled />  
                     &nbsp;&nbsp;						
                    <input name="txtTotalFleteSeguro" type="text" size="16" style="text-align:right; border:2px solid #666; font-weight:bold;"  
                     value="<?php
                     		if($cliente->seguro=="N" || $cliente->seguro=="") {  
                     			echo number_format($factura->total_mercancia*($factura->seguro/100),2,",","."); 
                     		}
                     		?>" disabled /> 							
                     <br />	
                     <br />
                    <strong style="padding-right:5px">&iquest;COBRAR SEGURO?</strong> 
                    <input type="radio" name="cmbSeguro" value="S" <?php if($cliente->seguro=="N" || $cliente->seguro=="") { ?> checked <?php } ?>
                     onChange="validaSeguro(frmSP)" /> 
                     <strong>SI</strong>
                    &nbsp; 
                    <input type="radio" name="cmbSeguro" value="N" <?php if($cliente->seguro=="S") { ?> checked <?php } ?>
                     onChange="validaSeguro(frmSP)" /> 
                     <strong>NO</strong>	
                    &nbsp;									
                    <strong style="padding-left:149px; padding-right:10px">TOTAL A PAGAR Bs</strong>
                    <input name="txtTotalPagar" type="text" size="16" style="text-align:right; border:2px solid #666; font-weight:bold;"  
                     value="<?php
                     			$valor = $factura->total_flete_mercancia;
                     			$valor += $factura->total_flete_peso;
                     			$valor += $factura->total_flete*($factura->iva/100);
                     			$valor += $factura->total_viaje;
                     			if($cliente->seguro=="N" || $cliente->seguro=="") { 
                     				$valor += $factura->total_mercancia*($factura->seguro/100);
                     			}
                     			echo number_format($valor,2,",","."); 
                     		?>" disabled /> 					
                     &nbsp;
                    <br />  
                    <?php include("inc_mensajes.php"); ?> 
                    </p>
                    <hr />
                                                   
                    <p>
                   	<input name="action" type="hidden" value="GenerarFacturaProveedor" />  
                    <input name="id_proveedor" type="hidden" value="<?php echo $factura->cliente->id; ?>" />   
                    <input name="seguro_aux" type="hidden" value="<?php echo obtenerSeguro($link); ?>" />           
                    <input name="mercancia" type="hidden" value="<?php echo $factura->total_mercancia; ?>" />         
                    <input name="flete_mercancia" type="hidden" value="<?php echo $factura->total_flete_mercancia; ?>" />     
                    <input name="total_viaje" type="hidden" value="<?php echo $factura->total_viaje; ?>" />    
                    <input name="flete_peso" type="hidden" value="<?php echo $factura->total_flete_peso; ?>" />        
                    <input name="iva" type="hidden" value="<?php echo $factura->total_flete*($factura->iva/100); ?>" />   
                    <input name="tipo_cobro" type="hidden" value="<?php echo $factura->tipo_cobro; ?>" />             
                    <input class="button" value="GENERAR FACTURA" type="submit" />
                    <input class="button" value="CANCELAR" type="reset" />	
					</p>			
				</form>
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