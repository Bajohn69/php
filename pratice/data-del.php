<?php

// echo $_SERVER['HTTP_REFERER']; // 人從哪裡來
// exit;

require __DIR__ . '/parts/connect_db.php';

if(isset($_GET['sid'])){
    $sid = intval($_GET['sid']);
    $sql = "DELETE FROM address_book WHERE sid = $sid";
    $pdo->query($sql);
}

// 不是空的就跳到原本的頁數，是空的就去第一頁
$comeFrom = `datalist.php`;
if(! empty($_SERVER['HTTP_REFERER'])){
    $comeFrom = $_SERVER['HTTP_REFERER'];
}

header('Location: '. $comeFrom);
