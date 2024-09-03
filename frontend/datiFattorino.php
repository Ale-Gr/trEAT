<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en" ><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" ><!--<![endif]-->
<html>
<?php include "../common/head.php" ?>
<body>
<!-- Header e barra di navigazione -->
<header>
<nav class="navbar navbar-default">
<div class="container">
 <div class="navbar-header">
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
   <span class="icon-bar"></span>
   <span class="icon-bar"></span>
   <span class="icon-bar"></span>
  </button>
  <a class="navbar-brand" href="../index.php"></a>
 </div> 
 <div class="collapse navbar-collapse navbar-responsive-collapse">
   <ul class="nav navbar-nav">
   	<li><a href="../index.php">Home</a></li>
   </ul>
 </div><!-- /.nav-collapse -->
</div>
</nav><!-- /.navbar -->
<div class="header-portfolio clearfix">
        <h2>FORM PER EFFETTUARE LA REGISTRAZIONE COME FATTORINO</h2>
       </div>
       <!-- Contenuti (griglia) -->
       <div class="container">
</header><!-- /header -->


<?php


function visualizzaErrore($chiave)
{
    global $errore,$tipoErrore;
    if (isset($errore[$chiave])) echo "<span class=\"errore\">" . $tipoErrore[$errore[$chiave]] . "</span>"; 
}

function toBeSelected($chiave, $valore)
{
    echo $chiave==$valore?"selected='selected'":"";
}

function toBeChecked($attivita,$chiave)
{
    if (is_array($attivita))
        echo isset($attivita) &&in_array($chiave,$attivita)?"checked":"";
    else
        echo $attivita==$chiave?"checked":"";
}

$tipoErrore = array("1"=> "nome non valido",
                    "2" => "cognome non valido",
					"3" => "data di nascita non valida",
					"4" => "email non valida",
					"5" => "Password non valida",
					"6" => "IBAN non valido",
					"7" => "Bisogna accettare le condizioni di utilizzo",
					"8" => "Bisogna indicare un cap", #aggiunto			
					"9" => "Bisogna inserire almeno un turno"
				);
$errore = array();
$dati = array();

if (isset($_GET["status"]))
{
	if ($_GET["status"]=='ko') $errore=unserialize($_GET["errore"]);
	$dati=unserialize($_GET["dati"]);
    // print_r($dati);
    // print_r($errore);
}
else
{
	$dati["nome"]="";
	$dati["cognome"]="";
	$dati["data"]="";
	$dati["email"]="";
	$dati["turni"]= array();
	$dati["password"]="";
	$dati["iban"]="";
	$dati["cap"] ="";
	$dati["condizioni"]="ko";
}

?>
<!DOCTYPE html>
<html lang="it">
	
	<body>

        <?php 	
		
		?>
        <p class="form">
		<form id = "registrazioneF"  method="GET" action="../backend/checkFattorino.php" onsubmit="return validateRegistrazione()">
		  <?php if (isset($_GET["login"]))
                {
                    $login = $_GET["login"];
                    echo "<input type = \"hidden\" name = \"login\" value=\"$login\">";
                }
                
          ?>
          <center>
		  <table class="insert"> 
		  <tr>
					<td>Nome: </td><td><input type = "text" name = "nome" value="<?php  echo $dati["nome"];?>"/> 
                     <?php visualizzaErrore("nome"); ?>
</td>
				</tr>
				<tr>
					<td>Cognome: </td>
					<td><input type = "text" name = "cognome" value="<?php  echo $dati["cognome"];?>"/>
                    <?php visualizzaErrore("cognome")  ?>
</td>
				</tr>
				<tr>
				<td>Data nascita: </td><td>
  				<input type="date" id="data" name="data" value="<?php echo $dati["data"];?>"/>
					<?php visualizzaErrore("data"); ?>
					
					</td>
				</tr>
				
				<tr>
					<td>Email: </td>
					<td><input type = "text" name = "email" value="<?php  echo $dati["email"];?>"/>
                    <?php visualizzaErrore("email")  ?>
</td>
				</tr>

				<tr>
					<td>Password: </td>
					<td><input type = "password" name = "password" id ="password" value="<?php  echo $dati["password"];?>"/>
					<input type="checkbox" onclick="mostraPassword()"> Mostra password
                    <?php visualizzaErrore("password")  ?>
</td>
				</tr>

				<tr>
					<td>Iban: </td><td><input type = "text" name = "iban" value="<?php  echo $dati["iban"];?>"/> 
					<?php visualizzaErrore("iban"); ?>
