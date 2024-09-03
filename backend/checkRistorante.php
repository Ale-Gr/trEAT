    <?php

session_start();

include_once("../common/setup.php");
include_once("../common/funzioni.php");

$dati = array(); 
$errore = array();
$nome = $_GET["nome"];
$ragione = $_GET["ragione"];
$iva = $_GET["iva"];
$email = $_GET["email"];
$password = $_GET["password"];
$via = $_GET["via"];
$civico = $_GET["civico"];
$citta = $_GET["citta"];
$citofono = $_GET["citofono"];
$cap = $_GET["cap"];
$via_sede = $_GET["via_sede"];
$civico_sede = $_GET["civico_sede"];
$citta_sede = $_GET["citta_sede"];
$citofono_sede = $_GET["citofono_sede"];
$cap_sede = $_GET["cap_sede"];
$turni=$_GET["turni"];
$condizioni = $_GET["condizioni"];

if (isset($_GET["login"]))$dati["login"]=$_GET["login"];

if(empty($nome)){
    $errore["nome"]="1";
    $dati["nome"]="";
}
else{
    $dati["nome"]=$nome;
}

if(empty($ragione)){
    $errore["ragione"]="2";
    $dati["ragione"]="";
}
else{
    $dati["ragione"]=$ragione;
}

if(empty($iva)){
    $errore["iva"]="3";
    $dati["iva"]="";
}
else{
    $dati["iva"]=$iva;
}


if(empty($email)){
    $errore["email"]="4";
    $dati["email"]="";
}
else{
    $dati["email"]=$email;
}

if(empty($password)){
    $errore["password"]="12";
    $dati["password"]="";
}
else{
    $dati["password"]=$password;
}

if(empty($via)){
    $errore["via"]="5";
    $dati["via"]="";
}
else{
    $dati["via"]=$via;
}

if(empty($civico)){
    $errore["civico"]="6";
    $dati["civico"]="";
}
else{
    $dati["civico"]=$civico;
}

if(empty($citta)){
    $errore["citta"]="7";
    $dati["citta"]="";
}
else{
    $dati["citta"]=$citta;
}

if(empty($citofono)){
    $errore["citofono"]="8";
    $dati["citofono"]="";
}
else{
    $dati["citofono"]=$citofono;
}

if(empty($cap)){
    $errore["cap"]="9";
    $dati["cap"]="";
}
else{
    $dati["cap"]=$cap;
}

if(empty($via_sede)){
    $errore["via_sede"]="5";
    $dati["via_sede"]="";
}
else{
    $dati["via_sede"]=$via_sede;
}

if(empty($civico_sede)){
    $errore["civico_sede"]="6";
    $dati["civico_sede"]="";
}
else{
    $dati["civico_sede"]=$civico_sede;
}

if(empty($citta_sede)){
    $errore["citta_sede"]="7";
    $dati["citta_sede"]="";
}
else{
    $dati["citta_sede"]=$citta_sede;
}

if(empty($citofono_sede)){
    $errore["citofono_sede"]="8";
    $dati["citofono_sede"]="";
}
else{
    $dati["citofono_sede"]=$citofono_sede;
}

if(empty($cap_sede)){
    $errore["cap_sede"]="9";
    $dati["cap_sede"]="";
}
else{
    $dati["cap_sede"]=$cap_sede;
}

if (!isset($_GET["condizioni"]))
{
	$errore["condizioni"]="10";
	$dati["condizioni"]="ko";
}		
else{
	$dati["condizioni"]="ok";
}  

if (!isset($_GET["turni"]))
{
    $errore["turni"]="11";
    $dati["turni"]="ko";
}		

else
    $dati["turni"]="ok";  




