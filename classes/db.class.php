<?php
 class DB{

     public static function connect($db_host, $db_user, $db_password, $db_database = null): mysqli
    {
        $conn = new mysqli($db_host, $db_user, $db_password, $db_database);
        if(!$conn)
            echo $conn->error;
        return $conn;
    }
}

