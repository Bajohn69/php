<?php
session_start(); // 一定要初始化才能用$_session
// 這個檔案可以拿來除錯

echo json_encode($_SESSION);
?>