if (count($errore)>0)
{
	header('location:../frontend/datiRistorante.php?status=ko&errore=' . serialize($errore). '&dati=' . serialize($dati));
}
else
{

    $type = 'rist';
	$resEmail = checkNewEmail($cid, $type, $email);
    if ($resEmail == 1){
		$errore["email"]="4";
		$dati["email"]="";
		header('location:../frontend/datiRistorante.php?status=ko&errore=' . serialize($errore). '&dati=' . serialize($dati));    
    } else {
        #se non è presente la mail allora verifico se l'indirizzo è già presente o meno e, nel caso non ci fosse, lo aggiungo 
		$resIndirizzo = checkIndirizzo($cid, $via, $civico, $citofono, $cap, $citta);
		if ($resIndirizzo == 0){ #se non c'è devo crearlo
            $resZona = checkZona($cid, $cap);
            if ($resZona == 0){
                $sqlcap = "INSERT INTO zona(cap) VALUES ('$cap')";
                $rescap = $cid->query($sqlcap);
            }
			$sql1 = "INSERT INTO indirizzo(via,	numero_civico, citofono, cap,nome_citta) VALUES('$via', '$civico', '$citofono', '$cap', '$citta');";
			$res1=$cid->query($sql1);
		}
        $sql2 = "INSERT INTO ristorante(partita_iva, ragione_sociale, via, numero_civico, citofono, cap, nome_citta, nome, email, password, via_sede, numero_civico_sede, citofono_sede, cap_sede, citta_sede) VALUES('$iva','$ragione', '$via', '$civico', '$citofono', '$cap', '$citta', '$nome', '$email', '$password', '$via_sede', '$civico_sede', '$citofono_sede', '$cap_sede', '$citta_sede');";
        $res2=$cid->query($sql2);
        #controllo indirizzo della sede
        $resSede = checkIndirizzo($cid, $via_sede, $civico_sede, $citofono_sede, $cap_sede, $citta_sede);
		if ($resSede == 0){ #se non c'è devo crearlo
            $resZona = checkZona($cid, $cap_sede);
            if ($resZona == 0){
                $sqlcap = "INSERT INTO zona(cap) VALUES ('$cap_sede')";
                $rescap = $cid->query($sqlcap);
            }
            $sql5 = "INSERT INTO indirizzo(via,	numero_civico, citofono, cap,nome_citta) VALUES('$via_sede', '$civico_sede', '$citofono_sede', '$cap_sede', '$citta_sede');";
            $res5=$cid->query($sql5);
		}
        $sql3 = "UPDATE ristorante SET via_sede = '$via_sede', numero_civico_sede = '$civico_sede', citofono_sede = '$citofono_sede', cap_sede = '$cap_sede', citta_sede ='$citta_sede' WHERE ristorante.email LIKE '$email';";
        $res3=$cid->query($sql3);   
        if (in_array("1", $turni)){
            $giorno = "lunedi";
            $orario_inizio = "11:30:00";
            $orario_fine = "15:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("2", $turni)){
            $giorno = "lunedi";
            $orario_inizio = "15:30:00";
            $orario_fine = "19:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("3", $turni)){
            $giorno = "lunedi";
            $orario_inizio = "19:30:00";
            $orario_fine = "23:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("4", $turni)){
            $giorno = "martedi";
            $orario_inizio = "11:30:00";
            $orario_fine = "15:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("5", $turni)){
            $giorno = "martedi";
            $orario_inizio = "15:30:00";
            $orario_fine = "19:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("6", $turni)){
            $giorno = "martedi";
            $orario_inizio = "19:30:00";
            $orario_fine = "23:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("7", $turni)){
            $giorno = "mercoledi";
            $orario_inizio = "11:30:00";
            $orario_fine = "15:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("8", $turni)){
            $giorno = "mercoledi";
            $orario_inizio = "15:30:00";
            $orario_fine = "19:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("9", $turni)){
            $giorno = "mercoledi";
            $orario_inizio = "19:30:00";
            $orario_fine = "23:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("10", $turni)){
            $giorno = "giovedi";
            $orario_inizio = "11:30:00";
            $orario_fine = "15:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("11", $turni)){
            $giorno = "giovedi";
            $orario_inizio = "15:30:00";
            $orario_fine = "19:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("12", $turni)){
            $giorno = "giovedi";
            $orario_inizio = "19:30:00";
            $orario_fine = "23:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("13", $turni)){
            $giorno = "venerdi";
            $orario_inizio = "11:30:00";
            $orario_fine = "15:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("14", $turni)){
            $giorno = "venerdi";
            $orario_inizio = "15:30:00";
            $orario_fine = "19:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("15", $turni)){
            $giorno = "venerdi";
            $orario_inizio = "19:30:00";
            $orario_fine = "23:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        } 
        if (in_array("16", $turni)){
            $giorno = "sabato";
            $orario_inizio = "11:30:00";
            $orario_fine = "15:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("17", $turni)){
            $giorno = "sabato";
            $orario_inizio = "15:30:00";
            $orario_fine = "19:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("18", $turni)){
            $giorno = "sabato";
            $orario_inizio = "19:30:00";
            $orario_fine = "23:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("19", $turni)){
            $giorno = "domenica";
            $orario_inizio = "11:30:00";
            $orario_fine = "15:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("20", $turni)){
            $giorno = "domenica";
            $orario_inizio = "15:30:00";
            $orario_fine = "19:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("21", $turni)){
            $giorno = "domenica";
            $orario_inizio = "19:30:00";
            $orario_fine = "23:30:00";
            $sql2 = "INSERT INTO apertura(ristorante, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }     
    }
    $_SESSION["utente"]=$email;
    $_SESSION["logged"]=true;
	header('location:../frontend/ristorante.php?status=ok&dati=' . serialize($dati));
}    


?>