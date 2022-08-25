<?php

$db_host = 'localhost';
$db_user = 'Bajohn';
$db_pass = 'AdminBajohn69';
$db_name = 'mytest';

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8"; 
// data source name
// 雙引號!!!

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];//設定 fetch mode

try{
    $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
} catch(PDOException $ex) {
    echo "Exception:" . $ex->getMessage(); // 錯誤會發什麼訊息
}


