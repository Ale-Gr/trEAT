<?php


/* Funzioni relative alla gestione degli utenti */

function isUser($cid,$login,$pwd, $type)
{
    if ($type == ""){
        $risultato= array("msg"=>"","status"=>"ko");
        return $risultato;
    }
    
    if ($type == "cliente"){
        $risultato= array("msg"=>"","status"=>"ok");

    /* inserire controlli dell'input */
    $sql = "SELECT * FROM cliente where email = '$login' and password = '$pwd'";
    
    $res = $cid->query($sql);
        if ($res==null) 
        {
                $msg = "Si sono verificati i seguenti errori:<br/>" 
                . $res->error;
                $risultato["status"]="ko";
                $risultato["msg"]=$msg;			
        }elseif($res->num_rows==0 || $res->num_rows>1)
        {
                $msg = "Email o password sbagliate";
                $risultato["status"]="ko";
                $risultato["msg"]=$msg;		
        }elseif($res->num_rows==1)
        {
            $msg = "Login effettuato con successo";
            $risultato["status"]="ok";
            $risultato["msg"]=$msg;		
        }
        return $risultato;
    }
    if ($type == "fattorino"){
        $risultato= array("msg"=>"","status"=>"ok");

    /* inserire controlli dell'input */
    $sql = "SELECT * FROM fattorino where email = '$login' and password = '$pwd'";
    
    $res = $cid->query($sql);
        if ($res==null) 
        {
                $msg = "Si sono verificati i seguenti errori:<br/>" 
                . $res->error;
                $risultato["status"]="ko";
                $risultato["msg"]=$msg;			
        }elseif($res->num_rows==0 || $res->num_rows>1)
        {
                $msg = "Email o password sbagliate";
                $risultato["status"]="ko";
                $risultato["msg"]=$msg;		
        }elseif($res->num_rows==1)
        {
            $msg = "Login effettuato con successo";
            $risultato["status"]="ok";
            $risultato["msg"]=$msg;		
        }
        return $risultato;
    }
    if ($type == "ristorante"){
        $risultato= array("msg"=>"","status"=>"ok");

    /* inserire controlli dell'input */
    $sql = "SELECT * FROM ristorante where email = '$login' and password = '$pwd'";
    
    $res = $cid->query($sql);
        if ($res==null) 
        {
                $msg = "Si sono verificati i seguenti errori:<br/>" 
                . $res->error;
                $risultato["status"]="ko";
                $risultato["msg"]=$msg;			
        }elseif($res->num_rows==0 || $res->num_rows>1)
        {
                $msg = "Email o password sbagliate";
                $risultato["status"]="ko";
                $risultato["msg"]=$msg;		
        }elseif($res->num_rows==1)
        {
            $msg = "Login effettuato con successo";
            $risultato["status"]="ok";
            $risultato["msg"]=$msg;		
        }
        return $risultato;
    }
}
function checkNewEmail($cid, $type, $email){
    if ($type == "rist"){
        $sql = "SELECT email FROM ristorante WHERE ristorante.email LIKE '$email';";
        $res = $cid->query($sql);
        $count = mysqli_num_rows($res);
        return $count;
    }
    elseif ($type == "fattorino"){
        $sql = "SELECT email FROM fattorino WHERE fattorino.email LIKE '$email'";
        $res = $cid->query($sql);
        $count = mysqli_num_rows($res);
        return $count;
    }
    elseif ($type == "cliente"){
        $sql = "SELECT email FROM cliente WHERE cliente.email LIKE '$email'";
        $res = $cid->query($sql);
        $count = mysqli_num_rows($res);
        return $count;
    }
}


function checkIndirizzo($cid, $via, $civico, $citofono, $cap, $citta){
    $sqlIndirizzo = "SELECT * FROM indirizzo WHERE via LIKE '$via' AND numero_civico LIKE '$civico' AND citofono LIKE '$citofono' AND cap LIKE '$cap' AND nome_citta LIKE '$citta';";
    $resIndirizzo = $cid->query($sqlIndirizzo); #controllo se l'indirizzo c'è già nel db
    $count = mysqli_num_rows($resIndirizzo);
    return $count;
}

function checkZona($cid, $cap){
    $sqlZona = "SELECT * FROM zona WHERE cap LIKE '$cap';";
    $resZona = $cid->query($sqlZona); #controllo se l'indirizzo c'è già nel db
    $count = mysqli_num_rows($resZona);
    return $count;
}

