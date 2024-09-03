<?php
include "../common/head.php";
include_once("../common/setup.php");
include_once("../common/funzioni.php");

// Array with names
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
      

$orario = Date('H:i:s');
$sql = "SELECT ristorante.nome FROM ristorante JOIN apertura ON ristorante.email = apertura.ristorante WHERE giorno LIKE '$giorno_it' AND '$orario' BETWEEN orario_inizio AND orario_fine ORDER BY nome";
$res = $cid->query($sql);
while( $row = mysqli_fetch_assoc( $res)){
  $a[]= $row['nome'];
}


// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""

if (!empty($a)){
  if ($q !== "") {
    //$q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
      if (str_contains($name, $q)) {
        if ($hint === "") {
          $hint = $name;
        } else {
          $hint .= ", $name";
        }
      }
    }
  }
}
// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no suggestion" : $hint;
?>
