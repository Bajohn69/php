<?php
require __DIR__ . '/parts/connect_db.php';

// 防止 SQL injection 隱碼攻擊

$sql = "INSERT INTO `address_book`(
    `name`,
    `email`, 
    `mobile`, 
    `birthday`, 
    `address`, 
    `created_at`
    ) VALUES(
        ?,
        ?,
        ?,
        ?,
        ?,
        NOW()
        -- 先挖五個祕密的洞
    )";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    "巴巴's 女友",
    '88888@gmail.com',
    '0956060982',
    '1994-06-09',
    '新北勢',
]);

echo json_encode([
    $stmt->rowCount(), //拿來測試用  // 影響的資料筆數
    $pdo->lastInsertId(), // 最新的新增資料的主鍵
]);

