<?php
class Database {

    // укажите свои учетные данные базы данных
    private $host = "localhost";
    private $db_name ;
    private $username = "root";
    private $password = "";
    public $conn;

    // получаем соединение с БД

    /**
     * @param $dbName Параметр принимает название базы данных
     * @return PDO|null Возвращает объект PDO в случае успеха подключения к БД
     */
    public function getConnection($dbName): ?PDO
    {
        $this->conn = null;
        $this->db_name = $dbName;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}