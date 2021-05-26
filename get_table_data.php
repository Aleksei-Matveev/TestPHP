<?php
    require_once('config.php');
    spl_autoload_register(function ($class) {
        include 'classes/' . $class . '.class.php';
    });

    $conn = DB::connect(DB_HOST, DB_USER, DB_PASSWORD);

    $page = $_GET['page'] ?? 1; //если page не существует задаем значение 1
    $limit = $_GET['limit'] ?? 0; //если limit не существует, задаем значение 0.


    $json_result = Paginator::pagination($conn, DB_DATABASE, "test", $page, $limit);



    header('Content-Type: application/json;charset=utf-8');
    header("Content-Disposition: inline; filename=table_json.json");

    echo $json_result;

