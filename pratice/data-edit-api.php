<?php
require __DIR__ . '/parts/connect_db.php';

$output = [
    'success' => false, // 是否修改成功
    'error' => '', // 錯誤訊息
    'code' => 0,
    'postData' => $_POST,
];

// 必填欄位沒填會回傳 error
// 記得加 sid
if(empty($_POST['sid']) or empty($_POST['name']) or empty($_POST['email'])) {
    $output['error'] = '欄位資料不足';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// TODO: 欄位資料要驗證

// 如果時間的字串無法轉換成 timestamp, 表示格式錯誤
if(strtotime($_POST['birthday'])===false){
    $birthday = null;
} else {
    $birthday = date('Y-m-d', strtotime($_POST['birthday']));
}

$sql = "UPDATE `address_book` SET 
`name`=?,
`email`=?,
`mobile`=?,
`birthday`=?,
`address`=?
WHERE `sid`=?";
// 不用改 create at

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['name'],
    $_POST['email'],
    $_POST['mobile'],
    $birthday,
    $_POST['address'],
    $_POST['sid']
]);

if($stmt->rowCount()){ // $stmt->rowCount() > 1 就是 true
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改';
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);

/*
echo json_encode([
    $stmt->rowCount(), //拿來測試用  // 影響的資料筆數
    $pdo->lastInsertId(), // 最新的新增資料的主鍵
]);
*/
// 影響的資料筆數
