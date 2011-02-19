<?php include("inc_session.php"); ?>
<?php include("inc_seguridad.php"); ?>
<?php include("inc_conectarse.php"); ?>
<?php $_SESSION["modulo"] = "facturas"; ?>
<?php include("inc_functions.php"); ?>	
<?php 
	$id = $_GET["id"];
	$factura = obtenerFactura($link, $id);	
	$cliente = obtenerProveedor($link, $factura->id_proveedor);
	$total_flete_mercancia = $factura->total_mercancia*($factura->flete/100);
	$total_flete_peso = $factura->total_peso*$factura->bskg;
	$total_viaje = $factura->total_viaje;
	$total_flete =  $total_flete_mercancia + $total_flete_peso + $total_viaje;
	$total_iva = $total_flete*($factura->iva/100);
	$total_seguro = $factura->total_mercancia*($factura->seguro/100);
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
					
				<h1>Ver Factura</h1>				
				<div align="right" style="padding:0px 0px 20px 15px">
				<a href="adm_facturas.php">
                    <strong><< Regresar</strong>
              	</a>
              	</div>				
				<div align="right" style="padding:0px 0px 20px 15px">
				<a href="adm_consultar_factura_proveedor_imp.php?id=<?php echo $id; ?>" target="_blank">
                	<img src="images/icons/printer.png" align="texttop" border="0" />
                    <strong>Versi&oacute;n Imprimible</strong>
              	</a>
              	</div>
              	<div align="left" style="padding:0px 0px 20px 15px">
				<a href="adm_relacion_notas_entrega.php?id=<?php echo $id; ?>">
                    <strong>Ver Relaci&oacute;n de Env&iacute;os</strong>
              	</a>
				</div>
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
				                     value="<?php echo mostrarFecha($factura->fecha_creacion); ?>" disabled />    
                                    <br /><br />										
				                    <strong style="padding-right:5px">RIF</strong>
									<input name="txtRIF" type="text" size="12" style="text-transform:uppercase; text-align:right" 
				                     value="<?php echo $cliente->rif; ?>" disabled />	   
                                    <br /><br />
                                    <strong style="padding-right:5px">FACTURA N&deg;</strong>
									<input name="txtFactura" type="text" size="8" style="text-align:right" 
									 value="<?php echo str_pad($factura->numero_factura, 9, "0", STR_PAD_LEFT); ?>" disabled />    
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
                     value="<?php echo $cliente->nombre; ?>" disabled />  	
                    <br /><br />													
                    <strong style="padding-right:5px">DIRECCION FISCAL</strong>
					<input name="txtDireccion" type="text" size="85" style="text-transform:uppercase" 
                     value="<?php echo $cliente->direccion; ?>" disabled />   
                    <br /><br />
                    <strong style="padding-right:5px">CIUDAD</strong>
					<input name="txtCiudad" type="text" size="31" style="text-transform:uppercase" 
                     value="<?php echo $cliente->ciudad; ?>" disabled /> 
                    &nbsp;                     	 														
                    <strong style="padding-right:5px">TELEFONOS</strong>
					<input name="txtTelefono" type="text" size="42" style="text-transform:uppercase" 
                     value="<?php echo $cliente->telefono; ?>" disabled />  	
                    <br /><br />													
                    <strong style="padding-right:5px">PROVEEDOR</strong>
					<input name="txtProveedor" type="text" size="91" style="text-transform:uppercase" 
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
					<input name="txtProveedor" type="text" size="15" style="text-align:right; font-weight:bold" 
                     value="<?php echo number_format($factura->total_mercancia,2,",","."); ?>" disabled /> 
                     &nbsp;													
                    <strong style="padding-right:8px">POR Bs.</strong>
					<input name="txtProveedor" type="text" size="13" style="text-align:right" 
                     value="<?php
                     			if($factura->flete!=0) {  
                     				echo number_format($factura->flete,2,",",".")." %"; 
                     			}
                     		?>" disabled /> 
                     &nbsp;													
                    <strong style="padding-right:5px"></strong>
					<input name="txtTotalFleteMercancia" type="text" size="16" style="text-align:right; border:2px solid #666; font-weight:bold;" 
                     value="<?php
                     			if($total_flete_mercancia!=0) { 
                     				echo number_format($total_flete_mercancia,2,",","."); 
                     			}
                     			/*                     			
                     			if($total_viaje!="" && ) { 
                     				echo number_format($total_viaje,2,",","."); 
                     			}*/
                     		?>" disabled /> 
                     &nbsp;
                    <br />												
                    <strong style="padding-right:5px">POR KILO Bs.</strong>
					<input name="txtProveedor" type="text" size="29" style="text-align:right;" 
                     value="<?php 
                     			if($factura->total_peso!=0) { 
                     				echo number_format($factura->total_peso,2,",",".")." Kg";	
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
                     			if($total_flete_peso!=0) { 
                     				echo number_format($total_flete_peso,2,",","."); 
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
                     value="<?php echo number_format($total_flete,2,",","."); ?>" disabled /> 
                     &nbsp;													
                    <strong style="padding-right:5px"></strong>
					<input name="txtTotalFleteIva" type="text" size="16" style="text-align:right; border:2px solid #666; font-weight:bold;" 
                     value="<?php 
                     			echo number_format($total_iva,2,",","."); 
                     		?>" disabled /> 
                     &nbsp;  	
                    <br />				
                    <strong style="padding-right:1px">SEGURO DE MERCANCIA Bs.</strong>
					<input  name="txtSeguro" type="text" size="13" style="text-align:right;" 
                     value="<?php
                     			if($factura->seguro!="") {    
                     				echo number_format($factura->seguro,2,",",".")." %"; 
                     			}
                     		?>" disabled /> 
                     &nbsp;													
                    <strong style="padding-right:9px">POR Bs.</strong>
					<input name="txtValorMercancia" type="text" size="13" style="text-align:right;"  
                     value="<?php 
                     			if($factura->seguro!="") {   
                     				echo number_format($factura->total_mercancia,2,",","."); 
                     			}
                     		?>" disabled /> 
                     &nbsp;&nbsp;							
                    <input name="txtTotalFleteSeguro" type="text" size="16" style="text-align:right; border:2px solid #666; font-weight:bold;"  
                     value="<?php
                     		if($factura->seguro!="") {  
                     			echo number_format($total_seguro,2,",","."); 
                     		}
                     		?>" disabled /> 							
                     <br />	
                     <br />
							
                    <strong style="padding-left:371px; padding-right:10px">TOTAL A PAGAR Bs</strong>
                    <input name="txtTotalPagar" type="text" size="16" style="text-align:right; border:2px solid #666; font-weight:bold;"  
                     value="<?php
                     			$valor = $total_flete;
                     			$valor += $total_seguro;
                     			$valor += $total_iva;
                     			echo number_format($valor,2,",","."); 
                     		?>" disabled /> 					
                     &nbsp;
                    </p>   
                    <p>  
                    <?php include("inc_mensajes.php"); ?> 
                    </p>
                    <br />  			
				</form>
                <br />                    
                <br />
                    <hr />   
                    <p>
                    <strong style="padding-right:5px;">ESTATUS</strong>
                    <span style="color:<?php echo colorIndFactura($factura->ind_factura); ?>; font-weight:bold">
					<?php echo indFacturaStr($factura->ind_factura); ?>
                    </span>                    
                    <?php if($factura->ind_factura==3) { ?>
                    <br /><br />
                    <strong style="padding-right:5px;">MOTIVO ANULACION</strong>
                    <br />
                    <?php echo $factura->motivo; ?>
                    <?php } ?> 
                    <?php if($factura->ind_factura==2) { ?>
                    <br /><br />
                    <strong style="padding-right:5px;">FORMA DE PAGO</strong>
                    <input name="txtMercancia" type="text" size="48" style="text-transform:uppercase"  
						 value="<?php echo $factura->forma_pago; ?>" disabled />
						 &nbsp;
                    <strong style="padding-right:5px;">FECHA DE PAGO</strong>
                    <input name="txtMercancia" type="text" size="8" style="text-transform:uppercase"  
						 value="<?php echo mostrarFecha($factura->fecha_pago); ?>" disabled />	 
                    <br /><br />
                    <strong style="padding-right:5px;">N&deg;</strong>
                    <input name="txtMercancia" type="text" size="30" style="text-transform:uppercase"  
						 value="<?php echo $factura->numero_pago; ?>" disabled />
						 &nbsp;
                    <strong style="padding-right:5px;">BANCO</strong>
                    <input name="txtMercancia" type="text" size="53" style="text-transform:uppercase"  
						 value="<?php echo $factura->banco; ?>" disabled />	
					<br /><br />
					<?php if($factura->motivo!="") { ?>
                    <strong style="padding-right:5px;">OBSERVACIONES</strong>
                    <br />
                    <?php echo $factura->motivo; ?>  
                    <?php 
					      }
                        } 
                    ?>
                    </p>           
                    <hr />
                <br />                    
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