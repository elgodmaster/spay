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
   <div style="padding-bottom:13px">&nbsp;</div>
   <div style="padding-left:510px; 
    font-size:19px; font-family:Arial Unicode MS;">
	 <?php echo mostrarFecha($factura->fecha_creacion); ?>
   </div>    
   <div align="centered" style="padding:4px 0px 0px 500px;
    font-size:19px; font-family:Arial Unicode MS;">
	 <?php echo $cliente->rif;?>
   </div>       
   <div align="centered" style="padding:70px 0px 0px 170px; 
    font-size:16px; font-family:Arial Unicode MS;">
  	 <?php echo $cliente->nombre; ?>
   </div>          
   <div align="centered" style="padding:20px 0px 17px 100px; 
    font-size:12px; font-family:Arial Unicode MS;">
  	 <?php echo substr($cliente->direccion,0,120); ?>
   </div>      
   <span align="centered" style="padding:17px 0px 0px 40px; 
    font-size:17px; font-family:Arial Unicode MS;">
  	 <?php echo $cliente->ciudad; ?>
   </span> 	 
   <span align="centered" style="padding:17px 0px 0px 255px; 
    font-size:12px; font-family:Arial Unicode MS;">
  	 <?php echo $cliente->telefono; ?>
   </span> 	       
   <div align="centered" style="padding:65px 0px 17px 80px; font-size:12px; ">
   </div>      
   <span align="centered" style="padding:14px 0px 0px 144px; 
    font-size:18px; font-family:Arial Unicode MS;">
  	 <?php echo str_pad($factura->relacion, 4, "0", STR_PAD_LEFT); ?>
   </span> 	 
   <span align="centered" style="padding:12px 0px 0px 220px; 
    font-size:18px; font-family:Arial Unicode MS;">
  	 <?php echo $factura->total_bultos; ?>
   </span>  
   <div>&nbsp;</div> 
   <span align="centered" style="padding:0px 0px 0px 125px; font-weight:bold; 
    font-size:18px; font-family:Arial Unicode MS;">
  	 <?php echo number_format($factura->total_mercancia,2,",","."); ?>
   </span> 	 
   <span align="centered" style="padding:0px 0px 0px 170px; 
    font-size:18px; font-family:Arial Unicode MS;">
		<?php
         if($factura->flete!=0) {  
          echo number_format($factura->flete,2,",",".")." %"; 
         }                    			
         if($total_viaje!="") { 
           echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
         }
        ?>
   </span>  
   <span width="150px" align="right" style="padding:0px 0px 0px 115px; font-weight:bold;
    font-size:18px; font-family:Arial Unicode MS;">
		<?php
          if($total_flete_mercancia!=0 || $total_viaje!=0) { 
            echo number_format($total_flete,2,",","."); 
          }
      	?>
   </span>  
   <div>&nbsp;</div>    
   <span align="centered" style="padding:0px 0px 0px 110px;  
    font-size:18px; font-family:Arial Unicode MS;">
		<?php 
        	if($factura->total_peso!=0) { 
          		echo number_format($factura->total_peso,2,",",".")." Kg";	
       		} 		
		?>
   </span> 	 
   <span align="centered" style="padding:0px 0px 0px 215px; 
    font-size:18px; font-family:Arial Unicode MS;">
		<?php
        	if($factura->bskg!=0) { 
            	echo "  ".number_format($factura->bskg,2,",",".")." Bs/Kg"; 
        	}
        ?>
   </span>  
   <span width="150px" align="right" style="padding:0px 0px 0px 110px; font-weight:bold;
    font-size:18px; font-family:Arial Unicode MS;">
		<?php
        	if($total_flete_peso!=0) { 
            	echo "  ".number_format($total_flete_peso,2,",","."); 
            }
      	?>
   </span>   
   <div>&nbsp;</div>    
   <span align="centered" style="padding:0px 0px 0px 50px;  
    font-size:18px; font-family:Arial Unicode MS;">
		<?php echo number_format($factura->iva,2,",",".")." %"; ?>
   </span> 	 
   <span align="centered" style="padding:0px 0px 0px 245px; 
    font-size:18px; font-family:Arial Unicode MS;">
		<?php 
			if($total_flete_peso!=0) { 
				echo "  ".number_format($total_flete,2,",","."); 
			}
			else {
				echo number_format($total_flete,2,",",".");
			}
		?>
   </span>  
   <span width="150px" align="right" style="padding:0px 0px 10px 135px; font-weight:bold;
    font-size:18px; font-family:Arial Unicode MS;">
		<?php  
			if($total_flete_peso!=0) { 
				echo "  ".number_format($total_iva,2,",","."); 
			}
			else {
				echo number_format($total_iva,2,",","."); 

			}
		?>
   </span>       
   <div>&nbsp;</div>    
   <span align="centered" style="padding:0px 0px 0px 150px;  
    font-size:18px; font-family:Arial Unicode MS;">
		<?php 
			if($factura->seguro!="") {    
            	echo number_format($factura->seguro,2,",",".")." %"; 
      		}		
		?>
   </span> 	  
   <span align="centered" style="padding:0px 0px 0px 150px; 
    font-size:18px; font-family:Arial Unicode MS;">
		<?php 
			if($factura->seguro!="") {    
            	if($total_flete_peso!=0) { 
            		echo "  ".number_format($factura->total_mercancia,2,",",".");  
            	}
            	else {
            		echo number_format($factura->total_mercancia,2,",",".");  
            		
            	}
      		}		
		?>
   </span>  
   <span width="150px" align="right" style="padding:0px 0px 0px 130px; font-weight:bold;
    font-size:18px; font-family:Arial Unicode MS;">
		<?php 
			if($factura->seguro!="") {    
            	if($total_flete_peso!=0) { 
            		echo "  ".number_format($total_seguro,2,",",".");  
            	}
            	else {
            		echo number_format($total_seguro,2,",",".");  
            		
            	}
      		}		
		?>
   </span>      
   <div align="centered" style="padding:19px 0px 0px 560px; font-weight:bold; 
    font-size:18px; font-family:Arial Unicode MS;">
  	 <?php
     	$valor = $total_flete;
        $valor += $total_seguro;
     	$valor += $total_iva;
        if($total_flete_peso!=0) { 
     		echo "  ".number_format($valor,2,",",".");  
        }
        else {
     		echo number_format($valor,2,",",".");  
        	
        } 	 
  	 ?>
   </div>  

<?php include("inc_desconectarse.php"); ?>