<?php
	$dbh = new PDO('mysql:host=localhost;dbname=elaborato', "root", "");
	
	$dir = "/TESINE/";


	if(isset($_POST['nometesina'])){

		$query = $dbh->prepare("DELETE FROM log l , tesina t WHERE l.idtesina = t.idetesina ");
		$query->execute();
		$fetch = $query->fetch();
 
?>