<?php
    session_start();

    include("../common/setup.php");
    include("../common/funzioni.php");

    $email = $_SESSION["utente"];
    $pietanza = $_GET["pietanza"];

    echo $email;
    echo $piatto;

    $sql = "DELETE FROM pietanza WHERE email = '$email' AND nome = '$pietanza';";
    $res = $cid->query($sql);
    header('location:../frontend/piatti.php');

?>