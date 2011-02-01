<?php
// redirect ***************************************************************
// Purpose: Redirects to relative URL on the current site
// Author: http://www.edoceo.com/
function redirect($to)
{
  $schema = $_SERVER['SERVER_PORT'] == '443' ? 'https' : 'http';
  $host = strlen($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:$_SERVER['SERVER_NAME'];
  if (headers_sent()) return false;
  else
  {
    header("HTTP/1.1 301 Moved Permanently");
    // header("HTTP/1.1 302 Found")
    // header("HTTP/1.1 303 See Other")
	
	// Modificar la dir relativa en el servidor ej: "/2004/"
	header("Location:".$schema."://".$host."/spay/".$to);
    exit();
  }
}
?>