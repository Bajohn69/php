<?php
require __DIR__. '/parts/connect_db.php';

$sql = "SELECT * FROM address_book"; //用雙引號

$stmt = $pdo->query($sql);

while($row = $stmt->fetch()){
    echo "<div>{$row['name']}: {$row['email']}</div>";
}
// 一筆一筆讀取，沒資料 = false 就會離開迴圈

