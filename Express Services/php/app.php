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


    //informations Formulaire(variables) pour la table employe
    $id=$_POST["id"];
    $pnom=$_POST["prenom"];
    $nom=$_POST["nom"];
    $mail=$_POST["email"];
    $sexe=$_POST["gender"];



    //variable code en utilisant la fonction random(deux employes peuvent avoir le meme code)
    $code=rand(100000,999999);
    //Verifier la connexion a la base 
    try {
        // connexion à la base de données Oracle en utilisant PDO
        $db = new PDO("oci:MYDB=" . $tns, $username, $password);
        $sql = "SELECT * FROM employe WHERE id = '$id'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            // ID ou email existe dans la table
             echo '<script>alert("Error:ID or Email already exists!");</script>';
            sleep(3);
            require_once('../admin/index.html');
        } else {
            // the given id or email doesn't exist in the table, insert new row
            $sql = "INSERT INTO employe(id,nom, prenom, email,sexe,code)VALUES('$id','$nom','$pnom','$mail','$sexe',$code)";
            $stmt = $db->prepare($sql);
            $check=$stmt->execute();
            if($check){
               	echo"<center><h2>The operation was successful</h2></center><br><center><p>Welcome to our new admin
               		<br>Your code is</center><center color='yellow'><h1>$code</h1></center></p>";
            	echo"<br><br><br><br><br><br><br><br><center><h3>Together for a<strong>&nbsp;BETTER TUNISIA</strong></h3></center>";
            }
            else {
                echo "Error,There was a problem!<br> Please try again!";
                sleep(3);
                require_once('../admin/index.html');
            }
        }
        // définir le mode d'erreur pour PDO sur Exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données Oracle: " . $e->getMessage();
    }
?>