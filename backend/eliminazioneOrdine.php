<?php 

session_start();

include_once("../common/setup.php");
include_once("../common/funzioni.php");

$email = $_SESSION["utente"];
$date = $_GET["date"];

$sql2 = "DELETE FROM contiene WHERE timestamp_ordine = '$date' AND email_cliente = '$email';";
$res2 = $cid->query($sql2);


header("location:../frontend/carrello.php?actualpage=0");

?>