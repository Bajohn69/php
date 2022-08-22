<pre>
    <?php
    $arr=[]; // 有說明的用意, 不是必要的
    for($i=0;$i<=20;$i++){
        $arr[] = $i;  // array push
    }

    shuffle($arr); // 亂數排序
    print_r($arr);
    ?>
</pre>