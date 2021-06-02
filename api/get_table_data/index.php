<?php

require_once ('../config/database.php');
require_once ('../classes/paginator.class.php');


$page = $_GET['page'] ?? 1; //если page не существует задаем значение 1
$limit = $_GET['limit'] ?? 0 ; //если limit не существует, задаем значение 0.

$pages = new Paginator();
$database = new Database();

$json_result = $pages->pagination($database->getConnection('test'), 'test', "test", $page, $limit);

header('Content-Type: application/json;charset=utf-8');
header("Content-Disposition: inline; filename=table_json.json");

echo $json_result;