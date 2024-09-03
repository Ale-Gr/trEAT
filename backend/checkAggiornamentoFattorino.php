<?php

session_start();

include_once("../common/setup.php");
include_once("../common/funzioni.php");

$emailOld = $_SESSION["utente"];
$password = $_GET["password"];
$email = $_GET["email"];
$iban=$_GET["iban"];
$zona=$_GET["zona"];

if (empty($email) || empty($iban)){
    header('location:../frontend/profiloFattorino.php?stato=1');
} 
else {
    #se l'utente modifica, controllo che la stessa mail non sia stata associata ad altri
    if ($email != $emailOld){
        $type = 'fattorino';
        $resEmail = checkNewEmail($cid, $type, $email);
        if ($resEmail == 1){ 
            header('location:../frontend/profiloFattorino.php?stato=2');
        } else {
            $sql1 = "UPDATE fattorino SET fattorino.email = '$email' WHERE fattorino.email = '$emailOld'";
            $res1 = $cid->query($sql1);
            $_SESSION["utente"] = $email; 
          
        }
    }
    #una volta verificata la mail aggiorno l'iban che è associato a quell'utente
    $sql2 = "UPDATE fattorino SET fattorino.iban = '$iban' WHERE fattorino.email = '$email'";
    $res2 = $cid->query($sql2);
    #stessa cosa per la password
    $sql6 = "UPDATE fattorino SET fattorino.password = '$password' WHERE fattorino.email = '$email'";
    $res6 = $cid->query($sql6);
    #inserimento/controllo cap della zona, avviene solo se è stato inserito un cap
    if (!empty($zona) && $resEmail == 0){
        #controllo prima se il cap è già presente nel database

        $sql3 = "SELECT cap FROM zona WHERE cap LIKE '$zona'"; 
        $res3 = $cid -> query($sql3);

        #se non esiste lo inserisco nel db 
        if (mysqli_num_rows($res3) == 0){
            $sql5 = "INSERT INTO zona(cap) VALUES('$zona');";
            $res5 = $cid->query($sql5);
        }
        #controllo che il cap non sia già associato al fattorino 
        $resZona = checkZonaFattorino($cid, $email, $zona);
        if ($resZona == 0){ #se non è già associato lo inserisco
            $sql7 = "INSERT INTO disponibile(fattorino, zona) VALUES ('$email','$zona');";
            $sql7 = $cid->query($sql7);
            header('location:../frontend/profiloFattorino.php?stato=3'); 
        }
        else{
            header('location:../frontend/profiloFattorino.php?stato=5'); 
        }


    }
    elseif(empty($zona) && $resEmail == 0){
        header('location:../frontend/profiloFattorino.php?stato=3'); 
    }
    
    


}

?>