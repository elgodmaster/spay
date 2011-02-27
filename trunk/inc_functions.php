<?php

	//require("class.phpmailer.php");

	// *********************************************************************************
	// Pagination Functions
	// *********************************************************************************
	
	// PAGE
	function getPage() {
		if(isset($_GET["page"]) && $_GET["page"]!="") {
			return $_GET["page"]; 	
		}
		else {
			return 1;	
		}
	}
	
	// ROWS_PER_PAGE
	function getRowsPerPage($link) {
		$query = "SELECT valor FROM ts_config WHERE parametro='ROWS_PER_PAGE'";
		$result = mysql_query($query,$link);
		while ($row = mysql_fetch_object($result)) {
			return $row->valor;
		}
		return 0;
	}
	
	// PRINT NAVIGATION LINKS FOR NAVIGATION
	function printPaginationNavigation($page,$lastPage, $variables=NULL) {
	
		$variables = substr($variables,strpos($variables,"&")+1);
	
		if($page > 1) {
			if($variables==NULL) {
				$string =  "<a href='".$_SERVER['PHP_SELF']."?page=1' title='Primera P&aacute;gina'>";
			}
			else {
				$string =  "<a href='".$_SERVER['PHP_SELF']."?page=1&".$variables."' title='Primera P&aacute;gina'>";
			}
			$string .= "<img align='texttop' src='images/icons/resultset_first.png' border='0' />"; 
			$string .= "</a>&nbsp;";
			if($variables==NULL) {
				$string .=  "<a href='".$_SERVER['PHP_SELF']."?page=".($page-1)."' title='Anterior'>";
			}
			else {
				$string .=  "<a href='".$_SERVER['PHP_SELF']."?page=".($page-1)."&".$variables."' title='Anterior'>";	
			}
			$string .= "<img align='texttop' src='images/icons/resultset_previous.png' border='0' />"; 
			$string .= "</a>&nbsp;";		
			echo $string;	
		}
		
		if($lastPage==0) {
			echo "P&aacute;gina ".$lastPage." de ".$lastPage."&nbsp;";
		}
		else {
			echo "P&aacute;gina ".$page." de ".$lastPage."&nbsp;";	
		}
		
		if($page < $lastPage) {
			if($variables==NULL) {
				$string =  "<a href='".$_SERVER['PHP_SELF']."?page=".($page+1)."' title='Siguiente'>";
			}
			else {
				$string =  "<a href='".$_SERVER['PHP_SELF']."?page=".($page+1)."&".$variables."' title='Siguiente'>";
			}
			$string .= "<img align='texttop' src='images/icons/resultset_next.png' border='0' />"; 
			$string .= "</a>&nbsp;";
			if($variables==NULL) {
				$string .=  "<a href='".$_SERVER['PHP_SELF']."?page=".$lastPage."' title='&Uacute;ltima P&aacute;gina'>";
			}
			else {
				$string .=  "<a href='".$_SERVER['PHP_SELF']."?page=".$lastPage."&".$variables."' title='&Uacute;ltima P&aacute;gina'>";	
			}
			$string .= "<img align='texttop' src='images/icons/resultset_last.png' border='0' />"; 
			$string .= "</a>&nbsp;";		
			echo $string;	
		}		
	
	}
	
	// *********************************************************************************
	
	// *********************************************************************************
	// MySQL Functions 
	// ********************************************************************************
	
	function obtenerResultset($link, $query) {
		return mysql_query($query,$link);
	}
	
	function obtenerRegistro($result) {
		return mysql_fetch_object($result);
	}
	
	function numeroRegistros($result) {
		return mysql_num_rows($result);
	}	

	function NVL($valor) {
		if($valor!="") {
			return $valor;
		}
		else {
			return "NULL";
		}
	}
		
	// *********************************************************************************
	// Config Functions 
	// ********************************************************************************	
	
	function obtenerIndActivo($link) {
		$query = "SELECT * FROM ts_config WHERE parametro = 'IND_ACTIVO' AND ind_activo = 1 ORDER BY valor";
		return mysql_query($query,$link);
	}
	
	function mostrarFecha($fecha) {
		return date("d/m/Y", strtotime($fecha));
	}
	
	function indEnvioStr($link, $codigo) {
		$query = "SELECT * FROM ts_config WHERE parametro='IND_ENVIO' AND codigo=".$codigo;
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		return $row->valor;
	}
	
	function indEstatusStr($link, $codigo) {
		$query = "SELECT * FROM ts_config WHERE parametro='IND_ACTIVO' AND codigo=".$codigo;
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		return $row->valor;
	}
	
	function colorIndEnvio($codigo) {
		switch ($codigo) {
			case 1: return "#009";
			break;
			case 2: return "#F90";
			break;
			case 3: return "#093";
			break;
			case 4: return "#F00";
			break;
			case 5: return "#F06";
			break;
		}
	}
	
	function colorIndEstatus($codigo) {
		switch ($codigo) {
			case 0: return "#F00";
			break;
			case 1: return "#093";
			break;
		}
	}
	
	function tipoEnvio($tipo) {
		switch ($tipo) {
			case "F": return "FACTURA";
			break;
			case "N": return "NOTA DE ENTREGA";
			break;
		}
	}
	
	function tipoCobro($tipo) {
		switch ($tipo) {
			case "V": return "VALOR";
			break;
			case "P": return "PESO";
			break;
			case "M": return "VIAJE";
			break;
		}
	}
	
	function indGuiaStr($ind_guia) {
		switch ($ind_guia) {
			case 0: return "TEMPORAL";
			break;
			case 1: return "EN RUTA";
			break;
			case 2: return "ENTREGADA";
			break;
			
			default:
				;
			break;
		}
	}
	
	function colorIndGuia($codigo) {
		switch ($codigo) {
			case 0: return "#F00";
			break;
			case 1: return "#F90";
			break;
			case 2: return "#093";
			break;
		}
	}	
	
	function indFacturaStr($ind_factura) {
		switch ($ind_factura) {
			case 1: return "POR COBRAR";
			break;
			case 2: return "COBRADA";
			break;
			case 3: return "ANULADA";
			break;
			
			default:
				;
			break;
		}
	}
	
	function colorIndFactura($codigo) {
		switch ($codigo) {
			case 1: return "#F90";
			break;
			case 2: return "#093";
			break;
			case 3: return "#F00";
			break;
		}
	}		
		
	function codigoNotaDeEntrega($link) {
		$query = "SELECT * FROM ts_config WHERE parametro='SEQ_NOTA_ENTREGA'";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		$query = "UPDATE ts_config SET valor=".($row->valor+1)." WHERE parametro='SEQ_NOTA_ENTREGA'";
		mysql_query($query,$link);
		return $row->valor+1;
	}
		
	function codigoNumeroGuia($link) {
		$query = "SELECT * FROM ts_config WHERE parametro='SEQ_NUMERO_GUIA'";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		$query = "UPDATE ts_config SET valor=".($row->valor+1)." WHERE parametro='SEQ_NUMERO_GUIA'";
		mysql_query($query,$link);
		return $row->valor+1;
	}		
		
	function codigoRelacion($link) {
		$query = "SELECT * FROM ts_config WHERE parametro='SEQ_RELACION'";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		$query = "UPDATE ts_config SET valor=".($row->valor+1)." WHERE parametro='SEQ_RELACION'";
		mysql_query($query,$link);
		return $row->valor+1;
	}	
	
	function codigoNotaDeDevolucion($link) {
		$query = "SELECT * FROM ts_config WHERE parametro='SEQ_DEVOLUCION'";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		$query = "UPDATE ts_config SET valor=".($row->valor+1)." WHERE parametro='SEQ_DEVOLUCION'";
		mysql_query($query,$link);
		return $row->valor+1;
	}
		
	function obtenerNumeroFactura($link, $id) { 
		$query = "SELECT * FROM ts_factura WHERE id=".$id;
		if($result = mysql_query($query,$link)) { 
			$row = mysql_fetch_object($result);
			return $row->numero_factura;	
		}
		return "";
	}
	
	function obtenerIVA($link) {
		$query = "SELECT * FROM ts_config WHERE parametro='IVA'";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		return $row->valor;	
	}
	
	function obtenerBSKG($link) {
		$query = "SELECT * FROM ts_config WHERE parametro='BSKG'";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		return $row->valor;	
	}
	
	function obtenerSeguro($link) {
		$query = "SELECT * FROM ts_config WHERE parametro='SEGURO'";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		return $row->valor;	
	}
	
	function obtenerSeqNotaEntrega($link) {
		$query = "SELECT * FROM ts_config WHERE parametro='SEQ_NOTA_ENTREGA'";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		return $row->valor;	
	}
	
	function obtenerSeqNumeroGuia($link) {
		$query = "SELECT * FROM ts_config WHERE parametro='SEQ_NUMERO_GUIA'";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		return $row->valor;	
	}
	
	function obtenerSeqRelacion($link) {
		$query = "SELECT * FROM ts_config WHERE parametro='SEQ_RELACION'";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		return $row->valor;	
	}
	
	function obtenerSeqDevolucion($link) {
		$query = "SELECT * FROM ts_config WHERE parametro='SEQ_DEVOLUCION'";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		return $row->valor;	
	}
	
	function modificarDatosSistema($link, $datos) { 
		
		// IVA
		$query = "UPDATE ts_config SET valor=".$datos->iva." WHERE parametro='IVA'";
		mysql_query($query,$link);
		
		// BsF/Kg
		$query = "UPDATE ts_config SET valor=".$datos->bskg." WHERE parametro='BSKG'";
		mysql_query($query,$link);
		
		// Seguro
		$query = "UPDATE ts_config SET valor=".$datos->seguro." WHERE parametro='SEGURO'";
		mysql_query($query,$link);	
		
		// SeqNotaEntrega
		$query = "UPDATE ts_config SET valor=".$datos->seq_nota_entrega." WHERE parametro='SEQ_NOTA_ENTREGA'";
		mysql_query($query,$link);
		// SeqNumeroGuia
		$query = "UPDATE ts_config SET valor=".$datos->seq_numero_guia." WHERE parametro='SEQ_NUMERO_GUIA'";
		mysql_query($query,$link);
		// SeqRelacion
		$query = "UPDATE ts_config SET valor=".$datos->seq_relacion." WHERE parametro='SEQ_RELACION'";
		mysql_query($query,$link);
		// SeqDevolucion
		$query = "UPDATE ts_config SET valor=".$datos->seq_devolucion." WHERE parametro='SEQ_DEVOLUCION'";
		mysql_query($query,$link);			

		return "exitoModificarDatosSistema";
	}
	
	function pagadero($tipo_envio) {
		switch ($tipo_envio) {
			case "F": return "DESTINO";
			break;
			case "N": return "CARACAS";;
		}
	}
	
	
	// *********************************************************************************
	// Proveedores
	// *********************************************************************************
	
	function obtenerProveedor($link,$id) {
		$query = "SELECT * from ts_proveedor WHERE id=".$id;
		$result = mysql_query($query,$link);
		return mysql_fetch_object($result);
	}
	
	function obtenerProveedores($link) {
		$query = "SELECT * FROM ts_proveedor
		           WHERE ind_activo = 1 
		        ORDER BY nombre";
		return mysql_query($query,$link);
	}	
	
	function obtenerProveedorStr($link,$id) {
		$query = "SELECT * from ts_proveedor WHERE id=".$id;
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		return $row->nombre;
	}		
	
	function existeProveedor($link, $rif) {
		$query = "SELECT * from ts_proveedor WHERE rif='".$rif."'";
		$result = mysql_query($query,$link);
		return (mysql_num_rows($result) > 0);
	}
		
	function agregarProveedor($link, $proveedor) {
		
		if(!existeProveedor($link, $proveedor->rif)) {
			$query = "INSERT INTO ts_proveedor(rif,
			                                 nombre,
			                                 direccion,
			                                 ciudad,
			                                 telefono,
			                                 flete,
			                                 seguro,
			                                 ind_activo,
			                                 fecha_creacion,
			                                 fecha_modificacion,
			                                 id_usuario) 
			                         VALUES ('".$proveedor->rif."',
			                                 '".$proveedor->nombre."',
			                                 '".$proveedor->direccion."',
			                                 '".$proveedor->ciudad."',
			                                 '".$proveedor->telefono."',
			                                 ".$proveedor->flete.",
			                                 '".$proveedor->seguro."',
			                                 1,
			                                 CURDATE(),
			                                 CURDATE(),
			                                 ".$_SESSION["id_usuario"].")";
			
			mysql_query($query, $link);
			return "exitoAgregarProveedor";
		}
		else {
			return "proveedorYaExisteError";
		}
	}
	
	function modificarProveedor($link, $proveedor) {
		$query = "UPDATE ts_proveedor SET rif='".$proveedor->rif."', 
		                                nombre='".$proveedor->nombre."',
		                                direccion='".$proveedor->direccion."',
		                                ciudad='".$proveedor->ciudad."',
		                                telefono='".$proveedor->telefono."',
		                                flete=".$proveedor->flete.",
		                                seguro='".$proveedor->seguro."',
		                                fecha_modificacion=CURDATE(),
		                                id_usuario=".$_SESSION["id_usuario"]."  
		                          WHERE id=".$proveedor->id;
		
		mysql_query($query, $link);
		return "exitoModificarProveedor";	
	}
	
	function eliminarProveedor($link, $id) {
	
		// Si el proveedor ha sido utilizado en envios se marca como eliminado
		$query = "SELECT * FROM ts_envio WHERE id_proveedor = ".$id;
		$result = mysql_query($query, $link);
		if(mysql_num_rows($result) > 0) {
			$query = "UPDATE ts_proveedor SET ind_activo = 2 WHERE id = ".$id	;
			$result = mysql_query($query, $link);
		}
		else {				
				// El proveedor puede ser eliminado fisicamente
				$query = "DELETE FROM ts_proveedor WHERE id=".$id;
				$result = mysql_query($query, $link);
		}
		return "exitoEliminarProveedor";
	}
	
	function activarProveedor($link, $id) {
		$query = "UPDATE ts_proveedor 
		             SET ind_activo=1
		           WHERE id = ".$id;		
		mysql_query($query, $link);
		return "exitoModificarProveedor";		
	}	
	
	function inactivarProveedor($link, $id) {
		$query = "UPDATE ts_proveedor 
		             SET ind_activo=0
		           WHERE id = ".$id;		
		mysql_query($query, $link);
		return "exitoModificarProveedor";		
	}
		
	// *********************************************************************************	
	
	
	// *********************************************************************************
	// Clientes
	// *********************************************************************************
	
	function obtenerCliente($link,$id) {
		$query = "SELECT * from ts_cliente WHERE id=".$id;
		$result = mysql_query($query,$link);
		return mysql_fetch_object($result);
	}
	
	function obtenerClienteStr($link,$id) {
		$query = "SELECT * from ts_cliente WHERE id=".$id."";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		return $row->nombre;
	}
	
	function obtenerClienteRIF($link,$rif) {
		$query = "SELECT * from ts_cliente WHERE rif='".$rif."'";
		$result = mysql_query($query,$link);
		return mysql_fetch_object($result);
	}
	
	function obtenerClienteIDRIF($link,$rif) {
		$query = "SELECT * from ts_cliente WHERE rif='".$rif."'";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		return $row->id;
	}	
	
	function existeCliente($link, $rif) {
		$query = "SELECT * from ts_cliente WHERE rif='".$rif."'";
		$result = mysql_query($query,$link);
		return (mysql_num_rows($result) > 0);
	}
		
	function obtenerClientes($link) {
		$query = "SELECT * FROM ts_cliente
		           WHERE ind_activo = 1 
		        ORDER BY nombre";
		return mysql_query($query,$link);
	}	
	
	function agregarCliente($link, $cliente) {
		
		if(!existeCliente($link, $cliente->rif)) {
			$query = "INSERT INTO ts_cliente(rif,
			                                 nombre,
			                                 direccion,
			                                 ciudad,
			                                 telefono,
			                                 id_destino,
			                                 flete,
			                                 seguro,
			                                 ind_activo,
			                                 fecha_creacion,
			                                 fecha_modificacion,
			                                 id_usuario) 
			                         VALUES ('".$cliente->rif."',
			                                 '".$cliente->nombre."',
			                                 '".$cliente->direccion."',
			                                 '".$cliente->ciudad."',
			                                 '".$cliente->telefono."',
			                                 ".$cliente->id_destino.",
			                                 ".$cliente->flete.",
			                                 '".$cliente->seguro."',
			                                 1,
			                                 CURDATE(),
			                                 CURDATE(),
			                                 ".$_SESSION["id_usuario"].")";
			
			mysql_query($query, $link);
			return "exitoAgregarCliente";
		}
		else {
			return "clienteYaExisteError";
		}
	}
	
	function modificarCliente($link, $cliente) {
		$query = "UPDATE ts_cliente SET rif='".$cliente->rif."', 
		                                nombre='".$cliente->nombre."',
		                                direccion='".$cliente->direccion."',
		                                ciudad='".$cliente->ciudad."',
		                                telefono='".$cliente->telefono."',
		                                id_destino=".$cliente->id_destino.",
		                                flete=".$cliente->flete.",
		                                seguro='".$cliente->seguro."',
		                                fecha_modificacion=CURDATE(),
		                                id_usuario=".$_SESSION["id_usuario"]."  
		                          WHERE id=".$cliente->id;
		
		mysql_query($query, $link);
		return "exitoModificarCliente";	
	}
	
	function eliminarCliente($link, $id) {
	
		// Si el cliente ha sido utilizado en envios se marca como eliminado
		$query = "SELECT * FROM ts_envio WHERE id_cliente = ".$id;
		$result = mysql_query($query, $link);
		if(mysql_num_rows($result) > 0) {
			$query = "UPDATE ts_cliente SET ind_activo = 2 WHERE id = ".$id	;
			$result = mysql_query($query, $link);
		}
		else {				
				// El cliente puede ser eliminado fisicamente
				$query = "DELETE FROM ts_cliente WHERE id=".$id;
				$result = mysql_query($query, $link);
		}
		return "exitoEliminarCliente";
	}
	
	function activarCliente($link, $id) {
		$query = "UPDATE ts_cliente 
		             SET ind_activo=1
		           WHERE id = ".$id;		
		mysql_query($query, $link);
		return "exitoModificarCliente";		
	}	
	
	function inactivarCliente($link, $id) {
		$query = "UPDATE ts_cliente 
		             SET ind_activo=0
		           WHERE id = ".$id;		
		mysql_query($query, $link);
		return "exitoModificarCliente";		
	}	
		
	// *********************************************************************************		
	
	// *********************************************************************************
	// Envios
	// *********************************************************************************
	
	
	function obtenerEnvio($link,$id) {
		$query = "SELECT * FROM ts_envio WHERE id=".$id;
		$result = mysql_query($query,$link);
		return mysql_fetch_object($result);
	}
	
	function obtenerUltimoEnvioCliente($link,$id_cliente) {
		$query = "SELECT * FROM ts_envio WHERE id_cliente=".$id_cliente." ORDER BY fecha_creacion DESC";
		$result = mysql_query($query,$link);
		return mysql_fetch_object($result);
	}
	
	function obtenerEnviosGuia($link, $id_guia) {
		$query = "SELECT * FROM ts_envio WHERE id_guia=".$id_guia;
		return mysql_query($query, $link);
	}
	
	function obtenerEnviosClienteRemesa($link, $id_cliente, $remesa) {
		$query = "SELECT * 
		            FROM ts_envio 
		           WHERE id_cliente=".$id_cliente." 
		             AND remesa='".$remesa."' 
		             AND id_factura IS NULL ";
		return mysql_query($query, $link);
	}
	
	function obtenerNumeroRemesa($link, $id) {
		$query = "SELECT * FROM ts_envio WHERE id=".$id;
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		return $row->remesa;	
	}
	
	function existeEnvio($link, $envio) { 
		
		if($envio->tipo_envio=="F") {

			$query = "SELECT * 
			            FROM ts_envio 
			           WHERE remesa='".$envio->remesa."' 
			             AND NOT(id_cliente=".$envio->id_cliente.") 
			             AND ind_activo < 2";  
			$result = mysql_query($query, $link);
			if (mysql_num_rows($result) > 0) { return true; }
			
			$query = "SELECT *  
			            FROM ts_factura 
			           WHERE numero_factura='".$envio->remesa."'  
			             AND tipo_factura='C' 
			             AND ind_factura < 3"; 
			$result = mysql_query($query, $link); 
			if (mysql_num_rows($result) > 0) { return true; } 
			
		}
				
		$query = "SELECT * 
		            FROM ts_envio 
		            WHERE id_proveedor=".$envio->id_proveedor." 
		              AND factura='".$envio->factura."' 
		              AND ind_envio < 3 
		              AND ind_activo < 2"; 
		$result = mysql_query($query, $link); 
		if (mysql_num_rows($result) > 0) { return true; }
		
		return false;
	}
	
	// Cargar Envio
	function cargarEnvio($link, $envio) {
	
		if(existeCliente($link, $envio->rif)) {
			$envio->id_cliente = obtenerClienteIDRIF($link, $envio->rif);
		}
		else {
			$query = "INSERT INTO ts_cliente(rif,
			                                 nombre,
			                                 direccion,
			                                 ciudad,
			                                 telefono,
			                                 id_destino,
			                                 flete,
			                                 ind_activo,
			                           	     fecha_creacion,
			                                 fecha_modificacion,
			                                 id_usuario)
			                          VALUES('".$envio->rif."',
			                                 '".$envio->nombre."',
			                                 '".$envio->direccion."',
			                                 '".$envio->ciudad."',
			                                 '".$envio->telefono."',
			                                 '".$envio->id_destino."',
			                                 '".$envio->flete."',
			                                 1,
			                           		 CURDATE(),
			                           		 CURDATE(),
			                           		 ".$_SESSION["id_usuario"].")";
			
			mysql_query($query, $link);

			$id_cliente = mysql_insert_id($link);
			$envio->id_cliente = $id_cliente;
		}
		
		if(!existeEnvio($link, $envio)) {
			
			// Genero el numero de Nota de Entrega
			if($envio->tipo_envio=="N" && trim($envio->remesa)=="") {
				$envio->remesa = codigoNotaDeEntrega($link);
			}
			
			$query = "INSERT INTO ts_envio(id_cliente,
				                           id_proveedor, 
				                           id_destino,
				                           tipo_envio,
				                           tipo_cobro,
				                           bultos,
				                           remesa,
				                           factura,
				                           mercancia,
				                           flete,
				                           peso,
				                           bskg, 
				                           viaje,
				                           ind_envio,
				                           motivo,
				                           ind_activo,
				                           fecha_creacion,
				                           fecha_modificacion,
				                           id_usuario)
				                    VALUES(".$envio->id_cliente.",
				                           ".$envio->id_proveedor.",
				                           ".$envio->id_destino.",
				                           '".$envio->tipo_envio."',
				                           '".$envio->tipo_cobro."',
				                           ".$envio->bultos.",
				                           '".$envio->remesa."',
				                           '".$envio->factura."',
				                           ".NVL($envio->mercancia).",
				                           ".NVL($envio->flete).",
				                           ".NVL($envio->peso).",
				                           ".NVL($envio->bskg).",
				                           ".NVL($envio->viaje).",
				                           1,
				                           '".$envio->observaciones."',
				                           1,
				                           CURDATE(),
				                           CURDATE(),
				                           ".$_SESSION["id_usuario"].")";
	
			mysql_query($query, $link);
			
			$_SESSION["id_ultimo_envio"] = mysql_insert_id($link);
			$_SESSION["id_cliente"] = $envio->id_cliente;
			
			return "exitoCargarEnvio";	
			
		}	
		
		return "envioYaExisteError";
	}
	
	function modificarEnvio($link, $envio) {
		
		$envio_old = obtenerEnvio($link, $envio->id); 
		if(($envio->tipo_envio!=$envio_old->tipo_envio) && $envio->tipo_envio=="N") {
			$envio->remesa = codigoNotaDeEntrega($link);
		}
		
		$query = "UPDATE ts_envio SET bultos=".$envio->bultos.",
				                      tipo_envio='".$envio->tipo_envio."',
				                      tipo_cobro='".$envio->tipo_cobro."',
			                      	  remesa='".$envio->remesa."',
			                      	  factura='".$envio->factura."',
			                      	  mercancia=".NVL($envio->mercancia).",
			                      	  flete=".NVL($envio->flete).",
			                      	  peso=".NVL($envio->peso).",
			                      	  bskg=".NVL($envio->bskg).",
			                      	  viaje=".NVL($envio->viaje).",
			                      	  fecha_modificacion=CURDATE(),
			                      	  id_usuario=".$_SESSION["id_usuario"]." 
			                	WHERE id=".$envio->id;

		mysql_query($query, $link); 
		$envio=NULL;
		return "exitoModificarEnvio";	
	}	
	
	function marcarEnvioEntregado($link, $id, $observaciones) {
		$query = "UPDATE ts_envio  
		             SET ind_envio=3,  
		                 motivo='".$observaciones."', 
			             fecha_modificacion=CURDATE(), 
			             id_usuario=".$_SESSION["id_usuario"]."   
			       WHERE id=".$id; 
		mysql_query($query, $link);
		return "exitoModificarEnvio";
	}
	
	function marcarEnvioNoEntregado($link, $id, $motivo) {
		
	    $envio = obtenerEnvio($link, $id);
		
		$query = "UPDATE ts_envio  
		             SET ind_envio=5,
		                 motivo='".$motivo."',  
		                 id_guia=NULL,
			             fecha_modificacion=CURDATE(), 
			             id_usuario=".$_SESSION["id_usuario"]."   
			       WHERE id=".$id; 
		mysql_query($query, $link);
		
		$guia = obtenerGuia($link, $envio->id_guia);
		$query = "UPDATE ts_guia 
		             SET total_bultos=".($guia->total_bultos - $envio->bultos).", 
		                 total_mercancia=".($guia->total_mercancia - $envio->mercancia).",
		                 total_facturas=".($guia->total_facturas - 1).",
		                 total_flete=".($guia->total_flete - ($envio->mercancia*($envio->flete/100)))." 
		           WHERE id=".$guia->id;
		mysql_query($query, $link);
		
		return "exitoModificarEnvio";
	}
	
	function marcarEnvioDevuelto($link, $id, $motivo) {
		$query = "UPDATE ts_envio  
		             SET ind_envio=4,  
		                 motivo='".$motivo."', 
			             fecha_modificacion=CURDATE(), 
			             id_usuario=".$_SESSION["id_usuario"].",
			             devolucion=".codigoNotaDeDevolucion($link)."    
			       WHERE id=".$id; 
		mysql_query($query, $link);
		return "exitoModificarEnvio";
	}
	
	function eliminarEnvio($link, $id) {
	
		// Si el envio se encuentra asignado a una guia se marca como eliminado
		$query = "SELECT * FROM ts_envio WHERE id=".$id;
		$result = mysql_query($query, $link);
		$row = mysql_fetch_object($result);
		
		if($row->id_guia!="" || $row->ind_envio > 1) {
			$query = "UPDATE ts_envio SET ind_activo = 2 WHERE id=".$id;
			$result = mysql_query($query, $link);
		}
		else {				
				// El envio puede ser eliminado fisicamente
				$query = "DELETE FROM ts_envio WHERE id=".$id;
				$result = mysql_query($query, $link);
		}
		return "exitoEliminarEnvio";
	}	
	
	function liberarEnvio($link, $id) {
	
		$query = "UPDATE ts_envio 
		             SET id_guia=NULL,
		                 ind_envio=1  
		           WHERE id=".$id;
		mysql_query($query, $link);
		return "exitoLiberarEnvio";
	}
			
	
	// *********************************************************************************
	// Regiones
	// *********************************************************************************
	
	// Obtener Region
	function obtenerRegion($link,$id) {
		$query = "SELECT * FROM ts_region WHERE id=".$id;
		$result = mysql_query($query,$link);
		return mysql_fetch_object($result);
	}
	
	function obtenerRegionStr($link,$id) {
		$query = "SELECT * FROM ts_region WHERE id=".$id;
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		return $row->nombre;
	}	
	
	function obtenerRegiones($link) {
		$query = "SELECT * FROM ts_region WHERE ind_activo < 2 ORDER BY nombre";
		return mysql_query($query,$link);
	}
		
	// Agregar Region
	function agregarRegion($link, $nombre, $ind_activo) {
		
		$query = "INSERT INTO ts_region(nombre,
		                                ind_activo,
		                                fecha_creacion,
		                                fecha_modificacion,
		                                id_usuario)
		                         VALUES('".$nombre."',
		                                ".$ind_activo.",
		                                CURDATE(),
		                                CURDATE(),
		                                ".$_SESSION["id_usuario"].")";
		mysql_query($query, $link);
		return "exitoCrearRegion";	
			
	}
	
	// Modificar Region
	function modificarRegion($link, $id, $nombre, $ind_activo) {

		$query = "UPDATE ts_region "; 
		$query .= " SET nombre='".$nombre."', ";
		$query .= "     ind_activo='".$ind_activo."',";
		$query .= "     id_usuario='".$_SESSION["id_usuario"]."',";
		$query .= "     fecha_modificacion= CURDATE() ";
		$query .= " WHERE id = ".$id;		

		mysql_query($query, $link);
		return "exitoModificarRegion";
		
	}	
	
	// Eliminar Region
	function eliminarRegion($link, $id) {
	
		// Si la region es usada por algun estado se marca como eliminada
		$query = "SELECT * FROM ts_estado WHERE id_region = ".$id;
		$result = mysql_query($query, $link);
		if(mysql_num_rows($result) > 0) {
			$query = "UPDATE ts_region SET ind_activo = 2 WHERE id = ".$id	;
			mysql_query($query, $link);
		}
		else {				
			// La region puede ser eliminada fisicamente
			$query = "DELETE FROM ts_region WHERE id=".$id;
			mysql_query($query, $link);
		}
		return "exitoEliminarRegion";
	}	
	
	function activarRegion($link, $id) {
		$query = "UPDATE ts_region 
		             SET ind_activo=1
		           WHERE id = ".$id;		
		mysql_query($query, $link);
		return "exitoModificarRegion";		
	}	
	
	function inactivarRegion($link, $id) {
		$query = "UPDATE ts_region 
		             SET ind_activo=0
		           WHERE id = ".$id;		
		mysql_query($query, $link);
		return "exitoModificarRegion";		
	}	
	
	// *********************************************************************************
	// Estados
	// *********************************************************************************
	
	// Obtener Estado
	function obtenerEstado($link,$id) {
		$query = "SELECT * FROM ts_estado WHERE id=".$id;
		$result = mysql_query($query,$link);
		return mysql_fetch_object($result);
	}
	
	function obtenerEstadoStr($link,$id) {
		$query = "SELECT * FROM ts_estado WHERE id=".$id;
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		return $row->nombre;
	}	
	
	function obtenerEstados($link) {
		$query = "SELECT * FROM ts_estado WHERE ind_activo < 2 ORDER BY nombre";
		return mysql_query($query,$link);
	}
		
	// Agregar Estado
	function agregarEstado($link, $id_region, $nombre, $ind_activo) {
		
		$query = "INSERT INTO ts_estado(id_region,
		 								nombre,
		                                ind_activo,
		                                fecha_creacion,
		                                fecha_modificacion,
		                                id_usuario)
		                         VALUES(".$id_region.",
		                         		'".$nombre."',
		                                ".$ind_activo.",
		                                CURDATE(),
		                                CURDATE(),
		                                ".$_SESSION["id_usuario"].")";
		mysql_query($query, $link);
		return "exitoCrearEstado";	
			
	}
	
	// Modificar Estado
	function modificarEstado($link, $id, $id_region, $nombre, $ind_activo) {

		$query = "UPDATE ts_estado "; 
		$query .= " SET id_region=".$id_region.", nombre='".$nombre."', ";
		$query .= "     ind_activo='".$ind_activo."',";
		$query .= "     id_usuario='".$_SESSION["id_usuario"]."',";
		$query .= "     fecha_modificacion= CURDATE() ";
		$query .= " WHERE id = ".$id;		

		mysql_query($query, $link);
		return "exitoModificarEstado";
		
	}	
	
	// Eliminar Estado
	function eliminarEstado($link, $id) {
	
		// Si el estado es usado por algun destino se marca como eliminado
		$query = "SELECT * FROM ts_destino WHERE id_estado = ".$id;
		$result = mysql_query($query, $link);
		if(mysql_num_rows($result) > 0) {
			$query = "UPDATE ts_estado SET ind_activo = 2 WHERE id = ".$id	;
			mysql_query($query, $link);
		}
		else {				
			// El estado puede ser eliminado fisicamente
			$query = "DELETE FROM ts_estado WHERE id=".$id;
			mysql_query($query, $link);
		}
		return "exitoEliminarEstado";
	}	
	
	function activarEstado($link, $id) {
		$query = "UPDATE ts_estado 
		             SET ind_activo=1
		           WHERE id = ".$id;		
		mysql_query($query, $link);
		return "exitoModificarEstado";		
	}	
	
	function inactivarEstado($link, $id) {
		$query = "UPDATE ts_estado 
		             SET ind_activo=0
		           WHERE id = ".$id;		
		mysql_query($query, $link);
		return "exitoModificarEstado";		
	}	
		
	
	// *********************************************************************************
	// Destinos
	// *********************************************************************************
	
	// Obtener Destino
	function obtenerDestino($link,$id) {
		$query = "SELECT * FROM ts_destino WHERE id=".$id;
		$result = mysql_query($query,$link);
		return mysql_fetch_object($result);
	}
	
	function obtenerDestinoStr($link,$id) {
		$query = "SELECT * FROM ts_destino WHERE id=".$id;
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		return $row->nombre;
	}	
	
	function obtenerDestinos($link) {
		$query = "SELECT * FROM ts_destino WHERE ind_activo < 2 ORDER BY nombre";
		return mysql_query($query,$link);
	}
		
	// Agregar Destino
	function agregarDestino($link, $id_region, $id_estado, $nombre, $ind_activo) {
		
		$query = "INSERT INTO ts_destino(id_region,
										 id_estado,
		 								 nombre,
		                                 ind_activo,
		                                 fecha_creacion,
		                                 fecha_modificacion,
		                                 id_usuario)
		                          VALUES(".$id_region.",
		                                 ".$id_estado.",
		                          		 '".$nombre."',
		                                 ".$ind_activo.",
		                                 CURDATE(),
		                                 CURDATE(),
		                                 ".$_SESSION["id_usuario"].")";
		mysql_query($query, $link);
		return "exitoCrearDestino";	
			
	}
	
	// Modificar Destino
	function modificarDestino($link, $id, $id_region, $id_estado, $nombre, $ind_activo) {

		$query = "UPDATE ts_destino "; 
		$query .= " SET id_region=".$id_region.", id_estado=".$id_estado.",  nombre='".$nombre."', ";
		$query .= "     ind_activo='".$ind_activo."',";
		$query .= "     id_usuario='".$_SESSION["id_usuario"]."',";
		$query .= "     fecha_modificacion= CURDATE() ";
		$query .= " WHERE id = ".$id;		

		mysql_query($query, $link);
		return "exitoModificarDestino";
		
	}	
	
	// Eliminar Destino
	function eliminarDestino($link, $id) {
	
		// Si el destino es usado en envios se marca como eliminado
		$query = "SELECT * FROM ts_envio WHERE id_estado = ".$id;
		$result = mysql_query($query, $link);
		if(mysql_num_rows($result) > 0) {
			$query = "UPDATE ts_destino SET ind_activo = 2 WHERE id = ".$id	;
			mysql_query($query, $link);
		}
		else {				
			// El destino puede ser eliminado fisicamente
			$query = "DELETE FROM ts_destino WHERE id=".$id;
			mysql_query($query, $link);
		}
		return "exitoEliminarDestino";
	}	
	
	function activarDestino($link, $id) {
		$query = "UPDATE ts_destino 
		             SET ind_activo=1
		           WHERE id = ".$id;		
		mysql_query($query, $link);
		return "exitoModificarDestino";		
	}	
	
	function inactivarDestino($link, $id) {
		$query = "UPDATE ts_destino 
		             SET ind_activo=0
		           WHERE id = ".$id;		
		mysql_query($query, $link);
		return "exitoModificarDestino";		
	}

	
	// *********************************************************************************
	// Choferes
	// *********************************************************************************
	
	// Obtener Chofer
	function obtenerChofer($link,$id) {
		$query = "SELECT * FROM ts_chofer WHERE id=".$id;
		$result = mysql_query($query,$link);
		return mysql_fetch_object($result);
	}
	
	function obtenerChoferStr($link,$id) {
		$query = "SELECT * FROM ts_chofer WHERE id=".$id;
		$result = mysql_query($query,$link);
		$row = mysql_fetch_object($result);
		return $row->nombre;
	}	
	
	function obtenerChoferes($link) {
		$query = "SELECT * FROM ts_chofer WHERE ind_activo < 2 ORDER BY nombre";
		return mysql_query($query,$link);
	}
		
	// Agregar Chofer
	function agregarChofer($link, $nombre, $cedula, $telefono, $placa, $direccion, $ind_activo) {
		
		$query = "INSERT INTO ts_chofer(nombre,
										cedula,
										telefono,
										placa,
										direccion,
		                                ind_activo,
		                                fecha_creacion,
		                                fecha_modificacion,
		                                id_usuario)
		                         VALUES('".$nombre."',
		                         		'".$cedula."',
		                          		'".$telefono."',
		                          		'".$placa."',
		                          		'".$direccion."',
		                                ".$ind_activo.",
		                                CURDATE(),
		                                CURDATE(),
		                                ".$_SESSION["id_usuario"].")";
		mysql_query($query, $link);
		return "exitoCrearChofer";	
			
	}
	
	// Modificar Chofer
	function modificarChofer($link, $id, $nombre, $cedula, $telefono, $placa, $direccion, $ind_activo) {

		$query = "UPDATE ts_chofer "; 
		$query .= " SET nombre='".$nombre."', cedula='".$cedula."',  telefono='".$telefono."', ";
		$query .= "     placa='".$placa."', direccion='".$direccion."', ind_activo='".$ind_activo."',";
		$query .= "     id_usuario='".$_SESSION["id_usuario"]."',";
		$query .= "     fecha_modificacion= CURDATE() ";
		$query .= " WHERE id = ".$id;		

		mysql_query($query, $link);
		return "exitoModificarChofer";
		
	}	
	
	// Eliminar Chofer
	function eliminarChofer($link, $id) {
	
		// Si el chofer se usa en una guia se marca como eliminado
		$query = "SELECT * FROM ts_guia WHERE id_estado = ".$id;
		$result = mysql_query($query, $link);
		if(mysql_num_rows($result) > 0) {
			$query = "UPDATE ts_chofer SET ind_activo = 2 WHERE id = ".$id	;
			mysql_query($query, $link);
		}
		else {				
			// El chofer puede ser eliminado fisicamente
			$query = "DELETE FROM ts_chofer WHERE id=".$id;
			mysql_query($query, $link);
		}
		return "exitoEliminarChofer";
	}	
	
	function activarChofer($link, $id) {
		$query = "UPDATE ts_chofer 
		             SET ind_activo=1
		           WHERE id = ".$id;		
		mysql_query($query, $link);
		return "exitoModificarChofer";		
	}	
	
	function inactivarChofer($link, $id) {
		$query = "UPDATE ts_chofer 
		             SET ind_activo=0
		           WHERE id = ".$id;		
		mysql_query($query, $link);
		return "exitoModificarChofer";		
	}
	
	
	// *********************************************************************************
	// GUIAS
	// *********************************************************************************

	function obtenerGuia($link,$id) {
		$query = "SELECT * FROM ts_guia WHERE id=".$id;
		$result = mysql_query($query,$link);
		return mysql_fetch_object($result);
	}
	
	function obtenerGuiaChofer($link,$id_chofer) {
		$query = "SELECT * 
		            FROM ts_guia 
		           WHERE id_chofer=".$id_chofer." 
		             AND fecha_creacion = CURDATE() 
		        ORDER BY fecha_creacion DESC";
		$result = mysql_query($query,$link);
		return mysql_fetch_object($result);
	}
	
	function generarGuiaTemporal($link, $guia) {
		
		$envios = $guia->envios; 
		
		$total_bultos = 0;
		$total_facturas = 0;
		$total_mercancia = 0;
		$total_flete = 0;
		
		$query = "INSERT INTO ts_guia(id_chofer, 
		                              ind_guia, 
		                              ind_activo,
		                              fecha_creacion,
		                              fecha_modificacion,
		                              id_usuario)
		                       VALUES(".$guia->id_chofer.",
		                              0,
		                              1,
		                              CURDATE(),
		                              CURDATE(),
		                              ".$_SESSION["id_usuario"].")";
		mysql_query($query, $link);
		$id_guia = mysql_insert_id($link);
		
		foreach ($envios as $id_envio) {
			
			$query = "SELECT * FROM ts_envio WHERE id=".$id_envio; 
			$result = mysql_query($query, $link);
			$row = mysql_fetch_object($result);
			
            if($row->tipo_cobro=="V") { 
          		$total_flete += $row->mercancia*($row->flete/100);
 			}
 			if($row->tipo_cobro=="P") {
 				$total_flete += $row->peso*$row->bskg;
 			}
 			if($row->tipo_cobro=="M") {
 				$total_flete += $row->viaje;
 			}
 			
 			$total_bultos += $row->bultos;
 			$total_facturas++;
 			$total_mercancia += $row->mercancia;
 			
 			$query = "UPDATE ts_envio 
 			             SET id_guia=".$id_guia.",  
		                 fecha_modificacion=CURDATE(),
		                 id_usuario=".$_SESSION["id_usuario"]."  
 			           WHERE id=".$row->id;
			mysql_query($query, $link);
			
		}
		
		$query = "UPDATE ts_guia 
		             SET total_bultos=".$total_bultos.",  
		                 total_facturas=".$total_facturas.",  
		                 total_mercancia=".$total_mercancia.",  
		                 total_flete=".$total_flete.",  
		                 fecha_modificacion=CURDATE(),
		                 id_usuario=".$_SESSION["id_usuario"]."  
		           WHERE id=".$id_guia;
		mysql_query($query, $link);
		
		$_SESSION["id_guia_tmp"] = $id_guia;
		
		return "exitoGenerarGuiaTemporal";
	}
	
	function modificarGuia($link, $guia, $id_guia) {
		
		$envios = $guia->envios; 
		$envios_actuales = obtenerEnviosGuia($link, $id_guia);
		
		$total_bultos = 0;
		$total_facturas = 0;
		$total_mercancia = 0;
		$total_flete = 0;
		
		while($row = obtenerRegistro($envios_actuales)) {
			$query = "UPDATE ts_envio 
			             SET id_guia=NULL 
			           WHERE id_guia=".$id_guia;
			mysql_query($query, $link);
		}
		
		foreach ($envios as $id_envio) {
			
			$query = "SELECT * FROM ts_envio WHERE id=".$id_envio; 
			$result = mysql_query($query, $link);
			$row = mysql_fetch_object($result);
			
            if($row->tipo_cobro=="V") { 
          		$total_flete += $row->mercancia*($row->flete/100);
 			}
 			if($row->tipo_cobro=="P") {
 				$total_flete += $row->peso*$row->bskg;
 			}
 			if($row->tipo_cobro=="M") {
 				$total_flete += $row->viaje;
 			}
 			
 			$total_bultos += $row->bultos;
 			$total_facturas++;
 			$total_mercancia += $row->mercancia;
 			
 			$query = "UPDATE ts_envio 
 			             SET id_guia=".$id_guia.",  
		                 fecha_modificacion=CURDATE(),
		                 id_usuario=".$_SESSION["id_usuario"]."  
 			           WHERE id=".$row->id;
			mysql_query($query, $link);
			
		}
		
		$query = "UPDATE ts_guia 
		             SET id_chofer=".$guia->id_chofer.",
		                 total_bultos=".$total_bultos.",  
		                 total_facturas=".$total_facturas.",  
		                 total_mercancia=".$total_mercancia.",  
		                 total_flete=".$total_flete.",  
		                 fecha_modificacion=CURDATE(),
		                 id_usuario=".$_SESSION["id_usuario"]."  
		           WHERE id=".$id_guia;
		mysql_query($query, $link);
				
		return "exitoModificarGuia";
	}	
	
	function enviarGuiaRuta($link, $id) {
		                                  	
		$query = "UPDATE ts_guia
		             SET ind_guia=1,
		                 numero_guia=".codigoNumeroGuia($link).",
		                 fecha_modificacion=CURDATE(),
		                 id_usuario=".$_SESSION["id_usuario"]." 
		           WHERE id=".$id;

		mysql_query($query,$link); 
		
		$query = "SELECT * FROM ts_envio WHERE id_guia=".$id;
		$result = mysql_query($query, $link);

		while($row = mysql_fetch_object($result)) {
			$query = "UPDATE ts_envio 
			             SET ind_envio=2,
			             	 motivo=NULL, 
			                 fecha_modificacion=CURDATE(),
		                     id_usuario=".$_SESSION["id_usuario"]." 
			           WHERE id=".$row->id;
			mysql_query($query, $link);
		}
				
		return "exitoEnviarGuiaRuta";
	}
	
	function marcarGuiaEntregada($link, $id) {
		$query = "UPDATE ts_guia SET ind_guia=2 WHERE id=".$id;
		mysql_query($query, $link);
		return "exitoModificarGuia";
	}
	
	
	function eliminarGuia($link, $id) {
		$envios = obtenerEnviosGuia($link, $id);
		while($row = obtenerRegistro($envios)) {
			$query = "UPDATE ts_envio SET id_guia=NULL WHERE id=".$row->id;
			mysql_query($query, $link);
		}
		$query = "DELETE FROM ts_guia WHERE id=".$id;
		mysql_query($query, $link);
		
		return "exitoEliminarGuia";
	}
	
	// *********************************************************************************
	// Usuarios
	// *********************************************************************************
	
	
	function obtenerUsuario($link, $id) {
		$query = "SELECT * FROM ts_usuario WHERE id=".$id;
		$result = mysql_query($query,$link);
		return mysql_fetch_object($result);	
	}
	
	
	// Agregar Usuario
	function agregarUsuario($link, &$login, &$password, &$nombre, &$email, &$ind_activo, &$id_usuario) {
	
		// Verificar que el nombre de usuario no exista
		$query = "SELECT * FROM ts_usuario WHERE login='".$login."'";
		$result = mysql_query($query, $link);
		if(mysql_num_rows($result)>0) {
			return "usuarioYaExisteError";
		}
		else {
			$query = "INSERT INTO ts_usuario(login,
			                                 password,
			                                 nombre,
			                                 email,
			                                 ind_activo,
			                                 fecha_creacion,
			                                 fecha_modificacion,
			                                 id_usuario)
			                          VALUES('".$login."',
			                                 '".$password."',
			                                 '".$nombre."',
			                                 '".$email."',
			                                 ".$ind_activo.",
			                                 CURDATE(),
			                                 CURDATE(),
			                                 ".$id_usuario.")";
			$result = mysql_query($query, $link);	
			return "exitoCrearUsuario";
		}
			
	}
	
	// Modificar Usuario
	function modificarUsuario($link, $id, $password, $nombre, $email, $ind_activo, $id_usuario) {

		$query = "UPDATE ts_usuario "; 
		$query .= " SET password='".$password."', ";
		$query .= "     nombre='".$nombre."',";
		$query .= "     email='".$email."',";
		$query .= "     ind_activo=".$ind_activo.",";
		$query .= "     id_usuario=".$id_usuario.",";
		$query .= "     fecha_modificacion = CURDATE() ";
		$query .= " WHERE id = ".$id;		
		mysql_query($query, $link);
		return "exitoModificarUsuario";
	}	
	
	// Eliminar Usuario
	function eliminarUsuario($link, $id) {
		$query = "UPDATE ts_usuario SET ind_activo = 2 WHERE id = ".$id	;
		mysql_query($query, $link);
		return  "exitoEliminarUsuario";
	}	
	
	function activarUsuario($link, $id) {
		$query = "UPDATE ts_usuario 
		             SET ind_activo=1
		           WHERE id = ".$id;		
		mysql_query($query, $link);
		return "exitoModificarUsuario";		
	}	
	
	function inactivarUsuario($link, $id) {
		$query = "UPDATE ts_usuario 
		             SET ind_activo=0
		           WHERE id = ".$id;		
		mysql_query($query, $link);
		return "exitoModificarUsuario";		
	}	
	
	// Enviar Password 
	function enviarPassword($link,$usuario) {
	
		// Enviar Password
		try {	
			$mail = new PHPMailer(); 
			$mail->IsSMTP(); 
			$mail->Host = "stmp.gmail.com"; // SMTP server
			$mail->SMTPDebug  = 1; // 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth  = true; 
			$mail->SMTPSecure = "ssl"; 
			$mail->Host = "smtp.gmail.com"; 
			$mail->Port = 465;  
			$mail->Username  = "comercial.discoleto@gmail.com";  
			$mail->Password   = "Discoleto2010";
			$mail->SetFrom('comercial.discoleto@gmail.com', 'COMERCIAL DIS-COLETO C.A.');
			$mail->AddReplyTo("comercial.discoleto@gmail.com","COMERCIAL DIS-COLETO C.A.");
			$mail->Subject = "Reenvío de Password: Usuario '".$usuario->login."'";
 			$body =  "Estimado usuario, su password es: ".$usuario->password;
			$mail->MsgHTML($body);
			$address = $usuario->email;
			$mail->AddAddress($address, $usuario->nommbre);			
			$mail->Send();
		}
		catch (Exception $ex){ $action = "do-nothing"; }	
	}
	
	
	// *********************************************************************************
	
	
	// *********************************************************************************
	// FACTURAS
	// *********************************************************************************

	function obtenerFactura($link, $id) {
		$query = "SELECT * FROM ts_factura WHERE id=".$id;
		$result = mysql_query($query, $link); 
		return mysql_fetch_object($result); 
	}
	
	function obtenerIDFactura($link, $numero_factura) {
		$query = "SELECT * FROM ts_factura WHERE numero_factura='".$numero_factura."'";
		$result = mysql_query($query, $link); 
		$row = mysql_fetch_object($result); 
		return $row->id;	
	}
	
	function existeFactura($link, $numero_factura, $envios) {
		
		// Chequeo si el numero de factura es utilizado en facturas no anuladas
		$query = "SELECT * FROM ts_factura WHERE numero_factura='".$numero_factura."' AND ind_factura < 3";
		$result = mysql_query($query, $link);
		if (mysql_num_rows($result)>0) { return true; }
		
		$i = 0;
		foreach ($envios as $e) {
			$envioStr .= $e.",";
		}
		$envioStr = substr($envioStr,0,-1);
		
		// Chequeo si el numero de factura es utilizado como numero de remesa
		// en envios distintos a los facturados
		$query = "SELECT * FROM ts_envio WHERE remesa=".$numero_factura." AND id NOT IN (".$envioStr.")";
		$result = mysql_query($query, $link);
		if (mysql_num_rows($result)>0) { return true; } 
		
		return false;
		
	}
	
	function facturaMarcarCobrada($link, $id, $forma_pago, $fecha_pago, $numero, $banco, $observaciones) {
		
		$query = "UPDATE ts_factura 
		             SET ind_factura=2,
		                 forma_pago='".$forma_pago."', 
		                 numero_pago='".$numero."', 
		                 banco='".strtoupper($banco)."',
		                 fecha_pago='".$fecha_pago."', 
		                 motivo='".$observaciones."',
			             fecha_modificacion=CURDATE(),
		                 id_usuario=".$_SESSION["id_usuario"]."  
		           WHERE id=".$id;
		mysql_query($query, $link);
		return "exitoModificarFactura";
	}
	
	function generarFacturaCliente($link, $id_cliente, $flete, $remesa, $numero_factura, 
	                               $cobrarSeguro, $seguro, $envios) {
	                               	
		$envios2 = $envios;
		$envios1 = $envios;
		
		if(!existeFactura($link, $numero_factura, $envios2)) {
			$cliente = obtenerCliente($link, $id_cliente); 
			
			$factura->proveedor = "";
			$factura->factura = "";
			$factura->total_bultos;
			$factura->total_mercancia = 0;
			$factura->total_peso = 0;
			$factura->bskg = 0;
			$factura->total_viaje;
			$factura->flete = str_replace(",", ".", substr($flete, 0, strpos($flete, ",")+3));
			$factura->seguro = str_replace(",", ".", substr($seguro, 0, strpos($seguro, ",")+3));
					
			
			
			foreach($envios as $id_envio) {
				
				// Obtengo el envio
				$query = "SELECT * FROM ts_envio WHERE id=".$id_envio;
				$result = mysql_query($query, $link);
				$row = mysql_fetch_object($result);
				
				$factura->proveedor .= obtenerProveedorStr($link, $row->id_proveedor).", ";
				$factura->factura .= $row->factura.", ";
				$factura->total_bultos += $row->bultos;
				$factura->total_mercancia += $row->mercancia;
				$factura->total_peso += $row->peso;
				$factura->total_flete_mercancia += $row->mercancia*($factura->flete/100);
				$factura->total_flete_peso += $row->peso*$row->bskg;
				if($factura->bskg==0) $factura->bskg = $row->bskg;
				$factura->total_viaje += $row->viaje;
			} 
			
			$factura->proveedor = substr($factura->proveedor,0,-2);
			$factura->factura = substr($factura->factura,0,-2);
			$factura->total_flete = $factura->total_flete_mercancia + $factura->total_flete_peso + $factura->total_viaje;
			$factura->iva = obtenerIVA($link);
			$factura->total_iva = ($factura->iva/100)*$factura->total_flete;
			
	        $valor = $factura->total_flete + $factura->total_iva;
			if($factura->seguro!="") {
	        	$valor = $valor + ($factura->total_mercancia*($factura->seguro/100));
	        }
	        		
			$query = "INSERT INTO ts_factura(id_cliente,
			                                 numero_factura,
			                                 fecha_factura,
			                                 tipo_factura,
			                                 proveedor,
			                                 factura,
			                                 total_bultos,
			                                 total_mercancia,
			                                 flete,
			                                 total_peso,
			                                 bskg,
			                                 total_viaje,
			                                 iva,
			                                 seguro,
			                                 total_pagar,
			                                 ind_factura,
			                                 ind_activo,
			                                 fecha_creacion,
			                                 fecha_modificacion,
			                                 id_usuario) 
			                          VALUES(".$id_cliente.", 
			                                 '".$numero_factura."', 
			                                 CURDATE(),
			                                 'C',
			                                 '".$factura->proveedor."',
			                                 '".$factura->factura."',
			                                 ".$factura->total_bultos.",
			                                 ".$factura->total_mercancia.",
			                                 ".NVL($factura->flete).",
			                                 ".NVL($factura->total_peso).",
			                                 ".NVL($factura->bskg).",
			                                 ".NVL($factura->total_viaje).",
			                                 ".$factura->iva.",
			                                 ".NVL($factura->seguro).",
			                                 ".$valor.",
			                                 1,
			                                 1,
			                                 CURDATE(),
			                                 CURDATE(),
			                                 ".$_SESSION["id_usuario"].")";
			mysql_query($query, $link); 
			$id_factura = mysql_insert_id($link);
			
			foreach($envios1 as $id_envio) {
				// Obtengo el envio
				$query = "SELECT * FROM ts_envio WHERE id=".$id_envio;
				$result = mysql_query($query, $link);
				$row = mysql_fetch_object($result);
				
				$query = "UPDATE ts_envio SET id_factura=".$id_factura.", remesa='".$numero_factura."' WHERE id=".$row->id;
				mysql_query($query, $link); 
			}
			
			return "exitoGenerarFactura";
		}
		else {
			return "facturaYaExisteError";
		}
	}

	function generarFacturaProveedor($link, $id_proveedor, $flete, $numero_factura, $cobrarSeguro, $seguro, $envios) {

			$envios1 = $envios;
			$envios2 = $envios;
			 
			if(!existeFactura($link, $numero_factura, $envios2)) {		
			$factura->proveedor = "";
			$factura->factura = "";
			$factura->total_bultos;
			$factura->total_mercancia = 0;
			$factura->total_peso = 0;
			$factura->bskg = 0;
			$factura->total_viaje;
			$factura->flete = str_replace(",", ".", substr($flete, 0, strpos($flete, ",")+3));
			$factura->seguro = str_replace(",", ".", substr($seguro, 0, strpos($seguro, ",")+3));
			
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
				$factura->total_flete_mercancia += $row->mercancia*($factura->flete/100);
				$factura->total_flete_peso += $row->peso*$row->bskg;
				if($factura->flete==0) $factura->flete = $row->flete;
				if($factura->bskg==0) $factura->bskg = $row->bskg;
				$factura->total_viaje += $row->viaje;
			} 
			$factura->proveedor = substr($factura->proveedor,0,-2);
			$factura->factura = substr($factura->factura,0,-2);
			$factura->total_flete = $factura->total_flete_mercancia + $factura->total_flete_peso + $factura->total_viaje;
			$factura->iva = obtenerIVA($link);
			$factura->total_iva = ($factura->iva/100)*$factura->total_flete;
			 
	        $valor = $factura->total_flete + $factura->total_iva;
			if($factura->seguro!="") {
	        	$valor = $valor + ($factura->total_mercancia*($factura->seguro/100));
	        }
	        
			$query = "INSERT INTO ts_factura(id_proveedor,
			                                 numero_factura,
			                                 fecha_factura,
			                                 tipo_factura,
			                                 factura,
			                                 total_bultos,
			                                 total_mercancia,
			                                 flete,
			                                 total_peso,
			                                 bskg,
			                                 total_viaje,
			                                 iva,
			                                 seguro,
			                                 total_pagar,
			                                 relacion,
			                                 ind_factura,
			                                 ind_activo,
			                                 fecha_creacion,
			                                 fecha_modificacion,
			                                 id_usuario) 
			                          VALUES(".$id_proveedor.", 
			                                 '".$numero_factura."', 
			                                 CURDATE(),
			                                 'P', 
			                                 '".$factura->factura."',
			                                 ".$factura->total_bultos.",
			                                 ".$factura->total_mercancia.",
			                                 ".NVL($factura->flete).",
			                                 ".NVL($factura->total_peso).",
			                                 ".NVL($factura->bskg).",
			                                 ".NVL($factura->total_viaje).",
			                                 ".$factura->iva.",
			                                 ".NVL($factura->seguro).",
			                                 ".$valor.",
			                                 ".codigoRelacion($link).",
			                                 1,
			                                 1,
			                                 CURDATE(),
			                                 CURDATE(),
			                                 ".$_SESSION["id_usuario"].")"; 
			mysql_query($query, $link); 
			$id_factura = mysql_insert_id($link);	
	
			foreach($envios1 as $id_envio) {
				// Obtengo el envio
				$query = "SELECT * FROM ts_envio WHERE id=".$id_envio;
				$result = mysql_query($query, $link);
				$row = mysql_fetch_object($result);
				
				$query = "UPDATE ts_envio SET id_factura=".$id_factura." WHERE id=".$row->id;
				mysql_query($query, $link); 
			}
			
			return "exitoGenerarFactura";
		}		
		
		return "facturaYaExisteError";
	}

	function anularFactura($link, $id, $motivo) {
		
		$query = "UPDATE ts_factura 
		             SET ind_factura=3,
		                 motivo='".$motivo."', 
			             fecha_modificacion=CURDATE(),
		                 id_usuario=".$_SESSION["id_usuario"]." 
		           WHERE id=".$id; 
		mysql_query($query, $link);
		
		$query = "SELECT * FROM ts_envio WHERE id_factura=".$id;
		$result = mysql_query($query, $link);
		
		while ($row = mysql_fetch_object($result)) {
			$query = "UPDATE ts_envio 
			             SET id_factura=NULL, 
			                 fecha_modificacion=CURDATE(),
		                     id_usuario=".$_SESSION["id_usuario"]."  
		               WHERE id=".$row->id;  
			mysql_query($query, $link);
		}
		
		return "exitoAnularFactura";
	}
	
	function agregarComentarioRelacion($link, $id, $comentarios) {
		
		$factura = obtenerFactura($link, $id);
		if($factura->comentarios!="") {
			$comentarios = $factura->comentarios."<br/>".$comentarios;
		}
		
		$query = "UPDATE ts_factura 
		             SET comentarios='".$comentarios."'
		           WHERE id=".$id;
		mysql_query($query, $link); 

		return "exitoAgregarComentario";
	}


	
	
	
?>	