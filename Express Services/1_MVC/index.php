<?php
// __DIR__ est une constante "magique" de PHP qui contient le chemin du dossier courant
$ROOT = __DIR__;

// DS contient le slash des chemins de fichiers, c'est-à-dire '/' sur Linux et '\' sur Windows
$DS = DIRECTORY_SEPARATOR;

$controleur_default = "Login" ;

if(!isset($_REQUEST['controller']))
                //$controller récupère $controller_default;
                $controller=$controleur_default;
            else 
                // recupère l'action passée dans l'URL
                $controller = $_REQUEST['controller'];

                
switch ($controller) {
    // {$var} pour concaténer les chaînes de caractères 
            case "Employe":
                require "{$ROOT}{$DS}controller{$DS}EmployeController.php";
                break;
            case "Penal":
                require "{$ROOT}{$DS}controller{$DS}PenalController.php";
                break;
            case "Login" :
                require "{$ROOT}{$DS}controller{$DS}LoginController.php";
                break;  
            case "default" :
                require "{$ROOT}{$DS}controller{$DS}LoginController.php";
                break;
    }

?>