</td>
				</tr>	

				<tr>
			<td>Inserire i propri turni - lunedì: </td><td>
						<input type="checkbox" name="turni[]" value="1" <?php toBeChecked($dati["turni"],"1");?>/> 11.30 - 15.30<br/>
						<input type="checkbox" name="turni[]" value="2" <?php toBeChecked($dati["turni"],"2");?>/> 15.30 - 19.30<br/>
						<input type="checkbox" name="turni[]" value="3" <?php toBeChecked($dati["turni"],"3");?>/> 19.30 - 23.30<br/>				
			</td>		<?php visualizzaErrore("turni"); ?>
			<tr>
			<td>Inserire i propri turni - martedì: </td><td>
						<input type="checkbox" name="turni[]" value="4" <?php toBeChecked($dati["turni"],"4");?>/> 11.30 - 15.30<br/>
						<input type="checkbox" name="turni[]" value="5" <?php toBeChecked($dati["turni"],"5");?>/> 15.30 - 19.30<br/>
						<input type="checkbox" name="turni[]" value="6" <?php toBeChecked($dati["turni"],"6");?>/> 19.30 - 23.30<br/>
			</td>
			<tr>
			<td>Inserire i propri turni - mercoledì: </td><td>
						<input type="checkbox" name="turni[]" value="7" <?php toBeChecked($dati["turni"],"7");?>/> 11.30 - 15.30<br/>
						<input type="checkbox" name="turni[]" value="8" <?php toBeChecked($dati["turni"],"8");?>/> 15.30 - 19.30<br/>
						<input type="checkbox" name="turni[]" value="9" <?php toBeChecked($dati["turni"],"9");?>/> 19.30 - 23.30<br/>		 						
			</td>
			<tr>
			<td>Inserire i propri turni - giovedì: </td><td>
						<input type="checkbox" name="turni[]" value="10" <?php toBeChecked($dati["turni"],"10");?>/> 11.30 - 15.30<br/>
						<input type="checkbox" name="turni[]" value="11" <?php toBeChecked($dati["turni"],"11");?>/> 15.30 - 19.30<br/>
						<input type="checkbox" name="turni[]" value="12" <?php toBeChecked($dati["turni"],"12");?>/> 19.30 - 23.30<br/>
			</td>
			<tr>
			<td>Inserire i propri turni - venerdì: </td><td>
						<input type="checkbox" name="turni[]" value="13" <?php toBeChecked($dati["turni"],"13");?>/> 11.30 - 15.30<br/>
						<input type="checkbox" name="turni[]" value="14" <?php toBeChecked($dati["turni"],"14");?>/> 15.30 - 19.30<br/>
						<input type="checkbox" name="turni[]" value="15" <?php toBeChecked($dati["turni"],"15");?>/> 19.30 - 23.30<br/>	 						 
			</td>
			<tr>
			<td>Inserire i propri turni - sabato: </td><td>
						<input type="checkbox" name="turni[]" value="16" <?php toBeChecked($dati["turni"],"16");?>/> 11.30 - 15.30<br/>
						<input type="checkbox" name="turni[]" value="17" <?php toBeChecked($dati["turni"],"17");?>/> 15.30 - 19.30<br/>
						<input type="checkbox" name="turni[]" value="18" <?php toBeChecked($dati["turni"],"18");?>/> 19.30 - 23.30<br/>
			</td>
			<tr>
			<td>Inserire i propri turni - domenica: </td><td>
						<input type="checkbox" name="turni[]" value="19" <?php toBeChecked($dati["turni"],"19");?>/> 11.30 - 15.30<br/>
						<input type="checkbox" name="turni[]" value="20" <?php toBeChecked($dati["turni"],"20");?>/> 15.30 - 19.30<br/>
						<input type="checkbox" name="turni[]" value="21" <?php toBeChecked($dati["turni"],"21");?>/> 19.30 - 23.30<br/>				 						 
					</td>
				</tr>
			<!--Casella per il cap nella tabella-->
			<tr>
				<td>Inserire il cap in cui si è disponibili</td><td>
					<input type = "text" name = "cap" value = "<?php echo $dati["cap"];?>"/>
               	 	<?php visualizzaErrore("cap")?>
				</td>

			</tr>
			
			
				<tr>
					<td>Condizioni di utilizzo </td><td>
				
				         <table border="1">
						 <tr><td>bla bla bla bla bla bla bla bla bla bla bla bla 
						         bla bla bla bla bla bla bla bla bla bla bla bla 
								 bla bla bla bla bla bla bla bla bla bla bla bla </td></tr>
						</table>						 
						<input type="checkbox" name="condizioni" value="ok" 
                        
                        <?php toBeChecked($dati["condizioni"],"ok");?>/>Accetto<br/>
						<?php visualizzaErrore("condizioni");  ?>
					</td>
				</tr>
				<tr>
					<td colspan="2"><input type= "submit" value= "OK"/>
					    <input type = "reset" value = "Cancella"/>
						
					</td>
				</tr>
			</table>
            </center>
				</form>

				
   <?php include "../common/footer.php";?>  				
	  <!-- jQuery e plugin JavaScript  -->
  <script src="http://code.jquery.com/jquery.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/plugins/flexslider/jquery.flexslider.js"></script>
  <script src="../assets/plugins/fancybox/jquery.fancybox.pack.js"></script>
  <script src="../assets/js/scripts.js"></script>				
		
</body>
</html>