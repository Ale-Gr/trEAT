<?php 

session_start();

include_once("../common/setup.php");
include_once("../common/funzioni.php");

$ristorante = $_GET["ristorante"];
$piatto = $_GET["piatto"];
$email = $_SESSION["utente"];
$quantita = $_GET["quantita"];
$date = $_GET["date"];
$actualpage = $_GET["actualpage"];

$quantita_new = $quantita +1;
$sql = "SELECT prezzo FROM pietanza JOIN contiene ON pietanza.nome = contiene.nome AND pietanza.email = contiene.email_ristorante WHERE pietanza.nome LIKE '$piatto' AND pietanza.email LIKE '$ristorante';";
$res = $cid->query($sql);
while($row= mysqli_fetch_assoc($res)){   
    $pr = $row['prezzo'];       
}  


$sql1 = "UPDATE contiene SET quantita = '$quantita_new' WHERE nome = '$piatto' AND email_ristorante = '$ristorante' AND  email_cliente = '$email' AND timestamp_ordine = '$date';";
$res1 = $cid->query($sql1);

addPrezzo($cid, $pr, $email, $date);


header("location:../frontend/carrello.php?actualpage=". urlencode($actualpage));


?>