function checkZonaFattorino($cid, $email, $zona){
    $sql = "SELECT * FROM disponibile WHERE fattorino LIKE '$email' AND zona LIKE '$zona';";
    $res = $cid->query($sql);
    $count = mysqli_num_rows($res);
    return $count;
}

function addPrezzo($cid, $pr, $email, $date){
    $sql = "UPDATE ordine SET prezzo = prezzo + $pr WHERE email_cliente = '$email' AND timestamp_ordine = '$date';";
    $res = $cid->query($sql);
}

function checkOrario($cid, $email, $giorno, $orario, $type){
    if ($type == "fattorino"){
        $sql = "SELECT * FROM lavora_in  WHERE fattorino LIKE '$email' AND giorno = '$giorno' AND orario_inizio = '$orario';";
        $res = $cid -> query($sql);
        $count = mysqli_num_rows($res);
        return $count;
    }
    elseif($type == "ristorante"){
        $sql = "SELECT * FROM apertura  WHERE ristorante LIKE '$email' AND giorno = '$giorno' AND orario_inizio = '$orario';";
        $res = $cid -> query($sql);
        $count = mysqli_num_rows($res);
        return $count;  
    }
}

function checkPiatto($cid, $nome, $email){
    $sql = "SELECT * FROM pietanza WHERE nome LIKE '$nome' AND email LIKE '$email';";
    $res = $cid->query($sql);
    $count = mysqli_num_rows($res);
    return $count;
}

function queryCliente($cid){
    if (isset($_GET["actualpage"])){
        $actualpage = $_GET["actualpage"];
      }
      else{
        $actualpage = 0;
      }  
      $offset = $actualpage*3;
      
      $giorno = date('D');
      $giorno_it = '';
      if ($giorno == 'Mon'){
        $giorno_it = 'lunedi';
      }  
      elseif ($giorno == 'Tue'){
        $giorno_it = 'martedi';
      }  
      elseif ($giorno == 'Wed'){
        $giorno_it = 'mercoledi';
      }  
      elseif ($giorno == 'Thu'){
        $giorno_it = 'giovedi';
      }  
      elseif ($giorno == 'Fri'){
        $giorno_it = 'venerdi';
      }  
      elseif ($giorno == 'Sat'){  
        $giorno_it = 'sabato';
      }  
      else{
        $giorno_it = 'domenica';
      }  
      
      $ora = Date('H:i:s');

      return array($actualpage, $offset, $giorno, $giorno_it, $ora);
}

function datiPaginaCliente($cid, $email){
    $sql2 = "SELECT nome_citta FROM cliente WHERE email LIKE '$email';";
    $res2 = $cid->query($sql2);
    return $res2;
}

function queryRistoranti($res2, $cid, $giorno, $orario, $offset){
    while ($row2 = mysqli_fetch_assoc($res2)){
        $citta = $row2['nome_citta'];
        $ricerca = "";
        if (!isset($_GET["ricerca"])){
          $sql = "SELECT * FROM ristorante JOIN apertura ON ristorante.email = apertura.ristorante WHERE ristorante.nome_citta LIKE '$citta' AND giorno LIKE '$giorno' AND '$orario' BETWEEN orario_inizio AND orario_fine ORDER BY nome LIMIT 3 OFFSET $offset";
          $res = $cid->query($sql);
          $sql1 = "SELECT * FROM ristorante JOIN apertura ON ristorante.email = apertura.ristorante WHERE ristorante.nome_citta LIKE '$citta' AND giorno LIKE '$giorno' AND '$orario' BETWEEN orario_inizio AND orario_fine ORDER BY nome";
          $res1 = $cid->query($sql1);
          $countpage = mysqli_num_rows($res1);
          $limit = ceil($countpage/3) -1;  
        }  
        else{
          $ricerca = $_GET["ricerca"];
          $sql = "SELECT * FROM ristorante JOIN apertura ON ristorante.email = apertura.ristorante WHERE ristorante.nome_citta LIKE '$citta' AND nome LIKE '%$ricerca%' AND giorno LIKE '$giorno' AND '$orario' BETWEEN orario_inizio AND orario_fine ORDER BY nome LIMIT 3 OFFSET $offset";
          $res = $cid->query($sql); 
          $sql1 = "SELECT * FROM ristorante JOIN apertura ON ristorante.email = apertura.ristorante WHERE ristorante.nome_citta LIKE '$citta' AND nome LIKE '%$ricerca%' AND giorno LIKE '$giorno' AND '$orario' BETWEEN orario_inizio AND orario_fine ORDER BY nome";
          $res1 = $cid->query($sql1);
          $countpage = mysqli_num_rows($res1);
          $limit = ceil($countpage/3) -1; 
        }
    }
    return array($res, $countpage, $limit);
}

