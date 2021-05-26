<?php
 class DB{
     /**
      *
      * @staticvar int $columnName Количество страниц полученных в результате запроса к БД
      * @param db::$conn Возвращает объект, представляющий подключение к серверу MySQL
      * @param string $database Название базы данных для получения данных
      * @param string $table Название таблицы для получения данных
      * @param int $page Параметр задает номер страницы
      * @param int $limit Параметр задает количество записей на страницк
      */
     public static function connect($db_host, $db_user, $db_password, $db_database = null): mysqli
    {
        $conn = new mysqli($db_host, $db_user, $db_password, $db_database);
        if(!$conn)
            echo $conn->error;
        return $conn;
    }
}

