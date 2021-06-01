<?php
	$dbh = new PDO('mysql:host=localhost;dbname=elaborato', "root", "");
	
	$dir = "/TESINE/";


	if(isset($_GET['nometesina'])){


		$file = $_REQUEST['nometesina'];
		$query = $dbh->prepare("SELECT * FROM `tesina` WHERE `nometesina`='$file'");
		$query->execute();
		$fetch = $query->fetch();
		
 
		header("Content-Disposition: attachment; filename=".$fetch['nometesina']);
		header("Content-Type: application/octet-stream;");
		readfile("TESINE/".$fetch['nometesina']);
	}

?>