<?php
/*
 *Database Config information
 */
const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASSWORD = "";
spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});
