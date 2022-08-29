<?php
require __DIR__ . '/parts/connect_db.php';
$pageName = 'list'; // 頁面名稱

$perPage = 4;  // 每頁最多有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// 取得資料的總筆數
$t_sql = "SELECT COUNT(1) FROM products";
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
    $sql = sprintf("SELECT * FROM `products` ORDER BY `sid` DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
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
    <div class="row">
        <div class="col">
        <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= $page == 1 ? 'disabled': ''?>">
                        <a class="page-link" href="?page=<?= $page-1  ?>">
                            <i class="fa-solid fa-circle-arrow-left"></i>
                        </a>
                    </li>
                    <?php for($i=$page - 2; $i<=$page + 2;$i++):
                        if($i >= 1 and $i<= $totalPages):
                    ?>
                    <li class="page-item <?= $page==$i ? 'active' : ''?>">
                        <a class="page-link" href="?page=<?= $i ?>">
                            <?= $i ?>
                        </a>
                    </li>
                    <?php endif; endfor; ?>
                    <li class="page-item <?= $page == $totalPages ? 'disabled': ''?>">
                        <a class="page-link" href="?page=<?= $page+1  ?>">
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
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>