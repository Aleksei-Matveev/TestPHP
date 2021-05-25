<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
require_once ("db.php");
require_once ("config.php");
if(isset($_FILES["filename"])){

$query='';
if ($_FILES && $_FILES["filename"]["error"]== UPLOAD_ERR_OK)
{
$name = $_FILES["filename"]["name"];

move_uploaded_file($_FILES["filename"]["tmp_name"], $name);
echo "Файл загружен <br>";
$query = file_get_contents($name);
}
else echo "файл не загружен<br>";

//$array = split_sql($query);


//for ($i=0; $i<count($array); $i++){
//    $ar[] = str_replace('(', '',$array[$i]);
//}


//    echo "<PRE>";
//    var_dump($ar);
//    echo "</PRE";


    //echo $ar

//foreach ($ar as $item)
//    echo $item . "<br>";


$conn = DB::connect(DB_HOST, DB_USER, DB_PASSWORD);

if ($conn->connect_error) {
die("Ошибка подключения: " . $conn->connect_error . "<br>");
}

if ($conn->multi_query($query) === TRUE) {
echo "Успешно выполнен запрос<br>";
} else {
echo "<br>Ошибка создания базы данных: " . $conn->error . "<br>";
}

$conn->close();
}
?>

<form method="POST"   enctype="multipart/form-data">
    <label>Выберите файл</label>
    <p><input type="file" name="filename"></p>
    <p><input type="submit" value="отправить"></p>
</form>
</body>
</html>
