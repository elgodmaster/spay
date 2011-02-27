// JavaScript Document

// return the value of the radio button that is checked
// return an empty string if none are checked, or
// there are no radio buttons
function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

// ************************************************
// VALIDATE_LOGIN_FORM
// ************************************************
function validate_login_form(form)
{
  	if (form.txtLogin.value=="") {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE SU LOGIN DE USUARIO.";
		form.txtLogin.focus();
		return false;
  	}
  	if (form.txtPassword.value=="") {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INGRESE SU PASSWORD.";
		form.txtPassword.focus();
		return false;
  	}	
}
// ************************************************


// ************************************************
// VALIDATE_ENVIAR_PASSWORD_FORM
// ************************************************
function validate_enviar_password_form(form)
{
  	if (form.txtLogin.value=="") {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE SU LOGIN DE USUARIO.";
		form.txtLogin.focus();
		return false;
  	}
}
// ************************************************

//************************************************
//VALIDATE_BUSCAR_CLIENTE_FORM
//************************************************
function validate_busqueda_cliente_form(form)
{
	if (form.txtRIF.value=="") {
		form.txtRIF.focus();
		return false;
	}
}
//************************************************

//************************************************
// VALIDATE_FACTURA_FORM
//************************************************
function validate_factura_form(form)
{
	if (form.txtFactura.value=="") {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE EL NUMERO DE FACTURA SPAY.";
		form.txtFactura.focus();
		return false;
	}		
	if(form.tipo_cobro.value=="V") {
		var flete = form.txtFlete.value;
		flete = flete.substring(0,flete.indexOf(',')+3);
		flete = flete.replace(',','.');	
		if (form.txtFlete.value=="" || form.txtFlete.value=="0,00 %") {
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE EL % FLETE.";
			form.txtFlete.focus();
			return false;
		}
		if (isNaN(flete)) {
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  EL % FLETE DEBE SER NUMERICO.";
			form.txtFlete.focus();
			return false;
		}		
	}
	if(getCheckedValue(form.cmbSeguro)=="S") {
		var seguro = form.txtSeguro.value;
		seguro = seguro.substring(0,seguro.indexOf(',')+3);
		seguro = seguro.replace(',','.');
		
		if (form.txtSeguro.value=="" || form.txtSeguro.value=="0,00 %") {
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE EL % SEGURO.";
			form.txtSeguro.focus();
			return false;
		}
		if (isNaN(seguro)) {
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  EL % SEGURO DEBE SER NUMERICO.";
			form.txtSeguro.focus();
			return false;
		}
	}
		
}
//************************************************

//************************************************
// VALIDATE_FACTURA_PROVEEDOR_FORM
//************************************************
function validate_factura_proveedor_form(form)
{
	if (form.txtFactura.value=="") {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE EL NUMERO DE FACTURA SPAY.";
		form.txtFactura.focus();
		return false;
	}	
	if(form.tipo_cobro.value=="V") {
		var flete = form.txtFlete.value;
		flete = flete.substring(0,flete.indexOf(',')+3);
		flete = flete.replace(',','.');	
		if (form.txtFlete.value=="" || form.txtFlete.value=="0,00 %") {
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE EL % FLETE.";
			form.txtFlete.focus();
			return false;
		}
		if (isNaN(flete)) {
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  EL % FLETE DEBE SER NUMERICO.";
			form.txtFlete.focus();
			return false;
		}		
	}
	if(getCheckedValue(form.cmbSeguro)=="S") {
		var seguro = form.txtSeguro.value;
		seguro = seguro.substring(0,seguro.indexOf(',')+3);
		seguro = seguro.replace(',','.');
		
		if (form.txtSeguro.value=="" || form.txtSeguro.value=="0,00 %") {
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE EL % SEGURO.";
			form.txtSeguro.focus();
			return false;
		}
		if (isNaN(seguro)) {
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  EL % SEGURO DEBE SER NUMERICO.";
			form.txtSeguro.focus();
			return false;
		}
	}	
}
//************************************************

//************************************************
// VALIDATE_MOTIVO_FORM
//************************************************
function validate_motivo_form(form)
{
	if (form.txtMotivo.value=="") {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE EL MOTIVO.";
		form.txtMotivo.focus();
		return false;
	}
}
//************************************************

