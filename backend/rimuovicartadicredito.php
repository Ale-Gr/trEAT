<?php
    session_start();

    include("../common/setup.php");
    include("../common/funzioni.php");

    $email = $_SESSION["utente"];
    $numero = $_GET["numero"];

    $sql = "DELETE FROM carta WHERE email_cliente = '$email' AND numero_carta = '$numero';";
    $res = $cid->query($sql);
    header('location:../frontend/profiloCliente.php?stato=3');

?>