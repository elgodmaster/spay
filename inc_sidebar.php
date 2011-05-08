			<div id="sidebar">
				<a href="envios.php"><h1>Env&iacute;os</h1></a>
				<ul class="sidemenu">
                  	<li>
                    	<a href="adm_cargar_envio.php">
                        	<img align="texttop" src="images/icons/lorry_add.png" border="0" />
                            Cargar Env&iacute;o
                       	</a>
                   	</li>
					<li>
                    	<a href="adm_envios.php">
                        	<img align="texttop" src="images/icons/lorry.png" border="0" />
                            Administrar Env&iacute;os
                       	</a>
                  	</li>
				</ul>				
				
                <a href="guias.php"><h1>Gu&iacute;as de Entrega</h1></a>				
				<ul class="sidemenu">
                    <li>
                    	<a href="adm_generar_guia.php">
                        	<img align="texttop" src="images/icons/paste_plain.png" border="0" />
                            Generar Gu&iacute;a
                       	</a>
                   	</li>
                    <li>
                    	<a href="adm_guias.php">
                        	<img align="texttop" src="images/icons/paste_plain.png" border="0" />
                            Administrar Gu&iacute;as
                       	</a>
                  	</li>                  
				</ul>
                						
				<a href="facturas.php"><h1>Facturas</h1></a>				
				<ul class="sidemenu">
					<li>
                    	<a href="adm_factura_proveedor.php">
                    		<img align="texttop" src="images/icons/printer_add.png" border="0" />
                        	Generar Factura Proveedor
                      	</a>
                   	</li>
					<li>
                    	<a href="adm_factura_cliente.php">
                    		<img align="texttop" src="images/icons/printer_add.png" border="0" />
                        	Generar Factura Cliente
                      	</a>
                   	</li>
					<li>
                    	<a href="adm_facturas.php">
                            <img align="texttop" src="images/icons/printer.png" border="0" />
                        	Administrar Facturas
                      	</a>
                 	</li>
      		    </ul>
				
				<a href="reportes.php"><h1>Reportes</h1></a>				
				<ul class="sidemenu">
                    <li>
                    	<a href="adm_reporte_envios.php">
                        	<img align="texttop" src="images/icons/chart_bar.png" border="0" />
                        	Reporte Env&iacute;os
                       	</a>
                   	</li>
                    <li>
                    	<a href="adm_reporte_facturas.php">
                        	<img align="texttop" src="images/icons/chart_bar.png" border="0" />
                        	Reporte Facturas
                       	</a>
                   	</li>
				</ul>
				
				<a href="configuracion.php"><h1>Configuraci&oacute;n</h1></a>				
				<ul class="sidemenu">
                	<li>
                    	<a href="adm_cuenta.php">
                        	<img align="texttop" src="images/icons/user.png" border="0" />
                        	Datos de Usuario
                       	</a>
                  	</li>
					<?php if($_SESSION["id_usuario"]==1) { ?>
                    <li>
                    	<a href="adm_usuarios.php">
                        	<img align="texttop" src="images/icons/application_form_edit.png" border="0" />
                            Administrar Usuarios
                       	</a>
                   	</li>
                  	<?php } ?>
                    <li>
                    	<a href="adm_clientes.php">
                        	<img align="texttop" src="images/icons/group.png" border="0" />
                            Clientes
                       	</a>
                   	</li>
                    <li>
                    	<a href="adm_proveedores.php">
                        	<img align="texttop" src="images/icons/group.png" border="0" />
                            Proveedores
                       	</a>
                   	</li>
                    <li>
                    	<a href="adm_destinos.php">
                        	<img align="texttop" src="images/icons/map.png" border="0" />
                            Destinos
                       	</a>
                   	</li>
                    <li>
                    	<a href="adm_choferes.php">
                        	<img align="texttop" src="images/icons/lorry.png" border="0" />
                            Choferes y Camiones
                       	</a>
                   	</li>
                    <li>
                    	<a href="adm_datos_sistema.php">
                        	<img align="texttop" src="images/icons/wrench_orange.png" border="0" />
                            Datos del Sistema
                       	</a>
                   	</li>
				</ul>
			</div>	         