//************************************************
// VALIDATE_DATOS_SISTEMA_FORM
//************************************************
function validate_datos_sistema_form(form)
{
	if (form.txtIVA.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL VALOR DEL IVA.";
		form.txtIVA.focus();
		return false;
	}	
	if (isNaN(form.txtIVA.value)) {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> EL IVA DEBE SER UN VALOR NUMERICO.";
		form.txtIVA.focus();
		return false;
	}	
	if (form.txtBSKG.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL VALOR DE BSF/KG.";
		form.txtBSKG.focus();
		return false;
	}	
	if (isNaN(form.txtBSKG.value)) {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> EL VALOR DE BSF/KG DEBE SER NUMERICO.";
		form.txtBSKG.focus();
		return false;
	}		
	if (form.txtSeguro.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL VALOR DEL % SEGURO.";
		form.txtSeguro.focus();
		return false;
	}	
	if (isNaN(form.txtSeguro.value)) {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> EL VALOR DE % SEGURO DEBE SER NUMERICO.";
		form.txtSeguro.focus();
		return false;
	}
}
//************************************************


// ************************************************
// VALIDATE_REGION_FORM
// ************************************************
function validate_region_form(form)
{
  	if (form.txtNombre.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL NOMBRE DE LA REGION.";
		form.txtNombre.focus();
		return false;
  	}
}
// ************************************************


//************************************************
// VALIDATE_ESTADO_FORM
//************************************************
function validate_estado_form(form)
{
	if (form.cmbRegion.selectedIndex=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR SELECCIONE LA REGION.";
		form.cmbRegion.focus();
		return false;
	}	
	
	if (form.txtNombre.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL NOMBRE DEL ESTADO.";
		form.txtNombre.focus();
		return false;
	}
}
//************************************************


//************************************************
// VALIDATE_DESTINO_FORM
//************************************************
function validate_destino_form(form)
{
	if (form.cmbRegion.selectedIndex=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR SELECCIONE LA REGION.";
		form.cmbRegion.focus();
		return false;
	}	
	if (form.cmbEstado.selectedIndex=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR SELECCIONE EL ESTADO.";
		form.cmbEstado.focus();
		return false;
	}	
	if (form.txtNombre.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL NOMBRE DEL DESTINO.";
		form.txtNombre.focus();
		return false;
	}
}
//************************************************


//************************************************
//VALIDATE_CHOFER_FORM
//************************************************
function validate_chofer_form(form)
{
	if (form.txtNombre.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL NOMBRE DEL CHOFER.";
		form.txtNombre.focus();
		return false;
	}
	if (form.txtCedula.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE LA CEDULA DEL CHOFER.";
		form.txtCedula.focus();
		return false;
	}
	if (form.txtTelefono.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE LOS TELEFONOS DEL CHOFER.";
		form.txtTelefono.focus();
		return false;
	}
	if (form.txtPlaca.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL NUMERO DEL PLACA DEL CAMION.";
		form.txtPlaca.focus();
		return false;
	}
}
//************************************************

//************************************************
// VALIDATE_BUSCAR_CLIENTE_FORM
//************************************************
function validate_buscar_cliente_form(form)
{
	if (form.txtBuscarCliente.value=="") {	
		form.txtBuscarCliente.focus();
		return false;
	}
}
//************************************************


//************************************************
// VALIDATE_CLIENTE_FORM
//************************************************
function validate_cliente_form(form)
{
	if (form.txtRIF.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL RIF DEL CLIENTE.";
		form.txtRIF.focus();
		return false;
	}	
	if (form.txtFlete.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL VALOR DE % FLETE.";
		form.txtFlete.focus();
		return false;
	}	
	if (isNaN(form.txtFlete.value)) {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> EL % FLETE DEBE SER NUMERICO.";
		form.txtFlete.focus();
		return false;
	}	
	if (form.txtNombre.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL NOMBRE O LA RAZON SOCIAL DEL CLIENTE.";
		form.txtNombre.focus();
		return false;
	}
	if (form.txtDireccion.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE LA DIRECCION FISCAL DEL CLIENTE.";
		form.txtDireccion.focus();
		return false;
	}
	if (form.txtCiudad.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE LA CIUDAD DEL CLIENTE.";
		form.txtCiudad.focus();
		return false;
	}
	if (form.txtTelefono.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL TELEFONO DEL CLIENTE.";
		form.txtTelefono.focus();
		return false;
	}
	if (form.cmbDestino.selectedIndex=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR SELECCIONE EL DESTINO DE LOS ENVIOS.";
		form.cmbDestino.focus();
		return false;
	}	
}
//************************************************

//************************************************
// VALIDATE_PROVEEDOR_FORM
//************************************************
function validate_proveedor_form(form)
{
	if (form.txtRIF.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL RIF DEL PROVEEDOR.";
		form.txtRIF.focus();
		return false;
	}	
	if (form.txtFlete.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL VALOR DE % FLETE.";
		form.txtFlete.focus();
		return false;
	}	
	if (isNaN(form.txtFlete.value)) {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> EL % FLETE DEBE SER NUMERICO.";
		form.txtFlete.focus();
		return false;
	}	
	if (form.txtNombre.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL NOMBRE O LA RAZON SOCIAL DEL PROVEEDOR.";
		form.txtNombre.focus();
		return false;
	}
	if (form.txtDireccion.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE LA DIRECCION FISCAL DEL PROVEEDOR.";
		form.txtDireccion.focus();
		return false;
	}
	if (form.txtCiudad.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE LA CIUDAD DEL PROVEEDOR.";
		form.txtCiudad.focus();
		return false;
	}
	if (form.txtTelefono.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL TELEFONO DEL PROVEEDOR.";
		form.txtTelefono.focus();
		return false;
	}
}
//************************************************


