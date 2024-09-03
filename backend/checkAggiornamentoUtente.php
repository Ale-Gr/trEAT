<?php 

session_start();

include_once("../common/setup.php");
include_once("../common/funzioni.php");

$emailold = $_SESSION["utente"];

$email=$_GET["email"];
$password=$_GET["password"];
$via=$_GET["via"];
$civico=$_GET["civico"];
$citofono=$_GET["citofono"];
$cap=$_GET["cap"];
$citta=$_GET["citta"];


if (empty($email) || empty($password) || empty($via) || empty($civico) || empty($citofono) || empty($cap) || empty($citta)){
    header('location:../frontend/profiloCliente.php?stato=1');
}
else{    
    if ($email != $emailold){
        $sql = "SELECT email FROM cliente WHERE cliente.email = '$email';";
        $res = $cid->query($sql);
        if (mysqli_num_rows($res) == 1){
            header('location:../frontend/profiloCliente.php?stato=2');
        }
        else{
            $sql1 = "UPDATE cliente SET cliente.email = '$email' WHERE cliente.email = '$emailold';";
            $res1 = $cid->query($sql1);
            $_SESSION["utente"]=$email;
        }
    }     
    $sql2 = "UPDATE cliente SET cliente.password = '$password' WHERE cliente.email = '$email';";
    $res2 = $cid->query($sql2);
    $sql3 = "SELECT * FROM indirizzo WHERE via LIKE '$via' AND numero_civico LIKE '$civico' AND citofono LIKE '$citofono' AND cap LIKE '$cap' AND nome_citta LIKE '$citta';";
    $res3 = $cid->query($sql3); #controllo se l'indirizzo c'è già nel db    
    if (mysqli_num_rows($res3) == 1){ #se c'è già non devo crearne uno nuovo, basta aggiornare. Il cliente può non averlo cambiato oppure aver inserito lo stesso indirizzo di un altro cliente (cosa ammissibile)
        $sql4 = "UPDATE cliente SET cliente.via = '$via', cliente.numero_civico = '$civico', cliente.citofono = '$citofono', cliente.cap = '$cap', cliente.nome_citta = '$citta' WHERE cliente.email = '$email';";
        $res4 = $cid->query($sql4);
        header('location:../frontend/profiloCliente.php?stato=3');
    }
    else{ #se non c'è, va creato un indirizzo e poi associato al cliente
        $sql7 = "SELECT * FROM zona WHERE CAP LIKE '$cap';"; #controllo se c'è già il cap
        $res7 = $cid->query($sql7);
        if (mysqli_num_rows($res7) == 0){
            $sql7 = "INSERT INTO zona(cap) VALUES('$cap');";
            $res7 = $cid->query($sql7);
        }
        $sql5 = "INSERT INTO indirizzo(via,	numero_civico, citofono, cap,nome_citta) VALUES('$via', '$civico', '$citofono', '$cap', '$citta');";
        $res5 = $cid->query($sql5);
        $sql6 = "UPDATE cliente SET cliente.via = '$via', cliente.numero_civico = '$civico', cliente.citofono = '$citofono', cliente.cap = '$cap', cliente.nome_citta = '$citta' WHERE cliente.email = '$email';";
        $sql6 = $cid->query($sql6);
        header('location:../frontend/profiloCliente.php?stato=4'); 
    }
}
?>