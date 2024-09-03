<?php 

session_start();

include_once("../common/setup.php");
include_once("../common/funzioni.php");

$email = $_SESSION["utente"];
$date = $_GET["date"];
$istruzioni = $_GET["istruzioni"];
$pagamento = $_GET["pagamento"];
$ristorante = $_GET["ristorante"];

$giorno = date('D');
$giorno_it = '';
if ($giorno == 'Mon'){
  $giorno_it = 'lunedi';
}  
elseif ($giorno == 'Tue'){
  $giorno_it = 'martedi';
}  
elseif ($giorno == 'Wed'){
  $giorno_it = 'mercoledi';
}  
elseif ($giorno == 'Thu'){
  $giorno_it = 'giovedi';
}  
elseif ($giorno == 'Fri'){
  $giorno_it = 'venerdi';
}  
elseif ($giorno == 'Sat'){  
  $giorno_it = 'sabato';
}  
else{
  $giorno_it = 'domenica';
}  

$ora = Date('H:i:s');

$sqlorari = "SELECT * FROM apertura WHERE ristorante LIKE '$ristorante' AND giorno LIKE '$giorno_it' AND '$ora' BETWEEN orario_inizio AND orario_fine;";
$resorari = $cid->query($sqlorari);
$apertura = "";
if (mysqli_num_rows($resorari) == 0){
  $apertura = "chiuso";
}

if (empty($pagamento)){
    header("location:../frontend/carrello.php?stato=2");
}
if ($apertura == "chiuso"){
    header("location:../frontend/carrello.php?stato=3");
}
else{
    $data_creazione = date('Y-m-d H:i:s');
    $sql2 = "UPDATE ordine SET stato = 'in preparazione', istruzioni_consegna = '$istruzioni', metodo_pagamento = '$pagamento', timestamp_ordine = '$data_creazione' WHERE timestamp_ordine = '$date' AND email_cliente = '$email';";
    $res2 = $cid->query($sql2);
    header("location:../frontend/carrello.php?actualpage=0");
}
?>