//************************************************
// VALIDATE_ENVIO_FORM
//************************************************
function validate_envio_form(form)
{
	if (form.txtRIF.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL RIF DEL CLIENTE.";
		form.txtRIF.focus();
		return false;
	}	
	if (form.txtNombre.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL NOMBRE O LA RAZON SOCIAL DEL CLIENTE.";
		form.txtNombre.focus();
		return false;
	}
	if (form.txtDireccion.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE LA DIRECCION FISCAL DEL CLIENTE.";
		form.txtDireccion.focus();
		return false;
	}
	if (form.txtCiudad.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE LA CIUDAD DEL CLIENTE.";
		form.txtCiudad.focus();
		return false;
	}
	if (form.txtTelefono.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL TELEFONO DEL CLIENTE.";
		form.txtTelefono.focus();
		return false;
	}
	if (form.cmbGenerar.selectedIndex=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE SI SE DEBE GENERAR FACTURA O NOTA DE ENTREGA.";
		form.cmbGenerar.focus();
		return false;
	}	
	if (form.cmbCobrar.selectedIndex=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE SI SE DEBE COBRAR POR VALOR, PESO O VIAJE.";
		form.cmbCobrar.focus();
		return false;
	}	
	if (form.cmbProveedor.selectedIndex=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR SELECCIONE EL PROVEEDOR.";
		form.cmbProveedor.focus();
		return false;
	}	
	if (form.cmbDestino.selectedIndex=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR SELECCIONE EL DESTINO.";
		form.cmbDestino.focus();
		return false;
	}
	if (form.txtBultos.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL NUMERO DE BULTOS.";
		form.txtBultos.focus();
		return false;
	}	
	if (isNaN(form.txtBultos.value)) {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> EL NUMERO DE BULTOS DEBE SER NUMERICO.";
		form.txtBultos.focus();
		return false;
	}
	if (form.cmbGenerar.value=="F" && form.txtRemesa.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL NUMERO DE REMESA (FACTURA SPAY).";
		form.txtRemesa.focus();
		return false;
	}	
	if (form.txtFactura.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL NUMERO DE FACTURA DEL PROVEEDOR.";
		form.txtFactura.focus();
		return false;
	}
	if (form.txtMercancia.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL VALOR DE LA MERCANCIA.";
		form.txtMercancia.focus();
		return false;
	}	
	if (isNaN(form.txtMercancia.value)) {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> EL VALOR DE LA MERCANCIA DEBE SER NUMERICO.";
		form.txtMercancia.focus();
		return false;
	}	
	if(form.cmbCobrar.value=="V") {
		if (form.txtFlete.value=="") {	
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL VALOR DE % FLETE.";
			form.txtFlete.focus();
			return false;
		}	
		if (isNaN(form.txtFlete.value)) {	
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  /> EL % FLETE DEBE SER NUMERICO.";
			form.txtFlete.focus();
			return false;
		}
	}	
	if(form.cmbCobrar.value=="P") {
		if (form.txtPeso.value=="") {	
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL PESO DE LA MERCANCIA.";
			form.txtPeso.focus();
			return false;
		}	
		if (isNaN(form.txtPeso.value)) {	
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  /> EL PESO DE LA MERCANCIA DEBE SER NUMERICO.";
			form.txtPeso.focus();
			return false;
		}
		if (form.txtBsKg.value=="") {	
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL VALOR DE BSF/KG.";
			form.txtBsKg.focus();
			return false;
		}	
		if (isNaN(form.txtBsKg.value)) {	
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  /> EL VALOR DE BSF/KG DEBE SER NUMERICO.";
			form.txtBsKg.focus();
			return false;
		}
	}	
	if(form.cmbCobrar.value=="M") {
		if (form.txtViaje.value=="") {	
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL VALOR DEL VIAJE.";
			form.txtViaje.focus();
			return false;
		}	
		if (isNaN(form.txtViaje.value)) {	
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  /> EL VALOR DEL VIAJE DEBE SER NUMERICO.";
			form.txtViaje.focus();
			return false;
		}
	}
	if (form.cmbOtroEnvio.selectedIndex=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE SI DESEA AGREGAR OTRO ENVIO.";
		form.cmbOtroEnvio.focus();
		return false;
	}	
}
//************************************************


