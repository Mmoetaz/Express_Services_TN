<?php
    // informations de connexion à la base de données Oracle
    $tns = "
    (DESCRIPTION =
        (ADDRESS_LIST =
            (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
        )
        (CONNECT_DATA =
            (SID = ORCL)
        )
    )"; 
    $username = "system"; 
    $password = "1*Moetaz"; 

    //informations Formulaire
    $mail=$_POST["email"];
    $pwd=$_POST["pwd"];
    //verifier la connexion a la base
    try {
        // connexion à la base de données Oracle en utilisant PDO
        $db = new PDO("oci:MYDB=" . $tns, $username, $password);

        // Préparer la requête SQL
        $stmt = $db->prepare("SELECT COUNT(*) AS NAME_COUNT FROM Citoyen WHERE Email = :email and Pwd= :pwd");

        // Bind des paramètres(utilisation du bindparam pour pour prévenir des attaques par injection SQL)
        $stmt->bindParam(':email', $mail);
        $stmt->bindParam(':pwd', $pwd);
        // Exécuter la requête
        $ex=$stmt->execute();

        // Récupérer le résultat
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si le nom existe
        if ($row['NAME_COUNT'] > 0) {
            sleep(2);
            require_once('../html/main.html');
        } else {
            // Afficher la page d'erreur
            echo "<html><body><center><p style='color:red;font-family:initial;'>Wrong password!<br> Please create an account.<br>If you are sure you have an account go to the sign in page and try again.</p></center></body></html>";
            echo "<html><body><center><a href='../html/signin.html' style='color:white;'>sign in</a><center></body></html>";
            // Redirection vers la page d'inscription
            sleep(2);
            include("../html/signup.html");
        }

    }
    catch (PDOException $e) {
        echo "Erreur de connexion à la base de données Oracle: " . $e->getMessage();
    }

?>
