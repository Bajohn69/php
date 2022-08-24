<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/navbar.php'; ?>
<div class="container">

</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">登入</h5>

                <form method="post">
                    <div class="mb-3">
                        <label for="account" class="form-label">帳號</label>
                        <input type="text" class="form-control" id="account" name="account">
                        
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">密碼</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <button type="submit" class="btn btn-primary">登入</button>
                </form>


            </div>
        </div>
        <div>
            <?php
                if(!empty($_POST)){
                    print_r($_POST);
                }
            ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/scripts.php'; ?>
<?php include __DIR__ . '/parts/html-foot.php'; ?>