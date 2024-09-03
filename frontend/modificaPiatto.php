<!DOCTYPE html>
<html>
<?php include "../common/head.php";

include_once("../common/setup.php");
include_once("../common/funzioni.php");

$email = $_SESSION['utente'];
$piatto_old = $_GET['nome'];
?>
    
  <body>
  <?php include "../common/headerRistorante.php";
  
  if ($_SESSION["logged"] != true){
    ?><div class = "messaggio"> <h2> Non sei loggato. </h2> </div><?php
  
  }
  else{ 
    $res = queryModificaPiatto($cid, $email, $piatto_old);
  
  ?>
        <div class="header-portfolio clearfix">
            <h2>PAGINA PER MODIFICARE PIATTO</h2>
           </div>

           <?php
       	  if (isset($_GET["stato"]))
           {
            $stato = $_GET["stato"];
           if ($stato ==1){
            echo "<div class=\"alert alert-danger\"><strong><center>ERRORE! Nome già associato a un altro piatto</center></strong></div>";
           }             
           if ($stato ==2){
            echo "<div class=\"alert alert-danger\"><strong><center>ERRORE! Dati mancanti</center></strong></div>";
           }        
         }
         ?>
           <!-- Contenuti (griglia) -->
           <script src = "../assets/js/aggmodpiatti.js"></script>

        <div class="container-info">

        <form  id = "Piatto" method="POST" enctype="multipart/form-data" action="../backend/checkModificaPiatto.php?piatto_old=<?php echo $piatto_old;?>" onsubmit = "return validatePiattiMod()">
    <?php while($row= mysqli_fetch_assoc($res)){ ?>
    <label for="nome">Nome:</label><br>
    <input type="text" required id="nome" name="nome" value="<?php echo $row['nome']; ?>"><br>
    <label for="descrizione">Descrizione:</label><br>
    <input type="text" required id="descrizione" name="descrizione" value="<?php echo $row['descrizione']; ?>"><br>                                      
    <label for="prezzo">Prezzo:</label><br>
    <input type="text" required id="prezzo" name="prezzo" value="<?php echo $row['prezzo']; ?>"><br>
    <label for="immagine">Immagine:</label><br>
    <input class = "img" type="file" id="immagine" name="immagine"><br>                          
    <div class = "conferma">
    <input type= "submit" value= "conferma"/>
		</form>
    <?php } ?>

</div>       
    </div>    
    
    <script src="../assets/js/aggmodpiatti.js"></script>

<?php include "../common/footer.php";?>  
        <!-- jQuery e plugin JavaScript  -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/flexslider/jquery.flexslider.js"></script>
        <script src="assets/plugins/fancybox/jquery.fancybox.pack.js"></script>
        <script src="assets/js/scripts.js"></script>    
        </div>
    </body>
    <?php } ?>
</html>