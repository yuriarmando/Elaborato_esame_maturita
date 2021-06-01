<?php

$user = "root";
$pass = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = $_POST["user"];
    $psw = md5($_POST["psw"]);
    $dbh = new PDO('mysql:host=localhost;dbname=elaborato', $user, $pass);
    //$con=new mysqli("localhost","root","","elaborato");

/*
    if($con->connect_errno)
        die("Errore connessione database " . $con->connect_errno . " " . $con->connect_error);
        */

    $query = $dbh->prepare("SELECT * FROM utenti WHERE password = '$psw' and username = '$username'");
    //$sql="SELECT * FROM utenti WHERE password = '$psw' and username = '$username'";

   // $rs=$con->query($sql);
    $query->execute();
    $res = $query->fetch(PDO::FETCH_ASSOC);
    
    
    if($res){
        session_start();
        $_SESSION["pass"] = $res["password"];
        $_SESSION["user"] = $res["username"];
        $_SESSION["admin"] = intval($res["amministratore"]);
        
        echo "ok";
        //header("location: home.php");
    }else{
        header("location: logins.php?message=CREDENZIALI+ERRATE");
    }
}else{
    session_start();
    session_destroy();
    echo "ok";
}
?>
