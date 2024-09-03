<?php 

session_start();

include_once("../common/setup.php");
include_once("../common/funzioni.php");

$cliente = $_GET["cliente"];
$date = $_GET["date"];
$email = $_SESSION["utente"];
$credito = $_GET["credito"];

$sql = "SELECT * FROM fattorino WHERE email = '$email';";
$res = $cid->query($sql);

while($row= mysqli_fetch_assoc($res)){     
    $cr = $row['credito'];       
    }     
    $credito_new = $cr + $credito;

$sql1 = "UPDATE fattorino SET credito = $credito_new WHERE email = '$email';";
$res1 = $cid->query($sql1);


$sql2 = "UPDATE ordine SET stato = 'consegnato', email_fattorino = '$email' WHERE timestamp_ordine = '$date' AND email_cliente = '$cliente';";
$res2 = $cid->query($sql2);
header("location:../frontend/consegne.php?actualpage=0");

?>
