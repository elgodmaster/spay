	<div id="header">	
		<div align="left">
		<img align src="images/logo.jpg" width="95px" height="100px" />
		</div>
		<h1 id="logo"><span class="orange">TRANSPORTE</span> <span class="blue">SPAY</span></h1>
        <h2 id="slogan">SISTEMA ADMINISTRATIVO v1.0</h2>
        <div align="right" style="color:#333; padding: 8px 10px 0px 0px; position:absolute; right:10px; top:15px">
        <strong style="font: bold 20px 'Trebuchet MS';"><?php echo date("d/m/Y");?></strong>
        <br />
        <br />
		<?php if($_SESSION["nombre"]!="") { ?>
        <img align="texttop" src="images/icons/user.png" border="0" />
		<?php 
		echo($_SESSION["nombre"]." | ");
        ?>
        <strong>
        <a href="logout.php">SALIR</a>&nbsp;
		</strong>
        <?php 
		} 
        ?>      
        </div>	
	</div>	