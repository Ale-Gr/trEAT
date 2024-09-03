<?php
    session_start();

    include("../common/setup.php");
    include("../common/funzioni.php");

    $email = $_SESSION["utente"];
    $giorno = $_GET["giorno"];
    $inizio = $_GET["orario"];

    # controllo che l'orario indicato sia effettivamente esistente
    $orario = checkOrario($cid, $email, $giorno, $inizio,"fattorino");
    
    if($orario == 0) {
        header('location:../frontend/turniFattorino.php?stato=3');
    } else {
        if ($inizio == '11:30:00'){
            $fine = '15:30:00';
            $sql2 = "DELETE FROM lavora_in  WHERE fattorino = '$email' AND giorno = '$giorno' AND orario_inizio = '$inizio' AND orario_fine = '$fine';";
            $res2 = $cid->query($sql2);
            header('location:../frontend/turniFattorino.php?stato=2');
        }
        else if ($inizio == '15:30:00'){
            $fine = '19:30:00';
            $sql2 = "DELETE FROM lavora_in  WHERE fattorino = '$email' AND giorno = '$giorno' AND orario_inizio = '$inizio' AND orario_fine = '$fine';";
            $res2 = $cid->query($sql2);
            header('location:../frontend/turniFattorino.php?stato=2');
        }
        else{
            $fine = '23:30:00';
            $sql2 = "DELETE FROM lavora_in  WHERE fattorino = '$email' AND giorno = '$giorno' AND orario_inizio = '$inizio' AND orario_fine = '$fine';";
            $res2 = $cid->query($sql2);
            header('location:../frontend/turniFattorino.php?stato=2');
        }
    }
?>