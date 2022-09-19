<?php
require __DIR__ . '/parts/connect_db.php';

// 沒有登入或購物車沒有東西就回到商品列表
if(empty($_SESSION['user']) or empty($_SESSION['cart'])){
    header('Location: product-list.php');
}

$total = 0;
foreach($_SESSION['cart'] as $k=>$v){
    $total += $v['price'] * $v['qty'];
}

$o_sql = sprintf("INSERT INTO `orders`(
    `member_sid`, `amount`, `order_date`
    )VALUES(%s, %s, NOW())", $_SESSION['user']['id'], $total);

$stmt = $pdo->query($o_sql);

/*
echo json_encode([
    'rowCount: '=>$stmt->rowCount(),
    'lastInsertId: '=>$pdo->lastInsertId(), // primary key
]);

exit;
*/
$order_sid = $pdo->lastInsertId(); // 訂單編號

// 訂單明細
$od_sql = "INSERT INTO `order_details`(`order_sid`, `product_sid`, `price`, `quantity`) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($od_sql);

foreach($_SESSION['cart']as $k=>$v){
    $stmt->execute([
        $order_sid,
        $v['sid'],
        $v['price'],
        $v['qty'],
    ]);
}

unset($_SESSION['cart']); // 清除購物車內容

?>

<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/navbar.php'; ?>

<div class="container">
    <h1>
        感謝訂購
    </h1>
</div>


<?php include __DIR__ . '/parts/scripts.php'; ?>
<?php include __DIR__ . '/parts/html-foot.php'; ?>