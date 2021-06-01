<?php
 

    $user = "root";
    $pass = "";
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $argomento = $_POST["argomento"];
        $dbh = new PDO('mysql:host=localhost;dbname=elaborato', $user, $pass);

    
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
                echo  . "<br>";
                echo "<ul>"
                echo "<li><a href='TESINE/". md5($row["nometesina"]) . "'></a></li>"
                echo "</ul>"


            }
        }
    }
?>
</body></html>