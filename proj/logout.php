<?php
session_start(); // 記得加

// session_destroy() // 清除用戶的所有 SESSION 資料

unset($_SESSION['user']);

$comeFrom = 'login.php';
if(! empty($_SERVER['HTTP_REFERER'])){
    $comeFrom = $_SERVER['HTTP_REFERER'];
}

header('Location: '. $comeFrom);


