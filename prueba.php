<?php 
$string = "CUREX C.A., CUREX C.A.";
$string = preg_replace("/([,.?!])/"," \\1",$string);
$parts = explode(" ",$string);
$unique = array_unique($parts);
$unique = implode(" ",$unique);
$unique = preg_replace("/\s([,.?!])/","\\1",$unique);
$unique = substr($unique,0,-1);
echo $unique;
?>