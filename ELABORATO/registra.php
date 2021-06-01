<?php
$servername = "localhost";
$user = "root";
$pass = "";
$dbname = "elaborato";

$nome = $_POST["nome"];
$cognome = $_POST["cognome"];
$email = $_POST["email"];
$password = ($_POST["psw"]);
$username = $_POST["username"];
$idscuola = $_POST["idscuola"];
$anonimo =(key_exists("anonimo" , $_POST) ? 1:0);
$password= md5($password, FALSE);

//echo $anonimo;


try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO utenti (nome, cognome, email, password, idscuola, anonimo, username)
  VALUES ('$nome', '$cognome', '$email', '$password', $idscuola, $anonimo, '$username')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "ok";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>