//************************************************
// VALIDATE__MODIFICAR_ENVIO_FORM
//************************************************
function validate_modificar_envio_form(form)
{
	if (form.txtBultos.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL NUMERO DE BULTOS.";
		form.txtBultos.focus();
		return false;
	}	
	if (isNaN(form.txtBultos.value)) {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> EL NUMERO DE BULTOS DEBE SER NUMERICO.";
		form.txtBultos.focus();
		return false;
	}
	if (form.cmbGenerar.value=="F" && form.txtRemesa.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL NUMERO DE REMESA (FACTURA SPAY).";
		form.txtRemesa.focus();
		return false;
	}	
	if (form.txtFactura.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL NUMERO DE FACTURA DEL PROVEEDOR.";
		form.txtFactura.focus();
		return false;
	}	
	if(form.cmbCobrar.value=="V") {
		if (form.txtMercancia.value=="") {	
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL VALOR DE LA MERCANCIA.";
			form.txtMercancia.focus();
			return false;
		}	
		if (isNaN(form.txtMercancia.value)) {	
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  /> EL VALOR DE LA MERCANCIA DEBE SER NUMERICO.";
			form.txtMercancia.focus();
			return false;
		}
		if (form.txtFlete.value=="") {	
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL VALOR DE % FLETE.";
			form.txtFlete.focus();
			return false;
		}	
		if (isNaN(form.txtFlete.value)) {	
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  /> EL % FLETE DEBE SER NUMERICO.";
			form.txtFlete.focus();
			return false;
		}
	}	
	if(form.cmbCobrar.value=="P") {
		if (form.txtPeso.value=="") {	
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL PESO DE LA MERCANCIA.";
			form.txtPeso.focus();
			return false;
		}	
		if (isNaN(form.txtPeso.value)) {	
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  /> EL PESO DE LA MERCANCIA DEBE SER NUMERICO.";
			form.txtPeso.focus();
			return false;
		}
		if (form.txtBsKg.value=="") {	
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL VALOR DE BSF/KG.";
			form.txtBsKg.focus();
			return false;
		}	
		if (isNaN(form.txtBsKg.value)) {	
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  /> EL VALOR DE BSF/KG DEBE SER NUMERICO.";
			form.txtBsKg.focus();
			return false;
		}
	}	
	if(form.cmbCobrar.value=="M") {
		if (form.txtViaje.value=="") {	
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL VALOR DEL VIAJE.";
			form.txtViaje.focus();
			return false;
		}	
		if (isNaN(form.txtViaje.value)) {	
			document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  /> EL VALOR DEL VIAJE DEBE SER NUMERICO.";
			form.txtViaje.focus();
			return false;
		}
	}	
}
//************************************************


//************************************************
// VALIDATE_BUSQUEDA_ENVIO_FORM
//************************************************
function validate_busqueda_envio_form(form)
{	
	if(form.cmbDiaI.selectedIndex!="" && form.cmbMesI.selectedIndex!="" && form.cmbAnoI.selectedIndex!="") {

		var diaI = form.cmbDiaI.options[form.cmbDiaI.selectedIndex].value;
		var mesI = form.cmbMesI.options[form.cmbMesI.selectedIndex].value;
		var anoI = form.cmbAnoI.options[form.cmbAnoI.selectedIndex].value;
		var fechaI = new Date(anoI, mesI-1, diaI);
		var hoy = new Date();
		
		if (!isValidDate(diaI, mesI-1, anoI)) {
				return false;	
		}
		if(fechaI > hoy) {
				return false;
		}	
	}	

}
//************************************************


//************************************************
// VALIDATE_BUSQUEDA_ENVIO_FORM
//************************************************
function validate_factura_cobrada_form(form)
{	
	if (form.cmbFormaPago.selectedIndex=="") {
		document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR SELECCIONE UNA FORMA DE PAGO.";
		form.cmbFormaPago.focus();
		return false;
	}		
	if(form.cmbDiaI.selectedIndex!="" && form.cmbMesI.selectedIndex!="" && form.cmbAnoI.selectedIndex!="") {

		var diaI = form.cmbDiaI.options[form.cmbDiaI.selectedIndex].value;
		var mesI = form.cmbMesI.options[form.cmbMesI.selectedIndex].value;
		var anoI = form.cmbAnoI.options[form.cmbAnoI.selectedIndex].value;
		var fechaI = new Date(anoI, mesI-1, diaI);
		var hoy = new Date();
		
		if (!isValidDate(diaI, mesI-1, anoI)) {
			document.getElementById("mensError").innerHTML = 
				"<img align='texttop' src='images/icons/cancel.png' border='0'  />  FECHA INVALIDA.";
			return false;	
		}
		if(fechaI > hoy) {
			document.getElementById("mensError").innerHTML = 
				"<img align='texttop' src='images/icons/cancel.png' border='0'  />  FECHA INVALIDA.";
			return false;
		}	
	}	
	else{
		document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE LA FECHA DE PAGO.";
		return false;
	}
	if(form.cmbFormaPago.value!="EFECTIVO") {
		if (form.txtNumero.value=="") {
			document.getElementById("mensError").innerHTML = 
				"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE NUMERO CHEQUE/TARJETA;.";
			form.txtNumero.focus();
			return false;
		}
		if (form.txtBanco.value=="") {
			document.getElementById("mensError").innerHTML = 
				"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE EL BANCO.";
			form.txtBanco.focus();
			return false;
		}
	}

}
//************************************************

