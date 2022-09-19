<?php
require __DIR__ . '/parts/connect_db.php';
$pageName = 'cart'; // 頁面名稱
?>

<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/navbar.php'; ?>

<div class="container">
    <!-- 先判斷購物車內有沒有商品 -->
    <?php if (empty($_SESSION['cart'])) : ?>
        <div class="alert alert-danger" role="alert">
            購物車內沒有商品
        </div>
    <?php else : ?>
        <div class="row">
            <div class="col">
                <table class="table table-striped table-bordered cart-table">
                    <thead>
                        <tr>
                            <th>
                                <i class="fa-solid fa-trash-can"></i>
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">封面</th>
                            <th scope="col">書名</th>
                            <th scope="col">價格</th>
                            <th scope="col">數量</th>
                            <th scope="col">小計</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['cart'] as $k => $v) :
                            $total += $v['price'] * $v['qty'] //計算總價 
                        ?>

                            <tr data-sid="<?= $k ?>" class="cart-item">
                                <td>
                                    <a href="javascript:" onclick="removeItem(event)">
                                        <i class="text-danger fa-solid fa-trash-can"></i>
                                    </a>
                                    <!-- <i class="fa-solid fa-trash-can"></i> -->
                                </td>
                                <td><?= $k ?></td>
                                <td>
                                    <img src="imgs/small/<?= $v['book_id'] ?>.jpg" alt="<?= $v['bookname'] ?>">
                                </td>
                                <td><?= $v['bookname'] ?></td>
                                <td class="price" data-val="<?= $v['price'] ?>"></td>
                                <td>
                                    <select class="form-select qty" onchange="updateItem(event)">
                                        <?php for ($i = 1; $i <= 10; $i++) : ?>
                                            <option value="<?= $i ?>" <?= $i == $v['qty'] ? 'selected' : '' ?>>
                                                <?= $i ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </td>
                                <td class="sub-total"></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
        <div class="alert alert-success" role="alert">
            <span>總計: </span><span id="total-price"></span> 元
        </div>
        <div>
            <?php if(empty($_SESSION['user'])): ?>
                <div class="alert alert-danger" role="alert"></div>
            <?php else: ?>
                <a href="buy.php" class="btn btn-warning">結帳</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>


<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
    // 數字加逗點
    const dollarCommas = function(n){
        return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    };

    function removeItem(event) {
        const tr = $(event.currentTarget).closest('tr');
        const sid = tr.attr('data-sid');


        $.get(
            'handle-cart.php', {
                sid
            },
            function(data) {
                console.log(data);
                showCartCount(data); // 購物車總數量
                tr.remove();
                // TODO: 總計
                updatePrices(); // 刪除後就要呼叫函式
            }, 'json');
    }

    function updateItem(event) {
        const sid = $(event.currentTarget).closest('tr').attr('data-sid');
        const qty = $(event.currentTarget).val();

        $.get(
            'handle-cart.php', {
                sid,
                qty
            },
            function(data) {
                console.log(data);
                showCartCount(data); // 購物車總數量
                // TODO: 更新小計, 總計
                updatePrices(); // 更新後就要呼叫函式
            }, 'json');
    }

    function updatePrices() { // 更改數量就會更新價格
        let total = 0; // 總價
        $('.cart-item').each(function() {
            const tr = $(this);
            const td_price = tr.find('.price');
            const td_sub = tr.find('.sub-total');

            const price = +td_price.attr('data-val');
            const qty = +tr.find('.qty').val();

            td_price.html('$ ' + dollarCommas(price)); // + 是轉型
            td_sub.html('$ ' + dollarCommas(price * qty));
            total += price * qty;
        });
        $('#total-price').html('$ '+ dollarCommas(total));

    }
    updatePrices(); // 一進頁就要執行一次
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>