function queryProfiloCliente($cid, $email){
    $sql = "SELECT * FROM cliente WHERE email LIKE '$email';";
    $res = $cid->query($sql);
    return $res;
}

function queryCarta($cid, $email){
    $sql2 = "SELECT * FROM carta WHERE email_cliente LIKE '$email';";
    $res2 = $cid->query($sql2);  
    return $res2;
}

function queryOrdiniCliente($cid, $email, $offset){
    $sql = "SELECT DISTINCT ordine.prezzo, ordine.istruzioni_consegna, ordine.tempistica_consegna, ordine.stato,
    ordine.metodo_pagamento, ordine.data_accettazione, ordine.ora_accettazione, ordine.timestamp_ordine, ristorante.nome,
    ristorante.via, ristorante.numero_civico, ristorante.nome_citta, contiene.email_ristorante FROM ordine JOIN contiene ON 
    ordine.email_cliente = contiene.email_cliente AND ordine.timestamp_ordine = contiene.timestamp_ordine JOIN ristorante ON 
    contiene.email_ristorante = ristorante.email WHERE ordine.email_cliente LIKE '$email' ORDER BY ordine.timestamp_ordine LIMIT 3 OFFSET $offset;";
    $res = $cid->query($sql); 
    return $res;
}
function queryOrdiniClientebis($cid, $email){
    $sql1 = "SELECT DISTINCT ordine.prezzo, ordine.istruzioni_consegna, ordine.tempistica_consegna, ordine.stato, ordine.metodo_pagamento, 
    ordine.data_accettazione, ordine.ora_accettazione, ordine.timestamp_ordine, ristorante.nome, ristorante.via, ristorante.numero_civico, 
    ristorante.nome_citta, contiene.email_ristorante FROM ordine JOIN contiene ON ordine.email_cliente = contiene.email_cliente
     AND ordine.timestamp_ordine = contiene.timestamp_ordine JOIN ristorante ON contiene.email_ristorante = ristorante.email 
     WHERE ordine.email_cliente LIKE '$email' ORDER BY ordine.timestamp_ordine";
    $res1 = $cid->query($sql1); // aggiungi commento
    return $res1;
}

function queryPiattiOrdini($cid, $email, $date){
    $sql2 = "SELECT nome, quantita FROM contiene WHERE email_cliente LIKE '$email' AND timestamp_ordine LIKE '$date';";
    $res2 = $cid->query($sql2);
    return $res2;
}

function queryCarrello($cid, $email, $offset){
    $sql = "SELECT DISTINCT ristorante.email, ordine.prezzo, ordine.timestamp_ordine, ristorante.nome, ristorante.via, ristorante.numero_civico, ristorante.nome_citta, contiene.email_ristorante FROM ordine JOIN contiene ON ordine.email_cliente = contiene.email_cliente AND ordine.timestamp_ordine = contiene.timestamp_ordine JOIN ristorante ON contiene.email_ristorante = ristorante.email WHERE ordine.email_cliente LIKE '$email' AND stato = 'carrello' ORDER BY ordine.timestamp_ordine LIMIT 1 OFFSET $offset;";
    $res = $cid->query($sql); 
    return $res;
}

function queryCarrellobis($cid, $email){
    $sql1 = "SELECT DISTINCT ristorante.email, ordine.prezzo, ordine.timestamp_ordine, ristorante.nome, ristorante.via, ristorante.numero_civico, ristorante.nome_citta, contiene.email_ristorante FROM ordine JOIN contiene ON ordine.email_cliente = contiene.email_cliente AND ordine.timestamp_ordine = contiene.timestamp_ordine JOIN ristorante ON contiene.email_ristorante = ristorante.email WHERE ordine.email_cliente LIKE '$email' AND stato = 'carrello' ORDER BY ordine.timestamp_ordine;";
    $res1 = $cid->query($sql1);
    return $res1;    
}

function queryCartaCarrello($cid, $email){
    $sql2 = "SELECT * FROM carta WHERE email_cliente LIKE '$email';";
    $res3 = $cid->query($sql2);  
    return $res3;
}

