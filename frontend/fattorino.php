<!DOCTYPE html>
<html>
<?php include "../common/head.php";

include_once("../common/setup.php");
include_once("../common/funzioni.php");

?>
    
  <body>
  <?php include "../common/headerFattorino.php";
  
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
    $res = queryOrdiniFattorino($cid, $offset);
    $res1 = queryOrdiniFattorinobis($cid);
    $countpage = mysqli_num_rows($res1);
    $limit = ceil($countpage/3) -1;   
    
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
    
    $resorari = queryOrari($cid, $email, $giorno_it, $ora);
    $apertura = "";
    if (mysqli_num_rows($resorari) == 0){
      $apertura = "no";
    }
  
  ?>
  
        <div class="header-portfolio clearfix">
            <h2>ORDINI DISPONIBILI</h2>
           </div>
           <!-- Contenuti (griglia) -->
        <div class="container-info">
      
          <!-- Tabelle prezzi -->
        <section id="servizi">
            <div class="row">
            <?php 
            if($apertura == 'no'){ ?>
             <div class = "messaggio"> <h2> Al momento non stai lavorando, i tuoi turni sono consultabili dalla relativa pagina. </h2> </div>
            <?php }
            else{            
              while($row=mysqli_fetch_assoc($res)){
              $res2 = queryOrdiniZona($cid, $email);
              while($row2=mysqli_fetch_assoc($res2)){
                if ($row['cap'] == $row2['zona']){

              $cliente = $row['email_cliente'];
              $date = $row['timestamp_ordine'];   
              if ((time() - strtotime($date)) < 7200){
                $actual_orders = $actual_orders + 1;              
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
                        <li class="list-group-item servizi-portfolio-collegamento"><a href = "#accettazione" class = button> Accetta </a>
                    </ul>
                </div>
                <?php 
                  }
                }
              } ?>
                <div class = "overlay" id = "accettazione">
          <div class = "wrapper">
          <h3> Per accettare l'ordine indica le tempistiche di consegna: </h3>
          <a href="#" class="close">&times;</a>
          <div class = "content">
            <div class = "container">
            <form method="GET" action="../backend/fattorinoConferma.php">
            <input type="hidden" name="cliente" value="<?php echo $cliente; ?>"/> 
            <input type="hidden" name="date" value="<?php echo $date; ?>" /> 
              <select name="Tempistiche">
                <option value="5">5-15 minuti</option>
                <option value="15">15-25 minuti</option>
                <option value="25">25-35 minuti</option>	
                <option value="35">35-45 minuti</option>
                <option value="45">45-55 minuti</option>
                <option value="55">55-65 minuti</option>
                <option value="65">65-75 minuti</option>	
                <option value="75">75-85 minuti</option>
                <option value="85">85-95 minuti</option>
              </select>
              <div class = "conferma">
                        <input type= "submit" value= "conferma"/>
            </div>
            </div>
          </div>

          </div>
        </div>
                <?php } ?>
            </div>
      </div>
</div>
<?php
if($actual_orders ==0){ ?>
  <div class = "messaggio"> <h2> Nessun ordine disponibile.</h2> </div>
  <?php  
  }

   ?>
        </section>
        <div class="row">
   <div class="col-sm-12">
   <nav id="portfolio-pagination" class="text-center">
   <ul class="pagination pagination-large">
    <?php 
    if ($actual_orders > 0){
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
  }
    ?>
   </ul>
   </nav>
   </div>
   </div>
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