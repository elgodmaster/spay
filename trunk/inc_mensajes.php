<label id="mensError" style ="color:#F00; background-color:#FFC6C6; border-color:#F00;">
<?php 
if($action_result=="usuarioYaExisteError") {
	echo '<img align="texttop" src="images/icons/cancel.png" border="0"  />
          EL LOGIN '.$login.' NO ESTA DISPONIBLE. POR FAVOR INTENTE CON OTRO LOGIN.';
}
if($action_result=="clienteYaExisteError") {
	echo '<img align="texttop" src="images/icons/cancel.png" border="0"  />
          YA EXISTE UN CLIENTE CON EL RIF QUE SE INDICO.';
}
if($action_result=="proveedorYaExisteError") {
	echo '<img align="texttop" src="images/icons/cancel.png" border="0"  />
          YA EXISTE UN PROVEEDOR CON EL RIF QUE SE INDICO.';
}
if($action_result=="envioYaExisteError") {
	echo '<img align="texttop" src="images/icons/cancel.png" border="0"  />
          YA EXISTE UN ENVIO CON EL NUMERO DE REMESA &Oacute; PROVEEDOR-FACTURA QUE SE INDICO.';
}
if($action_result=="facturaYaExisteError") {
	echo '<img align="texttop" src="images/icons/cancel.png" border="0"  />
          YA EXISTE UNA FACTURA SPAY O REMESA CON EL NUMERO INDICADO.';
}
?>
</label> 