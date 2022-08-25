<?php
session_start(); // 記得加

// session_destroy() // 清除用戶的所有 SESSION 資料

unset($_SESSION['user1']);

header('Location: 39.login.php');

exit; // 結束程式，底下的程式都不會執行，如果下面沒其他程式的話可不加
// die('oops!');  // 同 exit
