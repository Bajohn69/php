<style>
    .navbar-nav .nav-link.active {
        background-color: #9999FF;
        border-radius: 10px;
        color: white;
        font-weight: 600;
    }

    /* 注意權重 */
</style>
<div class="container">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'home' ? 'active' : '' ?>" href="37.combine.php">Home</a>
                        <!-- 判斷當前頁面會不會亮 -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'list' ? 'active' : '' ?>" href="product-list.php">商品列表</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'cart' ? 'active' : '' ?>" href="cart.php">
                            購物車
                            <span class="badge rounded-pill text-bg-danger" id="cartCount"></span>
                        </a>
                        
                    </li>

                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['user'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" >
                                <?= $_SESSION['user']['nickname'] ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">登出</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">登入</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">註冊</a>
                        </li>
                    <?php endif; ?>

                </ul>

            </div>
        </div>
    </nav>
</div>

<script>
    // 按了加入購物車會改變購物車數量，用迴圈加總
    function showCartCount(obj){
        let count = 0;
        for(let k in obj){ // k 是 primary key，k 可以自己決定名稱
            const item = obj[k];
            count += +item.qty; // + 是讓字串轉型
        }
        $('#cartCount').html(count);
    }

    // 為了讓網頁一進來就呈現購物車數量
    // 每進來一次 nav bar 就會用 ajax 
    $.get(
    'handle-cart.php', // 先不用給 qty
    function(data){
    showCartCount(data);
    },
    'json');
    
</script>