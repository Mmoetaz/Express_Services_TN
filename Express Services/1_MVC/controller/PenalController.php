<?php
	/**
	 * Ce fichier représente le contrôleur de la table voiture et penalite
	 */
	// Inclure le fichier model penalty
	require_once $ROOT . $DS . "model/modelPenalite.php";

	// Form verification
	if (empty($_POST["id"]) || empty($_POST["reason"]) || empty($_POST["prix"])) {
	    die("Veuillez remplir tous les champs!");
	} else {
	    //Table penalite
	    $code = rand(1000, 9999);//creating a random code for each new penalty 
	    $id_citizen = $_POST["id"];
	    $raison = $_POST["reason"];
	    $prix = (int)$_POST["prix"];
	}
    try {
        // Instance of penalty table
        $penalite = new ModelPenal();

        // Insertion
        $resultat = $penalite->insert([
            "code" => $code,
            "citizen_id" => $id_citizen,
            "reason" => $raison,
            "prix" => $prix
        ]);

        if ($resultat === false) {
            echo "<center>Operation failed!<br>please try again</center>";
            header("Location: view/viewAdd.php");
        } else {
            echo '<script>alert("Operation has completed successfully!");</script>';
            header("Location: view/viewMain.php");
        }
    } catch (Exception $ex) {
    	echo $ex->getMessage();
	}

	

?>