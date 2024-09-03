<?php

session_start();
include_once("../common/setup.php");
include_once("../common/funzioni.php");

$nome = $_POST['nome'];
$prezzo = $_POST['prezzo'];
$descrizione = $_POST['descrizione'];
$email = $_SESSION['utente'];
if (!isset($_POST['piatti'])){
    $piatti = array();
}else{
    $piatti = $_POST['piatti'];
}    

echo $nome, $prezzo, $email, count($piatti);

if (empty($nome)|| empty($prezzo)|| (count($piatti) == 0)){
    header("location:../frontend/piatti.php?stato=2");
}
elseif(count($piatti) == 1){
    header("location:../frontend/piatti.php?stato=4");
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
                $sql = "INSERT INTO pietanza(descrizione, nome, prezzo, filename, email, tipo) VALUES ('$descrizione', '$nome', '$prezzo', '".$img_name."', '$email', 'menu')";             
                $res = $cid->query($sql);
                foreach($piatti as $p){                
                    $sql2 = "INSERT INTO ha(nome_menu, email_ristorante, nome_piatto, email_ristorante_piatto, descrizione,	prezzo) VALUES ('$nome', '$email', '$p', '$email', '$descrizione', '$prezzo');";
                    $res2 = $cid->query($sql2);
                }                    
                header('location:../frontend/piatti.php?stato=1');
            }
        }
        else{
            header("location:../frontend/piatti.php?stato=2");
        }

    }
}   


?>