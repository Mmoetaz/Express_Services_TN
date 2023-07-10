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

    //informations Formulaire
    $nom=$_POST["name"];
    $code=$_POST["code"];
    $identity=$_POST["id"];
    $numpenalite=$_POST["numpenal"];
    $prix=$_POST["prix"];
    try{
        // connexion à la base de données Oracle en utilisant PDO
        $db = new PDO("oci:MYDB=" . $tns, $username, $password);
        // Préparer la requête SQL
        $stmt = $db->prepare("SELECT COUNT(*) AS COUNT FROM penalite WHERE code = :numpenal and citizen_id= :id");

        // Bind des paramètres(utilisation du bindparam pour pour prévenir des attaques par injection SQL)
        $stmt->bindParam(':numpenal', $numpenalite);
        $stmt->bindParam(':id', $identity);
        // Exécuter la requête
        $ex=$stmt->execute();

        // Récupérer le résultat
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si le nom existe
        if ($row['COUNT'] > 0) {
            //si le penalite et identite existe dans la table
            // Preparer la requete
            $penalprix = $db->prepare("SELECT prix FROM penalite WHERE code = :numpenal AND citizen_id = :id");
            // Bind the parameters
            $penalprix->bindParam(':numpenal', $numpenalite);
            $penalprix->bindParam(':id', $identity);
            // Executer la requete
            $penalprix->execute();
            // cherhcer le resultat
            $result = $penalprix->fetch(PDO::FETCH_ASSOC);
            // Subtract the fetched value from the input value
            $prixpay =$result['PRIX']-$prix;
            //faire la mise a jour
            if($prixpay==0){
                /*SUPPRESSION DE LA TABLE PENALITE*/
                $stmt = $db->prepare("DELETE FROM penalite WHERE code = :numpenal and citizen_id= :id");
                // Bind des paramètres(utilisation du bindparam pour pour prévenir des attaques par injection SQL)
                $stmt->bindParam(':numpenal', $numpenalite);
                $stmt->bindParam(':id', $identity);
                // Exécuter la requête
                $ex=$stmt->execute();

                
                /*INSERTION A LA TABLE PAYE POUR LES CITOYENS QUI ONT PAYE LEUR TAXE*/
                $stmt2 = $db->prepare("INSERT INTO PAYE (id_citizen,code_penal) values (:id, :numpenal)");
                // Bind des paramètres(utilisation du bindparam pour pour prévenir des attaques par injection SQL)
                $stmt2->bindParam(':numpenal', $numpenalite);
                $stmt2->bindParam(':id', $identity);
                // Exécuter la requête
                $ex=$stmt2->execute();


                echo"<center><h1>Successful payment!<h1><center>";
            }
            //else statement
            else{
                //MISE A JOUR DE LA TABLE PENALITE SI LE CITOYEN DECIDE A PAYER PAR TRANCHE
                $stmt = $db->prepare("UPDATE  penalite SET prix=$prixpay where code = :numpenal and citizen_id= :id");
                // Bind des paramètres(utilisation du bindparam pour pour prévenir des attaques par injection SQL)
                $stmt->bindParam(':numpenal', $numpenalite);
                $stmt->bindParam(':id', $identity);
                // Exécuter la requête
                $ex=$stmt->execute();
                echo "<center>You are unpaid!, <br>you have ==> $prixpay DT left<center>";
           }
        }else{
            echo "penalité inexistante";
        }
        // définir le mode d'erreur pour PDO sur Exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
     catch (PDOException $e) {
        echo "Erreur de connexion à la base de données Oracle: " . $e->getMessage();
    }
?>
