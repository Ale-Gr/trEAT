<?php 

session_start();

include_once("../common/setup.php");
include_once("../common/funzioni.php");

if(isset($_SESSION["type"])){
    $type = $_SESSION["type"];
}
else{
    $type = "";
}  

echo $_SESSION["logged"];

if(!isset($_SESSION["logged"])){
    header("location:../index.php");
}
elseif(isset($_SESSION["logged"]) && $type == "fattorino"){
    header("location:../frontend/fattorino.php");
}
elseif(isset($_SESSION["logged"]) && $type == "cliente"){
    header("location:../frontend/cliente.php");
}
elseif(isset($_SESSION["logged"]) && $type == "ristorante"){
    header("location:../frontend/ristorante.php");
}

?>