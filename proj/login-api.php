<?php

require __DIR__ . '/parts/connect_db.php';

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
];

// 1. 先檢查欄位資料是否足夠
if(empty($_POST['email']) or empty($_POST['password'])){ // empty 跟 isset 差別，empty 範圍較廣
    $output['error'] = '參數不足';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
}

$sql = "SELECT * FROM members WHERE email=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([ $_POST['email'] ]);
$row = $stmt->fetch();

// 2. 以 email 去查詢資料
if(empty($row)){ // 若 email 是錯的，後端會讀不到資料 = empty($row)
    $output['error'] = '帳號或密碼錯誤';
    $output['code'] = '400';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// 3. 驗證密碼
// $_POST['password'] 使用者填的
// $row['password']) 後端資料 (hash 過的)
if(password_verify($_POST['password'], $row['password'])){
    $output['success'] = true;
    $_SESSION['user'] = [ // 要跟 login.php 那隻的 user 名字一樣
        'id' => $row['id'],
        'email' => $row['email'],
        'nickname' => $row['nickname'],
    ];
} else {
    // 密碼是錯誤的
    $output['error'] = '帳號或密碼錯誤';
    $output['code'] = 420;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);