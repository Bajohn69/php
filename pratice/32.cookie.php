<?php

setcookie('my_cookie', 'Bajohn', time()+15); // 設定
// 第一次不會讀到是因為資料還沒到用戶端
// setcookie(名稱, 值, 過期時間)

echo $_COOKIE['my_cookie']; // 讀取
?>