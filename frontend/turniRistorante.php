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
    $res = queryTurniRistorante($cid, $email);
  
  ?>

      <div class="header-portfolio clearfix">
        <h2>ORARI DI APERTURA</h2>
       </div>
       <?php
       	  if (isset($_GET["stato"]))
           {
            $stato = $_GET["stato"];
           if ($stato ==1){
            echo "<div class=\"alert alert-danger\"><strong><center>ERRORE!Orario già esistente</center></strong></div>";
           }
           elseif ($stato ==2){
            echo "<div class=\"alert alert-success\"><strong><center>Modifica effettuata correttamente</center></strong></div>";
           }    
           elseif($stato == 3) {
            echo "<div class=\"alert alert-danger\"><strong><center>ERRORE!Orario inesistente</center></strong></div>";
           }    
         }  
?>    

       <!-- Contenuti (griglia) -->
       <div class="container-info">  
       <div class = "profilo">     
       <table class = "tabella-profilo">
       <tr>
            <th>GIORNO</th>
            <th>ORARIO INIZIO</th>
            <th>ORARIO FINE</th>
        </tr>
       <?php 
        while($row= mysqli_fetch_assoc($res)){
        ?>
        <tr>
            <td><?php echo $row['giorno']; ?></td>
            <td><?php echo $row['orario_inizio']; ?></td>
            <td><?php echo $row['orario_fine']; ?></td>
        </tr>    
        <?php }; ?>          
        </table>
        </div>
        <div>
        <a href = "#modifica" class = button> Aggiungi </a>
            <a href = "#rimuovi" class = button> Rimuovi </a>
            </div>
            <div class = "overlay" id = "modifica">
              <div class = "wrapper">
                <h3> Modifica i turni: </h3>
                <a href="#" class="close">&times;</a>
                <div class = "content">
                  <div class = "container-info">
                  <form method="GET" action="../backend/checkOrariRistorante.php">
                      <label for="giono">Giorno:</label>
                      <select name="giorno" id="giorno">
                        <option value="lunedì">lunedì</option>
                        <option value="martedì">martedì</option>
                        <option value="mercoledì">mercoledì</option>
                        <option value="giovedì">giovedì</option>
                        <option value="venerdì">venerdì</option>
                        <option value="sabato">sabato</option>
                        <option value="domenica">domenica</option>
                      </select>
                      <br><br>
                      <label for="orario">Fascia oraria:</label>
                      <select name="orario" id="orario">
                        <option value="11:30:00">11.30-15.30</option>
                        <option value="15:30:00">15.30-19.30</option>
                        <option value="19:30:00">19.30-23.30</option>
                      </select>
                      <br><br>
                      <div class = "conferma">
                        <input type= "submit" value= "conferma"/>
                      </div>
                    </form>
                  </div>
                </div>
                </div>
            </div>

            <div class = "overlay" id = "rimuovi">
              <div class = "wrapper">
                <h3> Rimuovi i turni: </h3>
                <a href="#" class="close">&times;</a>
                <div class = "content">
                  <div class = "container-info">
                  <form method="GET" action="../backend/checkRimozioneOrariRistorante.php">
                      <label for="giono">Giorno:</label>
                      <select name="giorno" id="giorno">
                        <option value="lunedì">lunedì</option>
                        <option value="martedì">martedì</option>
                        <option value="mercoledì">mercoledì</option>
                        <option value="giovedì">giovedì</option>
                        <option value="venerdì">venerdì</option>
                        <option value="sabato">sabato</option>
                        <option value="domenica">domenica</option>
                      </select>
                      <br><br>
                      <label for="orario">Fascia oraria:</label>
                      <select name="orario" id="orario">
                        <option value="11:30:00">11.30-15.30</option>
                        <option value="15:30:00">15.30-19.30</option>
                        <option value="19:30:00">19.30-23.30</option>
                      </select>
                      <br><br>
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


<?php include "../common/footer.php";?>  
  <!-- jQuery e plugin JavaScript  -->
  <script src="http://code.jquery.com/jquery.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/plugins/flexslider/jquery.flexslider.js"></script>
  <script src="../assets/plugins/fancybox/jquery.fancybox.pack.js"></script>
  <script src="../assets/js/scripts.js"></script>    
  <?php } ?>
    </body>
</html>