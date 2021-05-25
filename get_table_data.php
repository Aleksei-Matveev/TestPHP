<?php
    //error_reporting(0);
    require_once ('config.php');
    require_once('db.php');

    $error      = "";
    $status     = 1;

    if((( isset( $_GET['limit'] )) && ( isset( $_GET['page'] ) )) ){
        $limit      = $_GET['limit'];
        $page       = $_GET['page'];
    }else
    {
        $status = 0;
        $error  ="Не указан LIMIT. LIMIT установлен в значение 100";
        $limit      = 100;
        $page       = 1;
    }



    $conn       = DB::connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

    $query      = "SELECT * FROM test LIMIT " . (($page - 1) * $limit) . " , $limit";
    $result     = $conn->query($query);

    while ($row = $result->fetch_row())
        $body[] = $row;


    if(!isset($body)) {
        $status = 0;
        $error="Превышен допустимый LIMIT. LIMIT установлен в значение 100";
    }

    $query        = "SELECT `COLUMN_NAME`FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='test'";
    $result       = $conn->query($query);

    while ($row   = $result->fetch_assoc())
        $name[]   = $row['COLUMN_NAME'];

    $data['head'] = $name;
    $data['body'] = $body;
    header('Content-Type: application/json;charset=utf-8');
    header("Content-Disposition: inline; filename=table_json.json");

    echo json_encode(["status"=>$status, "error"=>$error, "data"=>$data], JSON_UNESCAPED_UNICODE);