//************************************************
//VALIDATE_FORMA_PAGO
//************************************************
function validarFormaPago(form)
{
	if (form.cmbFormaPago.value!="EFECTIVO") {
		form.txtNumero.disabled=false;
		form.txtBanco.disabled=false;
	}
	else {
		form.txtNumero.disabled = true;
		form.txtBanco.disabled = true;		
	}
}

//************************************************



//************************************************
// VALIDATE_BUSQUEDA_GUIA_FORM
//************************************************
function validate_busqueda_guia_form(form)
{	
	if (form.cmbRegion.selectedIndex=="") {
			form.cmbRegion.focus();
			return false;
	}

}
//************************************************

//************************************************
// VALIDATE_BUSQUEDA_PROVEEDOR_FORM
//************************************************
function validate_busqueda_proveedor_form(form)
{	
	if (form.cmbProveedor.selectedIndex=="") {
		document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR SELECCIONE UN PROVEEDOR.";
		form.cmbProveedor.focus();	
		return false;
	}
}

//************************************************
// VALIDATE_FACTURA_ANULADA_FORM
//************************************************
function validate_factura_anulada_form(form)
{	
	if (form.txtMotivo.value=="") {
		document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE EL MOTIVO DE ANULACION.";
		form.txtMotivo.focus();	
		return false;
	}
}

//************************************************
// VALIDATE_GENERAR_GUIA_FORM
//************************************************
function validate_generar_guia_form(form)
{	
	if(!form['chkEnvio[]'].checked) {
		var seleccionoEnvios = false;
		for (var i=0; i < form["chkEnvio[]"].length; i++) {
			if(form["chkEnvio[]"][i].checked) {
				seleccionoEnvios = true;
				break;
			}
		}
		if(!seleccionoEnvios) {
			document.getElementById("mensError").innerHTML = 
				"<img align='texttop' src='images/icons/cancel.png' border='0'  />  DEBE SELECCIONAR AL MENOS UN ENVIO PARA GENERAR LA GUIA.";
			return false;
		}	
	}
	if (form.cmbChofer.selectedIndex=="") {
		document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR SELECCIONE EL CHOFER.";
			form.cmbChofer.focus();
			return false;
	}

}
//************************************************

//************************************************
//VALIDATE_GENERAR_GUIA_FORM
//************************************************
function validate_preparar_factura_form(form)
{	
	if(!form['chkEnvio[]'].checked) {
		var seleccionoEnvios = false;
		for (var i=0; i < form["chkEnvio[]"].length; i++) {
			if(form["chkEnvio[]"][i].checked) {
				seleccionoEnvios = true;
				break;
			}
		}
		if(!seleccionoEnvios) {
			document.getElementById("mensError").innerHTML = 
				"<img align='texttop' src='images/icons/cancel.png' border='0'  />  DEBE SELECCIONAR AL MENOS UN ENVIO PARA GENERAR LA FACTURA.";
			return false;
		}	
	}
}

//************************************************
	


// ************************************************
// VALIDATE_USUARIO_FORM
// ************************************************
function validate_usuario_form(form)
{
  	if (form.txtLogin.value=="") {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE EL LOGIN DE USUARIO.";
		form.txtLogin.focus();
		return false;
  	}
  	if (form.txtPassword.value=="") {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INGRESE EL PASSWORD.";
		form.txtPassword.focus();
		return false;
  	}	
  	if (form.txtPasswordConfirm.value=="") {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INGRESE LA CONFIRMACION DE PASSWORD.";
		form.txtPasswordConfirm.focus();
		return false;
  	}
  	if (form.txtPassword.value!=form.txtPasswordConfirm.value) {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  EL PASSWORD Y SU CONFIRMACION DEBEN SER IGUALES.";
		form.txtPasswordConfirm.focus();
		return false;
  	}	
  	if (form.txtNombre.value=="") {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE EL NOMBRE DE USUARIO.";
		form.txtNombre.focus();
		return false;
  	}	
  	if (form.txtEmail.value=="") {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE EL EMAIL DEL USUARIO.";
		form.txtEmail.focus();
		return false;
  	}
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if(reg.test(form.txtEmail.value) == false) {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INTRODUZCA UN EMAIL VALIDO.";
		form.txtEmail.focus();
      	return false;
   }
}
// ************************************************


