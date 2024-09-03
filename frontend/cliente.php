<!DOCTYPE html>
<html>
<?php include "../common/head.php";

include_once("../common/setup.php");
include_once("../common/funzioni.php");

if (isset($_GET["ricerca"])){
  $ricerca = $_GET["ricerca"];
}
else{
  $ricerca = "";
}


?>
    
  <body>
  <?php include "../common/headerCliente.php";
  
  if ($_SESSION["logged"] != true){
    ?> <div class = "messaggio"> <h2> Non sei loggato. </h2> </div><?php
  
  }
  else{
    $arrayCliente = queryCliente($cid);

    $res2 = datiPaginaCliente($cid, $email);
    $arrayRistoranti = queryRistoranti($res2, $cid, $arrayCliente[3], $arrayCliente[4], $arrayCliente[1]);
  
  ?>

  <section id="ultimi-lavori">

    
  <div class="header-portfolio clearfix">
    <h2>RISTORANTI NELLA TUA ZONA</h2>
   </div>
   <!-- Contenuti (griglia) -->
   <div class="container-info">
   
   <!-- Tabelle ristoranti -->

   <section id="servizi">
   <div class="row">
    <?php 
  if ($arrayRistoranti[1] > 0){
   while($row= mysqli_fetch_assoc($arrayRistoranti[0])){ 
    ?>
      <div class="col-sm-4">
      <ul class="list-group servizi">
      <li class="list-group-item servizi-portfolio-titolo"><h4><?php echo $row['nome'];?></h4></li>
      <li class="list-group-item servizi-portfolio-opzione"><?php echo $row['via'];?> <?php echo $row['numero_civico'];?></li>
      <li class="list-group-item servizi-portfolio-opzione"><?php echo $row['nome_citta'];?></li>      
      <li class="list-group-item servizi-portfolio-collegamento"><a href = "clientevistaristorante.php?emailrist=<?php echo $row['email']; ?>">vai al ristorante</a></li>
    </ul>
   </div>
<?php
   }   

   
   ?>    
   </div>
   </section>
   <div class="row">
   <div class="col-sm-12">
   <nav id="portfolio-pagination" class="text-center">
   <ul class="pagination pagination-large">
    <?php 
    
    if ($arrayCliente[0]==0 && $arrayCliente[0] != $arrayRistoranti[2]){?>
    <li class="active"><a href="cliente.php?actualpage=<?php echo $arrayCliente[0] ?>">1</a></li>
    <li><a href="cliente.php?actualpage=<?php echo $arrayCliente[0]+1 ?>">2</a></li>
    <li><a href="cliente.php?actualpage=<?php echo $arrayCliente[0]+1 ?>">&raquo;</a></li>
    <?php }
    elseif($arrayCliente[0] != $arrayRistoranti[2]){?>
    <li><a href="cliente.php?actualpage=<?php echo $arrayCliente[0]-1 ?>">&laquo;</a></li>
    <li><a href="cliente.php?actualpage=<?php echo $arrayCliente[0]-1 ?>"><?php echo $arrayCliente[0]?></a></li>
    <li class = "active"><a href="#cliente.php?actualpage=<?php echo $arrayCliente[0] ?>"><?php echo $arrayCliente[0]+1?></a></li>
    <li><a href="cliente.php?actualpage=<?php echo $arrayCliente[0]+1 ?>"><?php echo $arrayCliente[0]+2?></a></li>
    <li><a href="cliente.php?actualpage=<?php echo $arrayCliente[0]+1 ?>">&raquo;</a></li>

    <?php }
    elseif($arrayCliente[0]== 0 && $arrayCliente[0] == $arrayRistoranti[2]){?>
        <li class="active"><a href="cliente.php?actualpage=<?php echo $arrayCliente[0] ?>">1</a></li>
    <?php }
    else{?>
    <li><a href="cliente.php?actualpage=<?php echo $arrayCliente[0]-1 ?>">&laquo;</a></li>
    <li><a href="cliente.php?actualpage=<?php echo $arrayCliente[0]-1 ?>"><?php echo $arrayCliente[0]?></a></li>
    <li class = "active"><a href="#cliente.php?actualpage=<?php echo $arrayCliente[0]-1 ?>"><?php echo $arrayCliente[0]+1?></a></li> 

    <div class="ricerca">       
     <hs>Suggerimenti: <span id="txtHint"></span></hs>

      <form>
      Cerca ristoranti:
      <input type="text" onkeyup="showHint(this.value)">
      </form>

      <script>
      function showHint(str) {
        if (str.length == 0) {
          document.getElementById("txtHint").innerHTML = "";
          return;
        } else {
          const xmlhttp = new XMLHttpRequest();
          xmlhttp.onload = function() {
            document.getElementById("txtHint").innerHTML = this.responseText;
          }
        xmlhttp.open("GET", "../backend/gethint.php?q=" + str);
        xmlhttp.send();
        }
      }
      </script>
  </div>

    <?php } 
    
    
  }
  else{ ?>
    <div class = "messaggio"> <h2> Nessun ristorante disponibile. </h2> </div>
  <?php } ?>
   </ul>
   </nav>
   </div>
   </div>
      
  </section><!-- /section ultimi lavori -->

  <?php include "../common/footer.php";?>    

    
  <!-- jQuery e plugin JavaScript  -->
  <script src="http://code.jquery.com/jquery.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/plugins/flexslider/jquery.flexslider.js"></script>
  <script src="../assets/plugins/fancybox/jquery.fancybox.pack.js"></script>
  <script src="../assets/js/scripts.js"></script>
  </body>
  <?php } ?>
</html>
