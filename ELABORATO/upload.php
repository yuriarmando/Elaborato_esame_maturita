<!DOCTYPE html>
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
    <a href="mailto:yuri.armando@itiscuneo.eu" class="w3-bar-item w3-button w3-padding-large">Contattami</a>
  </div>
</div>

<div class="scrollable">
<!-- Header -->
<header class="w3-container w3-red w3-center" style="padding:128px 16px" .w3-red, .w3-hover-red:hover {
  color: #ff9800!important;
  background-color: #0d0d0d!important;
}>
  <h1 class="w3-margin w3-jumbo w3-text-green">Tesina caricata correttamente</h1>
  <p class="w3-xlarge w3-text-white">effettua una verifica nella sezione download</p>
  <div class="w3-center">
  <a class="w3-button w3-white w3-padding-large w3-large w3-margin-top" id="Loginbutton" href="caricatesina.php">Nuova Tesina</a>
  <a class="w3-button w3-white w3-padding-large w3-large w3-margin-top" id="Loginbutton" href="scaricatesina.php">Consulta Tesina</a>
  </div>
</script>
<?php
$servername = "localhost";
$user = "root";
$pass = "";
$dbname = "elaborato";
$upload_path = "TESINE/"; 
$file = $_FILES["file"];
$autore = $_SESSION['user'];


$datacomp = $_POST["datacomp"];
$datapubb= date('d-m-y');
$materia =$_POST["materia"];
$argomenti = $_POST["argomento"];

$nometesina = $file["name"];
$target_file = $upload_path.basename($_FILES["file"]["tmp_name"]);


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO tesina (idtesina, nometesina, datacomp, datapubb, idautore, idmateria, idargomento)
        VALUES ('','$nometesina', '$datacomp', '$datapubb', (SELECT IDutente FROM utenti WHERE username = '$autore'), '$materia', '$argomenti' );";
    $sqllog= "INSERT INTO log (datalog, desclog, idtesina)
        VALUES ('$datapubb', 'file caricato', (SELECT idtesina FROM tesina t WHERE idtesina = (SELECT idtesina FROM tesina WHERE nometesina = '$nometesina')))";
    // Check if file already exists
    if (file_exists($target_file)) {
      $msg="IL FILE E' GIA PRESENTE";
       echo $msg;
    }else{


      
      if(move_uploaded_file($_FILES['file']['tmp_name'], $upload_path.$_FILES['file']['name']) ){
          
      }else{
        echo "file vuoto";
      }
    }
    
    // use exec() because no results are returned
    $query1 = $conn->prepare($sql);
    $query2 = $conn->prepare($sqllog);

    $query1->execute();

    $query2->execute();
  
  } catch(PDOException $e) {
    echo  $e->getMessage();
  }
