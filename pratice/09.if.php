<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $age = isset($_GET['age']) ? intval($_GET['age']) : 0;

        // if 改寫
        if($age >= 18):
        ?>
            <h2>歡迎光臨</h2>
            <img src="../img/558.jpg" alt="">

        <?php
        else:
        ?>
            <h2>以後再來</h2>
            <img src="../img/98fc8863c7e68df57cd7ad7442f0ec18.jpg" alt="">
        <?php
        endif;
        ?>
</body>
</html>