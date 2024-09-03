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
  <?php include "../common/headerFattorino.php";
  
  if ($_SESSION["logged"] != true){
    ?> <div class = "messaggio"> <h2> Non sei loggato. </h2> </div><?php
  
  }
  else{

    $offset = $actualpage*3;
    $res = queryOrdiniAccettatiFattorino($cid, $email, $offset);
    $res1 = queryOrdiniAccettatiFattorinobis($cid, $email);
    $countpage = mysqli_num_rows($res1);
    $limit = ceil($countpage/3) -1;  
  
  ?>
  
        <div class="header-portfolio clearfix">
            <h2>ORDINI ACCETTATI</h2>
           </div>
           <!-- Contenuti (griglia) -->
        <div class="container-info">

        <?php 
      if (mysqli_num_rows($res) == 0){
        ?>

        <div class = "messaggio"> <h2> Nessun ordine accettato. </h2> </div>


        <?php
      } else{
      
      ?>
          <!-- Tabelle prezzi -->
        <section id="servizi">
            <div class="row">
            <?php while($row=mysqli_fetch_assoc($res)){
              $cliente = $row['email_cliente'];
              $date = $row['timestamp_ordine'];  
              $credito = $row['prezzo'] / 10;  
      ?>
                <div class="col-sm-4">
                    <ul class="list-group servizi">
                    <li class="list-group-item servizi-portfolio-titolo"><h4>Ordine #<?php echo $row['timestamp_ordine']; ?></h4></li>
                        <li class="list-group-item servizi-portfolio-opzione">Ristorante: <?php echo $row['nome']; ?></li>
                        <li class="list-group-item servizi-portfolio-opzione">Indirizzo ristorante: <?php echo $row['via']; ?> <?php echo $row['numero_civico']; ?> - <?php echo $row['nome_citta']; ?></li>
                        <li class="list-group-item servizi-portfolio-opzione">Citofono ristorante: <?php echo $row['citofono']; ?></li>
                        <li class="list-group-item servizi-portfolio-opzione">Indirizzo cliente: <?php echo $row['cliente_via']; ?> <?php echo $row['cliente_civico']; ?> - <?php echo $row['cliente_citta']; ?></li>
                        <li class="list-group-item servizi-portfolio-opzione">Citofono cliente: <?php echo $row['cliente_citofono']; ?></li>
                        <li class="list-group-item servizi-portfolio-opzione">Istruzioni consegna (se presenti): <?php echo $row['istruzioni_consegna']; ?></li>
                        <li class="list-group-item servizi-portfolio-opzione">Prezzo: <?php echo $row['prezzo']; ?> euro</li>
                        <li class="list-group-item servizi-portfolio-opzione">Stato: <?php echo $row['stato']; ?></li>
                        <li class="list-group-item servizi-portfolio-collegamento"><a href = "#accettazione" class = button> Consegnato </a>
                        
                        
                    </ul>
                </div>
                <?php } ?>
                <div class = "overlay" id = "accettazione">
          <div class = "wrapper">
          <h3> Confermi di aver consegnato l'ordine? Ti verrà accreditato il 10% del suo prezzo, quindi <?php echo $credito; ?> euro.</h3>
          <a href="#" class="close">&times;</a>
          <div class = "content">
            <div class = "container-info">
            <form method="GET" action="../backend/confermatoOrdineFattorino.php">
            <input type="hidden" name="cliente" value="<?php echo $cliente; ?>"/> 
            <input type="hidden" name="date" value="<?php echo $date; ?>" /> 
            <input type="hidden" name="credito" value="<?php echo $credito; ?>" /> 
              <div class = "conferma">
                        <input type= "submit" value= "conferma"/>
            </div>
            </div>
          </div>

          </div>
        </div>

            </div>
      </div>
</div>
        </section>
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
            <?php } #chiusura while "ci sono ordini?"?>
        </div>
        <?php include "../common/footer.php";?>  
        <!-- jQuery e plugin JavaScript  -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/flexslider/jquery.flexslider.js"></script>
        <script src="assets/plugins/fancybox/jquery.fancybox.pack.js"></script>
        <script src="assets/js/scripts.js"></script>    
        </div>
      <?php } ?>
    </body>
</html>