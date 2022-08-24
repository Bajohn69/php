<?php
$ar = [
    'name' => '哈囉',
    'age' => 30,
    'data' => '/abc',
    'data1' => [2, 4, 6, 8],
];

echo json_encode($ar, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
// 給中文字跟斜線轉換用


?>