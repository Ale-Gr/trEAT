<?php 

session_start();

include_once("../common/setup.php");
include_once("../common/funzioni.php");

$dati = array();
$errore = array();
$nome=$_GET["nome"];
$cognome=$_GET["cognome"];
$data=$_GET["data"];
$email=$_GET["email"];
$password=$_GET["password"];
$iban=$_GET["iban"];
$condizioni=$_GET["condizioni"];
$turni=$_GET["turni"];
$cap = $_GET["cap"]; 
 

if (isset($_GET["login"])) $dati["login"]=$_GET["login"];

if (empty($nome))
{
	$errore["nome"]="1";
	$dati["nome"]="";
}
else
{
	$dati["nome"]=$nome;
}

if (empty($cognome))
{
	$errore["cognome"]="2";
	$dati["cognome"]="";
}		
else
	$dati["cognome"]=$cognome;

if (empty($data))
{
	$errore["data"]="3";
	$dati["data"]="";
}		
else
	$dati["data"]=$data;    

if (empty($email))
{
	$errore["email"]="4";
	$dati["email"]="";
}		
else
	$dati["email"]=$email;

if (empty($password))
{
	$errore["password"]="5";
	$dati["password"]="";
}		
else
	$dati["password"]=$password;	
    
if (empty($iban))
{
	$errore["iban"]="6";
	$dati["iban"]="";
}		
else
	$dati["iban"]=$iban;
        

if (empty($cap)){
    $errore["cap"] = "8";
    $dati["cap"] = ""; 
}
else {
    $dati["cap"] = $cap;
}

if (!isset($_GET["condizioni"]))
{
	$errore["condizioni"]="7";
	$dati["condizioni"]="ko";
}		

else
	$dati["condizioni"]="ok";



if (!isset($_GET["turni"]))
{
    $errore["turni"]="9";
    $dati["turni"]="ko";
}		

else
    $dati["turni"]="ok";



if (count($errore)>0)
{	
	header('location:../frontend/datiFattorino.php?status=ko&errore=' . serialize($errore). '&dati=' . serialize($dati));
}
else{
    $type = 'fattorino';
    $resEmail = checkNewEmail($cid, $type, $email);
    if ($resEmail == 1){
        $errore["email"]="4";
        $dati["email"]="";
        header('location:../frontend/datiFattorino.php?status=ko&errore=' . serialize($errore). '&dati=' . serialize($dati));
    }
    else
        {
        
        $sql1 = "INSERT INTO fattorino(email,password, nome, cognome, iban, data_nascita) VALUES('$email','$password','$nome','$cognome','$iban','$data');";
        $res1 = $cid->query($sql1);
        if (in_array("1", $turni)){
            $giorno = "lunedi";
            $orario_inizio = "11:30:00";
            $orario_fine = "15:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("2", $turni)){
            $giorno = "lunedi";
            $orario_inizio = "15:30:00";
            $orario_fine = "19:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("3", $turni)){
            $giorno = "lunedi";
            $orario_inizio = "19:30:00";
            $orario_fine = "23:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("4", $turni)){
            $giorno = "martedi";
            $orario_inizio = "11:30:00";
            $orario_fine = "15:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("5", $turni)){
            $giorno = "martedi";
            $orario_inizio = "15:30:00";
            $orario_fine = "19:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("6", $turni)){
            $giorno = "martedi";
            $orario_inizio = "19:30:00";
            $orario_fine = "23:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("7", $turni)){
            $giorno = "mercoledi";
            $orario_inizio = "11:30:00";
            $orario_fine = "15:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("8", $turni)){
            $giorno = "mercoledi";
            $orario_inizio = "15:30:00";
            $orario_fine = "19:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("9", $turni)){
            $giorno = "mercoledi";
            $orario_inizio = "19:30:00";
            $orario_fine = "23:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("10", $turni)){
            $giorno = "giovedi";
            $orario_inizio = "11:30:00";
            $orario_fine = "15:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("11", $turni)){
            $giorno = "giovedi";
            $orario_inizio = "15:30:00";
            $orario_fine = "19:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("12", $turni)){
            $giorno = "giovedi";
            $orario_inizio = "19:30:00";
            $orario_fine = "23:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("13", $turni)){
            $giorno = "venerdi";
            $orario_inizio = "11:30:00";
            $orario_fine = "15:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("14", $turni)){
            $giorno = "venerdi";
            $orario_inizio = "15:30:00";
            $orario_fine = "19:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("15", $turni)){
            $giorno = "venerdi";
            $orario_inizio = "19:30:00";
            $orario_fine = "23:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        } 
        if (in_array("16", $turni)){
            $giorno = "sabato";
            $orario_inizio = "11:30:00";
            $orario_fine = "15:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("17", $turni)){
            $giorno = "sabato";
            $orario_inizio = "15:30:00";
            $orario_fine = "19:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("18", $turni)){
            $giorno = "sabato";
            $orario_inizio = "19:30:00";
            $orario_fine = "23:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("19", $turni)){
            $giorno = "domenica";
            $orario_inizio = "11:30:00";
            $orario_fine = "15:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("20", $turni)){
            $giorno = "domenica";
            $orario_inizio = "15:30:00";
            $orario_fine = "19:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        }
        if (in_array("21", $turni)){
            $giorno = "domenica";
            $orario_inizio = "19:30:00";
            $orario_fine = "23:30:00";
            $sql2 = "INSERT INTO lavora_in(fattorino, giorno, orario_inizio, orario_fine) VALUES('$email','$giorno','$orario_inizio','$orario_fine');";
            $res2 = $cid->query($sql2);
        } 
            #inserimento/controllo cap della zona 
        #controllo prima se il cap è già presente nel database

        $sql3 = "SELECT cap FROM zona WHERE cap LIKE '$cap'"; 
        $res3 = $cid -> query($sql3);

        #se esiste già non devo inserirlo nuovamente 
        if (mysqli_num_rows($res3) == 0){
            $sql5 = "INSERT INTO zona(cap) VALUES('$cap');";
            $res5 = $cid->query($sql5);
        }
        $sql7 = "INSERT INTO disponibile(fattorino, zona) VALUES ('$email','$cap');";
        $sql7 = $cid->query($sql7);
        header('location:../frontend/profiloFattorino.php?stato=4'); 


        $_SESSION["utente"]=$email;
        $_SESSION["logged"]=true;
    	header('location:../frontend/fattorino.php?status=ok&dati=' . serialize($dati));		
    }
}



?>