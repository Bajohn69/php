<?php
require __DIR__. '/parts/connect_db.php';

$sql = "SELECT * FROM address_book"; //用雙引號

$stmt = $pdo->query($sql);
// statement

// $row = $stmt->fetch(PDO::FETCH_NUM); // 讀取一筆, 索引式陣列
// $row = $stmt->fetch(PDO::FETCH_ASSOC); // 讀取一筆, 關聯式陣列
$row = $stmt->fetch(); // 從 'parts/connect_db.php' 那邊設定

echo json_encode($row);

