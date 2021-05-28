<?php

 final class DB{
     private static  $instance;

     private function __construct($database){

             self::$instance = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, $database);
     }
     public static function getInstance($database): mysqli
     {
        if(!isset(self::$instance)) new DB($database);
        return self::$instance;
     }
 }