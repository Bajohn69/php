<?php
require __DIR__ . '/parts/connect_db.php';
$pageName = 'list'; // 頁面名稱
$title = '資料列表';


$perPage = 20;  // 每頁最多有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// 取得資料的總筆數
$t_sql = "SELECT COUNT(1) FROM address_book";
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
    $sql = sprintf("SELECT * FROM `address_book` ORDER BY `sid` DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
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

// $sql = "SELECT * FROM address_book"; //用雙引號

// $stmt = $pdo->query($sql);
// $row = $stmt->fetchAll(); 
// // 合成下面那一條
// $rows = $pdo->query($sql)->fetchAll();

?>

<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/navbar.php'; ?>

<div class="container">
    <!-- 頁碼 -->
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
    <!-- 頁碼 end -->

    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">
                            <i class="fa-solid fa-trash-can"></i>
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">mobile</th>
                        <th scope="col">birthday</th>
                        <th scope="col">address</th>
                        <th scope="col">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td>
                                <a href="javascript: removeItem(<?= $r['sid'] ?>)" >
                                <!-- onclick="event.currentTarget.closest('tr').remove()" 從前端刪除，但重整之後還是看得到 -->
                                    <i class="text-danger fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td><?= $r['mobile'] ?></td>
                            <td><?= $r['birthday'] ?></td>
                            <td><?= htmlentities($r['address'])  ?></td>
                            <!-- 防止爛芭樂攻擊 (XSS) -->
                            <!-- <td><?= strip_tags($r['address'])  ?></td> -->
                            <td>
                                <a href="data-edit.php?sid=<?= $r['sid'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>
        </div>
    </div>

</div>

<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
    function removeItem(sid){
        if(confirm(`是否要刪除編號為 ${sid} 的資料?`)){
            location.href = `data-del.php?sid=${sid}`
        }
    }
    // 跳通知，確認才刪除
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>