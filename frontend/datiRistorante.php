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
        <h2>FORM PER EFFETTUARE LA REGISTRAZIONE COME RISTORANTE</h2>
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
                    "2" => "ragione sociale non valida",
					"3" => "iva non valida",		
					"4" => "email non valida",		
					"5" => "indirizzo non valido (via)",
					"6" => "indirizzo non valido (numero civico)",
					"7" => "indirizzo non valido (città)",
					"8" => "indirizzo non valido (citofono)",
					"9" => "indirizzo non valido (cap)",			
					"10" => "Bisogna accettare le condizioni di utilizzo",
					"11" => "Bisogna inserire almeno un turno",
					"12" => "Password non valida");
$errore = array();
$dati = array();

if (isset($_GET["status"]))
{
	if ($_GET["status"]=='ko') $errore=unserialize($_GET["errore"]);
	$dati=unserialize($_GET["dati"]);
}
else
{
	$dati["nome"]="";
	$dati["ragione"]="";
	$dati["iva"]="";
	$dati["email"]="";
	$dati["password"]="";
	$dati["via"]="";
	$dati["civico"]="";
	$dati["citta"]="";
	$dati["citofono"]="non presente";
	$dati["cap"]="";
	$dati["via_sede"]="";
	$dati["civico_sede"]="";
	$dati["citta_sede"]="";
	$dati["citofono_sede"]="non presente";
	$dati["cap_sede"]="";
	$dati["turni"]= array();
	$dati["condizioni"]="ko";
}

?>
<!DOCTYPE html>
<html lang="it">
	
	<body>

		<p class="form">
		<form id= "registrazioneR" method="GET" action="../backend/checkRistorante.php" onsubmit="return validateRistorante()">
		<?php 
		if (isset($_GET["login"]))
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
					<td>Ragione sociale: </td>
					<td><input type = "text" name = "ragione" value="<?php  echo $dati["ragione"];?>"/>
					<?php visualizzaErrore("ragione") ?>
</td>
				</tr>

				<tr>
					<td>Partita iva: </td><td><input type = "text" name = "iva" value="<?php  echo $dati["iva"];?>"/> 
					<?php visualizzaErrore("iva"); ?>
</td>
				</tr>		
				<tr>
					<td>Email: </td><td><input type = "text" name = "email" value = "<?php echo $dati["email"];?>"/>
					<?php visualizzaErrore("email"); ?>
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
					<td>Via: </td><td><input type = "text" name = "via" value="<?php  echo $dati["via"];?>"/> 
					<?php visualizzaErrore("via"); ?>
</td>
				</tr>
				<tr>
					<td>Numero civico: </td><td><input type = "text" name = "civico" value="<?php  echo $dati["civico"];?>"/> 
					<?php visualizzaErrore("civico"); ?>
</td>
				</tr>	
				<tr>
					<td>Città: </td><td><input type = "text" name = "citta" value="<?php  echo $dati["citta"];?>"/> 
					<?php visualizzaErrore("citta"); ?>
</td>
				</tr>	
				<tr>
					<td>Citofono: </td><td><input type = "text" name = "citofono" value="<?php  echo $dati["citofono"];?>"/> 
					<?php visualizzaErrore("citofono"); ?>
</td>
				</tr>
				<tr>
					<td>Cap: </td><td><input type = "text" name = "cap" value="<?php  echo $dati["cap"];?>"/> 
					<?php visualizzaErrore("cap"); ?>
</td>
				</tr>					
				<tr>
					<td>Via (sede legale): </td><td><input type = "text" name = "via_sede" value="<?php  echo $dati["via_sede"];?>"/> 
					<?php visualizzaErrore("via_sede"); ?>
</td>
				</tr>
				<tr>
					<td>Numero civico (sede legale): </td><td><input type = "text" name = "civico_sede" value="<?php  echo $dati["civico_sede"];?>"/> 
					<?php visualizzaErrore("civico_sede"); ?>
</td>
				</tr>	
				<tr>
					<td>Città (sede legale): </td><td><input type = "text" name = "citta_sede" value="<?php  echo $dati["citta_sede"];?>"/> 
					<?php visualizzaErrore("citta_sede"); ?>
</td>
				</tr>	
				<tr>
					<td>Citofono (sede legale): </td><td><input type = "text" name = "citofono_sede" value="<?php  echo $dati["citofono_sede"];?>"/> 
					<?php visualizzaErrore("citofono_sede"); ?>
</td>
				</tr>				
				<tr>
					<td>Cap (sede legale): </td><td><input type = "text" name = "cap_sede" value="<?php  echo $dati["cap_sede"];?>"/> 
					<?php visualizzaErrore("cap_sede"); ?>
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
	
					
				
				<tr>
					<td>Condizioni di utilizzo </td><td>
				
				         <table border="1">
						 <tr><td>bla bla bla bla bla bla bla bla bla bla bla bla 
						         bla bla bla bla bla bla bla bla bla bla bla bla 
								 bla bla bla bla bla bla bla bla bla bla bla bla </td></tr>
						</table>						 
						<input type="checkbox" name="condizioni" value="ok"

						<?php toBeChecked($dati["condizioni"],"ok");?>/>Accetto<br/>
						<?php visualizzaErrore("condizioni"); ?>
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
</html>