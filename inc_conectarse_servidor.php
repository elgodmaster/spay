<?php
function Conectarse() 
{ 
$link=mysql_connect ("localhost", "sarkosco_ds", "ds2010") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("sarkosco_wrdp1");
return $link; 
}
$link = Conectarse();
?>
