<?php 

session_start();

include_once("../common/setup.php");
include_once("../common/funzioni.php");

$ristorante = $_GET["ristorante"];
$piatto = $_GET["piatto"];
$prezzo = $_GET["prezzo"]; # prezzo piatto
$email = $_SESSION["utente"];

#1 - controllo se l'utente ha già nel carrello un ordine da questo ristorante
$sql = "SELECT * FROM ordine JOIN contiene ON ordine.email_cliente = contiene.email_cliente AND ordine.timestamp_ordine = contiene.timestamp_ordine WHERE ordine.email_cliente LIKE '$email' AND contiene.email_ristorante LIKE '$ristorante' AND ordine.stato LIKE 'carrello';";
$res = $cid->query($sql);
if (mysqli_num_rows($res) == 0){ #se non c'è nessun ordine nel carrello da questo ristorante, ne aggiungo uno
    $data_creazione = date('Y-m-d H:i:s');
    $sql2 = "INSERT INTO ordine(prezzo, stato, email_cliente, timestamp_ordine) VALUES ('$prezzo', 'carrello', '$email', '$data_creazione');";
    $res2 = $cid->query($sql2);  
    $sql3 = "INSERT INTO contiene(nome, quantita, email_ristorante, email_cliente, timestamp_ordine) VALUES ('$piatto', 1, '$ristorante', '$email', '$data_creazione');";
    $res3 = $cid->query($sql3);
    header("location:../frontend/clientevistaristorante.php?stato=1&emailrist=". urlencode($ristorante));
    }       
else{ #altrimenti, se c'è un ordine nel carrello da questo ristorante, aggiungo solo su contiene 
    while($row= mysqli_fetch_assoc($res)){
    $date = $row['timestamp_ordine'];     
    $pr = $row['prezzo']; #prezzo ordine attuale       
    }     
    $prezzo_new = $prezzo + $pr; #prezzo aggiornato
    $sql5 = "SELECT * from contiene WHERE nome = '$piatto' AND email_ristorante = '$ristorante' AND  email_cliente = '$email' AND timestamp_ordine = '$date';";
    $res5 = $cid->query($sql5); #controllo prima che non ci sia già quel piatto nell'ordine, in questo caso, aggiungo quantità
    if(mysqli_num_rows($res5) == 1){
        while($row= mysqli_fetch_assoc($res5)){
            $qnt = $row['quantita'];    
            $new_quantita = $qnt+1;     
            }   
        $sql7 = "UPDATE contiene SET quantita = $new_quantita WHERE nome = '$piatto' AND email_ristorante = '$ristorante' AND  email_cliente = '$email' AND timestamp_ordine = '$date';";            
        $res7 = $cid->query($sql7);
        $sql8 = "UPDATE ordine SET prezzo = $prezzo_new WHERE email_cliente = '$email' AND timestamp_ordine = '$date';";
        $res8 = $cid->query($sql8);

        header("location:../frontend/clientevistaristorante.php?stato=2&emailrist=". urlencode($ristorante));
    }else{                 
        $sql4 = "INSERT INTO contiene(nome, quantita, email_ristorante, email_cliente, timestamp_ordine) VALUES ('$piatto', 1, '$ristorante', '$email', '$date');";
        $res4 = $cid->query($sql4); 
        addPrezzo($cid, $prezzo, $email, $date);
        header("location:../frontend/clientevistaristorante.php?stato=3&emailrist=". urlencode($ristorante));
    }            
}


?>

