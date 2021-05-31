<?php
    require_once('../config.php');

    $page = $_GET['page'] ?? 1; //если page не существует задаем значение 1
    $limit = $_GET['limit'] ?? 0 ; //если limit не существует, задаем значение 0.

    $pages = new Paginator();
    $json_result = $pages->pagination(DB::getInstance('test'), 'test', "test", $page, $limit);

    header('Content-Type: application/json;charset=utf-8');
    header("Content-Disposition: inline; filename=table_json.json");

    echo $json_result;

