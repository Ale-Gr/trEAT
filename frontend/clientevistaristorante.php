<!DOCTYPE html>
<html>
<?php include "../common/head.php";

include_once("../common/setup.php");
include_once("../common/funzioni.php");

if (isset($_GET["emailrist"])){
    $email_ristorante = $_GET["emailrist"];
}
?>
    
  <body>
  <?php include "../common/headerCliente.php";
  
  if ($_SESSION["logged"] != true){
    ?> <div class = "messaggio"> <h2> Non sei loggato. </h2> </div><?php
  
  }
  else{ 
    $res = queryPiatti($cid, $email_ristorante);  
  
  ?>
        <div class="header-portfolio clearfix">
            <h2>PIATTI DISPONIBILI</h2><br>
            
            <h2><?php 
            $sql2 = "SELECT nome, email FROM ristorante WHERE email like '$email_ristorante';";
            $res2 = $cid->query($sql2);
            while($row= mysqli_fetch_assoc($res2)){                    
                echo $row['nome'];
                $ristorante = $row['email'];
            };                
            ?></h2>
           </div>
           <!-- Contenuti (griglia) -->
        <div class="container">
          <!-- Tabelle prezzi -->
        <section id="servizi">
            <div class="row">
            <?php 
            while($row= mysqli_fetch_assoc($res)){ 
              ?>
                  <div class="col-sm-4">
                      <ul class="list-group servizi">
                          <?php $imageURL = '../images/'.$row['filename'] ?>
                          <img src="<?php echo $imageURL; ?>" alt="" />
                          <li class="list-group-item servizi-portfolio-titolo"><h4><?php echo $row['nome'];?></h4></li>
                          <li class="list-group-item servizi-portfolio-opzione">Tipo: <?php echo $row['tipo'];?></li>
                          <li class="list-group-item servizi-portfolio-opzione"><?php echo $row['descrizione'];?></li>
                          <li class="list-group-item servizi-portfolio-opzione">Prezzo: <?php echo $row['prezzo'];?> euro</li>
                          <?php if( $row['tipo'] == 'menu'){ ?>
                          <li class="list-group-item servizi-portfolio-opzione">Piatti: <?php $piatti = queryStampaMenu($cid, $row['nome'], $email_ristorante); 
                          while($contenuto= mysqli_fetch_assoc($piatti)){ 
                            echo $contenuto['nome_piatto']; ?> <br/> <?php
                          }
                          ?>                                                 
                            
                          <?php } ?>
                          <li class="list-group-item servizi-portfolio-collegamento"><a href = "../backend/aggiuntacarrello.php?ristorante=<?php echo $ristorante;?>&piatto=<?php echo $row['nome']; ?>&prezzo=<?php echo $row['prezzo'];?>" class = button> Aggiungi al carrello </a>
                      </ul>
                  </div>
                  <?php }; ?>  
        </section>
    </div>
        
    
    <?php include "../common/footer.php"; ?>
        <!-- jQuery e plugin JavaScript  -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/plugins/flexslider/jquery.flexslider.js"></script>
        <script src="../assets/plugins/fancybox/jquery.fancybox.pack.js"></script>
        <script src="../assets/js/scripts.js"></script>    

    </body>
    <?php } ?>
</html>  