//************************************************
//VALIDATE_EMPRESA_FORM
//************************************************
function validate_empresa_form(form)
{
	if (form.txtNombre.value=="") {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE EL NOMBRE DE LA EMPRESA.";
		form.txtNombre.focus();
		return false;
	}
	if (form.txtRIF.value=="") {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE EL RIF DE LA EMPRESA.";
		form.txtRIF.focus();
		return false;
	}	
	if (form.txtDireccion.value=="") {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INGRESE LA DIRECCION DE LA EMPRESA.";
		form.txtDireccion.focus();
		return false;
	}
	if (form.txtTelefonos.value=="") {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE LOS TELEFONOS DE LA EMPRESA.";
		form.txtTelefonos.focus();
		return false;
	}	
	if (form.txtEmail.value=="") {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INDIQUE EL EMAIL DE LA EMPRESA.";
		form.txtEmail.focus();
		return false;
	}
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if(reg.test(form.txtEmail.value) == false) {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  POR FAVOR INTRODUZCA UN EMAIL VALIDO.";
		form.txtEmail.focus();
		return false;
	}
}
//************************************************


// ************************************************
// VALIDATE_SUBIR_BAJAR_PRODUCTO_FORM
// ************************************************
function validate_subir_bajar_producto_form(form)
{
   	if (form.cmbCategoria.selectedIndex=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR SELECCIONE LA CATEGORIA DEL PRODUCTO.";
		form.cmbCategoria.focus();
		return false;
  	}	
   	if (form.cmbProducto.selectedIndex=="" || form.cmbProducto.selectedIndex==-1) {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR SELECCIONE EL PRODUCTO.";
		form.cmbProducto.focus();
		return false;
  	}		
	var dia = form.cmbDia.options[form.cmbDia.selectedIndex].value;
	var mes = form.cmbMes.options[form.cmbMes.selectedIndex].value;
	var ano = form.cmbAno.options[form.cmbAno.selectedIndex].value;
	var fecha = new Date(ano, mes-1, dia);
	var hoy = new Date();
	if (!isValidDate(dia, mes-1, ano)) {
		document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  " +
			" LA FECHA DE LA TRANSACCION ES INVALIDA.";
			return false;	
	}
	if(fecha > hoy) {
		document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  " +
			" NO ESTA PERMITIDO GENERAR MOVIMIENTOS PARA FECHAS FUTURAS.";
			return false;
	}	
  	if (form.txtNumeroUnidades.value=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR INDIQUE EL NUMERO DE UNIDADES.";
		form.txtNumeroUnidades.focus();
		return false;
  	}
	if (isNaN(form.txtNumeroUnidades.value)) {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> EL NUMERO DE UNIDADES DEBE SER UN NUMERO.";
		form.txtNumeroUnidades.value == "";
		form.txtNumeroUnidades.focus();
		return false;
  	}		
}
// ************************************************

//************************************************
//VALIDATE_FICHA_PRODUCTO_FORM
//************************************************
function validate_ficha_producto_form(form)
{
	if (form.cmbCategoria.selectedIndex=="") {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR SELECCIONE LA CATEGORIA DEL PRODUCTO.";
		form.cmbCategoria.focus();
		return false;
	}	
	if (form.cmbProducto.selectedIndex=="" || form.cmbProducto.selectedIndex==-1) {	
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  /> POR FAVOR SELECCIONE EL PRODUCTO.";
		form.cmbProducto.focus();
		return false;
	}	
	var diaI = form.cmbDiaI.options[form.cmbDiaI.selectedIndex].value;
	var mesI = form.cmbMesI.options[form.cmbMesI.selectedIndex].value;
	var anoI = form.cmbAnoI.options[form.cmbAnoI.selectedIndex].value;
	var diaF = form.cmbDiaF.options[form.cmbDiaF.selectedIndex].value;
	var mesF = form.cmbMesF.options[form.cmbMesF.selectedIndex].value;
	var anoF = form.cmbAnoF.options[form.cmbAnoF.selectedIndex].value;
	
	var fechaI = new Date(anoI, mesI-1, diaI);
	var fechaF = new Date(anoF, mesF-1, diaF);
	var hoy = new Date();
	
	if (!isValidDate(diaI, mesI-1, anoI)) {
		document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  " +
			" LA FECHA DE INICIO ES INVALIDA.";
			return false;	
	}
	if (!isValidDate(diaF, mesF-1, anoF)) {
		document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  " +
			" LA FECHA FINAL ES INVALIDA.";
		return false;	
	}	
	if (fechaI > fechaF) {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  " +
		" LA FECHA FINAL DEBE SER MAYOR QUE LA FECHA DE INICIO.";
		return false;
	}
	if(fechaI > hoy || fechaF > hoy ) {
		document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  " +
			" NO ESTA PERMITIDO GENERAR REPORTES PARA FECHAS FUTURAS.";
			return false;
	}	
}
//************************************************

