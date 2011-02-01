<script type="text/javascript"> 
// ************************************************
// CARGAR_LISTA_ESTADOS
// ************************************************
function cargarEstados(frmSP, id_estado) {

	<?php
	$query = "SELECT * FROM ts_region WHERE ind_activo = 1";
	$result = mysql_query($query,$link);

	while($row1=mysql_fetch_object($result)) {
	?>
		if (frmSP.cmbRegion.value==<?php echo $row1->id; ?>) {
			frmSP.cmbEstado.options.length=0;
			<?php
			$query = "SELECT * FROM ts_estado WHERE id_region='".$row1->id."' AND ind_activo=1 ORDER BY nombre";
			$result2 = mysql_query($query,$link);
			
			$i=1;
			if(mysql_num_rows($result2)>0) {
			?>	
				frmSP.cmbEstado.disabled=false;
				frmSP.cmbEstado.options[0] = new Option("SELECCIONE...","",false,true);
			<?php
			}
			else {
			?>
				frmSP.cmbEstado.disabled=true;
			<?php
			}
			while($row2=mysql_fetch_object($result2)) {
			?>
			if(<?php echo $row2->id;?>==id_estado) {
				frmSP.cmbEstado.options[<?php echo $i;?>] = 
				   new Option("<?php echo $row2->nombre;?>","<?php echo $row2->id;?>",false,"selected");
			}
			else {
				frmSP.cmbEstado.options[<?php echo $i;?>] = 
					   new Option("<?php echo $row2->nombre;?>","<?php echo $row2->id;?>",false,false);
			}
			<?php 
				$i++;
			}
			?>							         	
		}
	<?php
	}
	mysql_free_result($result2);
	?>
	if(frmSP.cmbRegion.value=="") {
		frmSP.cmbEstado.options.length=0;
		frmSP.cmbEstado.disabled=true;
	}
};
// ************************************************

function cargarFlete(frmSP) {
	if(frmSP.cmbGenerar.value=="N") {
		cargarFleteProveedor(frmSP);
	}
	if(frmSP.cmbGenerar.value=="F") {
		cargarFleteCliente(frmSP);
	}	
}

function cargarFleteProveedor(frmSP) {
	if(frmSP.cmbCobrar.value=="V") {
		<?php
		$query = "SELECT * FROM ts_proveedor WHERE ind_activo = 1";
		$result = mysql_query($query,$link);
	
		while($row1=mysql_fetch_object($result)) {
		?>	
		if (frmSP.cmbProveedor.value==<?php echo $row1->id; ?>) {
			frmSP.txtFlete.value = <?php echo $row1->flete; ?>;
		}
		<?php 
		}
		?>
	}
}

function cargarFleteCliente(frmSP) {

	if(frmSP.cmbCobrar.value=="V") {
		<?php
		$query = "SELECT * FROM ts_cliente WHERE ind_activo = 1";
		$result = mysql_query($query,$link);
	
		while($row1=mysql_fetch_object($result)) {
		?>	
		if (frmSP.txtRIF.value=="<?php echo $row1->rif; ?>") {
			frmSP.txtFlete.value = <?php echo $row1->flete; ?>;
		}
		<?php 
		}
		?>
	}
}

function cargarBsKg(frmSP) {
	frmSP.txtBsKg.value = <?php echo obtenerBSKG($link); ?>;
}

function NotaDeEntrega(frmSP) {
	if(frmSP.cmbGenerar.value=="F") {
		frmSP.txtRemesa.disabled = false;
		cargarFleteCliente(frmSP);
	}
	if(frmSP.cmbGenerar.value=="N") {
		frmSP.txtRemesa.disabled = "disabled";
		cargarFleteProveedor(frmSP);
	}	
}

