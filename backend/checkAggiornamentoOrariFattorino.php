<?php 

session_start();

include_once("../common/setup.php");
include_once("../common/funzioni.php");

$email = $_SESSION["utente"];
$giorno = $_GET["giorno"];
$orario = $_GET["orario"];


#se esiste già un turno del fattorino nel giorno e orario indicato, non devo aggiungere nulla

$numorario = checkOrario($cid, $email, $giorno, $orario,"fattorino");

#tratto direttamente il caso in cui non sia già presente il turno 
if ($numorario == 0){
    if ($orario == '11:30:00'){
        $fine = '15:30:00';
        $sql2 = "INSERT INTO lavora_in(fattorino,giorno,orario_inizio,orario_fine) VALUES ('$email','$giorno', '$orario','$fine');";
        $res2 = $cid -> query($sql2);
        header('location:../frontend/turniFattorino.php?stato=2');
    } else if ($orario == '15:30:00') {
        $fine = '19:30:00';
        $sql3 = "INSERT INTO lavora_in(fattorino,giorno,orario_inizio,orario_fine) VALUES ('$email','$giorno', '$orario','$fine');";
        $res3 = $cid -> query($sql3);
        header('location:../frontend/turniFattorino.php?stato=2');
    } else if ($orario == '19:30:00'){
        $fine = '23:30:00';
        $sql4 = "INSERT INTO lavora_in(fattorino,giorno,orario_inizio,orario_fine) VALUES ('$email','$giorno', '$orario','$fine');";
        $res4 = $cid -> query($sql4);
        header('location:../frontend/turniFattorino.php?stato=2');
    }
} else {
    header('location:../frontend/turniFattorino.php?stato=1');
}


?>