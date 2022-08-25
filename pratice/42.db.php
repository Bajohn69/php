<?php
require __DIR__. '/parts/connect_db.php';

$sql = "SELECT * FROM address_book"; //用雙引號

$stmt = $pdo->query($sql);

$row = $stmt->fetchAll(); // 讀取所有資料

header('Content-Type:application/json'); // 加這行是為了讓外掛正常運作(json view)
echo json_encode($row);

