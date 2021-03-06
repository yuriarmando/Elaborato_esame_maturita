
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
?>
<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-red w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="home.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <?php
      
      if($_SESSION && key_exists("user" , $_SESSION)){
        echo '<a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" onclick="logout()">Logout</a>';
      }
  
    ?>
    <a href="mailto:yuri.armando@itiscuneo.eu" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Contattami</a>
</div>
  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="mailto:yuri.armando@itiscuneo.eu" class="w3-bar-item w3-button w3-padding-large">Contattami</a>
  </div>
</div>

<div class="scrollable">
<!-- Header -->
<header class="w3-container w3-red w3-center" style="padding:128px 16px" .w3-red, .w3-hover-red:hover {
  color: #ff9800!important;
  background-color: #0d0d0d!important;
}>
  <h1 class="w3-margin w3-jumbo">THESIS</h1>
  <p class="w3-xlarge">Elaborato esame di Stato - Yuri Armando</p>
  <?php 
  
  if(!($_SESSION && key_exists("user" , $_SESSION))){
    echo '<button class="w3-button w3-white w3-padding-large w3-large w3-margin-top" id="Loginbutton">LOGIN</button>';
  }
    ?>
  

<script type="text/javascript">
    document.getElementById("Loginbutton").onclick = function () {
        location.href = "logins.php";
    };
    
</script>
</header>

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
  <div class="w3-xlarge w3-padding-32">
    <a href="https://www.facebook.com/profile.php?id=100007499658569" target="_blank"><i class="fa fa-facebook-official w3-hover-opacity"></i></a>
    <a href="https://github.com/yuriarmando/Elaborato_esame_maturita" target="_blank"><i class="fa fa-github w3-hover-opacity"></i></a>
    <a href="https://www.instagram.com/yuriarmando_/" target="_blank"><i class="fa fa-instagram w3-hover-opacity"></i></a>
 </div>
</footer>

<script>
// NON MODIFICARE. SCRIPT W3SCHOOLS PER SCHERMI PICCOLI
function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
function gotoLogin(){
    $.ajax({
      type: "GET",
      url: "login.php"
    }).done(function( data) {
      alert( "CONNESO AL LOGIN" );
    });
}
</script>
<script>
  const logout = async()=> {
    const Res = await fetch('login.php');
    const res = await Res.text();
    console.log(res);
    location.reload();
    session.destroy();
  }

</script>
</body>
</html>