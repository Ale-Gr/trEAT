<?php
session_start();
if ($_SESSION["logged"]==true){
  $email = $_SESSION["utente"];
}


?>

<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>trEAT</title>
      <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900,400italic' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
      <link rel="stylesheet" href="../assets/css/ordini.css">
      <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-glyphicons.css">
      <link rel="stylesheet" href="../assets/plugins/fancybox/jquery.fancybox.css">
      <link rel="stylesheet" href="../assets/plugins/flexslider/flexslider.css">
      <link rel="stylesheet" href="../assets/css/stili-custom.css">
      <script src="../assets/js/modernizr.custom.js"></script>
      <script src="../assets/js/controllo.js"></script>
      

    </head>