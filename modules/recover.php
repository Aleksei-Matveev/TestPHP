<!--<!doctype html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport"-->
<!--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->
<!--    <meta http-equiv="X-UA-Compatible" content="ie=edge">-->
<!--    <title>Document</title>-->
<!--</head>-->
<!--<body>-->
<?php

require_once("config.php");

//if(isset($_FILES["filename"])){

//$query='';
//if ($_FILES && $_FILES["filename"]["error"]== UPLOAD_ERR_OK)
//{
//$name = $_FILES["filename"]["name"];
//
//move_uploaded_file($_FILES["filename"]["tmp_name"], $name);
//echo "Файл загружен <br>";
//$query = file_get_contents($name);
//}
//else echo "файл не загружен<br>";

$con = DB::getInstance('user');

$res = $con->query('Select * from user');



while ($row = $res->fetch_assoc()){
    $result[] = $row;
}


echo "<PRE>";
    print_r($result);
echo "</PRE>";





//$conn = DB::getInstance();



?>

<!--<form method="POST"   enctype="multipart/form-data">-->
<!--    <label>Выберите файл</label>-->
<!--    <p><input type="file" name="filename"></p>-->
<!--    <p><input type="submit" value="отправить"></p>-->
<!--</form>-->
<!--</body>-->
<!--</html>-->
