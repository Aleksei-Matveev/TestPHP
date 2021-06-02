<?php
final class  Paginator{

    private $columnName = Array();
    private  $body = Array();
    private  $countPages;

    /**
    * @return int возращает общее количество страниц
    */
    public  function getCountPages(): int
    {
        return $this->countPages;
    }

    /**
     * Функция пагинатора предназначена для получения данных в виде страницы с определенным количеством записей
     * @param PDO $conn Принимает экзкмпляр, представляющий подключение к серверу MySQL
     * @param string $database Название базы данных для получения данных
     * @param string $table Название таблицы для получения данных
     * @param int $page Параметр задает номер страницы
     * @param int $limit Параметр задает количество записей на странице
     * @return string структура ответа в формате JSON:
     * структура ответа в формате JSON:
     *{
     *"status": "Число 1, если ОК, или 0, если ошибка",
     *"error": "Описание ошибки, или пустая строка",
     *"data": {
     *"head" :[ ],
     *"body" [ [ ], [ ] ] } }
     */
    public function pagination(PDO $conn, string $database, string $table, int $page = 1, int $limit = 0): string
    {
        $error  = "";
        $status = 1;


#region check page and limit
        if($page < 1) {
            $page = 1;
            $error .= "Страницы с таким индексом не существует! PAGE установлен в значение 1. ";
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

        $query = sprintf("SELECT `COLUMN_NAME`FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='%s'", $table);
        $stmt = $conn->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch())
            $this->columnName[] = $row['COLUMN_NAME'];

        $query = sprintf("SELECT * FROM $database.$table LIMIT %d , $limit", ($page - 1) * $limit);
        $stmt = $conn->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_NUM))
            $this->body[] = $row;

        $this->countPages = count($this->body);

        $data['head'] = $this->columnName;
        $data['body'] = $this->body;

        return json_encode(["status" => $status, "error" => $error, "data" => $data], JSON_UNESCAPED_UNICODE);
    }
}