function PesoValor(frmSP) {
	
	if(frmSP.cmbCobrar.value=="P") {
		frmSP.txtPeso.disabled = false;
		frmSP.txtBsKg.disabled = false;
		cargarBsKg(frmSP);
		frmSP.txtFlete.value = "";
		frmSP.txtViaje.value = "";
		frmSP.txtFlete.disabled = "disabled";
		frmSP.txtViaje.disabled = "disabled";	
	}
	if(frmSP.cmbCobrar.value=="V") {
		frmSP.txtFlete.disabled = false;
		cargarFlete(frmSP);
		frmSP.txtPeso.value = "";
		frmSP.txtBsKg.value = "";
		frmSP.txtViaje.value = "";
		frmSP.txtPeso.disabled = "disabled";
		frmSP.txtBsKg.disabled = "disabled";
		frmSP.txtViaje.disabled = "disabled";
	}
	if(frmSP.cmbCobrar.value=="M") {
		frmSP.txtViaje.disabled = false;
		frmSP.txtFlete.value = "";
		frmSP.txtPeso.value = "";
		frmSP.txtBsKg.value = "";
		frmSP.txtFlete.disabled = "disabled";
		frmSP.txtPeso.disabled = "disabled";
		frmSP.txtBsKg.disabled = "disabled";
	}	
	
}
//number formatting function
//copyright Stephen Chapman 24th March 2006, 22nd August 2008
//permission to use this function is granted provided
//that this copyright notice is retained intact

function formatNumber(num,dec,thou,pnt,curr1,curr2,n1,n2) {
	var x = Math.round(num * Math.pow(10,dec));
	if (x >= 0) n1=n2='';
	var y = (''+Math.abs(x)).split('');
	var z = y.length - dec; 
	if (z<0) z--; 
	for(var i = z; i < 0; i++) y.unshift('0'); 
	if (z<0) z = 1; 
	y.splice(z, 0, pnt); 
	if(y[0] == pnt) y.unshift('0'); 
	while (z > 3) {
		z-=3; 
		y.splice(z,0,thou);
	}
	var r = curr1+n1+y.join('')+n2+curr2;
	return r;
}

function sumarGuia(form) {

	var total_bultos=0;
	var total_facturas=0;
	var total_mercancia=0;
	var total_flete=0;
	
	//alert('length='+form.chkEnvio.length);
	<?php 
	$query = "SELECT e.* 
	            FROM ts_envio e,
	                 ts_proveedor p, ts_cliente c,
	                 ts_destino d 
	           WHERE e.ind_activo < 2
	             AND e.id_proveedor = p.id 
	             AND e.id_cliente = c.id 
	             AND e.id_destino = d.id 
	             AND e.ind_envio IN (1,4,5) "; 
	
	$result = obtenerResultset($link,$query);
	while ($row1 = obtenerRegistro($result)) {
	?>

		if(form['chkEnvio[]'].checked && form['chkEnvio[]'].value==<?php echo $row1->id; ?>) {
			
			<?php 
	            if($row1->tipo_cobro=="V") { 
	      			$flete = $row1->mercancia*($row1->flete/100);
					}
					if($row1->tipo_cobro=="P") {
						$flete = $row1->peso*$row1->bskg;
					}
					if($row1->tipo_cobro=="M") {
						$flete = $row1->viaje;
					}
			?>
			total_bultos += <?php echo $row1->bultos; ?>;
			total_facturas++;
			total_mercancia += <?php echo $row1->mercancia; ?>;
			total_flete += <?php echo $flete; ?>;
		}
		else {	
			for (var i=0; i < form['chkEnvio[]'].length; i++) {
				if(form['chkEnvio[]'][i].checked && form['chkEnvio[]'][i].value==<?php echo $row1->id; ?>) {
	
					//alert(form.chkEnvio[i].value);	
	
					<?php 
			            if($row1->tipo_cobro=="V") { 
		          			$flete = $row1->mercancia*($row1->flete/100);
		 				}
		 				if($row1->tipo_cobro=="P") {
		 					$flete = $row1->peso*$row1->bskg;
		 				}
		 				if($row1->tipo_cobro=="M") {
		 					$flete = $row1->viaje;
		 				}
					?>
					total_bultos += <?php echo $row1->bultos; ?>;
					total_facturas++;
					total_mercancia += <?php echo $row1->mercancia; ?>;
					total_flete += <?php echo $flete; ?>;
					
				}
			}
		}		
	<?php 
	}
	?>
	document.getElementById("bultos").innerHTML = total_bultos;
	document.getElementById("facturas").innerHTML = total_facturas;
	document.getElementById("mercancia").innerHTML = formatNumber(total_mercancia,2,'.',',','','','-','');
	document.getElementById("flete").innerHTML = formatNumber(total_flete,2,'.',',','','','-','');
	//alert('bultos='+total_bultos+' facturas='+total_facturas+' mercancia='+total_mercancia+' flete='+total_flete);	
}

