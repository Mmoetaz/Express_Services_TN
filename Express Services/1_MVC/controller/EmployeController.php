<?php

/**
 * Using employe table 
 */
// Inclure le fichier
require_once $ROOT . $DS . "model/modelEmploye.php";


    try {
        if (empty($_POST["id"]) || empty($_POST["code"])) {
            die("Invalid ID or Code.");
        }

        // Récupérer l'identifiant de l'employe
        $id = $_POST["id"];
        $code = $_POST["code"];

        $employe = new employe();
        $employe = $employe->getById($id, $code);

        if ($employe == false) {
            echo "Employee doesn't exist!";
            echo '<script>alert("Employee does not exist!");</script>';
        } else {
            header("Location: view/viewMain.php");
        }
    } catch (Exception $ex) {
        // Handle the exception
        echo "An error occurred: " . $ex->getMessage();
    }



?>