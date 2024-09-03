<?php 

session_start();

include_once("../common/setup.php");
include_once("../common/funzioni.php");

$emailold = $_SESSION["utente"];

$nome = $_GET["nome"];
$partita_iva = $_GET["partita_iva"];
$ragione_sociale = $_GET["ragione_sociale"];
$email=$_GET["email"];
$password=$_GET["password"];
$via=$_GET["via"];
$civico=$_GET["civico"];
$citofono=$_GET["citofono"];
$cap=$_GET["cap"];
$citta=$_GET["citta"];
$via_sede=$_GET["via_sede"];
$civico_sede=$_GET["civico_sede"];
$citofono_sede=$_GET["citofono_sede"];
$cap_sede=$_GET["cap_sede"];
$citta_sede=$_GET["citta_sede"];
$resEmail = 0;


if (empty($nome) || empty($partita_iva) || empty($ragione_sociale) || empty($email) || empty($password) || empty($via) || empty($civico) || empty($citofono) || empty($cap) || empty($citta) || empty($via_sede) || empty($civico_sede) || empty($citofono_sede) || empty($cap_sede) || empty($citta_sede)){
    header('location:../frontend/profiloRistorante.php?stato=1');
}
else{    
    if ($email != $emailold){
        $type = 'rist';
        $resEmail = checkNewEmail($cid, $type, $email);
        if ($resEmail == 1){ #controllo che la stessa email non sia già associata ad altri ristoranti
            header('location:../frontend/profiloRistorante.php?stato=2');
        }
        else{
            $sql1 = "UPDATE ristorante SET ristorante.email = '$email' WHERE ristorante.email = '$emailold';";
            $res1 = $cid->query($sql1);
            $_SESSION["utente"]=$email;
        }
    }
    $sql = "UPDATE ristorante SET ristorante.nome = '$nome' WHERE ristorante.email = '$email';";
    $res = $cid->query($sql); #update nome    
    $sql12 = "UPDATE ristorante SET ristorante.password = '$password' WHERE ristorante.email = '$email';";
    $res12 = $cid->query($sql12); #update password
    $sql2 = "UPDATE ristorante SET ristorante.partita_iva = '$partita_iva' WHERE ristorante.email = '$email';";
    $res2 = $cid->query($sql2); #nella partita iva non faccio controlli, due ristoranti possono averla uguale se per esempio sono parte della stessa catena
    $sql3 = "UPDATE ristorante SET ristorante.ragione_sociale = '$ragione_sociale' WHERE ristorante.email = '$email';";
    $res3 = $cid->query($sql3); 
    $resIndirizzo = checkIndirizzo($cid, $via, $civico, $citofono, $cap, $citta);
    $resSede = checkIndirizzo($cid, $via_sede, $civico_sede, $citofono_sede, $cap_sede, $citta_sede);
    if ($resIndirizzo == 1 && $resSede == 1 && $resEmail == 0){ #indirizzo e sede già nel db - aggiorno e basta
        $sql4 = "UPDATE ristorante SET ristorante.via = '$via', ristorante.numero_civico = '$civico', ristorante.citofono = '$citofono', ristorante.cap = '$cap', ristorante.nome_citta = '$citta' WHERE ristorante.email = '$email';";
        $res4 = $cid->query($sql4);
        $sql8 = "UPDATE ristorante SET ristorante.via_sede = '$via_sede', ristorante.numero_civico_sede = '$civico_sede', ristorante.citofono_sede = '$citofono_sede', ristorante.cap_sede = '$cap_sede', ristorante.citta_sede = '$citta_sede' WHERE ristorante.email = '$email';";
        $sql8 = $cid->query($sql8);
        header('location:../frontend/profiloRistorante.php?stato=3');
    }
    elseif ($resIndirizzo == 0 && $resSede == 0 && $resEmail == 0){ #indirizzo e sede non nel db - inserisco e aggiorno
        $sql9 = "SELECT cap FROM zona WHERE cap LIKE '$cap';"; //controllo l'esistenza del cap dell'indirizzo
        $res9 = $cid->query($sql9);
        if (mysqli_num_rows($res9) == 0){  //cap inesistente --> lo aggiungo
            $sql10 = "INSERT INTO zona(cap) VALUES ('$cap');";
            $res10 = $cid->query($sql10);
        }
        $sql11 = "SELECT cap FROM zona WHERE cap LIKE '$cap_sede';"; //controllo l'esistenza del cap della sede
        $res11 = $cid->query($sql11);
        if (mysqli_num_rows($res11) == 0){  //cap inesistente --> lo aggiungo
            $sql12 = "INSERT INTO zona(cap) VALUES ('$cap_sede');";
            $res = $cid->query($sql12);
        }
        $sql5 = "INSERT INTO indirizzo(via,	numero_civico, citofono, cap,nome_citta) VALUES('$via', '$civico', '$citofono', '$cap', '$citta');";
        $res5 = $cid->query($sql5);
        $resSede = checkIndirizzo($cid, $via_sede, $civico_sede, $citofono_sede, $cap_sede, $citta_sede);
        if ($resSede == 0){        
            $sql7 = "INSERT INTO indirizzo(via,	numero_civico, citofono, cap,nome_citta) VALUES('$via_sede', '$civico_sede', '$citofono_sede', '$cap_sede', '$citta_sede');";
            $res7 = $cid->query($sql7);
        }
        $sql6 = "UPDATE ristorante SET ristorante.via = '$via', ristorante.numero_civico = '$civico', ristorante.citofono = '$citofono', ristorante.cap = '$cap', ristorante.nome_citta = '$citta' WHERE ristorante.email = '$email';";
        $sql6 = $cid->query($sql6);
        $sql8 = "UPDATE ristorante SET ristorante.via_sede = '$via_sede', ristorante.numero_civico_sede = '$civico_sede', ristorante.citofono_sede = '$citofono_sede', ristorante.cap_sede = '$cap_sede', ristorante.citta_sede = '$citta_sede' WHERE ristorante.email = '$email';";
        $sql8 = $cid->query($sql8);
        header('location:../frontend/profiloRistorante.php?stato=3'); 
    }
    elseif ($resIndirizzo == 1 && $resSede == 0 && $resEmail == 0){ #indirizzo già nel db - sede da aggiungere
        $sql11 = "SELECT cap FROM zona WHERE cap LIKE '$cap_sede';"; //controllo l'esistenza del cap della sede
        $res11 = $cid->query($sql11);
        if (mysqli_num_rows($res11) == 0){  //cap inesistente --> lo aggiungo
            $sql12 = "INSERT INTO zona(cap) VALUES ('$cap_sede');";
            $res = $cid->query($sql12);
        }
        $sql7 = "INSERT INTO indirizzo(via,	numero_civico, citofono, cap,nome_citta) VALUES('$via_sede', '$civico_sede', '$citofono_sede', '$cap_sede', '$citta_sede');";
        $res7 = $cid->query($sql7);
        $sql6 = "UPDATE ristorante SET ristorante.via = '$via', ristorante.numero_civico = '$civico', ristorante.citofono = '$citofono', ristorante.cap = '$cap', ristorante.nome_citta = '$citta' WHERE ristorante.email = '$email';";
        $sql6 = $cid->query($sql6);
        $sql8 = "UPDATE ristorante SET ristorante.via_sede = '$via_sede', ristorante.numero_civico_sede = '$civico_sede', ristorante.citofono_sede = '$citofono_sede', ristorante.cap_sede = '$cap_sede', ristorante.citta_sede = '$citta_sede' WHERE ristorante.email = '$email';";
        $sql8 = $cid->query($sql8);
        header('location:../frontend/profiloRistorante.php?stato=3'); 
    }
    elseif ($resIndirizzo == 0 && $resSede == 1 && $resEmail == 0){ #sede già nel db - indirizzo da aggiungere
        $sql9 = "SELECT cap FROM zona WHERE cap LIKE '$cap';"; //controllo l'esistenza del cap dell'indirizzo
        $res9 = $cid->query($sql9);
        if (mysqli_num_rows($res9) == 0){  //cap inesistente --> lo aggiungo
            $sql10 = "INSERT INTO zona(cap) VALUES ('$cap');";
            $res10 = $cid->query($sql10);
        }
        $sql5 = "INSERT INTO indirizzo(via,	numero_civico, citofono, cap,nome_citta) VALUES('$via', '$civico', '$citofono', '$cap', '$citta');";
        $res5 = $cid->query($sql5);
        $sql6 = "UPDATE ristorante SET ristorante.via = '$via', ristorante.numero_civico = '$civico', ristorante.citofono = '$citofono', ristorante.cap = '$cap', ristorante.nome_citta = '$citta' WHERE ristorante.email = '$email';";
        $sql6 = $cid->query($sql6);
        $sql8 = "UPDATE ristorante SET ristorante.via_sede = '$via_sede', ristorante.numero_civico_sede = '$civico_sede', ristorante.citofono_sede = '$citofono_sede', ristorante.cap_sede = '$cap_sede', ristorante.citta_sede = '$citta_sede' WHERE ristorante.email = '$email';";
        $sql8 = $cid->query($sql8);
        header('location:../frontend/profiloRistorante.php?stato=3'); 
    }
    
}
?>