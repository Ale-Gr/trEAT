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
        <h2>FORM PER EFFETTUARE LA REGISTRAZIONE COME CLIENTE</h2>
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
					"5" => "indirizzo non valido (via)",
					"6" => "indirizzo non valido (numero civico)",
					"7" => "indirizzo non valido (città)",
					"8" => "indirizzo non valido (citofono)",
					"9" => "indirizzo non valido (cap)",
					"10" => "Bisogna accettare le condizioni di utilizzo",
					"11" => "Password non valida"			
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
	$dati["password"]="";
	$dati["via"]="";
	$dati["civico"]="";
	$dati["citta"]="";
	$dati["citofono"]="non presente";
	$dati["cap"]="";
	$dati["condizioni"]="ko";
}

?>
<!DOCTYPE html>
<html lang="it">
	
	<body>
        <p class="form">
		<form id = "clientejs" method="GET" action="../backend/checkUtente.php" onsubmit="return validateUtente()">
		  <?php if (isset($_GET["login"]))
                {
                    $login = $_GET["login"];
                    echo "<input type = \"hidden\" name = \"login\" value=\"$login\">";
                }
                
          ?>
          <center>
		  <table class="insert"> 
		  <tr>
					<td>Nome:</td><td><input type = "text" name = "nome" value= "<?php  echo $dati["nome"];?>"/> 
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
					<td>Via: </td>
					<td><input type = "text" name = "via" value="<?php  echo $dati["via"];?>"/>
                    <?php visualizzaErrore("via")  ?>
</td>
				</tr>

				<tr>
					<td>Numero Civico: </td>
					<td><input type = "text" name = "civico" value="<?php  echo $dati["civico"];?>"/>
                    <?php visualizzaErrore("civico")  ?>
</td>
				</tr>
				<tr>
					<td>Città: </td>
					<td><input type = "text" name = "citta" value="<?php  echo $dati["citta"];?>"/>
                    <?php visualizzaErrore("citta")  ?>
</td>
				</tr>
				<tr>
					<td>Citofono: </td>
					<td><input type = "text" name = "citofono" value="<?php  echo $dati["citofono"];?>"/>
                    <?php visualizzaErrore("citofono")  ?>
</td>
				</tr>
				<tr>
					<td>Cap: </td>
					<td><input type = "text" name = "cap" value="<?php  echo $dati["cap"];?>"/>
                    <?php visualizzaErrore("cap")  ?>
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

