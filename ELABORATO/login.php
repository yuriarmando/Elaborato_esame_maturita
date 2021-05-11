<?php

session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = $_POST["user"];
    $psw = $_POST["psw"];
    $_SESSION["pass"] = $psw;

    $con=new mysqli("localhost","root","","elaborato");
    if($con->connect_errno)
        die("Errore connessione database " . $con->connect_errno . " " . $con->connect_error);
        
    $sql="SELECT * FROM utenti WHERE password = '$psw' and nomeutente = '$username'";
    $rs=$con->query($sql);

    if($rs->num_rows == 1){
        header("location:home.php");
    }else{
        echo("Error");
    }
}
?>
