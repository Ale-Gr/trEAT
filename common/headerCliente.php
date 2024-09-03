
  


  
    <!-- Lavoriamo per sezioni e definiamo classi che possiamo riutilizzare-->
    <header>
      <nav class="navbar navbar-default">
      <div class="container">
       <div class="navbar-header">
        <a class="navbar-brand" img src="../images/logo.png" href="../backend/gotoHome.php"></a>
       </div> 
       <div class="collapse navbar-collapse navbar-responsive-collapse">
         <ul class="nav navbar-nav">
         <li><a href="cliente.php">Cerca ristoranti</a></li>
         <li><a href="profiloCliente.php">Profilo</a></li>
         <li><a href="ordiniCliente.php">Ordini</a></li>
         <li><a href="carrello.php">Carrello</a></li>
         <!-- Se sono loggato mostro solo la primitiva di logout-->    
         
          <li><a class = "logout" href="../backend/logout-exe.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
         
         </ul>
       </div><!-- /.nav-collapse -->
      </div>
      </nav><!-- /.navbar -->
      </header><!-- /header -->