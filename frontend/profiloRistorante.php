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
    $res = queryProfiloRistorante($cid, $email);
  
  ?>


      <div class="header-portfolio clearfix">
        <h2>PROFILO RISTORANTE</h2>
       </div>

       
       <?php
       	  if (isset($_GET["stato"]))
           {
            $stato = $_GET["stato"];
           if ($stato ==1){
            echo "<div class=\"alert alert-danger\"><strong><center>ERRORE! Dati mancanti</center></strong></div>";
           }
           elseif ($stato ==2){
            echo "<div class=\"alert alert-danger\"><strong><center>ERRORE! Email già associata a un altro ristorante</center></strong></div>";
           }     
           elseif ($stato ==3){
            echo "<div class=\"alert alert-success\"><strong><center>Modifica effettuata correttamente</center></strong></div>";
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
            <th>Nome:</th>
            <td><?php echo $row['nome']; ?></td>
        </tr>        
        <tr>
            <th>Partita iva:</th>
            <td><?php echo $row['partita_iva']; ?></td>
        </tr>     
        <tr>
            <th>Ragione sociale:</th>
            <td><?php echo $row['ragione_sociale']; ?></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><?php echo $row['email']; ?></td>
        </tr>
        <tr>
            <th>Password:</th>
            <td><?php echo $row['password']; ?></td>
        </tr>
        <tr>
            <th>via:</th>
            <td><?php echo $row['via']; ?></td>
        </tr>  
        <tr>
            <th>Numero civico:</th>
            <td><?php echo $row['numero_civico']; ?></td>
        </tr> 
        <tr>
            <th>Citofono:</th>
            <td><?php echo $row['citofono']; ?></td>
        </tr>     
        <tr>
            <th>Cap:</th>
            <td><?php echo $row['cap']; ?></td>
        </tr> 
        <tr>
            <th>Città:</th>
            <td><?php echo $row['nome_citta']; ?></td>
        </tr>           
    


        <tr>
            <th>Via sede:</th>
            <td><?php echo $row['via_sede']; ?></td>
        </tr>  
        <tr>
            <th>Numero civico sede:</th>
            <td><?php echo $row['numero_civico_sede']; ?></td>
        </tr> 
        <tr>
            <th>Citofono sede:</th>
            <td><?php echo $row['citofono_sede']; ?></td>
        </tr>     
        <tr>
            <th>Cap sede:</th>
            <td><?php echo $row['cap_sede']; ?></td>
        </tr> 
        <tr>
            <th>Città sede:</th>
            <td><?php echo $row['citta_sede']; ?></td>
        </tr> 

        </table>
        </div>

        <div>
        <a href = "#modifica" class = button> Modifica </a>
        </div>
        
        <div class = "overlay" id = "modifica">
          <div class = "wrapper">
            <h3> Modifica il tuo profilo: </h3>
            <a href="#" class="close">&times;</a>                 
            <div class = "content">           
              <div class = "container-info">
              <form id = "risto" method="GET" action="../backend/checkAggiornamentoRistorante.php" onsubmit= "return validateRistorante()">                
                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome" value="<?php echo $row['nome']; ?>"><br>
                <label for="partita_iva">Partita iva:</label><br>
                <input type="text" id="partita_iva" name="partita_iva" value="<?php echo $row['partita_iva']; ?>"><br>
                <label for="ragione_sociale">Ragione sociale:</label><br>
                <input type="text" id="ragione_sociale" name="ragione_sociale" value="<?php echo $row['ragione_sociale']; ?>"><br>
                <label for="email">Email:</label><br>
                <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>"><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" value="<?php echo $row['password']; ?>"><br>
					      <input type="checkbox" onclick="mostraPassword()"> Mostra password<br>                                    
                <label for="via">Via:</label><br>
                <input type="text" id="via" name="via" value="<?php echo $row['via']; ?>"><br>
                <label for="civico">Numero civico:</label><br>
                <input type="text" id="civico" name="civico" value="<?php echo $row['numero_civico']; ?>"><br>    
                <label for="citofono">Citofono:</label><br>
                <input type="text" id="citofono" name="citofono" value="<?php echo $row['citofono']; ?>"><br> 
                <label for="cap">Cap:</label><br>
                <input type="text" id="cap" name="cap" value="<?php echo $row['cap']; ?>"><br>
                <label for="citta">Città:</label><br>
                <input type="text" id="citta" name="citta" value="<?php echo $row['nome_citta']; ?>"><br>    
                <label for="via_sede">Via sede:</label><br>
                <input type="text" id="via_sede" name="via_sede" value="<?php echo $row['via_sede']; ?>"><br>
                <label for="civico_sede">Numero civico sede:</label><br>
                <input type="text" id="civico_sede" name="civico_sede" value="<?php echo $row['numero_civico_sede']; ?>"><br>    
                <label for="citofono_sede">Citofono sede:</label><br>
                <input type="text" id="citofono_sede" name="citofono_sede" value="<?php echo $row['citofono_sede']; ?>"><br> 
                <label for="cap_sede">Cap sede:</label><br>
                <input type="text" id="cap_sede" name="cap_sede" value="<?php echo $row['cap_sede']; ?>"><br>
                <label for="Citta_sede">Città sede:</label><br>
                <input type="text" id="citta_sede" name="citta_sede" value="<?php echo $row['citta_sede']; ?>"><br>  

                <div class = "conferma">
                <input type= "submit" value= "conferma"/>
              </div>
              </div>
            </div>

          </div>
        </div>
        <?php }; ?>  
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