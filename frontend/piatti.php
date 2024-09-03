<!DOCTYPE html>
<html>
<?php include "../common/head.php";

include_once("../common/setup.php");
include_once("../common/funzioni.php");

$piatti = array();
?>
    
  <body>
  <?php include "../common/headerRistorante.php";
  
  if ($_SESSION["logged"] != true){
    ?> <div class = "messaggio"> <h2> Non sei loggato. </h2> </div><?php
  
  }
  else{ 
    $res = queryPiatti($cid, $email);
  ?>
        <div class="header-portfolio clearfix">
            <h2>PIATTI</h2>
           </div>          
           <?php
       	  if (isset($_GET["stato"]))
           {
            $stato = $_GET["stato"];
           if ($stato ==1){
            echo "<div class=\"alert alert-success\"><strong><center>Modifica effettuata correttamente</center></strong></div>";
           }    
           if ($stato ==2){
            echo "<div class=\"alert alert-danger\"><strong><center>ERRORE! Dati mancanti</center></strong></div>";
           }           
           if ($stato ==3){
            echo "<div class=\"alert alert-danger\"><strong><center>ERRORE! Nome già associato a un altro pietanza</center></strong></div>";
           }
           if ($stato ==4){
            echo "<div class=\"alert alert-danger\"><strong><center>ERRORE! Selezionare più di un pietanza da aggiungere al menù</center></strong></div>";
           }    
         }
         ?>
           <!-- Contenuti (griglia) -->
        <div class="container-info">
          <div class ="aggiunta">
            <h2><a style="color:green" href = "#aggiungi"> AGGIUNGI PIATTO</a></h2>          
            <h2><a style="color:green" href = "#aggiungimenu"> AGGIUNGI MENU</a></h2>          
        </div>
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
                        <li class="list-group-item servizi-portfolio-opzione">Piatti: <?php $piatti = queryStampaMenu($cid, $row['nome'], $email); 
                        while($contenuto= mysqli_fetch_assoc($piatti)){ 
                          echo $contenuto['nome_piatto']; ?> <br/> <?php
                        }
                        ?>                                                 
                          
                        <?php } ?>
                        <li class="list-group-item servizi-portfolio-collegamento"><a href = "modificaPiatto.php?nome=<?php echo $row['nome']?>" class = button> Modifica </a>
                        <li class="list-group-item servizi-portfolio-collegamento"><a href = "../backend/rimuoviPiatto.php?pietanza=<?php echo $row['nome'];?>" class = button> Rimuovi </a>
                    </ul>
                </div>
                <?php }; ?>  
            </div>
            <div class = "overlay" id = "aggiungi">
          <div class = "wrapper">
            <h3> Aggiungi un pietanza: </h3>
            <a href="#" class="close">&times;</a>                 
            <div class = "content">           
              <div class = "container-info">
              <form id = "Piatto" method="POST" enctype="multipart/form-data" action="../backend/aggiungiPiatto.php" onsubmit = "return validatePiatti()">               
                <label for="nome">Nome:</label><br>
                <input type="text" required id="nome" name="nome" value=""><br>
                <label for="descrizione">Descrizione:</label><br>
                <input type="text" required id="descrizione" name="descrizione" value=""><br>                                      
                <label for="prezzo">Prezzo:</label><br>
                <input type="text" required id="prezzo" name="prezzo" value=""><br>
                <label for="immagine">Immagine:</label><br>
                <input class="img" type="file" required id="immagine" name="immagine"><br>                          
                <div class = "conferma">
                <input type= "submit" value= "conferma"/>
              </div>
              </form>  
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class = "overlay" id = "aggiungimenu">
          <div class = "wrapper">
            <h3> Aggiungi un menu: </h3>
            <a href="#" class="close">&times;</a>                 
            <div class = "content">           
              <div class = "container-info">
              <form id ="Menu" method="POST" enctype="multipart/form-data" action="../backend/aggiungiMenu.php" onsubmit="return validateAggiungiM()">                  
                <label for="nome">Nome:</label><br>
                <input type="text" required id="nome" name="nome" value=""><br> 
                <label for="descrizione">Descrizione:</label><br>
                <input type="text" required id="descrizione" name="descrizione" value=""><br>                                   
                <label for="prezzo">Prezzo:</label><br>
                <input type="text" required id="prezzo" name="prezzo" value=""><br>
                <label for="immagine">Immagine:</label><br>
                <input class="img" type="file" required id="immagine" name="immagine"><br>
                <label for="piatti"> Quali piatti contiene il menù?</label><br>
                <?php
                $res2 = queryPiattiMenu($cid, $email);
                while($row2= mysqli_fetch_assoc($res2)){ ?>                
                <input type="checkbox" id = "piatti" name="piatti[]" value = "<?php echo $row2['nome'];?>">
                <label style="font-weight: normal" for="piatti"> <?php echo $row2['nome'];?></label><br>
                <?php 
                }
                ?>                        
                <div class = "conferma">
                <input type= "submit" value= "conferma"/>
              </div>
              </form>  
              </div>
            </div>

          </div>
        </div>
      </div>
</div>
        </section>


        <script src="../assets/js/aggmodpiatti.js"></script>        
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