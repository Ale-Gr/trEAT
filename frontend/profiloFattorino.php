<!DOCTYPE html>
<html>
<?php 
  include "../common/head.php";
  include_once("../common/setup.php");
  include_once("../common/funzioni.php");
?>
    
  <body>

  <?php include "../common/headerFattorino.php";
  
  if ($_SESSION["logged"] != true){
    ?> <div class = "messaggio"> <h2> Non sei loggato. </h2> </div><?php
  
  }
  else{
    $res = queryProfiloFattorino($cid, $email);
  
  ?>
    
      <div class="header-portfolio clearfix">
        <h2>PROFILO FATTORINO</h2>
       </div>

       <?php
       	  if (isset($_GET["stato"]))
           {
            $stato = $_GET["stato"];
           if ($stato ==1){
            echo "<div class=\"alert alert-danger\"><strong><center>ERRORE! Dati mancanti</center></strong></div>";
           }
           elseif ($stato ==2){
            echo "<div class=\"alert alert-danger\"><strong><center>ERRORE! Email già associata a un altro fattorino</center></strong></div>";
           }     
           elseif ($stato ==3){
            echo "<div class=\"alert alert-success\"><strong><center>Modifica effettuata correttamente</center></strong></div>";
           }              
           elseif ($stato ==4){
            echo "<div class=\"alert alert-danger\"><strong><center>Zona non associata al tuo utente, impossibile rimuovere.</center></strong></div>";
           }  
           elseif ($stato ==5){
            echo "<div class=\"alert alert-danger\"><strong><center>Zona già associata al tuo utente.</center></strong></div>";
           }   
         }  
        ?> 

       <!-- Contenuti (griglia) -->
       <div class="container-info">  
       <div class = "profilo">     
       <table class = "tabella-profilo">
       <?php 
        while($row= mysqli_fetch_assoc($res)){
        ?>
        <tr>
            <th>Email:</th>
            <td><?php echo $row['email']; ?></td>
        </tr>
        <tr>
            <th>Password:</th>
            <td><?php echo $row['password']; ?></td>
        </tr> 
        <tr>
            <th>Iban:</th>
            <td><?php echo $row['iban']; ?></td>
        </tr>
        <tr>
            <th>Zone di competenza:</th>
            <td>
            <?php 
            $sql2 = "SELECT zona from disponibile WHERE fattorino LIKE '$email';";
            $res2 = $cid->query($sql2);

            while($row2= mysqli_fetch_assoc($res2)){
              echo $row2['zona']; ?> <br> <?php
           }; ?>
           </td>
        </tr>   
        <tr>
            <th>Credito:</th>
            <td><?php echo $row['credito']; ?> €</td>
        </tr>        
            
        </table>
        </div>

        <div>
        <a href = "#modifica" class = button> Modifica </a>
        <a href = "#rimuovi" class = button> Rimuovi cap</a>
        </div>
        <div class = "overlay" id = "modifica">
          <div class = "wrapper">
            <h3> Modifica il tuo profilo: </h3>
            <a href="#" class="close">&times;</a>
            <div class = "content">
              <div class = "container-info">
              <form id = "fattorinoMod" method="GET" action="../backend/checkAggiornamentoFattorino.php" onsubmit="return validateModificaF()">
                <label for="email">Email:</label><br>
                <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>"><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" value="<?php echo $row['password']; ?>"><br>
					      <input type="checkbox" onclick="mostraPassword()"> Mostra password<br> 
                <label for="telefono">Iban:</label><br>
                <input type="text" id="iban" name="iban" value="<?php echo $row['iban']; ?>"><br>             
                <label for="zona">Aggiungi zona (cap):</label><br>
                <input type="text" id="zona" name="zona" value=""><br>
                <label for="credito">Credito:</label><br>
                <input type="text" id="credito" name="credito" value="<?php echo $row['credito']; ?> €" readonly><br><br>
                
                <?php }; ?> 
                <div class = "conferma">
                <input type= "submit" value= "conferma"/>
              </div>
              </form> 
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class = "overlay" id = "rimuovi">
          <div class = "wrapper">
            <h3> Rimuovi un cap dalle tue zone: </h3>
            <a href="#" class="close">&times;</a>
            <div class = "content">
              <div class = "container-info">
              <form id = "rimuoviCap" method = "GET" action="../backend/checkRimozioneZonaFattorino.php" onsubmit="return validateRimuoviF()">
              <label for="zona">Cap da rimuovere:</label><br>
                <input type="text" required id="zona" name="zona" value=""><br>                                           
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

<script src="../assets/js/controlloModifiche.js"></script>


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