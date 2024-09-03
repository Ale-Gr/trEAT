<?php
session_start();
$_SESSION["logged"] = false;
include "common/setup.php";
include "common/funzioni.php";
?>


<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en" ><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" ><!--<![endif]-->
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HOME DELIVERY</title>
<!-- Fogli di stile -->
<link href='http://fonts.googleapis.com/css?family=Lato:400,700,900,400italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="assets/plugins/fancybox/jquery.fancybox.css">
<link rel="stylesheet" href="assets/plugins/flexslider/flexslider.css">
<link rel="stylesheet" href="assets/css/stili-custom.css">
<!-- Modernizr -->
<script src="assets/js/controllo.js"></script>
<script src="assets/js/modernizr.custom.js"></script>
<!-- respond.js per IE8 -->
<!--[if lt IE 9]>
<script src="assets/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
<!-- Header e barra di navigazione -->
<header>
<nav class="navbar navbar-default">
<div class="container">
 <div class="navbar-header">
  <a class="navbar-brand" href="#"></a>
 </div> 
 <div class="collapse navbar-collapse navbar-responsive-collapse">
   <ul class="nav navbar-nav">
    <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">LOGIN/REGISTRAZIONE <span class="caret"></span></a>
     <ul class="dropdown-menu">
      <li><a href="#" data-toggle="modal" data-target="#login-modal"> Login</a></li>
      <li><a href="frontend/datiUtente.php">Registrati come cliente</a></li>
      <li><a href="frontend/datiFattorino.php">Registrati come fattorino</a></li>
      <li><a href="frontend/datiRistorante.php">Registrati come ristorante</a></li>
     </ul>
   </ul>
 </div><!-- /.nav-collapse -->

	 
</div>
</nav><!-- /.navbar -->
</header><!-- /header -->

<?php
	  if (isset($_GET["status"]))
      {
		  if ($_GET["status"]=='ok')
			  echo "<div class=\"alert alert-success\"><strong>" . urldecode($_GET["msg"]) . "</strong></div>";
				  else 
			  echo "<div class=\"alert alert-danger\"><strong>Errore! </strong>" . urldecode($_GET["msg"]) . "</div>";
	  }  
	?>

<!--Importo lo script js-->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog"  aria-hidden="true" style="display: none;">
    	  <div class="modal-dialog">
				<div class="loginmodal-container">
					<h1>Accedi al tuo account</h1><br>
				  <form id = "log" method="POST" action="backend/check.php"  onsubmit="return validateForm()">
					<input type="text" name="user" placeholder="Inserisci Email"  value="">
					<input type="password" name="pass" placeholder="Inserisci Password" >
          <form action="">
          Tipologia di utente:<br/>
          cliente <input type="radio"  name="type" value="cliente"/>
          fattorino <input type="radio"   name="type" value="fattorino"/>
          ristorante <input type="radio"  name="type"  value="ristorante" /><br/>
					<input type="submit" name="login" class="login loginmodal-submit" value="Login" onclick="checkRadio()"> <!--Ho modificato value che era Login-->


				  <div class="login-help">
					<a href="frontend/datiUtente.php">Registrazione come cliente</a><br/>
          <a href="frontend/datiFattorino.php">Registrazione come fattorino</a><br/> 
          <a href="frontend/datiRistorante.php">Registrazione come ristorante</a><br/>
				  </div>
				</div>
			</div>
	</div>



<!-- Sezione slider con Flexslider -->
<div class="row">
  <div class="col-sm-12">
   <div id="main-slider" class="flexslider">
    <ul class="slides">
     <li>
     <img src="https://www.ristoilpozzo.it/wp-content/uploads/2020/05/DSC_8911-2000x1335.jpg">
     <div class="flex-caption">
     <p class="flex-caption-text">
     <span>Migliaia </span><br>
     <span>di</span><br>
     <span>ristoranti</span>
     </p>
     </div>
     </li>
     <li>
     <img src="https://media.gettyimages.com/id/1333145485/it/foto/man-indoors-by-front-door-in-block-of-flats-food-delivery-and-coronavirus-concept.jpg?s=1024x1024&w=gi&k=20&c=7FazZyMCTjWOsD4mGXuUaXmawKrjhStp2b2_XTRNKZc=">
     <div class="flex-caption">
     <p class="flex-caption-text">
     <span>Consegne </span><br>
     <span>veloci</span><br>
     <span>a casa tua</span>
     </p>
     </div>
     </li>
     <li>
     <img src="https://thumbs.dreamstime.com/b/assorted-american-food-top-view-109748438.jpg">
     <div class="flex-caption">
     <p class="flex-caption-text">
     <span>Scopri</span><br>
     <span>i nostri</span><br>
     <span>menu</span>
     </p>
     </div>
     </li>
    </ul>
   </div><!-- /.flexslider -->
  </div><!-- /.col-sm-12 -->
  </div><!-- /.row -->

  <?php $res = queryPietanzeHomePage($cid);?>
  <section id="ultimi-lavori">
    <header class="header-sezione">
     <h2>Alcuni dei nostri ristoranti</h2>     
    </header>
    <div class="row">
    <?php while($row= mysqli_fetch_assoc($res)){ ?>
      <div class="col-sm-4">
      <ul class="list-group servizi">
      <li class="list-group-item servizi-portfolio-titolo"><h4><?php echo $row['nome'];?></h4></li>
      <li class="list-group-item servizi-portfolio-opzione"><?php echo $row['via'];?> <?php echo $row['numero_civico'];?></li>
      <li class="list-group-item servizi-portfolio-opzione"><?php echo $row['nome_citta'];?></li>            
    </ul>
   </div>
      <?php } ?>
      <div class="col-sm-4">
      <ul class="list-group servizi">
      <li class="list-group-item servizi-portfolio-titolo"><h4><a href="#" data-toggle="modal" data-target="#login-modal"> Accedi per vedere altro</a></li></h4> 
        </div>
      </div> 
    </div>
  </section><!-- /section ultimi lavori -->

  <?php include "common/footer.php";?>  

    
  <!-- jQuery e plugin JavaScript  -->
  <script src="http://code.jquery.com/jquery.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/plugins/flexslider/jquery.flexslider.js"></script>
  <script src="assets/plugins/fancybox/jquery.fancybox.pack.js"></script>
  <script src="assets/js/scripts.js"></script>
  </body>
</html>
