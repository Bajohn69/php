<?php include __DIR__ . 'parts/html-head.php'; ?>
<?php include __DIR__ . 'parts/navbar.php'; ?>

<div class="container">
    <h1>
        Hello
    </h1>
</div>

<!-- 
    include 包含檔案進來 
    找不到檔案會 warning 但底下來是可以執行

    require 包含檔案進來
    找不到會 error
    資料庫建議用這個
-->


<?php include __DIR__ . 'parts/script.php'; ?>
<?php include __DIR__ . 'parts/html-foot.php'; ?>