function queryPiattiCarrello($cid, $email, $date){
    $sql2 = "SELECT * FROM contiene WHERE contiene.email_cliente = '$email' AND contiene.timestamp_ordine = '$date'";
    $res2 = $cid->query($sql2);
    return $res2;
}

function queryRistoranteOrari($cid, $email, $giorno_it, $ora){
    $sqlorari = "SELECT * FROM apertura WHERE ristorante LIKE '$email' AND giorno LIKE '$giorno_it' AND '$ora' BETWEEN orario_inizio AND orario_fine;";
    $resorari = $cid->query($sqlorari);
    return $resorari;
}

function queryOrdiniRistorante($cid, $email, $offset){
    $sql = "SELECT DISTINCT ordine.email_cliente, ordine.metodo_pagamento, ordine.prezzo,ordine.timestamp_ordine, contiene.email_ristorante FROM ordine JOIN contiene ON ordine.email_cliente = contiene.email_cliente AND ordine.timestamp_ordine = contiene.timestamp_ordine WHERE contiene.email_ristorante LIKE '$email' AND ordine.stato LIKE 'in preparazione' ORDER BY ordine.timestamp_ordine LIMIT 3 OFFSET $offset;";
    $res = $cid->query($sql); 
    return $res;
}

function queryOrdiniRistorantebis($cid, $email){
    $sql1 = "SELECT DISTINCT ordine.email_cliente, ordine.metodo_pagamento, ordine.prezzo,ordine.timestamp_ordine, contiene.email_ristorante FROM ordine JOIN contiene ON ordine.email_cliente = contiene.email_cliente AND ordine.timestamp_ordine = contiene.timestamp_ordine WHERE contiene.email_ristorante LIKE '$email' AND ordine.stato LIKE 'in preparazione' ORDER BY ordine.timestamp_ordine";
    $res1 = $cid->query($sql1);
    return $res1;
}

function queryPiattiOrdiniRistorante($cid, $cliente, $date){
    $sql2 = "SELECT nome, quantita FROM contiene WHERE email_cliente LIKE '$cliente' AND timestamp_ordine LIKE '$date';";
    $res2 = $cid->query($sql2);
    return $res2;
}

function queryProfiloRistorante($cid, $email){
    $sql = "SELECT * FROM ristorante WHERE email LIKE '$email';";
    $res = $cid->query($sql);
    return $res;
}

function queryPiatti($cid, $email){
    $sql = "SELECT * FROM pietanza WHERE email LIKE '$email' ORDER BY nome";
    $res = $cid->query($sql);
    return $res;
}

function queryPiattiMenu($cid, $email){
    $sql = "SELECT * FROM pietanza WHERE email LIKE '$email' AND tipo LIKE 'piatto' ORDER BY nome";
    $res = $cid->query($sql);
    return $res;
}

function queryTurniRistorante($cid, $email){
    $sql = "SELECT giorno,orario_inizio,orario_fine FROM apertura WHERE ristorante LIKE '$email' ORDER BY giorno, orario_inizio;";
    $res = $cid->query($sql);
    return $res;
}

function queryOrdiniFattorino($cid, $offset){
    $sql = "SELECT DISTINCT ristorante.cap, ordine.istruzioni_consegna, ordine.email_cliente, ordine.timestamp_ordine, 
    cliente.via as cliente_via, cliente.numero_civico as cliente_civico, cliente.citofono as cliente_citofono, cliente.nome_citta 
    as cliente_citta, ristorante.via, ristorante.nome, ristorante.numero_civico, ristorante.citofono, ristorante.nome_citta FROM 
    cliente JOIN ordine ON cliente.email = ordine.email_cliente JOIN contiene ON ordine.email_cliente = contiene.email_cliente AND
    ordine.timestamp_ordine = contiene.timestamp_ordine JOIN ristorante ON contiene.email_ristorante = ristorante.email WHERE
    ordine.stato LIKE 'preparato/in attesa' ORDER BY ordine.timestamp_ordine LIMIT 3 OFFSET $offset;";
    $res = $cid->query($sql); 
    return $res;
}

