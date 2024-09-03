<!DOCTYPE html>
<html>
<?php include "../common/head.php";

include_once("../common/setup.php");
include_once("../common/funzioni.php");
?>
    
  <body>
  <?php include "../common/headerCliente.php";
  
  if ($_SESSION["logged"] != true){
    ?> <div class = "messaggio"> <h2> Non sei loggato. </h2> </div><?php
  
  }
  else{ 
    $res = queryProfiloCliente($cid, $email);
  
  ?>

      <div class="header-portfolio clearfix">
        <h2>PROFILO UTENTE</h2>
       </div>
       <?php
       	  if (isset($_GET["stato"]))
           {
            $stato = $_GET["stato"];
           if ($stato ==1){
            echo "<div class=\"alert alert-danger\"><strong><center>ERRORE! Dati mancanti</center></strong></div>";
           }
           elseif ($stato ==2){
            echo "<div class=\"alert alert-danger\"><strong><center>ERRORE! Email già associata a un altro utente</center></strong></div>";
           }     
           elseif ($stato ==3){
            echo "<div class=\"alert alert-success\"><strong><center>Modifica effettuata correttamente</center></strong></div>";
           }    
           elseif ($stato ==4){
            echo "<div class=\"alert alert-success\"><strong><center>Modifica effettuata correttamente</center></strong></div>";
           }
           elseif ($stato ==5){
            echo "<div class=\"alert alert-danger\"><strong><center>ERRORE! Numero carta non valido</center></strong></div>";
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
            <th>Via:</th>
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
    
        </table>
        </div>

        <div>
        <a href = "#modifica"> Modifica </a>
        </div>
        <div class = "overlay" id = "modifica">
          <div class = "wrapper">
            <h3> Modifica il tuo profilo: </h3>
            <a href="#" class="close">&times;</a>                 
            <div class = "content">           
              <div class = "container">
              <form id = "modificaC" method="GET" action="../backend/checkAggiornamentoUtente.php" onsubmit="return validateModificheC()">                    
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
                <label for="Citta">Città:</label><br>
                <input type="text" id="citta" name="citta" value="<?php echo $row['nome_citta']; ?>"><br>    
                <?php }; ?>                        
                <div class = "conferma">
                <input type= "submit" value= "conferma"/>
              </div>
              </form>  
              </div>
            </div>

          </div>
        </div>
        <?php 
        $res2 = queryCarta($cid, $email);     
        ?>
        <h2> Le tue carte di credito: </h2>
        <table class = "tabella-profilo">
  <tr>
    <th>Numero</th>
    <th>Titolare</th>
    <th>Mese scadenza</th>
    <th>Anno Scadenza</th>
    <th>Codice di controllo</th>
  </tr>
  <?php while ($row2 = mysqli_fetch_assoc($res2)){?>
  <tr>
    <td><?php echo $row2['numero_carta'];?></td>
    <td><?php echo $row2['nome_titolare'];?></td>
    <td><?php echo $row2['mese_scadenza'];?></td>
    <td><?php echo $row2['anno_scadenza'];?></td>
    <td><?php echo $row2['codice_di_controllo'];?></td>
  </tr>
  <?php }; ?>
</table>
<a href="#aggiunta"> Aggiungi carta di credito</a><br>
<a href="#rimuovi"> Rimuovi carta di credito</a>
<div class = "overlay" id = "aggiunta">
  <div class = "wrapper">
    <h3> Aggiungi una carta di credito: </h3>
    <a href="#" class="close">&times;</a>                 
    <div class = "content">           
      <div class = "container">
      <form id = "aggiungiCarta" method="GET" action="../backend/aggiungicartadicredito.php" onsubmit="return validateAggiuntaCarta() ">             
          <label for="numero">Numero:</label><br>
          <input type="number" id="numero" name="numero" value=""><br>
          <label for="nome">Nome:</label><br>
          <input type="text" id="nome" name="nome" value=""><br>                                      
          <label for="mese">Mese scadenza:</label><br>
          <input type="number" id="mese" name="mese" min="1" max="12"><br>
          <label for="anno">Anno scadenza:</label><br>
          <input type="number" id = "anno" name = "anno" min="2023" max="2050"><br>
          <label for="codice">Codice di controllo:</label><br>
          <input type="number" id="codice" name="codice" min="100" max="999"><br>
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
    <h3> Rimuovi una carta di credito: </h3>
    <a href="#" class="close">&times;</a>                 
    <div class = "content">           
      <div class = "container">
        <form method="GET" action="../backend/rimuovicartadicredito.php" onsubmit="return validateRimozioneCarta() ">   
          <?php 
          $sql2 = "SELECT * FROM carta WHERE email_cliente LIKE '$email';";
          $res2 = $cid->query($sql2);    
          while($row3 = mysqli_fetch_assoc($res2)){ ?>
            <input type="radio" id="numero" name="numero" value="<?php echo $row3['numero_carta'];?>">
            <label for="<?php echo $row3['numero_carta'];?>"><?php echo $row3['numero_carta'];?></label><br> 
          <?php } ?>    
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