//************************************************
// VALIDATE_FECHAS_FORM
//************************************************
function isValidDate(day,month,year){
	/*
	Purpose: return true if the date is valid, false otherwise

	Arguments: day integer representing day of month
	month integer representing month of year
	year integer representing year

	Variables: dteDate - date object

	*/
	var dteDate;

	//set up a Date object based on the day, month and year arguments
	//javascript months start at 0 (0-11 instead of 1-12)
	dteDate=new Date(year,month,day);

	/*
	Javascript Dates are a little too forgiving and will change the date to a reasonable guess if it's invalid. We'll use this to our advantage by creating the date object and then comparing it to the details we put it. If the Date object is different, then it must have been an invalid date to start with...
	*/

	return ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()));
}

function validate_fechas_form(form) {
	
	var diaI = form.cmbDiaI.options[form.cmbDiaI.selectedIndex].value;
	var mesI = form.cmbMesI.options[form.cmbMesI.selectedIndex].value;
	var anoI = form.cmbAnoI.options[form.cmbAnoI.selectedIndex].value;
	var diaF = form.cmbDiaF.options[form.cmbDiaF.selectedIndex].value;
	var mesF = form.cmbMesF.options[form.cmbMesF.selectedIndex].value;
	var anoF = form.cmbAnoF.options[form.cmbAnoF.selectedIndex].value;
	
	var fechaI = new Date(anoI, mesI-1, diaI);
	var fechaF = new Date(anoF, mesF-1, diaF);
	
	var hoy = new Date();
	
	if (!isValidDate(diaI, mesI-1, anoI)) {
		document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  " +
			"LA FECHA DE INICIO ES INVALIDA.";
			return false;	
	}
	if (!isValidDate(diaF, mesF-1, anoF)) {
		document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  " +
			"LA FECHA FINAL ES INVALIDA.";
		return false;	
	}	
	if (fechaI > fechaF) {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  " +
		"LA FECHA FINAL DEBE SER MAYOR QUE LA FECHA DE INICIO.";
		return false;
	}
	if(fechaI > hoy || fechaF > hoy ) {
		document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  " +
			"NO ESTA PERMITIDO GENERAR REPORTES PARA FECHAS FUTURAS.";
			return false;
	}
}

function validate_fechas_movimientos_form(form) {
	
	var diaI = form.cmbDiaI.options[form.cmbDiaI.selectedIndex].value;
	var mesI = form.cmbMesI.options[form.cmbMesI.selectedIndex].value;
	var anoI = form.cmbAnoI.options[form.cmbAnoI.selectedIndex].value;
	var diaF = form.cmbDiaF.options[form.cmbDiaF.selectedIndex].value;
	var mesF = form.cmbMesF.options[form.cmbMesF.selectedIndex].value;
	var anoF = form.cmbAnoF.options[form.cmbAnoF.selectedIndex].value;
	
	var fechaI = new Date(anoI, mesI-1, diaI);
	var fechaF = new Date(anoF, mesF-1, diaF);
	
	var hoy = new Date();
	
	if (!isValidDate(diaI, mesI-1, anoI)) {
		document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  " +
			"LA FECHA DE INICIO ES INVALIDA.";
			return false;	
	}
	if (!isValidDate(diaF, mesF-1, anoF)) {
		document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  " +
			"LA FECHA FINAL ES INVALIDA.";
		return false;	
	}	
	if (fechaI > fechaF) {
		document.getElementById("mensError").innerHTML = 
		"<img align='texttop' src='images/icons/cancel.png' border='0'  />  " +
		"LA FECHA FINAL DEBE SER MAYOR QUE LA FECHA DE INICIO.";
		return false;
	}
	if(fechaI > hoy || fechaF > hoy ) {
		document.getElementById("mensError").innerHTML = 
			"<img align='texttop' src='images/icons/cancel.png' border='0'  />  " +
			"NO EXISTEN MOVIMIENTOS PARA FECHAS FUTURAS.";
			return false;
	}
}


//************************************************

//************************************************
// VALIDATE_BUSQUEDA_FORM
//************************************************
function validate_busqueda_form(form)
{
	if (form.txtBusqueda.value=="") {
		form.txtBusqueda.focus();
		return false;
	}

}
//************************************************



// ************************************************
// CLEAN_MENSAJES
// ************************************************
function cleanMensajes()
{
	document.getElementById("mensError").innerHTML = "";	
	document.getElementById("mensCRUD").innerHTML = "";
}
// ************************************************

