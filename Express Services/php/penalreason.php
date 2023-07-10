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
    $id=$_POST["id"];
    try {
    // Connection a la base
    $db = new PDO("oci:MYDB=" . $tns, $username, $password);

    // Check if the id exists in the database
    $stmt = $db->prepare("SELECT count(*) as COUNTP from penalite where citizen_id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['COUNTP'] == 0) {
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
    $stmt = $db->prepare("SELECT * from penalite where citizen_id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $penalties = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>
                    <tr>
                        <th><h2>Penalty code</h2></th>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <th><h2>Penalty Reason</h2></th>
                    </tr>";
            foreach ($penalties as $penalty) {
                echo"<tr>
                        <td><h2>".$penalty['CODE']." </h2></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td><h2>".$penalty['REASON']."</h2></td>
                    </tr>";
            }
            echo "</table>";
    // définir le mode d'erreur pour PDO sur Exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
    } catch (PDOException $e) {
    echo "Erreur de connexion à la base de données Oracle: " . $e->getMessage();
    }

?>
