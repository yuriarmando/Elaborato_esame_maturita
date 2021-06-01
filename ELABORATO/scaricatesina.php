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
<?php
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

<div class="scrollable">
<!-- Header -->
<header class="w3-container w3-red w3-center" style="padding:128px 16px" .w3-red, .w3-hover-red:hover {
  color: #ff9800!important;
  background-color: #0d0d0d!important;
}>
  <h1 class="w3-margin w3-jumbo">Download tesine</h1>
  <p class="w3-xlarge">Cerca una tesina per argomento o consultale tutte</p>
  <form action="scaricatesina.php" method="GET">
  <select name="argomento">
              <?php 
               $dbh = new PDO('mysql:host=localhost;dbname=elaborato', "root", "");
               $query = $dbh->prepare("SELECT * FROM argomento");
               $query -> execute();
               $argomenti = $query -> fetchAll(PDO::FETCH_ASSOC);
               foreach($argomenti as $argomento){
               echo("<option value='".$argomento["idargomento"]."'>".$argomento["descargomento"]."</option>");
               }
              ?>
    </select>
              <div>
              <input class="w3-center" type="submit" value="Cerca">
              </div>
          </form>
          <?php
 

    $user = "root";
    $pass = "";
    
    if($_SERVER["REQUEST_METHOD"]=="GET" && key_exists("argomento" , $_GET)){
        $argomento = $_GET["argomento"];
        $dbh = new PDO('mysql:host=localhost;dbname=elaborato', $user, $pass);
        $row = [];

    
        $arr_txt = explode(" ", $argomento);
        $sql = "SELECT * FROM tesina WHERE ";
        for ($i=0; $i<count($arr_txt); $i++)
        {
            if ($i > 0)
            {
                $sql .= " AND ";
            }
            $sql .= "(idargomento LIKE '" . $arr_txt[$i] . "%')";
        }
        $sql .= " ORDER BY idtesina ";
        $query = $dbh -> prepare($sql);
        $query -> execute();
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        if (count($res) == 0)
        {
            echo "nessun risultato <br>";
        }
        else
        {
          foreach($res as $row){
            
            echo "<br>";
            echo '<li><a href="download.php?nometesina='. $row['nometesina'].'" target="_blank">'.$row['nometesina'].' </a></li>';
            echo "<br>";
            }
        }
      }
?>

              
               
</script>

</form>
</header>
<form>
<div class="form__input-group w3-center">
    <h1 class="form__title">Tutte le tesine</h1>
</form>

<table style="border:1px solid black;margin-left:auto;margin-right:auto;">
			<thead class="alert-info">
				<tr>
					<th style="padding-left: 10px; padding-right: 10px;">Tesina</th>
          <th style="padding-left: 10px; padding-right: 10px;">Autore  </th>
          <th style="padding-left: 10px; padding-right: 10px;">Data composizione</th>
          <th style="padding-left: 10px; padding-right: 10px;">Scuola frequentata</th>
					<th style="padding-left: 10px; padding-right: 10px;">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					
					$query = $dbh->prepare("SELECT * FROM `tesina` ORDER BY datapubb");
					$query->execute();
          $sqlutente = $dbh ->prepare("SELECT * FROM  utenti u,  tesina t, scuole s WHERE u.IDutente = t.idautore AND s.idscuola = u.idscuola") ;
          $sqlutente->execute();
          $resutente = $sqlutente -> fetch(PDO::FETCH_ASSOC);
  
					while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
				?>
				<tr>
					<td><?php echo $fetch['nometesina']?></td>
          <td><?php echo $resutente["anonimo"]==1?"anonimo":$resutente['username']?></td>
          <td><?php echo $fetch['datacomp']?></td>
          <td><?php echo $resutente['nomescuola']?></td>
					<td><a href="<?php echo "download.php?nometesina=".$fetch['nometesina'] ?>" class="btn btn-primary">Download</a></td>
				</tr>
				<?php

					}
				?>
			</tbody>
		</table>
    <div class="form__input-group w3-center">
    <h1 class="form__title">Esegui query</h1>
    <p class="w3-xsmall w3-text-black"><b>Per ogni scuola, il numero di tesine presenti per ogni materia</b></P>
    <?php
    $query1 = $dbh->prepare("SELECT s.nomescuola, m.nomemateria, COUNT(*) AS tesinetrattate 
      FROM materie m, tesina t, scuole s
      WHERE m.idmateria = t.idmateria 
      GROUP BY s.idscuola, m.nomemateria");
     $query1 -> execute();
     $res = $query1->fetchAll(PDO::FETCH_ASSOC);
     echo "<table class= table-border style='margin-right:auto; margin-left: auto'>";

         echo "<tr>";
         echo "<th>nome scuola</th>";
         echo "<th>nome materia</th>";
         echo "<th>tesine trattate</th>";
         echo "</tr>";
     foreach($res as $row){
       echo "<tr>";
       echo "<td>". $row["nomescuola"] ."</td>";
       echo "<td>". $row["nomemateria"] ."</td>";
       echo "<td>". $row["tesinetrattate"] ."</td>";
       echo "</tr>";
     }

     echo "</table>";
    ?>
    <p class="w3-xsmall w3-text-black"><b>La materia che è trattata di più in assoluto:</b>
     <?php
     /*
     $query2 = $dbh->prepare("SELECT nomemateria 
        FROM materie m, tesina t
        GROUP BY m.idmateria 
        HAVING COUNT(*)= (SELECT MAX(tesinetrattate) AS tesinet
                          FROM (SELECT COUNT(*) AS tesinetrattate
                                FROM tesine t, materie m 
                             WHERE m.idmateria == t.idmateria)
                       )");
      
      $query2->execute();

      $res2 = $query2->fetch(PDO::FETCH_ASSOC);
      echo $res2["nomemateria"];
*/
      echo "<br>SELECT nomemateria 
      FROM materie m, tesina t
      GROUP BY m.idmateria 
      HAVING COUNT(*)= (SELECT MAX(tesinetrattate) AS tesinet
                        FROM (SELECT COUNT(*) AS tesinetrattate
                              FROM tesine t, materie m 
                           WHERE m.idmateria == t.idmateria)
                     )";
      
     ?>
     </p>
    <p class="w3-xsmall w3-text-black"><b>le tesine presentati da studenti della stessa scuola dell'utente "admin"</B></p>
    <?php 
    $query3 = $dbh->prepare("SELECT t.nometesina FROM tesina t, utenti u WHERE t.idautore = u.IDutente AND u.idscuola = (SELECT DISTINCT idscuola FROM utenti WHERE username= 'admin')");
    $query3 -> execute();
    $res3 =  $query3->fetchAll(PDO::FETCH_ASSOC);
    echo "<table style='margin-right:auto; margin-left: auto'>";
     foreach($res3 as $row){
       echo "<tr>";
       echo "<td>". $row["nometesina"] ."</td>";
       
       echo "</tr>";
     }
     echo "</table>";
    ?>
    </div>

    
   
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
  <div class="w3-xlarge w3-padding-32">
    <a href="https://www.facebook.com/profile.php?id=100007499658569" target="_blank"><i class="fa fa-facebook-official w3-hover-opacity"></i></a>
    <a href="https://github.com/yuriarmando/Elaborato_esame_maturita" target="_blank"><i class="fa fa-github w3-hover-opacity"></i></a>
    <a href="https://www.instagram.com/yuriarmando_/" target="_blank"><i class="fa fa-instagram w3-hover-opacity"></i></a>
 </div>
</footer>
        </body>
        </html>
