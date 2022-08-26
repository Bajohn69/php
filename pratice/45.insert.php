
<?php
require __DIR__ . '/parts/connect_db.php';

$sql = "INSERT INTO `address_book`(
    `name`,
    `email`, 
    `mobile`, 
    `birthday`, 
    `address`, 
    `created_at`
    ) VALUES(
        '巴巴',
        '88888@gmail.com',
        '0956060982',
        '1994-06-09',
        '新北勢',
        NOW()
        -- 最後一個不用加逗號
    )";

$stmt = $pdo->query($sql);
echo $stmt->rowCount(); //拿來測試用
// 影響的資料筆數
