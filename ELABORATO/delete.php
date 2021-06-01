<?php
$pdo = new PDO('mysql:host=localhost;dbname=elaborato', "root", "");
$nometesina = $_GET['nometesina'];


$query = $pdo->prepare("SELECT idtesina FROM tesina WHERE nometesina = ?");
$query->execute([$nometesina]);
$id = intval($query->fetch(PDO::FETCH_ASSOC)["idtesina"]);
echo $id;



$query = $pdo->prepare("DELETE FROM  log  WHERE idtesina = ?");
$query->execute([$id]);

$sql = 'DELETE FROM tesina WHERE idtesina = ?';
$statement = $pdo->prepare($sql);
$statement->execute([$id]);
header("Location: ELABORATO/amministrazione.php"); 
  
//ELIMINO DA DIRECTORY
$file_pointer = "./TESINE/". $nometesina; 
   
//UNLINK PER ELIMINARE
if (!unlink($file_pointer)) { 
    echo ("$file_pointer Il file non può essere eliminato"); 
} 
else { 
    echo ("$file_pointer File eliminato"); 
} 


		
 