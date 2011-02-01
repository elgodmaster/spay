<?php
function Conectarse() 
{ 
$link=mysql_connect ("localhost", "spay", "spay2010") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("spay");
return $link; 
}
$link = Conectarse();
?>
