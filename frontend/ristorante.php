<!DOCTYPE html>
<html>
<?php include "../common/head.php";

include_once("../common/setup.php");
include_once("../common/funzioni.php");
?>
    
  <body>
  <?php include "../common/headerRistorante.php";
  
  if ($_SESSION["logged"] != true){
    ?> <div class = "messaggio"> <h2> Non sei loggato. </h2> </div><?php
  
  }
  else{
    if (isset($_GET["actualpage"])){
      $actualpage = $_GET["actualpage"];
    }
    else{
      $actualpage = 0;
    }  
    $offset = $actualpage*3;
    $actual_orders = 0; 
    
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
    
    $resorari = queryRistoranteOrari($cid, $email, $giorno_it, $ora);
    $apertura = "";
    if (mysqli_num_rows($resorari) == 0){
      $apertura = "chiuso";
    }
    $res = queryOrdiniRistorante($cid, $email, $offset);
    $res1 = queryOrdiniRistorantebis($cid, $email);
    $countpage = mysqli_num_rows($res1);
    $limit = ceil($countpage/3) -1;  
  
  ?>
  <div class="header-portfolio clearfix">
    <h2>ORDINI DA PREPARARE</h2>
   </div>
   <!-- Contenuti (griglia) -->
   <div class="container-info">
   
   <!-- Tabelle prezzi -->
   <section id="servizi">
   <div class="row">
   <?php 
   if ($apertura == "chiuso"){?>
    <div class = "messaggio"> <h2> Ristorante chiuso. </h2> </div>
  <?php
   } else{
   
   while($row=mysqli_fetch_assoc($res)){        
      $cliente = $row['email_cliente'];    
      $date = $row['timestamp_ordine'];
      if ((time() - strtotime($date)) < 7200){
        $actual_orders = $actual_orders + 1;
        $res2 = queryPiattiOrdiniRistorante($cid, $cliente, $date);
      ?>
   <div class="col-sm-4">
    <ul class="list-group servizi">
     <li class="list-group-item servizi-portfolio-titolo"><h4>EMAIL CLIENTE: <?php echo $row['email_cliente']; ?></h4></li>
     <?php while($row2=mysqli_fetch_assoc($res2)){ ?>
     <li class="list-group-item servizi-portfolio-piatto">Piatto: <?php echo $row2['nome']; ?> - Quantità: <?php echo $row2['quantita']; ?></a></li>
     <?php } ?>
     <li class="list-group-item servizi-portfolio-opzione">Prezzo: <?php echo $row['prezzo']; ?></li>
     <li class="list-group-item servizi-portfolio-opzione">Metodo pagamento: <?php echo $row['metodo_pagamento']; ?></li>
     <li class="list-group-item servizi-portfolio-collegamento"><a href="../backend/ristoranteConferma.php?cliente=<?php echo $cliente; ?>&date=<?php echo $date; ?>">Ordine preparato</a></li>
    </ul>
    <?php } ?>
   </div>
   <?php }
   if($actual_orders ==0){ ?>
        <div class = "messaggio"> <h2> Nessun ordine da preparare. </h2> </div>
  <?php  
  }

   ?>
   </section>
     </div>
   <div class="row">
   <div class="col-sm-12">
   <nav id="portfolio-pagination" class="text-center">
   <ul class="pagination pagination-large">
    <?php 
    if($actual_orders > 0){    
    if ($actualpage==0 && $actualpage != $limit){?>
    <li class="active"><a href="ordiniCliente.php?actualpage=<?php echo $actualpage ?>">1</a></li>
    <li><a href="ordiniCliente.php?actualpage=<?php echo $actualpage+1 ?>">2</a></li>
    <li><a href="ordiniCliente.php?actualpage=<?php echo $actualpage+1 ?>">&raquo;</a></li>
    <?php }
    elseif($actualpage != $limit){?>
    <li><a href="ordiniCliente.php?actualpage=<?php echo $actualpage-1 ?>">&laquo;</a></li>
    <li><a href="ordiniCliente.php?actualpage=<?php echo $actualpage-1 ?>"><?php echo $actualpage?></a></li>
    <li class = "active"><a href="#ordiniCliente.php?actualpage=<?php echo $actualpage ?>"><?php echo $actualpage+1?></a></li>
    <li><a href="ordiniCliente.php?actualpage=<?php echo $actualpage+1 ?>"><?php echo $actualpage+2?></a></li>
    <li><a href="ordiniCliente.php?actualpage=<?php echo $actualpage+1 ?>">&raquo;</a></li>

    <?php }
    elseif($actualpage== 0 && $actualpage == $limit){?>
        <li class="active"><a href="cliente.php?actualpage=<?php echo $actualpage ?>">1</a></li>
    <?php }
    else{?>
    <li><a href="ordiniCliente.php?actualpage=<?php echo $actualpage-1 ?>">&laquo;</a></li>
    <li><a href="ordiniCliente.php?actualpage=<?php echo $actualpage-1 ?>"><?php echo $actualpage?></a></li>
    <li class = "active"><a href="#ordiniCliente.php?actualpage=<?php echo $actualpage-1 ?>"><?php echo $actualpage+1?></a></li> 
    <?php } 
     } 
    }?>
   </ul>
   </nav>
   </div>
   </div>
   </div><!-- /.container -->
   <!-- jQuery e plugin JavaScript  -->
   <?php include "../common/footer.php";?>  
   <script src="http://code.jquery.com/jquery.js"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="assets/plugins/flexslider/jquery.flexslider.js"></script>
   <script src="assets/plugins/fancybox/jquery.fancybox.pack.js"></script>
   <script src="assets/js/scripts.js"></script>
   </body>
   <?php } ?>
   </html>
</html>
