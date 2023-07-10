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
    //Username et pwd de la base
    $username = "system"; 
    $password = "1*Moetaz"; 

    //informations Formulaire(variables)
    $fname=$_POST["prenom"];
    $name=$_POST["nom"];
    $id=$_POST["id"];
    $mail=$_POST["email"];
    $pwd=$_POST["pwd"];
    $sexe=$_POST["gender"];
    $age=$_POST["age"];

    //Verifier la connexion a la base 
    try {
        // connexion à la base de données Oracle en utilisant PDO
        $db = new PDO("oci:MYDB=" . $tns, $username, $password);
        $sql = "SELECT * FROM citoyen WHERE identity = '$id' OR email = '$mail'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            // the given id or email already exists in the table
             echo '<script>alert("Error:ID or Email already exists!");</script>';
            sleep(5);
            require_once('../html/signup.html');
        } else {
            // the given id or email doesn't exist in the table, insert new row
            $sql = "INSERT INTO citoyen (identity, fname, name, email, pwd, gender, age) VALUES ('$id','$fname','$name','$mail','$pwd','$sexe',$age)";
            $stmt = $db->prepare($sql);
            $check=$stmt->execute();
            if($check){
                sleep(3);
                require_once('../html/signin.html');
            }
            else {
                echo "Error, Please try again!";
                sleep(5);
                require_once('../html/signup.html');
            }
        }
        // définir le mode d'erreur pour PDO sur Exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données Oracle: " . $e->getMessage();
    }
?>