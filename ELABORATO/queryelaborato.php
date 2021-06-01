DOCTYPE html>
<html lang="It">
<title>Easy Tesina</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalcss.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-red w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="home.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="caricatesina.php" class="w3-bar-item w3-button w3-padding-large">Carica Tesina</a>
    <a href="scaricatesina.php" class="w3-bar-item w3-button w3-padding-large">Scarica Tesina</a>
    <a href="amministrazione.php" class="w3-bar-item w3-button w3-padding-large">Amministratore</a>
    <?php
      session_start();
      if($_SESSION && key_exists("user" , $_SESSION)){
        echo '<a href="home.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" onclick="logout()">Logout</a>';
      }
  
    ?>
    <a href="mailto:yuri.armando@itiscuneo.eu" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Contattami</a>
</div>
  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="caricatesina.php" class="w3-bar-item w3-button w3-padding-large">Carica Tesina</a>
    <a href="scaricatesina.php" class="w3-bar-item w3-button w3-padding-large">Scarica Tesina</a>
    <a href="amministrazione.php" class="w3-bar-item w3-button w3-padding-large">Amministratore</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Contattami</a>
  </div>
</div>
<?php

$dbh = new PDO('mysql:host=localhost;dbname=elaborato', "root", "");
               $query3 = $dbh->prepare("SELECT t.nometesina FROM tesina t, utenti u WHERE t.idautore = u.IDutente AND u.idscuola = (SELECT DISTINCT idscuola FROM utenti WHERE username= 'admin')");
               $query -> execute();
               $query1 = $dbh->prepare("SELECT s.nomescuola, m.nomemateria, COUNT(*) AS tesinetrattate 
               FROM materie m, tesina t, scuole s
               WHERE m.idmateria = t.idmateria 
               GROUP BY s.idscuola, m.nomemateria");
                $query -> execute();
                $query3 = $dbh->prepare("SELECT s.nomescuola, m.nomemateria, COUNT(*) AS tesinetrattate")
