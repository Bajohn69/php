<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(empty($_POST)): ?>
    <form name="form1" method="post">
        <!-- 預設是 get 不要用 get -->
        <input type="text" name="account" placeholder="帳號" autocomplete="off">
        <br>
        <input type="password" name="password" placeholder="密碼">
        <br>
        <button>送出</button>
    </form>
    <?php else: ?>
        <pre>
    <?php print_r($_POST) ?>
        </pre>
    <?php endif ?>
</body>
</html>