<!DOCTYPE html>
<html>
<?php include "../common/head.php";

include_once("../common/setup.php");
include_once("../common/funzioni.php");

if (isset($_GET["actualpage"])){
  $actualpage = $_GET["actualpage"];
}
else{
  $actualpage = 0;
}  
?>
    
  <body>
  <?php include "../common/headerCliente.php";
  
  if ($_SESSION["logged"] != true){
    ?> <div class = "messaggio"> <h2> Non sei loggato. </h2> </div><?php
  
  }
  else{ 
    $offset = $actualpage*3;
    $res = queryOrdiniCliente($cid, $email, $offset);
    $res1 = queryOrdiniClientebis($cid, $email); 
    $countpage = mysqli_num_rows($res1);
    $limit = ceil($countpage/3) -1;   
  
  ?>
    
  <div class="header-portfolio clearfix">
    <h2>ORDINI EFFETTUATI</h2>
   </div>
   <!-- Contenuti (griglia) -->
   <div class="container-info">
   <?php 
      if (mysqli_num_rows($res) == 0){
        ?>

        <div class = "messaggio"> <h2> Nessun ordine da mostrare. </h2> </div>


        <?php
      } else{
      
      ?>
   
   <!-- Tabelle prezzi -->
   <section id="servizi">
   <div class="row">
    <?php while($row=mysqli_fetch_assoc($res)){
      $date = $row['timestamp_ordine'];
      $res2 = queryPiattiOrdini($cid, $email, $date);
      ?>
    <div class="col-sm-4">
        <ul class="list-group servizi">          
            <li class="list-group-item servizi-portfolio-titolo"><h4><?php echo $row['nome'];?></h4></li>
            <li class="list-group-item servizi-portfolio-opzione">Indirizzo: <?php echo $row['via'];?> <?php echo $row['numero_civico'];?></li>
            <li class="list-group-item servizi-portfolio-opzione">Prezzo: <?php echo $row['prezzo'];?> euro</li>
            <li class="list-group-item servizi-portfolio-opzione">Metodo pagamento: <?php echo $row['metodo_pagamento'];?></li>
            <?php if($row['stato'] == 'preparato/in consegna'){ ?>
            <li class="list-group-item servizi-portfolio-opzione">Consegna iniziata alle: <?php echo $row['data_accettazione'];?> <?php echo $row['ora_accettazione'];?></li>
            <li class="list-group-item servizi-portfolio-opzione">Tempistica consegna: <?php echo $row['tempistica_consegna'];?></li>
            <?php } ?>
            <li class="list-group-item servizi-portfolio-opzione">Istruzioni consegna(se presenti): <?php echo $row['istruzioni_consegna'];?></li>
            <?php while($row2=mysqli_fetch_assoc($res2)){ ?>
            <li class="list-group-item servizi-portfolio-piatto">Piatto: <?php echo $row2['nome']; ?> - Quantità: <?php echo $row2['quantita']; ?></a></li>
            <?php } ?>
            <li class="list-group-item servizi-portfolio-collegamento">Stato: <?php echo $row['stato'];?></li>
        </ul>
       </div>
   <div class = "overlay" id = "piatti">
    <div class = "wrapper">
      <h3> Piatti ordinati: </h3>
      <a href="#" class="close">&times;</a>
      <div class = "content">
        <div class = "container-info">
            <table>
                <tr>
                  <th>Piatto</th>
                  <th>Quantità</th>
                </tr>
                <?php 
          while($row2 = mysqli_fetch_assoc($res2)){
          ?>
                <tr>
                  <td><?php echo $row2['nome']; ?></td>
                  <td><?php echo $row2['quantita']; ?></td>
                </tr>
                <?php }; ?>
              </table>

        </div>
      </div>
  
    </div>
  </div>
       <?php }; #chiusura primo while?>
   </div>
   <div class="row">
   <div class="col-sm-12">
   <nav id="portfolio-pagination" class="text-center">
   <ul class="pagination pagination-large">
    <?php 

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

    <?php } ?>
   </ul>
   </nav>
   </div>
   </div>

   </section>
   <?php }; #chiusura else "ci sono ordini?" ?> 
   </div>
      
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