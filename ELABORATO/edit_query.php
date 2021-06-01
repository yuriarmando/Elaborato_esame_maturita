<?php

$pdo = new PDO('mysql:host=localhost;dbname=elaborato', "root", "");
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_POST['nometesina'])) {
    if (!empty($_POST)) {
        print_r($_POST);
        $datapubb= date('d-m-y');
        $nometesina = isset($_POST['nometesina']) ? $_POST['nometesina'] : NULL;
        $sqllog= $pdo->prepare("INSERT INTO log (datalog, desclog, idtesina)
        VALUES ('$datapubb', 'file modificato', (SELECT idtesina FROM tesina t WHERE idtesina = (SELECT idtesina FROM tesina WHERE nometesina = '$nometesina')))");
        // This part is similar to the create.php, but instead we update a record and not insert
        $sqllog -> execute();
        $idmateria = isset($_POST['idmateria']) ? $_POST['idmateria'] : NULL;
        $idArgomento = isset($_POST['idArgomento']) ? $_POST['idArgomento'] : NULL;
        $idtesina = isset($_POST['idtesina']) ? $_POST['idtesina'] : NULL;
            if($nometesina && $idmateria && $idArgomento && $idtesina){
                // Update the record
                $stmt = $pdo->prepare('UPDATE tesina SET nometesina = ?, idmateria = ?, idArgomento = ? WHERE idtesina = ?');
                $stmt->execute([$nometesina, $idmateria, $idArgomento, $idtesina]);
                $msg = 'Tesina aggiornata!';
                header("Location: amministrazione.php"); 
                };
            }else{
                $msg2 = "Servono tutti e 4 i parametri";
                function EchoMessage($msg, $redirect){
                    echo '<script type="text/javascript">
                    alert("' . $msg2 . '")
                    window.location.href = "'.$redirect.'"
                    </script>';
            };


    }

}
?>
