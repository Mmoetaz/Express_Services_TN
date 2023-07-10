<?php
/**
 * Configuration de la base de données
 */
class Database {
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
}

?>
