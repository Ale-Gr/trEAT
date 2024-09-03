<?php

$login= $_POST["user"];
$pwd = $_POST["pass"];
$type = $_POST["type"];

include_once("../common/setup.php");
include_once("../common/funzioni.php");

if ($cid)
{
    $result= isUser($cid,$login,$pwd,$type);
	if ($result["status"]=="ok")
	{
	  session_start();
	  $_SESSION["utente"]=$login;
	  $_SESSION["logged"]=true;
	  $_SESSION["type"]=$type;
	  if ($type == "cliente"){
	  	header("Location:../frontend/cliente.php?status=ok&msg=". urlencode($result["msg"]));
	  }
	  elseif ($type == "fattorino"){
		header("Location:../frontend/fattorino.php?status=ok&msg=". urlencode($result["msg"]));
	}	  
	elseif ($type == "ristorante"){
		header("Location:../frontend/ristorante.php?status=ok&msg=". urlencode($result["msg"]));
	}	  	
	}
	else
	{
	  header("Location:../index.php?status=ko&msg=" . urlencode($result["msg"]));
	}
}
else
	header("Location:../index.php?status=ko&msg=". urlencode("errore di connessione al db"));


?>