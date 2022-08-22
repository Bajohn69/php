<?php
// query string
// isset() 判斷是不是有設定
// intval() 把字串轉換為整數

$a = isset($_GET['a']) ? intval($_GET['a']) : 0;
$b = isset($_GET['b']) ? intval($_GET['b']) : 0;

echo $a + $b;