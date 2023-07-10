<?php
//without using "model.php" file
class Employe {
    //DataBase informations
    public static $TNS = "
                          (DESCRIPTION =
                            (ADDRESS_LIST =
                              (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
                            )
                            (CONNECT_DATA =
                              (SID = ORCL)
                            )
                          )"; 
    public static $USERNAME = "system"; 
    public static $PASSWORD = "1*Moetaz";
    protected static $db=NULL ;
    //les champs de la table employe
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $sexe;
    //attributes of employe class
    protected $table = "employe";
    protected $clePrimaire = "id";
    protected $code = "code";

    /**
     * Connect to the database
     *
     * @return PDO Instance of the PDO class
     */
    public static function connect(){
        if(self::$db == null){
            try{
                self::$db = new PDO("oci:MYDB=".self::$TNS, self::$USERNAME, self::$PASSWORD);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $exception){
                die($exception->getMessage());
            }
        }
        return self::$db;
    }
    public function getById($id,$code){
        // Connect to the database
        $db = self::connect();
        // Create a string containing the SQL query to execute
        $sql = "SELECT COUNT(*) AS NAME_COUNT from {$this->table} where {$this->clePrimaire} = $id and {$this->code} = $code";
        try{
            $resultat = $db->prepare($sql);
            $resultat->execute();// Execute the SQL query
            $row = $resultat->fetch(PDO::FETCH_ASSOC);
            if($row['NAME_COUNT'] > 0) {
                return true;
            }
            else{
                return false;
            }
        }
        catch(PDOException $ex){
            //die($ex->getMessage());

        }
        finally{
            // Free resources
            $resultat->closeCursor();
        }
    }

           
}

?>