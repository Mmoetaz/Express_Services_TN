<?php

//Making CRUD file
require_once $ROOT . $DS . "config/config.php";

class Model extends Database{
    protected $table; // table name
    protected $clePrimaire; // Primary key 
    protected static $db=NULL ;

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

    /**
     * List all records of a table
     *
     * @return array List of found records
     */
    public function getAll(){
        // Connect to the database
        $db = self::connect();
        // Create a string containing the SQL query to execute
        $sql = "SELECT * FROM " . $this->table;
        $liste = [];
        try{
            $resultat = $db->query($sql); // Execute the SQL query
            $liste = $resultat->fetchAll(PDO::FETCH_CLASS, get_class($this));
        }
        catch(PDOException $ex){
            die($ex->getMessage());
        }
        finally{
            // Free resources
            $resultat->closeCursor();
        }
        return $liste;
    }

    /**
     * Retrieve a record by its unique identifier (primary key)
     *
     * @param int $id The value of the primary key
     * @return false if the object is not found, otherwise an instance of the class in question
     */
    public function getById($id){
        // Connect to the database
        $db = self::connect();
        // Create a string containing the SQL query to execute
        $sql = "SELECT * FROM {$this->table} where {$this->clePrimaire} = $id";
        try{
            $resultat = $db->query($sql); // Execute the SQL query
            if($resultat->rowCount() == 1){
                $record = $resultat->fetchObject();
                return $record;
            }
            else{
                return false;
            }
        }
        catch(PDOException $ex){
            die($ex->getMessage());
        }
        finally{
            // Free resources
            $resultat->closeCursor();
        }
    }

    /**
     * Delete a record by its unique identifier (primary key)
     *
     * @param int $id The value of the primary key
     * @return int Number of rows affected by the query
     */
    public function delete($id){
        // Connect to the database
        $db = self::connect();
        // Create a string containing the SQL query to execute
        $sql = "DELETE FROM {$this->table} WHERE {$this->clePrimaire} = $id";
        try{
            $resultat = $db->exec($sql);
            return $resultat;
        }
        catch(PDOException $ex){
            die($ex->getMessage());
        }
    }

     /**
     * insert record
     *
     * @param array $ligne Tableau associatif representant l'enregistrement à insérer
     * @return int Identifiant de la dernière ligne insérée
     */
    public function insert($ligne){
        // Se connecter à la base de données
        $db = self::connect();
        // Créer une chaîne de caractère contenant la requête à exécuter
        $sql = "INSERT INTO ".$this->table." (";
        foreach($ligne as $key=>$value){
            $sql .= $key. ",";
        }
        $sql = rtrim($sql, ",") . ") VALUES (";
        foreach($ligne as $key=>$value){
            $sql .= ":" . $key. ",";
        }
        $sql = rtrim($sql, ",") . ")";
        $requete = $db->prepare($sql);
        foreach($ligne as $key=>$value){
            $requete->bindValue(":".$key, $value);
        }
        try{
            $resultat = $requete->execute();
            if($resultat){
                $db->exec($sql); // Execute the INSERT statement
                $lastInsertId = $db->query('SELECT LAST_INSERT_ID()')->fetchColumn(); // Retrieve the last inserted ID
                return $lastInsertId;
                //return $db->lastInsertId();
            }
            else{
                return false;
            }
        }
        catch(PDOException $ex){
            die($ex->getMessage());
        }
    }


    /**
     * Modify record
     *
     * @param array $ligne Tableau associatif representant l'enregistrement à remplacer
     * @param int $id clé primaire de la ligne à modifier
     * @return int Nombre de ligne affectées par la la requête
     */
    public function update($ligne, $id){
        // Créer une chaîne de caractère contenant la requête à exécuter
        $sql = "UPDATE {$this->table} SET ";
        foreach($ligne as $key=>$value){
            $sql .= $key . " = :" . $key . ",";
        }
        $sql = rtrim($sql, ",") . " WHERE " . $this->clePrimaire . " = :" . $this->clePrimaire;
        $requete = oci_parse($this->conn, $sql);
        foreach($ligne as $key=>$value){
            oci_bind_by_name($requete, ":" . $key, $ligne[$key]);
        }
        oci_bind_by_name($requete, ":" . $this->clePrimaire, $id);
        try{
            $resultat = oci_execute($requete);
            if($resultat){
                $sequence = "{$this->table}_{$this->clePrimaire}_seq";
                $id_sequence = oci_parse($this->conn, "SELECT {$sequence}.CURRVAL FROM DUAL");
                oci_execute($id_sequence);
                $row = oci_fetch_array($id_sequence, OCI_ASSOC);
                return $row["CURRVAL"];
            }
            else{
                return false;
            }
        }
        catch(PDOException $ex){
            die($ex->getMessage());
        }
    }
}
?>