<pre>
    <?php
    $ar = [2, 5, 7, 3, 17];

    foreach ($ar as $v) { //因為這邊只是把值放進來而已
        $v++;
    }

    print_r($ar); //[2, 5, 7, 3, 17]

    foreach ($ar as &$v) { //這邊類似參照
        $v++;
    }

    print_r($ar); //[3, 6, 8, 4, 18]

    ?>
</pre>