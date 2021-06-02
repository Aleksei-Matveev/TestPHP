<?php
    require_once('../config/database.php');
    require_once ('../entity/pc.php');

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    if($_SERVER['REQUEST_METHOD'] === 'GET') {

        $database = new Database();

        $db = $database->getConnection('computers');
        $pc = new PC($db);

        $criteria = $_GET ?? array();

        $stmt = $pc->read($criteria);
        $num =$stmt->rowCount();

        if($num > 0){

            $pc_arr = array();
            $pc_arr['records'] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);

                $pc_item = array(
                    'speed'=>$speed,
                    'ram'=>$ram,
                    'hdd'=>$hdd,
                    'price'=>$price
                );

                array_push($pc_arr['records'], $pc_item);
            }

            http_response_code(200);

            echo json_encode($pc_arr, JSON_UNESCAPED_UNICODE);
        }
        else{
            http_response_code(404);

            echo json_encode(["message"=>"Не найдено"], JSON_UNESCAPED_UNICODE);
        }
    }

