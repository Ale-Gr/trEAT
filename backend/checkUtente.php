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
$via=$_GET["via"];
$civico=$_GET["civico"];
$citta=$_GET["citta"];
$citofono=$_GET["citofono"];
$cap=$_GET["cap"];
$condizioni=$_GET["condizioni"];

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
	$errore["password"]="11";
	$dati["password"]="";
}		
else
	$dati["password"]=$password;	

if (empty($via))
{
	$errore["via"]="5";
	$dati["via"]="";
}		
else
	$dati["via"]=$via;
    
if (empty($civico))
{
	$errore["civico"]="6";
	$dati["civico"]="";
}		
else
	$dati["civico"]=$civico;
    
if (empty($citta))
{
	$errore["citta"]="7";
	$dati["citta"]="";
}		
else
	$dati["citta"]=$citta;
    
if (empty($citofono))
{
	$errore["citofono"]="8";
	$dati["citofono"]="";
}		
else
	$dati["citofono"]=$citofono;

if (empty($cap))
{
	$errore["cap"]="9";
	$dati["cap"]="";
}		
else
	$dati["cap"]=$cap;    
	
    

if (!isset($_GET["condizioni"]))
{
	$errore["condizioni"]="10";
	$dati["condizioni"]="ko";
}		
else
	$dati["condizioni"]="ok";



if (count($errore)>0)
{	
	header('location:../frontend/datiUtente.php?status=ko&errore=' . serialize($errore). '&dati=' . serialize($dati));
}
else
{
	$data_reg = date('Y-m-d');
	#check email, se c'è già nel db ritorna errore, altrimenti va avanti col check indirizzo
	$type = 'cliente';
	$resEmail = checkNewEmail($cid, $type, $email);
    if ($resEmail == 1){
		$errore["email"]="4";
		$dati["email"]="";
		header('location:../frontend/datiUtente.php?status=ko&errore=' . serialize($errore). '&dati=' . serialize($dati));
    }
    else{
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
		$sql2 = "INSERT INTO cliente(email, password, nome, cognome, data_nascita, data_registrazione, via,	numero_civico, citofono, cap,nome_citta) VALUES('$email','$password', '$nome', '$cognome', '$data', '$data_reg', '$via', '$civico', '$citofono', '$cap', '$citta');";
		$res2=$cid->query($sql2);
	}

	if($resEmail == 0){	
	$_SESSION["utente"]=$email;
	$_SESSION["logged"]=true;
	header('location:../frontend/cliente.php?status=ok&dati=' . serialize($dati));
	}


}


?>
