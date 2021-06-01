
<?php 



    $URL = parse_url("http:/". $_SERVER["REQUEST_URI"] , PHP_URL_QUERY);

    echo $URL;
    $id = explode("=" , $URL)[1];
    
?>

<!DOCTYPE html>
<html lang="It">
<head>
<title>Easy Tesina</title>

</head>
<body>
<div  class="content update">
    
	<h2>Aggiorna Tesina :</h2>
    <form id="theform" action="edit_query.php" method="post">
        <label for="nometesina">Nome tesina</label>
        <input type="text" name="nometesina" placeholder="Nome" value="" id="nometesina">
        <label for="idArgomento">idArgomento</label>
        <input type="number" name="idArgomento" placeholder="Numero argomento" value="" id="idArgomento">
        <label for="idmateria">idMateria</label>
        <input type="number" name="idmateria" placeholder="id materia" value="" id="idmateria">
        <label for="idmateria" style="display:none">idTesina</label>
        <input type="number" name="idtesina"  value='<?= $id ?>'' id="idtesina" style="display:none;">

        <input type="submit" form="theform" value="modifica">
    </form>
    <?php 
    $msg = '';
    if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>
</body>
</html>