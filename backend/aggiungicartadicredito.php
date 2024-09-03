<?php 

session_start();

include_once("../common/setup.php");
include_once("../common/funzioni.php");

$numero = $_GET["numero"];
$nome = $_GET["nome"];
$mese = $_GET["mese"];
$anno = $_GET["anno"];
$codice = $_GET["codice"];
$email = $_SESSION["utente"];

if (empty($numero) || empty($nome) || empty($mese) || empty($anno) || empty($codice)){
    header("location:../frontend/profiloCliente.php?stato=1");
}
else{
    $sql = "SELECT * FROM carta WHERE numero_carta LIKE '$numero' AND email_cliente LIKE '$email';";
    $res = $cid->query($sql);
    if (mysqli_num_rows($res) == 0){
        $sql2 = "INSERT INTO carta(email_cliente, nome_titolare, numero_carta, mese_scadenza, anno_scadenza, codice_di_controllo) VALUES ('$email','$nome', '$numero','$mese','$anno','$codice');";
        $sql2 = $cid->query($sql2);
        header("location:../frontend/profiloCliente.php?stato=3");

    }
    else{
        header("location:../frontend/profiloCliente.php?stato=5");
    }

}    


?>