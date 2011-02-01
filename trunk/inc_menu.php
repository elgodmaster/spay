<div id="menu">
  <ul>
	 <li <?php if($_SESSION["modulo"]=="") {?>id="current"<?php }?>><a href="index.php">Inicio</a></li>
	 <li <?php if($_SESSION["modulo"]=="envios") {?>id="current"<?php }?>><a href="envios.php">Env&iacute;os</a></li>
     <li <?php if($_SESSION["modulo"]=="guias") {?>id="current"<?php }?>><a href="guias.php">Gu&iacute;as de Entrega</a></li>	          
	 <li <?php if($_SESSION["modulo"]=="facturas") {?>id="current"<?php }?>><a href="facturas.php">Facturas</a></li>            
	 <li <?php if($_SESSION["modulo"]=="reportes") {?>id="current"<?php }?>><a href="reportes.php">Reportes</a></li>
     <li <?php if($_SESSION["modulo"]=="configuracion") {?>id="current"<?php }?>><a href="configuracion.php">Configuraci&oacute;n</a></li>
  </ul>
</div>