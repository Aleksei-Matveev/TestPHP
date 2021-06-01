<?php
    require_once ('../config.php');
    $method = $_SERVER['REQUEST_METHOD'];

    if($method === 'GET') {

        getPcFilters($_GET);
    }

    /**
     * @param $params
     */
    function getPcFilters($params)
    {

    $query = "SELECT * FROM pc ";
    $tmp ="";
    if(count($params))
        $query .= " WHERE ";

    if(isset($params['hddfrom'])) {
        if(empty(!$tmp))
            $tmp .= " AND ";
        $hddfrom = $params['hddfrom']??1;
        $hddto = $params['hddto'] ?? " (select max(hdd) from `pc` )";

        $tmp .= " hdd >= $hddfrom and hdd <= $hddto";
    }
    if(isset($params['speedfrom'])) {
        if(empty(!$tmp))
            $tmp .= " AND ";
        $speedfrom = $params['speedfrom']??1;
        $speedto = $params['speedto'] ?? " (select max(speed) from `pc` )";
        $tmp .= " speed >= $speedfrom and speed <= $speedto";
    }
    $query .= $tmp;
    echo $query;
    $conn = DB::getInstance('computers');

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc())
        $rows[]=$row;


    $json_result = json_encode($rows, JSON_UNESCAPED_UNICODE);

        header('Content-Type: application/json;charset=utf-8');
        header("Content-Disposition: inline; filename=table_json.json");

        echo $json_result;
}