<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border='2'>
    <?php for($i=1;$i<10;$i++): ?>
        <tr>
            <?php for($k=1;$k<10;$k++): ?>
                <td><?= sprintf("%s * %s = %s", $i, $k, $i*$k) ?></td>
            <?php endfor ?>
        </tr>
    <?php endfor ?>
    </table>
    <div><?= sprintf("%X", 255) ?></div>
</body>
</html>