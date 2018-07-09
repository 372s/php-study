<?php

require_once '../init.php';


// $arr = array(
//     array('a' => 1, 'b' => 4),
//     array('a' => 343, 'b' => 434),
//     array('a' => 6454, 'b' => 5),
//     array('a' => 7, 'b' => 9),
// );
// $psort = new Psort();
// $res = $psort->sortArr($arr, 'a');
// print_r($res);

// $data[] = array('volume' => 67, 'edition' => 2);
// $data[] = array('volume' => 86, 'edition' => 1);
// $data[] = array('volume' => 85, 'edition' => 6);
// $data[] = array('volume' => 98, 'edition' => 2);
// $data[] = array('volume' => 86, 'edition' => 6);
// $data[] = array('volume' => 67, 'edition' => 7);

// foreach ($data as $key => $row) {
//     $volume[$key]  = $row['volume'];
//     $edition[$key] = $row['edition'];
// }

// // 将数据根据 volume 降序排列，根据 edition 升序排列
// // 把 $data 作为最后一个参数，以通用键排序
// array_multisort($volume, SORT_DESC, $edition, SORT_ASC, $data);
// print_r($edition);