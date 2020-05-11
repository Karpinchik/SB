<?php
//require_once "src/common.php";
//
//$opts = array(
//    'storage' => PHPMORPHY_STORAGE_FILE,
//    'with_gramtab' => false,
//    'predict_by_suffix' => true,
//    'predict_by_db' => true
//);
//$dir = 'dicts';
//$dict_bundle = new phpMorphy_FilesBundle($dir, 'rus');
//try {
//    $morphy = new phpMorphy($dict_bundle, $opts);
//} catch(phpMorphy_Exception $e) {
//    die('Error occured while creating phpMorphy instance: ' . $e->getMessage());
//}
//
//$text = 'элементам элемента элементам строка cстро строки после после стоп стоп дом дома стоп).';
//$stop_arr = [".", ",", ":", "–", "\n ", "\r", '”', "!", "?", "“"," (", ")"];    // стоп-лист (малая версия)
//$res_1 = mb_strtoupper(str_ireplace($stop_arr, "", $text));    // строка после спот-листа
//$res_2 = explode(" ", $res_1);   // собрал массив из оставшихся после стоп-листа слов
//
//
//$res = [];
//foreach ($res_2 as $item=>$value){
//    $res[$value] = $morphy->getPseudoRoot($value, $type = phpMorphy::NORMAL);     // получаю словообразующие формы каждого слова в тексте
//}
//
//foreach ($res as $item=>$value){
//    $res[$item] = $value[0];
//}
//
//$res_3 = [];
//function filter($item, $key)
//{
//    global $res, $res_3;
//    foreach ($res as $i) {
//        if(!empty($i)) {
//            similar_text($item, $i, $percent);
//            if($percent >= 79){
//                $res_3[$item][] = $percent . "   " . $i . '  '  .  $item;
//            }
//        }
//    }
//}
//array_walk_recursive($res_2, 'filter');
//
//foreach ($res_3 as $item=>$i) {
//    $res_3[$item] = count($i);
//}
//
//arsort($res_3);
//print_r($res_2);
//
//
//
//
//
//
