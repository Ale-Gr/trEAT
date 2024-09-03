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

$sql2 = "SELECT prezzo FROM pietanza JOIN contiene ON pietanza.nome = contiene.nome AND pietanza.email = contiene.email_ristorante WHERE pietanza.nome LIKE '$piatto' AND pietanza.email LIKE '$ristorante';";
$res2 = $cid->query($sql2);
while($row= mysqli_fetch_assoc($res2)){   
    $pr = $row['prezzo'];       
}  

if ($quantita==1){
    $sql="DELETE FROM contiene WHERE nome = '$piatto' AND email_ristorante = '$ristorante' AND  email_cliente = '$email' AND timestamp_ordine = '$date';";
    $res=$cid->query($sql);
    $sql8 = "UPDATE ordine SET prezzo = prezzo - $pr WHERE email_cliente = '$email' AND timestamp_ordine = '$date';";
$res8 = $cid->query($sql8);
}
else{
    $quantita_new = $quantita - 1;
    $sql = "UPDATE contiene SET quantita = '$quantita_new' WHERE nome = '$piatto' AND email_ristorante = '$ristorante' AND  email_cliente = '$email' AND timestamp_ordine = '$date';";
    $res = $cid->query($sql);
    $sql8 = "UPDATE ordine SET prezzo = prezzo - $pr WHERE email_cliente = '$email' AND timestamp_ordine = '$date';";
$res8 = $cid->query($sql8);
    
}

header("location:../frontend/carrello.php?actualpage=". urlencode($actualpage));

?>