function limpiarTotalesGuia() {
	document.getElementById("bultos").innerHTML = "";
	document.getElementById("facturas").innerHTML = "";
	document.getElementById("mercancia").innerHTML = "";
	document.getElementById("flete").innerHTML = "";	
}

function validaSeguro(form) {
	if(getCheckedValue(form.cmbSeguro)=="N") { 
		form.txtSeguro.value = "";
		form.txtSeguro.disabled = true;
		form.txtValorMercancia.value = "";
		form.txtTotalFleteSeguro.value = "";
		form.txtTotalPagar.value = formatNumber((eval(form.flete_mercancia.value) + 
				                   eval(form.iva.value) + eval(form.flete_peso.value) + 
				                   eval(form.total_viaje.value)),2,'.',',','','','-','');  
	}
	if(getCheckedValue(form.cmbSeguro)=="S") {
		var total;
		form.txtSeguro.value = formatNumber(form.seguro_aux.value,2,'.',',','','','-','')+" %";
		form.txtSeguro.disabled = false;
		form.txtValorMercancia.value = formatNumber(form.mercancia.value,2,'.',',','','','-','');
		form.txtTotalFleteSeguro.value =  formatNumber((eval(form.mercancia.value))*(eval(form.seguro_aux.value)/100),2,'.',',','','','-','');
		total = eval(form.flete_mercancia.value) + eval(form.iva.value) + 
		        eval(eval(form.mercancia.value)*(eval(form.seguro_aux.value)/100)) + 
		        eval(form.flete_peso.value) + eval(form.total_viaje.value);
		form.txtTotalPagar.value = formatNumber(total,2,'.',',','','','-','');  
	}	
}

function sumarFacturas(form) {

	var total_bultos=0;
	var total_facturas=0;
	var total_mercancia=0;
	var total_flete=0;
	
	//alert('length='+form.chkEnvio.length);
	<?php 
						$query = "SELECT e.* 
						            FROM ts_envio e,
						                 ts_proveedor p, ts_cliente c,
						                 ts_destino d 
						           WHERE e.ind_activo < 2
						             AND e.id_proveedor = p.id 
						             AND e.id_cliente = c.id 
						             AND e.id_destino = d.id 
						             AND e.ind_envio = 3 
						             AND e.id_factura IS NULL 
						             AND e.tipo_envio = 'N' ";
	
	$result = obtenerResultset($link,$query);
	while ($row1 = obtenerRegistro($result)) {
	?>

		if(form['chkEnvio[]'].checked && form['chkEnvio[]'].value==<?php echo $row1->id; ?>) {
				
				<?php 
		            if($row1->tipo_cobro=="V") { 
	          			$flete = $row1->mercancia*($row1->flete/100);
	 				}
	 				if($row1->tipo_cobro=="P") {
	 					$flete = $row1->peso*$row1->bskg;
	 				}
	 				if($row1->tipo_cobro=="M") {
	 					$flete = $row1->viaje;
	 				}
				?>
				total_bultos += <?php echo $row1->bultos; ?>;
				total_facturas++;
				total_mercancia += <?php echo $row1->mercancia; ?>;
				total_flete += <?php echo $flete; ?>;
		}
		else {
		
			for (var i=0; i < form['chkEnvio[]'].length; i++) {
				if(form['chkEnvio[]'][i].checked && form['chkEnvio[]'][i].value==<?php echo $row1->id; ?>) {
	
					//alert(form.chkEnvio[i].value);	
	
					<?php 
			            if($row1->tipo_cobro=="V") { 
		          			$flete = $row1->mercancia*($row1->flete/100);
		 				}
		 				if($row1->tipo_cobro=="P") {
		 					$flete = $row1->peso*$row1->bskg;
		 				}
		 				if($row1->tipo_cobro=="M") {
		 					$flete = $row1->viaje;
		 				}
					?>
					total_bultos += <?php echo $row1->bultos; ?>;
					total_facturas++;
					total_mercancia += <?php echo $row1->mercancia; ?>;
					total_flete += <?php echo $flete; ?>;
					
				}
			}	
		}		
	<?php 
	}
	?>
	document.getElementById("bultos").innerHTML = total_bultos;
	document.getElementById("facturas").innerHTML = total_facturas;
	document.getElementById("mercancia").innerHTML = formatNumber(total_mercancia,2,'.',',','','','-','');
	document.getElementById("flete").innerHTML = formatNumber(total_flete,2,'.',',','','','-','');
	//alert('bultos='+total_bultos+' facturas='+total_facturas+' mercancia='+total_mercancia+' flete='+total_flete);	
}


