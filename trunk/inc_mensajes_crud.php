<p>
<label id="mensCRUD" style="color: #063; background-color:#DCFCDA;">    
<?php 	
// Usuarios					
if($action_result=="exitoCrearUsuario") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Usuario creado exitosamente.";
}
if($action_result=="exitoModificarUsuario") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Usuario modificado exitosamente.";
}
if($action_result=="exitoEliminarUsuario") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Usuario eliminado exitosamente.";
}	
// Empresas					
if($action_result=="exitoModificarEmpresa") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Empresa modificada exitosamente.";
}

// Regiones
if($action_result=="exitoCrearRegion") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Regi&oacute;n agregada exitosamente.";
}
if($action_result=="exitoModificarRegion") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Regi&oacute;n modificada exitosamente.";
}
if($action_result=="exitoEliminarRegion") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Regi&oacute;n eliminada exitosamente.";
}	

// Estados
if($action_result=="exitoCrearEstado") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Estado agregado exitosamente.";
}
if($action_result=="exitoModificarEstado") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Estado modificado exitosamente.";
}
if($action_result=="exitoEliminarEstado") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Estado eliminado exitosamente.";
}	

// Destinos
if($action_result=="exitoCrearDestino") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Destino agregado exitosamente.";
}
if($action_result=="exitoModificarDestino") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Destino modificado exitosamente.";
}
if($action_result=="exitoEliminarDestino") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Destino eliminado exitosamente.";
}	

// Choferes
if($action_result=="exitoCrearChofer") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Chofer agregado exitosamente.";
}
if($action_result=="exitoModificarChofer") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Chofer modificado exitosamente.";
}
if($action_result=="exitoEliminarChofer") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Chofer eliminado exitosamente.";
}	

// Clientes
if($action_result=="exitoAgregarCliente") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Cliente agregado exitosamente.";
}
if($action_result=="exitoModificarCliente") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Cliente modificado exitosamente.";
}
if($action_result=="exitoEliminarCliente") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Cliente eliminado exitosamente.";
}

// Proveedores
if($action_result=="exitoAgregarProveedor") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Proveedor agregado exitosamente.";
}
if($action_result=="exitoModificarProveedor") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Proveedor modificado exitosamente.";
}
if($action_result=="exitoEliminarProveedor") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Proveedor eliminado exitosamente.";
}	

// Envios
if($action_result=="exitoCargarEnvio") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Env&iacute;o cargado exitosamente.";
}
if($action_result=="exitoModificarEnvio") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Env&iacute;o modificado exitosamente.";
}
if($action_result=="exitoEliminarEnvio") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Env&iacute;o eliminado exitosamente.";
}
if($action_result=="exitoLiberarEnvio") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Env&iacute;o liberado exitosamente.";
}

// Datos Sistema
if($action_result=="exitoModificarDatosSistema") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Datos del sistema modificados exitosamente.";
}

// Guias
if($action_result=="exitoGenerarGuiaTemporal") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Gu&iacute;a temporal generada exitosamente.";
}
if($action_result=="exitoModificarGuia") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Gu&iacute;a modificada exitosamente.";
}
if($action_result=="exitoEliminarGuia") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Gu&iacute;a eliminada exitosamente.";
}
if($action_result=="exitoEnviarGuiaRuta") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Gu&iacute;a enviada a ruta exitosamente.";
}	

// Facturas
if($action_result=="exitoGenerarFactura") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Factura generada exitosamente.";
}
if($action_result=="exitoModificarFactura") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Factura modificada exitosamente.";
}
if($action_result=="exitoAnularFactura") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Factura anulada exitosamente.";
}
if($action_result=="exitoEliminarFacturas") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Facturas eliminadas exitosamente.";
}
					
// General
if($action_result=="exitoModificarDatos") {
	echo "<img align='texttop' src='images/icons/accept.png' border='0'  /> Datos modificados exitosamente.";
}

	
?>
</label>
</p>