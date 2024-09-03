<?php
    session_start();

    include("../common/setup.php");
    include("../common/funzioni.php");

    $email = $_SESSION["utente"];

    $zona = $_GET["zona"];

    if(empty($zona)){
        header('location:../frontend/profiloFattorino.php?stato=1');
    }
    else{
        #vedo se la zona effettivamente esiste ed è associata al fattorino
        $resZona = checkZonaFattorino($cid, $email, $zona);
        if ($resZona == 0){
            header('location:../frontend/profiloFattorino.php?stato=4');
        }
        else{
            $sql2 = "DELETE FROM disponibile WHERE fattorino = '$email' AND zona = '$zona';";
            $res2 = $cid->query($sql2);
            header('location:../frontend/profiloFattorino.php?stato=3');
        }
    }
?>    