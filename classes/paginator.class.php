<?php
final class  Paginator
{
    private static $columnName = Array();
    private static $body = Array();
    private static $countPages;
    private function __construct()
    {
    }

    /**
    * @return mixed
    */
    public static function getCountPages()
    {
        return self::$countPages;
    }

    public static function pagination($conn, $database, $table, $page, $limit)
    {
        $error  = "";
        $status = 1;

#region check page and limit
        if($page < 1) {
            $page = 1;
            $error .= "Страницы с нулевым индексом не существует! PAGE установлен в значение 1. ";
            $status = 0;
        }
        if($limit == 0 ) {
            $status = 0;
            $error .= "Не указан LIMIT. LIMIT установлен в значение 100. ";
            $limit = 100;
        }
        if($limit > 100) {
            $status = 0;
            $error .= "Превышен допустимый LIMIT. LIMIT установлен в значение 100. ";
            $limit = 100;
        }
#endregion

        $query = "SELECT * FROM $database.$table LIMIT " . (($page - 1) * $limit) . " , $limit";
        $result = $conn->query($query);

        while ($row = $result->fetch_row())
            self::$body[] = $row;

        self::$countPages = count(self::$body);

        if (!self::$body) {
            $status = 0;
            $error = "Страницы с таким номером не существует";
            self::$body = '';
        }

        $query = "SELECT `COLUMN_NAME`FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='". $table . "'";
        $result = $conn->query($query);

        while ($row = $result->fetch_assoc())
            self::$columnName[] = $row['COLUMN_NAME'];

        $data['head'] = self::$columnName;
        $data['body'] = self::$body;

        return json_encode(["status" => $status, "error" => $error, "data" => $data], JSON_UNESCAPED_UNICODE);
    }





}