function queryOrdiniFattorinobis($cid){
    $sql1 = "SELECT DISTINCT ristorante.cap, ordine.istruzioni_consegna, ordine.email_cliente, ordine.timestamp_ordine,cliente.via
    as cliente_via, cliente.numero_civico as cliente_civico, cliente.citofono as cliente_citofono, cliente.nome_citta as cliente_citta,
    ristorante.via, ristorante.nome, ristorante.numero_civico, ristorante.citofono, ristorante.nome_citta  FROM cliente JOIN ordine ON
    cliente.email = ordine.email_cliente JOIN contiene ON ordine.email_cliente = contiene.email_cliente AND ordine.timestamp_ordine = 
    contiene.timestamp_ordine JOIN ristorante ON contiene.email_ristorante = ristorante.email WHERE ordine.stato LIKE 
    'preparato/in attesa' ORDER BY ordine.timestamp_ordine";
    $res1 = $cid->query($sql1);
    return $res1;
}

function queryOrdiniZona($cid, $email){
    $sql2 = "SELECT zona FROM disponibile WHERE fattorino LIKE '$email';";
    $res2 = $cid->query($sql2);
    return $res2;
}

function queryProfiloFattorino($cid, $email){
    $sql = "SELECT fattorino.email,fattorino.password, fattorino.iban, fattorino.credito FROM fattorino WHERE fattorino.email LIKE '$email';";
    $res = $cid->query($sql);  
    return $res;
}

function queryOrdiniAccettatiFattorino($cid, $email, $offset){
    $sql = "SELECT DISTINCT ordine.istruzioni_consegna, ordine.prezzo, ordine.stato,ordine.email_cliente, ordine.timestamp_ordine, cliente.via as cliente_via, cliente.numero_civico as cliente_civico, cliente.citofono as cliente_citofono, cliente.nome_citta as cliente_citta, ristorante.via, ristorante.nome, ristorante.numero_civico, ristorante.citofono, ristorante.nome_citta FROM cliente JOIN ordine ON cliente.email = ordine.email_cliente JOIN contiene ON ordine.email_cliente = contiene.email_cliente AND ordine.timestamp_ordine = contiene.timestamp_ordine JOIN ristorante ON contiene.email_ristorante = ristorante.email WHERE ordine.stato LIKE 'preparato/in consegna' AND ordine.email_fattorino LIKE '$email' ORDER BY ordine.timestamp_ordine LIMIT 3 OFFSET $offset;";
    $res = $cid->query($sql); 
    return $res;
}

function queryOrdiniAccettatiFattorinobis($cid, $email){
    $sql1 = "SELECT DISTINCT ordine.istruzioni_consegna, ordine.prezzo, ordine.stato,ordine.email_cliente, ordine.timestamp_ordine,cliente.via as cliente_via, cliente.numero_civico as cliente_civico, cliente.citofono as cliente_citofono, cliente.nome_citta as cliente_citta, ristorante.via, ristorante.nome, ristorante.numero_civico, ristorante.citofono, ristorante.nome_citta  FROM cliente JOIN ordine ON cliente.email = ordine.email_cliente JOIN contiene ON ordine.email_cliente = contiene.email_cliente AND ordine.timestamp_ordine = contiene.timestamp_ordine JOIN ristorante ON contiene.email_ristorante = ristorante.email WHERE ordine.stato LIKE 'preparato/in consegna' AND ordine.email_fattorino LIKE '$email' ORDER BY ordine.timestamp_ordine";
    $res1 = $cid->query($sql1);
    return $res1;
}

function queryTurniFattorino($cid, $email){
    $sql = "SELECT * FROM lavora_in WHERE fattorino LIKE '$email' ORDER BY giorno, orario_inizio"; 
    $res = $cid->query($sql); 
    return $res;
}

function queryStampaMenu($cid, $nome, $email){
    $sql = "SELECT nome_piatto FROM ha WHERE nome_menu LIKE '$nome' AND email_ristorante LIKE '$email';";
    $res = $cid->query($sql);
    return $res;
}

function queryModificaPiatto($cid, $email, $piatto_old){
    $sql = "SELECT * FROM pietanza WHERE email LIKE '$email' AND nome LIKE '$piatto_old' ORDER BY nome";
    $res = $cid->query($sql);
    return $res;
}

function queryOrari($cid, $email, $giorno_it, $ora){
    $sqlorari = "SELECT * FROM lavora_in WHERE fattorino LIKE '$email' AND giorno LIKE '$giorno_it' AND '$ora' BETWEEN orario_inizio AND orario_fine;";
    $resorari = $cid->query($sqlorari);
    return $resorari;
}

function queryPietanzeHomePage($cid){
    $sqlpietanze = "SELECT nome, nome_citta, via, numero_civico FROM ristorante LIMIT 2;";
    $respietanze = $cid->query($sqlpietanze);
    return $respietanze;    
}



?>