function sumarFacturasCliente(form) {

	var total_bultos=0;
	var total_facturas=0;
	var total_mercancia=0;
	var total_flete=0;
	
	//alert('length='+form.chkEnvio.length);
	<?php 
						$query = "SELECT e.* 
						            FROM ts_envio e,
						                 ts_proveedor p, ts_cliente c,
						                 ts_destino d 
						           WHERE e.ind_activo < 2
						             AND e.id_proveedor = p.id 
						             AND e.id_cliente = c.id 
						             AND e.id_destino = d.id 
						             AND e.ind_envio < 4 
						             AND e.id_factura IS NULL 
						             AND e.tipo_envio = 'F'"; 
	
	$result = obtenerResultset($link,$query);
	while ($row1 = obtenerRegistro($result)) {
	?>

		if(form['chkEnvio[]'].checked && form['chkEnvio[]'].value==<?php echo $row1->id; ?>) {
				
				<?php 
		            if($row1->tipo_cobro=="V") { 
	          			$flete = $row1->mercancia*($row1->flete/100);
	 				}
	 				if($row1->tipo_cobro=="P") {
	 					$flete = $row1->peso*$row1->bskg;
	 				}
	 				if($row1->tipo_cobro=="M") {
	 					$flete = $row1->viaje;
	 				}
				?>
				total_bultos += <?php echo $row1->bultos; ?>;
				total_facturas++;
				total_mercancia += <?php echo $row1->mercancia; ?>;
				total_flete += <?php echo $flete; ?>;
		}
		else {
		
			for (var i=0; i < form['chkEnvio[]'].length; i++) {
				if(form['chkEnvio[]'][i].checked && form['chkEnvio[]'][i].value==<?php echo $row1->id; ?>) {
	
					//alert(form.chkEnvio[i].value);	
	
					<?php 
			            if($row1->tipo_cobro=="V") { 
		          			$flete = $row1->mercancia*($row1->flete/100);
		 				}
		 				if($row1->tipo_cobro=="P") {
		 					$flete = $row1->peso*$row1->bskg;
		 				}
		 				if($row1->tipo_cobro=="M") {
		 					$flete = $row1->viaje;
		 				}
					?>
					total_bultos += <?php echo $row1->bultos; ?>;
					total_facturas++;
					total_mercancia += <?php echo $row1->mercancia; ?>;
					total_flete += <?php echo $flete; ?>;
					
				}
			}	
		}		
	<?php 
	}
	?>
	document.getElementById("bultos").innerHTML = total_bultos;
	document.getElementById("facturas").innerHTML = total_facturas;
	document.getElementById("mercancia").innerHTML = formatNumber(total_mercancia,2,'.',',','','','-','');
	document.getElementById("flete").innerHTML = formatNumber(total_flete,2,'.',',','','','-','');
	//alert('bultos='+total_bultos+' facturas='+total_facturas+' mercancia='+total_mercancia+' flete='+total_flete);	
}

</script>