function seguroMercancia(form) {

	var totalPagar=0;
	var totalFleteMercanciaF;
	var totalFletePesoF;
	var totalFleteIvaF;
	var mercanciaF;
	var seguroF;
	
	var mercancia = form.txtValorMercancia.value;	
	mercancia = mercancia.replace('.','');
	mercancia = mercancia.replace(',','.');
	mercanciaF = eval(mercancia);
	
	var seguro = form.txtSeguro.value;
	if(seguro!="") {
		seguro = seguro.substring(0,seguro.indexOf(',')+3);
		seguro = seguro.replace(',','.');
		seguroF = eval(seguro);
	}
	var totalFleteMercancia = form.txtTotalFleteMercancia.value;
	if(totalFleteMercancia!="") {
		totalFleteMercancia = totalFleteMercancia.replace('.','');
		totalFleteMercancia = totalFleteMercancia.replace(',','.');
		totalFleteMercanciaF = eval(totalFleteMercancia);
	}
	var totalFletePeso = form.txtTotalFletePeso.value;
	if(totalFletePeso!="") {
		totalFletePeso = totalFletePeso.replace('.','');
		totalFletePeso = totalFletePeso.replace(',','.');
		totalFletePesoF = eval(totalFletePeso);
	}
	var totalFleteIva = form.txtTotalFleteIVA.value;
	totalFleteIva = totalFleteIva.replace('.','');
	totalFleteIva = totalFleteIva.replace(',','.');
	totalFleteIvaF = eval(totalFleteIva);
	
	if(totalFleteMercancia!="") {
		totalPagar += totalFleteMercanciaF;
	}
	if(totalFletePeso!="") {
		totalPagar += totalFletePesoF;
	}
	totalPagar += totalFleteIvaF;
	totalPagar += mercanciaF*(seguroF/100);
	
	form.txtTotalFleteSeguro.value = formatNumber(mercancia*(seguro/100),2,'.',',','','','-','');
	form.txtTotalPagar.value = formatNumber(totalPagar,2,'.',',','','','-','');
	form.txtSeguro.value = formatNumber(seguro,2,'.',',','','','-','')+" %";
}


function fleteMercancia(form) {

	var totalPagar=0;
	var totalFleteMercanciaF;
	var totalFletePesoF;
	var totalFleteIvaF;
	var mercanciaF;
	var seguroF;
	var fleteF;
	
	var flete = form.txtFlete.value;
	flete = flete.substring(0,flete.indexOf(',')+3);
	flete = flete.replace(',','.');
	fleteF = eval(flete);
	var mercancia = form.txtMercancia.value;	
	mercancia = mercancia.replace('.','');
	mercancia = mercancia.replace(',','.');
	mercanciaF = eval(mercancia);

	totalFleteMercancia = mercanciaF*(fleteF/100);

	var seguro = form.txtSeguro.value;
	if(seguro!="") {
		seguro = seguro.substring(0,seguro.indexOf(',')+3);
		seguro = seguro.replace(',','.');
		seguroF = eval(seguro);
	}
	
	var totalFletePeso = form.txtTotalFletePeso.value;
	if(totalFletePeso!="") {
		totalFletePeso = totalFletePeso.replace('.','');
		totalFletePeso = totalFletePeso.replace(',','.');
		totalFletePesoF = eval(totalFletePeso);
	}
	
	var iva = form.txtIVA.value;
	iva = iva.substring(0,iva.indexOf(',')+3);
	iva = iva.replace(',','.');
	iva = eval(iva);	
	var totalFleteIva = totalFleteMercancia*(iva/100);
	totalFleteIvaF = eval(totalFleteIva);
	
	if(totalFleteMercancia!="") {
		totalPagar += totalFleteMercancia;
	}
	if(totalFletePeso!="") {
		totalPagar += totalFletePesoF;
	}
	totalPagar += totalFleteIvaF;
	if(seguro!="") {
		totalPagar += mercanciaF*(seguroF/100);
	}
	
	form.txtTotalFleteMercancia.value = formatNumber(totalFleteMercancia,2,'.',',','','','-','');
	form.txtFleteIVA.value = formatNumber(totalFleteMercancia,2,'.',',','','','-','');
	form.txtTotalFleteIVA.value = formatNumber(totalFleteIva,2,'.',',','','','-','');
	form.txtTotalPagar.value = formatNumber(totalPagar,2,'.',',','','','-','');
	form.txtFlete.value = formatNumber(fleteF,2,'.',',','','','-','')+" %";
}


// ************************************************
// TRIM FUNCTIONS 
// ************************************************
function trim(str, chars) {
	return ltrim(rtrim(str, chars), chars);
}
 
function ltrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}
 
function rtrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}
// ************************************************