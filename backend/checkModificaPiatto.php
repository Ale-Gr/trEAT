<?php

session_start();
include_once("../common/setup.php");
include_once("../common/funzioni.php");

$nome = $_POST['nome'];
$descrizione = $_POST['descrizione'];
$prezzo = $_POST['prezzo'];
$email = $_SESSION['utente'];
$piatto_old = $_GET['piatto_old'];



if (empty($nome) || empty($descrizione) || empty($prezzo)){
    header("location:../frontend/modificaPiatto.php?stato=2&nome=". urlencode($piatto_old));
}
else{

    $numPiatti = checkPiatto($cid, $nome, $email);
    if($numPiatti == 1 && $nome != $piatto_old){ #nome diverso da quello vecchio e già esistente --> errore
        header("location:../frontend/modificaPiatto.php?stato=1&nome=". urlencode($piatto_old));
    }
    else{
        $img_name = basename($_FILES['immagine']['name']);
        $targetFilePath = $targetDir . $img_name;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        if (!empty($img_name)){
            $allowTypes = array('jpg','png','jpeg');
            if(in_array($fileType, $allowTypes)){
                $file_content = addslashes(file_get_contents($img_name));     
                $sql="UPDATE pietanza SET nome = '$nome', prezzo = '$prezzo', descrizione = '$descrizione', filename = '$img_name' WHERE email = '$email' AND nome = '$piatto_old';";
                $res=$cid->query($sql);
            }
        }
        else{
            $sql="UPDATE pietanza SET nome = '$nome', prezzo = '$prezzo', descrizione = '$descrizione' WHERE email = '$email' AND nome = '$piatto_old';";
            $res=$cid->query($sql);
        }            
        header('location:../frontend/piatti.php?stato=1');
    }
}   


?>