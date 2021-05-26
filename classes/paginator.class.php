<?php
class Paginator{

    public static function pagination($conn, $page, $limit)
    {
        $error      = "";
        $status     = 1;

        if($page < 1) {
            $page = 1;
            $error      .=  "Такой страницы не существует! ";
            $status     = 0;
        }

        switch ($limit){
            case 0:{
                $status = 0;
                $error  .= "Не указан LIMIT. LIMIT установлен в значение 100. ";
                $limit = 100;
                break;
            }
            case 101:{
                $status = 0;
                $error .= "Превышен допустимый LIMIT. LIMIT установлен в значение 100. ";
                break;
            }
        }

        $query = "SELECT * FROM test LIMIT " . (($page - 1) * $limit) . " , $limit";
        $result = $conn->query($query);

        while ($row = $result->fetch_row())
            $body[] = $row;


        if (!isset($body)) {
            $status = 0;
            $error = "Страницы с таким номером не существует";
            $body[] = '';
        }

        $query = "SELECT `COLUMN_NAME`FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='test'";
        $result = $conn->query($query);

        while ($row = $result->fetch_assoc())
            $name[] = $row['COLUMN_NAME'];

        $data['head'] = $name;
        $data['body'] = $body;

        return json_encode(["status" => $status, "error" => $error, "data" => $data], JSON_UNESCAPED_UNICODE);
    }
}