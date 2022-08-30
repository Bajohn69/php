<?php
require __DIR__ . '/parts/connect_db.php';
$pageName = 'list'; // 頁面名稱

$perPage = 4;  // 每頁最多有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$cate = isset($_GET['cate']) ? intval($_GET['cate']) : 0; // 沒有的話就回到全部分類
$lowp = isset($_GET['lowp']) ? intval($_GET['lowp']) : 0;  // Lower price
$highp = isset($_GET['highp']) ? intval($_GET['highp']) : 0; // Higher price

$qsp = []; // query string parameters

// 取得分類資料，把第 0 層的找出來
$cates = $pdo->query("SELECT * FROM categories WHERE parent_sid=0")->fetchAll();


// ------------------------------------商品

$where = ' WHERE 1 '; // 起頭
if ($cate) {
    $where .= " AND category_sid=$cate "; // sql 前後都要加空格
    $qsp['cate'] = $cate;
}
if ($lowp) {
    $where .= " AND price>=$lowp "; // sql 前後都要加空格
    $qsp['lowp'] = $lowp;
}
if ($highp) {
    $where .= " AND price<=$highp "; // sql 前後都要加空格
    $qsp['highp'] = $highp;
}

// 取得資料的總筆數
$t_sql = " SELECT COUNT(1) FROM products $where ";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage); // 無條件進位

$rows = [];
// 有資料才執行
if ($totalRows > 0) {
    if ($page < 1) {
        header('Location: ?page=1');
        exit;
    }
    if ($page > $totalPages) {
        header('Location: ?page=' . $totalPages);
        exit;
    }
    // 取得該頁面的資料
    $sql = sprintf(
        "SELECT * FROM `products` %s ORDER BY `sid` DESC LIMIT %s, %s",
        $where,
        ($page - 1) * $perPage,
        $perPage
    );
    $rows = $pdo->query($sql)->fetchAll();
}

/*
echo json_encode([
    'totalRows' => $totalRows,
    'totalPages' => $totalPages,
    'perPage' => $perPage,
    'page' => $page,
    'rows' => $rows,
]);

exit; // 拿來測試
*/
?>
<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/navbar.php'; ?>

<div class="container">
    <!-- 分類按鈕 -->
    <div class="row my-3">
        <div class="col">
            <?php $allBtnStyle = empty($cate) ? 'btn-primary' : 'btn-outline-primary' ?>
            <!-- 只有全部分類要 unset -->
            <a type="button" class="btn <?= $allBtnStyle ?>" href="?
            <?php
            $tmp = $qsp; //複製
            unset($tmp['cate']);
            unset($tmp['lowp']);
            unset($tmp['highp']);
            echo http_build_query($tmp); ?>">全部</a>
            <?php foreach ($cates as $c) :
                $btnStyle = $c['sid'] == $cate ? 'btn-primary' : 'btn-outline-primary' ?>
                <a type="button" class="btn <?= $btnStyle ?>" href="?
                <?php
                $tmp['cate'] = $c['sid']; //你打錯
                echo http_build_query($tmp); ?>">
                    <?= $c['name'] ?>
                </a>
            <?php endforeach ?>
        </div>
    </div>
    <!-- 價格區間 -->
    <div class=" row my-3">
        <div class="col">
            <?php $btnStyle = (!$lowp && $highp == 400) ? 'btn-primary' : 'btn-outline-primary'  ?>
            <a type="button" class="btn <?= $btnStyle ?>" href="?
            <?php
            $tmp = $qsp;  // 複製
            unset($tmp['lowp']);
            $tmp['highp'] = 400;
            echo http_build_query($tmp); ?>">~400</a>

            <?php $btnStyle = ($lowp == 400 && $highp == 500) ? 'btn-primary' : 'btn-outline-primary'  ?>
            <a type="button" class="btn <?= $btnStyle ?>" href="?
            <?php $tmp['lowp'] = 400;
            $tmp['highp'] = 500;
            echo http_build_query($tmp); ?>">400~500</a>

            <?php $btnStyle = ($lowp == 500 && !$highp) ? 'btn-primary' : 'btn-outline-primary'  ?>
            <a type="button" class="btn <?= $btnStyle ?>" href="?
            <?php unset($tmp['highp']);
            $tmp['lowp'] = 500;
            echo http_build_query($tmp); ?>">500~</a>
        </div>
    </div>
    <!-- 頁碼 -->
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?php $qsp['page'] = $page - 1;
                                                    echo http_build_query($qsp); ?>">
                            <i class="fa-solid fa-circle-arrow-left"></i>
                        </a>
                    </li>
                    <?php for ($i = $page - 2; $i <= $page + 2; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                            $qsp['page'] = $i;
                    ?>
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                <a class="page-link" href="?<?= http_build_query($qsp); ?>"><?= $i ?>
                                </a>
                            </li>
                    <?php endif;
                    endfor; ?>
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?php $qsp['page'] = $page + 1;
                                                    echo http_build_query($qsp); ?>">
                            <i class="fa-solid fa-circle-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row">
        <?php foreach ($rows as $r) : ?>
            <div class="col-lg-3">
                <div class="card">
                    <img src="./imgs/big/<?= $r['book_id'] ?>.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $r['bookname'] ?></h5>
                        <p class="card-text"><?= $r['author'] ?></p>
                        <p class="card-text"><?= $r['price'] ?></p>
                        <p>
                            <select class="form-select">
                                <?php for ($i = 1; $i <= 10; $i++) : ?>
                                    <option value="<?= $i ?>">
                                        <?= $i ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </p>
                        <p>
                            <button class="btn btn-warning" data-sid=<?= $r['sid'] ?> onclick="addToCart(event)">
                                買
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
    function addToCart(event) {
        const btn = $(event.currentTarget);
        const qty = btn.closest('.card-body').find('select').val();
        const sid = btn.attr('data-sid');

        console.log({
            sid,
            qty
        });

        $.get(
            'handle-cart.php',
            {sid, qty},
            function(data){
                console.log(data);
                showCartCount(data);
            },
            'json');
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>