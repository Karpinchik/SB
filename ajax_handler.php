<?php
require_once "data_db.php";

$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false
];
$pdo = new PDO($dsn, $user, $password, $opt);

$text = $_POST['data'];     // получаю введеный текс
$count_words = $_POST['count'];

$stop_arr = [".", ",", ":", "-", "/n", "/r"];    // стоп-лист (малая версия)
$res_1 = mb_strtolower(str_ireplace($stop_arr, "", $text));    // строка после спот-листа
$res_2 = (explode(" ", $res_1));   // собрал массив из оставшихся после стоп-листа слов

$res_3 =[];       // собираю новый массив с подсчитаными повторениями
foreach($res_2 as $key=>$value) {
    if($value === '' ) $value = 0;           // заменяю пустые значения на 0
        $res_3[$value] = substr_count($text, $value);
}

//  $res_3 это на данном этапе резултар работы основного алгоритма. В котором использыется всего лишь стандартная функция
//  поиска одинаковых слов.
foreach($res_3 as $key=>$value){
    if($value < $count_words) unset($res_3[$key]);
}
arsort($res_3);


//    записываю в базу
foreach($res_3 as $key=>$value)
{
    $sql = "INSERT INTO words(word, count, about) VALUES ( :word, :count, :about)";
    $stmt = $pdo->prepare($sql);
    $params = [':word' => $key, ':count' => $value, ':about' => 'karpin'];
    $stmt->execute($params);
}


$result = json_encode($res_3);  // отправляю результат на js
echo $result;








