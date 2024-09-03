<?php 

session_start();

include_once("../common/setup.php");
include_once("../common/funzioni.php");

$cliente = $_GET["cliente"];
$date = $_GET["date"];
$email = $_SESSION["utente"];
$tempistica = $_GET["Tempistiche"];
$data_acc = date('Y-m-d');
$ora_acc = date('H:i:s');
$tempistica2 = $tempistica + 10;
$tempistica3 = $tempistica . "-" . $tempistica2 . "minuti";




$sql2 = "UPDATE ordine SET stato = 'preparato/in consegna', email_fattorino = '$email', data_accettazione = '$data_acc', ora_accettazione = '$ora_acc', tempistica_consegna = '$tempistica3'  WHERE timestamp_ordine = '$date' AND email_cliente = '$cliente';";
$res2 = $cid->query($sql2);
header("location:../frontend/fattorino.php?actualpage=0");

?>




