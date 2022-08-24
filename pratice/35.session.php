<?php
session_start(); // 一定要初始化才能用$_session

if(! isset($_SESSION['my'])){
    $_SESSION['my'] = 1;
}else{
    $_SESSION['my']++;
}
// 若網頁沒有 session 就會給一個 1 
// 有的話每次重整就會 +1

$_SESSION['my_data'] = [
    'name' => 'Baj',
    'age' => 28,
    'data' => [1, 3, 9]
];

// 透過瀏覽器的 application 可以把 PHPSESSID 刪掉
echo $_SESSION['my'];
?>
