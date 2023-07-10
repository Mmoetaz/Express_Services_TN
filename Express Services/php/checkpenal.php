<?php
    // informations de connexion à la base de données Oracle
    // Transparent Network Substrate 
    $tns = "
    (DESCRIPTION =
        (ADDRESS_LIST =
            (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
        )
        (CONNECT_DATA =
            (SID = ORCL)
        )
    )"; 
    //username et pwd de la base en oracle
    $username = "system"; 
    $password = "1*Moetaz"; 
    //form data
    $code=$_POST["code"];
    $id=$_POST["id"];

    try {
        // connexion à la base de données Oracle en utilisant PDO
        $db = new PDO("oci:MYDB=" . $tns, $username, $password);

        // Préparer la requête SQL
        $stmt = $db->prepare("SELECT COUNT(*) AS NAME_COUNT FROM penalite WHERE code = :code and citizen_id= :id");

        // Bind des paramètres(utilisation du bindparam pour pour prévenir des attaques par injection SQL)
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':id', $id);
        // Exécuter la requête
        $ex=$stmt->execute();

        // Récupérer le résultat
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si le nom existe
        if ($row['NAME_COUNT'] < 1) { 
            echo '<center>
                    <h2>
                        <em>
                            <span style="color: lightsalmon;border:2px solid darksalmon;padding:2px;">
                                You are clean, you have no penalties!
                            </span>
                        </em>
                    </h2>
                </center>';
        } else {
            // Execute the SELECT query to get the penalty information
            $stmt = $db->prepare("SELECT * FROM penalite WHERE code = :code and citizen_id= :id");
            $stmt->bindParam(':code', $code);
            $stmt->bindParam(':id', $id);
            $ex=$stmt->execute();
            $penalties = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Display the penalty information in a table
            echo "<table>
                    <tr>
                        <th><h2>Penalty code</h2></th>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <th><h2>Price</h2></th>
                    </tr>";
            foreach ($penalties as $penalty) {
                echo"<tr>
                        <td><h2>".$penalty['CODE']." </h2></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td><h2>".$penalty['PRIX']."</h2></td>
                    </tr>";
            }
            echo "</table>";
        
        // définir le mode d'erreur pour PDO sur Exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    }catch (PDOException $e) {
        echo "Erreur de connexion à la base de données Oracle: " . $e->getMessage();
}

?>