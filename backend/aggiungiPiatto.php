<?php

session_start();
include_once("../common/setup.php");
include_once("../common/funzioni.php");

$nome = $_POST['nome'];
$descrizione = $_POST['descrizione'];
$prezzo = $_POST['prezzo'];
$email = $_SESSION['utente'];
$targetDir = "images/";

if (empty($nome) || empty($descrizione) || empty($prezzo)){
    header("location:../frontend/piatti.php?stato=2");
}
else{

    $numPiatti = checkPiatto($cid, $nome, $email);
    if($numPiatti == 1){ #nome già esistente --> errore
        header("location:../frontend/piatti.php?stato=3");
    }
    else{
        $img_name = basename($_FILES['immagine']['name']);
        $targetFilePath = $targetDir . $img_name;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        if (!empty($img_name)){
            $allowTypes = array('jpg','png','jpeg');
            if(in_array($fileType, $allowTypes)){
                $sql = "INSERT INTO pietanza(descrizione, nome, prezzo, filename, email, tipo) VALUES ('$descrizione', '$nome', '$prezzo', '".$img_name."', '$email', 'piatto')";             
                $res = $cid->query($sql);
                header('location:../frontend/piatti.php?stato=1');
            }
        }            
        else{
            header("location:../frontend/piatti.php?stato=2");
        }

    }
}   


?>