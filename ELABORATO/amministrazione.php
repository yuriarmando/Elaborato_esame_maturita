<!DOCTYPE html>
<html lang="It">
<title>THESIS</title>
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
<?php
session_start();
if($_SESSION["admin"]==1){


?>
<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-red w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="home.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="caricatesina.php" class="w3-bar-item w3-button w3-padding-large">Carica Tesina</a>
    <a href="scaricatesina.php" class="w3-bar-item w3-button w3-padding-large">Scarica Tesina</a>
    <a href="amministrazione.php" class="w3-bar-item w3-button w3-padding-large">Amministratore</a>
    <?php
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

<form>
<div class="form__input-group w3-center">
    <h1 class="form__title">ELENCO LOG</h1>
    <style>
table {
border-collapse: collapse;
width: 100%;
color: #100000;
font-family: monospace;
font-size: 25px;
text-align: left;
background: #ed2938;
}
th {
background-color: #ed2938;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}
</style>
<table>
<tr>
<th>Id log</th>
<th>Data log</th>
<th>Id tesina</th>
<th>Desc log </th>
</tr>
<?php
$dbh = new PDO('mysql:host=localhost;dbname=elaborato', "root", "");
$sql=("SELECT * FROM log");
$query = $dbh -> prepare($sql);
$query -> execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) {
// output data of each row
echo "<tr><td>" . $row["idlog"]. "</td><td>" . $row["datalog"] . "</td><td>" . $row["idtesina"]. "</td><td>" . $row["desclog"]. "</td></tr>";

}
?>
</table>
<div class="form__input-group w3-center">
    <h1 class="form__title">ELIMINA/MODIFICA UNA TESINA</h1>
</form>
<?php
$azione = 'SELECT * FROM tesina';
$query = $dbh->prepare($azione);
$query->execute();
$elenco = $query->fetchAll(PDO::FETCH_OBJ); ?>
<div class="w3-center">
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>id tesina</th>
          <th>nometesina</th>
          <th>id materia</th>
          <th>id argomento</th>
          <th>Azione</th>
        </tr>
        <?php foreach($elenco as $singolo): ?>
          <tr>
            <td><?= $singolo->idtesina; ?></td>
            <td><?= $singolo->nometesina; ?></td>
            <td><?= $singolo->idmateria; ?></td>
            <td><?= $singolo->idArgomento; ?></td>
            <td>
              <a href="edit.php?nometesina=<?= $singolo->idtesina ?>" type ="submit" class="btn btn-info" method="post">Modifica</a>
              <a onclick="return confirm('Sei sicuro di voler eliminare questa tesina?')" href="delete.php?nometesina=<?= $singolo->nometesina ?>" class='btn btn-danger' method="post">Elimina</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
        
<?php 
}else{
  echo("non ammi");
}
?>
<!-- FOOTER -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
  <div class="w3-xlarge w3-padding-32">
    <a href="https://www.facebook.com/profile.php?id=100007499658569" target="_blank"><i class="fa fa-facebook-official w3-hover-opacity"></i></a>
    <a href="https://github.com/yuriarmando/Elaborato_esame_maturita" target="_blank"><i class="fa fa-github w3-hover-opacity"></i></a>
    <a href="https://www.instagram.com/yuriarmando_/" target="_blank"><i class="fa fa-instagram w3-hover-opacity"></i></a>
 </div>
        </footer>

        </body>
        </html>
