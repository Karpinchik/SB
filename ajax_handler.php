<?php
require_once "data_db.php";

$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false
];
$pdo = new PDO($dsn, $user, $password, $opt);

$text = $_POST['data'];     // получаю введеный текс
//$text = 'Веб Компоненты - это набор различных технологий, позволяющих создавать собственные переиспользуемые элементы - со своей функциональностью, инкапсулированной от остального кода - и использовать их в ваших веб-приложениях.';     // получаю введеный текс
$count_words = $_POST['count'];

$stop_arr = [".", ",", ":", "-", "–", "\n ", "\r", '”', "!", "?", "“"," (", ")"];    // стоп-лист (малая версия)
$res_1 = mb_strtolower(str_ireplace($stop_arr, "", $text));    // строка после спот-листа
$res_2 = explode(" ", $res_1);   // собрал массив из оставшихся после стоп-листа слов
foreach ($res_2 as $item=>$i) {
    if(strlen($i) < 6) unset($res_2[$item]);
}

$res_3 = [];

function filter($item, $key)
{
    global $res_2, $res_3;
    foreach ($res_2 as $i) {
        if(!empty($i)) {
            similar_text($item, $i, $percent);
            if($percent >= 79){
                $res_3[$item][] = $percent . "   " . $i . '  '  .  $item;
            }
        }
    }
}
array_walk_recursive($res_2, 'filter');

foreach ($res_3 as $item=>$i) {
    $res_3[$item] = count($i);
}

foreach ($res_3 as $item=>$i) {
    if($i < $count_words) unset($res_3[$item]);
}

//    записываю в базу
foreach($res_3 as $key=>$value)
{
    $sql = "INSERT INTO words(word, count, about) VALUES ( :word, :count, :about)";
    $stmt = $pdo->prepare($sql);
    $params = [':word' => $key, ':count' => $value, ':about' => 'karpin'];
    $stmt->execute($params);
}
arsort($res_3);
$result = json_encode($res_3);  // отправляю результат на js
echo $result;






























