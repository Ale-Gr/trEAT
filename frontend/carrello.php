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
$offset = $actualpage*1;

?>
    
  <body>
  <?php include "../common/headerCliente.php";
  
  if ($_SESSION["logged"] != true){
    ?> <h2> <center> Non sei loggato. </center> </h2><?php
  
  }
  else{ 
    $res = queryCarrello($cid, $email, $offset);
    $res1 = queryCarrellobis($cid, $email);
    $countpage = mysqli_num_rows($res1);
    $limit = ceil($countpage/1) -1;  
  
  ?>

      <div class="header-portfolio clearfix">
        <h2>CARRELLO</h2>
       </div>

       <?php
       	  if (isset($_GET["stato"]))
           {
            $stato = $_GET["stato"];
           if ($stato ==1){
            echo "<div class=\"alert alert-success\"><strong><center>Ordine effettuato</center></strong></div>";
           }
           elseif ($stato ==2){
            echo "<div class=\"alert alert-danger\"><strong><center>Selezionare un metodo di pagamento</center></strong></div>";
           }  
           elseif ($stato ==3){
            echo "<div class=\"alert alert-danger\"><strong><center>Ristorante chiuso</center></strong></div>";
           }     
         }  
        ?> 
       <!-- Contenuti (griglia) -->
       <div class="container-info">

    <div class = "orders">
      <center>
      <?php 
      if (mysqli_num_rows($res) == 0){
        ?>

        <h2> <center> Nessun ordine presente nel carrello.</center> </h2>


        <?php
      } else{
      
      ?>
    <?php 
            while($row= mysqli_fetch_assoc($res)){
              $date = $row['timestamp_ordine']; 
            ?>
      <div class = "ordine">
            <h3> Ordine #<?php echo $row['timestamp_ordine']; ?> </h3>
            <h4><a href = "../backend/eliminazioneOrdine.php?date=<?php echo $date?>" class = button> RIMUOVI </a></h4><br/>
            <strong>Ristorante</strong>: <?php echo $row['nome']; ?><br/>
            <strong>Indirizzo</strong>: <?php echo $row['via']; ?> <?php echo $row['numero_civico']; ?> - <?php echo $row['nome_citta']; ?><br/>
            <form method="GET" action="../backend/confermaOrdine.php?">
            <input type="hidden" id="date" name="date" value="<?php echo $date;?>">
            <input type="hidden" id="ristorante" name="ristorante" value="<?php echo $row['email'];?>">
            <label for="istruzioni">Istruzioni di consegna:</label><br>
                <input type="text" id="istruzioni" name="istruzioni" value=""><br>     
              <label for ="pagamento" name> Metodo di pagamento:<br>                                            
              <input type="radio" id="pagamento" name="pagamento" value="contanti" checked>
              <label for="contanti">contanti</label><br>
              <?php 
              $res3 = queryCartaCarrello($cid, $email);
              while($row3 = mysqli_fetch_assoc($res3)){ ?>
            <input type="radio" id="pagamento" name="pagamento" value="carta">
            <label for="<?php echo $row3['numero_carta'];?>">Carta di credito - <?php echo $row3['numero_carta'];?></label><br> 
              <?php } ?>                   
              
              <table>
            <tr>
              <th>Piatto</th>
              <th>Quantità</th>
            </tr>
            <?php
            $res2 = queryPiattiCarrello($cid, $email, $date);
            while($row2= mysqli_fetch_assoc($res2)){
             ?>
            <tr>
              <td> <?php echo $row2['nome']; ?></td>
              <td> <?php echo $row2['quantita']; ?> <h4> <a href="../backend/aggiungiCarrello.php?ristorante=<?php echo $row['email_ristorante'];?>&piatto=<?php echo $row2['nome']; ?>&quantita=<?php echo $row2['quantita'];?>&date=<?php echo $row['timestamp_ordine']; ?>&actualpage=<?php echo $actualpage; ?>">&plus;</a> 
              <a href="../backend/rimuoviCarrello.php?ristorante=<?php echo $row['email_ristorante'];?>&piatto=<?php echo $row2['nome']; ?>&quantita=<?php echo $row2['quantita'];?>&date=<?php echo $row['timestamp_ordine']; ?>&actualpage=<?php echo $actualpage; ?>">&minus;</a> </h4></td>
              </tr>
            <?php } ?>
            <td> <strong> Prezzo: </strong> </td>
            <td> <?php echo $row['prezzo']; ?>

          </table>
      </div>
      <div class = "conferma">
      <input type= "submit" value= "conferma"/>
      </form>
      &nbsp;
      &nbsp;

    </div>
    </div>
            </center>
      </div>
      <?php }; ?>


<div class="row">
   <div class="col-sm-12">
   <nav id="portfolio-pagination" class="text-center">
   <ul class="pagination pagination-large">
    <?php 

    if ($actualpage==0 && $actualpage != $limit){?>
    <li class="active"><a href="carrello.php?actualpage=<?php echo $actualpage ?>">1</a></li>
    <li><a href="carrello.php?actualpage=<?php echo $actualpage+1 ?>">2</a></li>
    <li><a href="carrello.php?actualpage=<?php echo $actualpage+1 ?>">&raquo;</a></li>
    <?php }
    elseif($actualpage != $limit){?>
    <li><a href="carrello.php?actualpage=<?php echo $actualpage-1 ?>">&laquo;</a></li>
    <li><a href="carrello.php?actualpage=<?php echo $actualpage-1 ?>"><?php echo $actualpage?></a></li>
    <li class = "active"><a href="#carrello.php?actualpage=<?php echo $actualpage ?>"><?php echo $actualpage+1?></a></li>
    <li><a href="carrello.php?actualpage=<?php echo $actualpage+1 ?>"><?php echo $actualpage+2?></a></li>
    <li><a href="carrello.php?actualpage=<?php echo $actualpage+1 ?>">&raquo;</a></li>

    <?php }
    elseif($actualpage== 0 && $actualpage == $limit){?>
        <li class="active"><a href="carrello.php?actualpage=<?php echo $actualpage ?>">1</a></li>
    <?php }
    else{?>
    <li><a href="carrello.php?actualpage=<?php echo $actualpage-1 ?>">&laquo;</a></li>
    <li><a href="carrello.php?actualpage=<?php echo $actualpage-1 ?>"><?php echo $actualpage?></a></li>
    <li class = "active"><a href="#carrello.php?actualpage=<?php echo $actualpage-1 ?>"><?php echo $actualpage+1?></a></li> 

    <?php } ?>
   </ul>
   </nav>
   </div>
   </div>
   <?php }; ?>
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