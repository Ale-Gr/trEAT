<?php 

session_start();

include_once("../common/setup.php");
include_once("../common/funzioni.php");

$email = $_GET["cliente"];
$date = $_GET["date"];

$sql2 = "UPDATE ordine SET stato = 'preparato/in attesa' WHERE timestamp_ordine = '$date' AND email_cliente = '$email';";
$res2 = $cid->query($sql2);


header("location:../frontend/ristorante.php?actualpage=0");

?>